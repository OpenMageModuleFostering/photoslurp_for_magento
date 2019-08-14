<?php

class Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId("pswidget_tabs");
        $this->setDestElementId("edit_form");
        $this->setTitle(Mage::helper("pswidget")->__("Widget information"));
    }

    protected function _beforeToHtml()
    {
        $this->addTab("form_section", array(
            "label" => Mage::helper("pswidget")->__("Configuration"),
            "title" => Mage::helper("pswidget")->__("Configuration"),
            "content" => $this->getLayout()->createBlock("pswidget/adminhtml_pswidget_edit_tab_form")->toHtml(),
        ));

        $this->addTab("form_section1", array(
            "label" => Mage::helper("pswidget")->__("Style parameters"),
            "title" => Mage::helper("pswidget")->__("Style parameters"),
            "content" => $this->getLayout()->createBlock("pswidget/adminhtml_pswidget_edit_tab_form1")->toHtml(),
        ));

        $this->addTab("form_section2", array(
            "label" => Mage::helper("pswidget")->__("Custom CSS"),
            "title" => Mage::helper("pswidget")->__("Custom CSS"),
            "content" => $this->getLayout()->createBlock("pswidget/adminhtml_pswidget_edit_tab_form2")->toHtml(),
        ));

        $this->addTab("form_section3", array(
            "label" => Mage::helper("pswidget")->__("Advanced parameters"),
            "title" => Mage::helper("pswidget")->__("Advanced parameters"),
            "content" => $this->getLayout()->createBlock("pswidget/adminhtml_pswidget_edit_tab_form3")->toHtml(),
        ));
        return parent::_beforeToHtml();
    }

}
