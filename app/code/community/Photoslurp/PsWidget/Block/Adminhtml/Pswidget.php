<?php


class Photoslurp_PsWidget_Block_Adminhtml_Pswidget extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_pswidget";
	$this->_blockGroup = "pswidget";
	$this->_headerText = Mage::helper("pswidget")->__("Photoslurp Widget Manager");
	$this->_addButtonLabel = Mage::helper("pswidget")->__("Add New Item");
	parent::__construct();
	
	}

}