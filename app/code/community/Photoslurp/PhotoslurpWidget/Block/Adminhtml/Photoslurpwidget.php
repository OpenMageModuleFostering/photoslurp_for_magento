<?php


class Photoslurp_PhotoslurpWidget_Block_Adminhtml_Photoslurpwidget extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_photoslurpwidget";
	$this->_blockGroup = "photoslurpwidget";
	$this->_headerText = Mage::helper("photoslurpwidget")->__("Photoslurp Widget Manager");
	$this->_addButtonLabel = Mage::helper("photoslurpwidget")->__("Add New Item");
	parent::__construct();
	
	}

}