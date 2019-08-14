<?php
class Photoslurp_PhotoslurpWidget_Model_Cron{

    private $delimiter = '|';

	public function photoslurpExport(){//cron
        if (Mage::getStoreConfig('export/export_configuration/cron_enable')){
            $this->export();
        }
	}

    public function manualExport(){
        $this->export();
    }

    private function export(){
        $collection = Mage::getResourceModel('catalog/product_collection')
            ->addAttributeToFilter('visibility',array("neq"=>1)) //except not visible individually
            ->addAttributeToSelect('image')
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('price');

        $headers = array();
        $headers[] = 'sku';
        $currencyCodes = Mage::app()->getStore()->getAvailableCurrencyCodes(true);
        foreach ($currencyCodes as $code){
            $headers[] = 'price_'.$code;
        }

        $headers[] = 'image_url';

        $rows = array();
        foreach ($collection as $product) {
            $rows[$product->getId()]= array();
            $rows[$product->getId()][] = $product->getSku();

            $baseCurrencyCode = Mage::app()->getStore()->getBaseCurrencyCode();
            foreach ($currencyCodes as $code){
                $rows[$product->getId()][] = $this->convertPrice($product->getPrice(),$baseCurrencyCode,$code)  ;
            }

            $rows[$product->getId()][] = $product->getImageUrl();
        }

        $stores = Mage::app()->getStores();

        foreach ($stores as $store) {
            $headers[] = 'title_'.$store->getCode();
            $headers[] = 'description_'.$store->getCode();
            $headers[] = 'url_'.$store->getCode();

            $collection = Mage::getResourceModel('catalog/product_collection')
                ->addAttributeToFilter('visibility',array("neq"=>1)) //except not visible individually
                ->setStoreId($store->getId())
                ->addAttributeToSelect('name')
                ->addAttributeToSelect('description');

            foreach ($collection as $product){
                $product->setStoreId($store->getId());
                $rows[$product->getId()][] = $product->getName();
                $rows[$product->getId()][] = $product->getDescription();
                $rows[$product->getId()][] = $product->getProductUrl();
            }
        }

        $filename = Mage::helper('photoslurpwidget')->getFileName();
        $fp = fopen($filename, 'w');

        fputcsv($fp, $headers, $this->delimiter);
        foreach ($rows as $row){
            fputcsv($fp, $row, $this->delimiter);
        }

        fclose($fp);
    }

    private function convertPrice($price,$from,$to){
        return Mage::helper('directory')->currencyConvert($price, $from, $to);
    }
}