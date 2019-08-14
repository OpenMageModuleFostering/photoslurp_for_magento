<?php
class Photoslurp_PsWidget_Block_Widget extends Mage_Core_Block_Template{

    protected $_product = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('pswidget/widget.phtml');
    }

    public function getProduct()
    {
        if (!$this->_product) {
            $this->_product = Mage::registry('product');
        }
        return $this->_product;
    }

    public function getWidget(){

        if ($this->getData('page_type') == 'product') {
            $_widget = Mage::getModel('pswidget/pswidget')->getCollection()
                        -> addFilter($field='widget_enable', $value= '1')
                        -> addFilter($field='page_type', $value = '2')
                        -> addFilter($field='position', $value = $this->getPosition())
                        -> getFirstItem();
        } else {
            $_widget = Mage::getModel('pswidget/pswidget')->getCollection()
                        -> addFilter($field='id', $value = $this->getData('id'))
                        -> addFilter($field='widget_enable', $value='1')
                        -> getFirstItem();
        }

        return $_widget;
    }

    public function getAllWidgets()
    {
        return Mage::getModel('pswidget/pswidget')->getCollection()
            -> addFilter($field='widget_enable', $value='1');
    }

	public function getLangValue($id_widget, $id_lang, $field){
			return Mage::getModel("pswidget/pswidgetlang")->getCollection()
			-> addFilter('id_widget', $id_widget)
			-> addFilter('id_lang', $id_lang)
			-> getFirstItem()
				->getData($field);
	}

    public function prepareStyleText($text, $id)
    {
        $cssModified = '';
        $pattern = '/[^{}]*{(?:[^{}]+|(?R))*}/';
        preg_match_all($pattern, $text, $cssBlocks);
        foreach($cssBlocks[0] as $cssBlock) {
            $cssBlock = trim($cssBlock);
            preg_match('/[^{}]*{/', $cssBlock, $selector);
            $cssBlockModified = "\n$cssBlock";
            $cssModified .= $cssBlockModified;
        }
        return $cssModified;
    }
}