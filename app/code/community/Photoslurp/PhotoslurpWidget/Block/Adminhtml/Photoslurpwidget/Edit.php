<?php
	
class Photoslurp_PhotoslurpWidget_Block_Adminhtml_Photoslurpwidget_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "id";
				$this->_blockGroup = "photoslurpwidget";
				$this->_controller = "adminhtml_photoslurpwidget";
				$this->_updateButton("save", "label", Mage::helper("photoslurpwidget")->__("Save Item"));
				$this->_updateButton("delete", "label", Mage::helper("photoslurpwidget")->__("Delete Item"));

				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("photoslurpwidget")->__("Save And Continue Edit"),
					"onclick"   => "saveAndContinueEdit()",
					"class"     => "save",
				), -100);



				$this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');
							}
						";
		}

		public function getHeaderText()
		{
				if( Mage::registry("photoslurpwidget_data") && Mage::registry("photoslurpwidget_data")->getId() ){

				    return Mage::helper("photoslurpwidget")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("photoslurpwidget_data")->getId()));

				} 
				else{

				     return Mage::helper("photoslurpwidget")->__("Add Item");

				}
		}
}