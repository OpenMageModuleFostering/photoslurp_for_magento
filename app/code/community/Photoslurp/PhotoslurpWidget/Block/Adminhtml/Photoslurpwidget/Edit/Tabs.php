<?php

class Photoslurp_PhotoslurpWidget_Block_Adminhtml_Photoslurpwidget_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId("photoslurpwidget_tabs");
        $this->setDestElementId("edit_form");
        $this->setTitle(Mage::helper("photoslurpwidget")->__("Widget information"));
    }

    protected function _beforeToHtml()
    {
        $this->addTab("form_section", array(
            "label" => Mage::helper("photoslurpwidget")->__("Configuration"),
            "title" => Mage::helper("photoslurpwidget")->__("Configuration"),
            "content" => $this->getLayout()->createBlock("photoslurpwidget/adminhtml_photoslurpwidget_edit_tab_form")->toHtml(),
        ));

        $this->addTab("form_section1", array(
            "label" => Mage::helper("photoslurpwidget")->__("Style parameters"),
            "title" => Mage::helper("photoslurpwidget")->__("Style parameters"),
            "content" => $this->getLayout()->createBlock("photoslurpwidget/adminhtml_photoslurpwidget_edit_tab_form1")->toHtml(),
        ));

        $this->addTab("form_section2", array(
            "label" => Mage::helper("photoslurpwidget")->__("Custom CSS"),
            "title" => Mage::helper("photoslurpwidget")->__("Custom CSS"),
            "content" => $this->getLayout()->createBlock("photoslurpwidget/adminhtml_photoslurpwidget_edit_tab_form2")->toHtml(),
        ));
        return parent::_beforeToHtml();
    }

}
