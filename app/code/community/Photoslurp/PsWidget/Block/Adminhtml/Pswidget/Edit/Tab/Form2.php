<?php
class Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Edit_Tab_Form2 extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

			$form = new Varien_Data_Form();
			$this->setForm($form);
			$fieldset = $form->addFieldset("pswidget_form", array("legend"=>Mage::helper("pswidget")->__("Custom CSS")));

            $fieldset->addField("style_custom", "textarea", array(
                "label" => Mage::helper("pswidget")->__("Custom CSS"),
                "name" => "style_custom",
				'after_element_html' => '<i>Enter your custom CSS code here. Only requires dot notation with !important flag. Eg: .galleria-info-product-description { margin-top:50px !important }</i>'

			));

			if (Mage::getSingleton("adminhtml/session")->getPswidgetData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getPswidgetData());
					Mage::getSingleton("adminhtml/session")->setPswidgetData(null);
				}
				elseif(Mage::registry("pswidget_data")) {
				    $form->setValues(Mage::registry("pswidget_data")->getData());
				}
				return parent::_prepareForm();
		}
}
