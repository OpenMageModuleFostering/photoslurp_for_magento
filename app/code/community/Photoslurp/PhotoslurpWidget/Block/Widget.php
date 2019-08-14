<?php
class Photoslurp_PhotoslurpWidget_Block_Widget extends Mage_Core_Block_Template{

    protected $_product = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('photoslurpwidget/widget.phtml');
    }

    public function getProduct()
    {
        if (!$this->_product) {
            $this->_product = Mage::registry('product');
        }
        return $this->_product;
    }

    public function getWidget(){

        return  $this->_widget = Mage::getModel('photoslurpwidget/photoslurpwidget')->getCollection()
                -> addFilter($field='id', $value = $this->getData('id'))
                -> addFilter($field='widget_enable', $value='1')
                -> getFirstItem();
    }

    public function getProductPageWidget()
    {
        return  $this->_widget = Mage::getModel('photoslurpwidget/photoslurpwidget')->getCollection()
            -> addFilter($field='widget_enable', $value='1')
            -> addFilter($field='page_type', $value='2')
            -> getFirstItem();
    }

    public function getAllWidgets()
    {
        return  $this->_widget = Mage::getModel('photoslurpwidget/photoslurpwidget')->getCollection()
            -> addFilter($field='widget_enable', $value='1');
    }

    public function getIsFacebookIconEnabled()
    {
        if (in_array(1, explode(",", $this->getWidget()->getNoteAddPicsIcons()))) {
            return true;
        }
        return false;
    }

    public function getIsTwitterIconEnabled()
    {
        if (in_array(2, explode(",", $this->getWidget()->getNoteAddPicsIcons()))) {
            return true;
        }
        return false;
    }

    public function getIsInstagramIconEnabled()
    {
        if (in_array(3, explode(",", $this->getWidget()->getNoteAddPicsIcons()))) {
            return true;
        }
        return false;
    }

    public function prepareStyleText($text, $id)
    {
        $cssModified = '';
        $pattern = '/[^{}]*{(?:[^{}]+|(?R))*}/';
        preg_match_all($pattern, $text, $cssBlocks);
        foreach($cssBlocks[0] as $cssBlock) {
            $cssBlock = trim($cssBlock);
            preg_match('/[^{}]*{/', $cssBlock, $selector);
            if(!preg_match('/^@/', $selector[0])) {
                $selectorModified = preg_replace(array('/,/', '/^/'), array(",\n#$id ", "\n#$id "), $selector[0]);
                $cssBlockModified = preg_replace("/$selector[0]/", $selectorModified, $cssBlock);
            }else{
                $cssBlockModified = "\n$cssBlock";
            }
            $cssModified .= $cssBlockModified;
        }
        return $cssModified;
    }
}