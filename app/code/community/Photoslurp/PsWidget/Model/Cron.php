<?php
class Photoslurp_PsWidget_Model_Cron{

    private $delimiter = '|';

    private $_productHelper = null;

    public function __construct()
    {
        $this->_productHelper = Mage::helper('catalog/product');
    }

    public function photoslurpExport(){//cron
        if (Mage::getStoreConfig('export/export_configuration/cron_enable')){
            $this->export(Mage::getStoreConfig('export/export_configuration/export_type'));
        }
    }

    public function manualExport($product_type){
        $this->export($product_type);
    }

    private function export($product_type){

        $filename = Mage::helper('pswidget')->findWritablePath();
        $fp = fopen($filename, 'w');

        if($fp != false){

            fwrite($fp, '# exported at ' . date('d-m-Y') . PHP_EOL);

            $websites = $this->getExportWebsites();

            $collection = Mage::getModel('catalog/product')->getCollection()
                ->joinTable('cataloginventory/stock_item', 'product_id=entity_id', array('stock_status' => 'is_in_stock'))
                ->addAttributeToSelect(array('image','price'), 'left')
                ->addAttributeToFilter('visibility',array("neq"=>1))
                ->addAttributeToFilter('status', 1)
                ->addWebsiteFilter($websites);

            $collection->getSelect()->columns(array('store_ids' => "GROUP_CONCAT(store.store_id)"));
            $collection->getSelect()->joinInner(array('store'=> Mage::getSingleton('core/resource')->getTableName('core/store')),"product_website.website_id=store.website_id");
            $collection->getSelect()->group('e.entity_id');

            if($product_type == 'simple'){
                $collection ->addAttributeToFilter('type_id', array('eq' => Mage_Catalog_Model_Product_Type::TYPE_SIMPLE));
            }

            if($product_type == 'parent'){
                $collection ->addAttributeToFilter('type_id', array('neq' => Mage_Catalog_Model_Product_Type::TYPE_SIMPLE));
            }

            $this->addProductStoreData($collection);

            $header = array("sku");
            $currency_codes = Mage::getModel('directory/currency')->getConfigAllowCurrencies();
            foreach ($currency_codes as $code){
                $header[] = 'price_'.$code;
            }
            $header[]='in_stock';
            $header[]='image_url';
            $stores = $this->getExportStores();
            foreach ($stores as $store){
                $language_code = Mage::getStoreConfig('general/locale/code', $store->getId()).'_'.$store->getId();
                $header[] = 'title_'.$language_code;
                $header[] = 'description_'.$language_code;
                $header[] = 'url_'.$language_code;
            }

            fputcsv($fp, $header, $this->delimiter);

            Mage::getSingleton('core/resource_iterator')->walk(
                $collection->getSelect(),
                array(array($this, 'productCallback')),
                array(
                    'fp' => $fp,
                    'stores'=> $stores,
                    'currency_codes' => $currency_codes,
                    'base_currency_code' => Mage::app()->getBaseCurrencyCode())
            );

            fclose($fp);

        }else{
            $errormsg = Mage::helper("pswidget")->__("Saving the export file (%s) on your server did not work. Please check your server's directory permissions.",$filename);
            Mage::log($errormsg, null, "photoslurp.log");
            Mage::throwException($errormsg);
        }
    }

    private function getExportWebsites(){
        $stores = $this->getExportStores();
        $websites = array();
        foreach($stores as $store){
            $websites[] = $store->getWebsiteId();
        }
        $websites = array_unique($websites);
        return $websites;
    }

    private function getExportStores(){
        $stores = array();
        if($storesExportEnabled = Mage::getStoreConfig('export/export_configuration/store_id')){
            $storesExportEnabled = explode(",", $storesExportEnabled);
            foreach($storesExportEnabled as $storeId){
                $stores[] = Mage::getModel('core/store')->load($storeId);
            }
        }else{
            $stores = Mage::app()->getStores();
        }

        foreach($stores as $store){
            $language_code = Mage::getStoreConfig('general/locale/code', $store->getId());
            $store->setLangCode($language_code);
        }

        return $stores;
    }

    private function addProductStoreData($collection){

        $stores = $this->getExportStores();

        foreach ($stores as $store){
            $storeId = $store->getId();
            $collection->joinAttribute('name_'.$storeId, 'catalog_product/name', 'entity_id', null, 'left',$storeId);
            $collection->joinAttribute('description_'.$storeId, 'catalog_product/description', 'entity_id', null, 'left',$storeId);
            $collection->joinAttribute('url_key_'.$storeId, 'catalog_product/url_key', 'entity_id', null, 'left',$storeId);
        }
    }

    public function productCallback($args){

        $product = Mage::getModel('catalog/product');
        $product->setData($args['row']);

        $insertData = array();

        $insertData['sku'] = $args['row']['sku'];

        $price = $args['row']['price'];
        foreach ($args['currency_codes'] as $code){
            $insertData['price_'.$code] = $this->convertPrice($price,$args['base_currency_code'],$code)  ;
        }

        $insertData['in_stock'] = ($args['row']['stock_status'])?'in stock':'out of stock';

        if($product->getImage() && ($product->getImage() != 'no_selection')){
            $insertData['image_url'] = Mage::getModel('catalog/product_media_config')->getMediaUrl($product->getImage());
        }else{
            $insertData['image_url'] = '';
        }

        $stores = $args['stores'];
        $productStores = explode(',',$product->getStoreIds());

        $pattern = '/"/';
        $replacement = '$0"';

        foreach($stores as $store){
            $langcode = $store->getLangCode().'_'.$store->getId();
            $isProductInStore = in_array($store->getId(), $productStores);
            $insertData['title_'.$langcode]         =  $isProductInStore ? sprintf('"%s"', preg_replace($pattern,$replacement,$args['row']['name_'.$store->getId()])) : '';
            $insertData['description_'.$langcode]   =  $isProductInStore ? sprintf('"%s"', preg_replace($pattern,$replacement,$args['row']['description_'.$store->getId()])) : '';
            $insertData['url_'.$langcode]           =  $isProductInStore ? $store->getBaseUrl() . $args['row']['url_key_'.$store->getId()].$this->_productHelper->getProductUrlSuffix($store->getId()) . '?___store=' . $store->getCode() : '';
        }

        fwrite ($args['fp'], implode($insertData, $this->delimiter) . PHP_EOL);
    }

    private function convertPrice($price,$from,$to){
        return Mage::helper('directory')->currencyConvert($price, $from, $to);
    }
}