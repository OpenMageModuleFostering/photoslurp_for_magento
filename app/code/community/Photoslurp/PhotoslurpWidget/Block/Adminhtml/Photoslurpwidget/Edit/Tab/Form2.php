<?php
class Photoslurp_PhotoslurpWidget_Block_Adminhtml_Photoslurpwidget_Edit_Tab_Form2 extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

			$form = new Varien_Data_Form();
			$this->setForm($form);
			$fieldset = $form->addFieldset("photoslurpwidget_form", array("legend"=>Mage::helper("photoslurpwidget")->__("Custom CSS")));

            $fieldset->addField('style_custom_enable', 'select', array(
                'label' => Mage::helper('photoslurpwidget')->__('Overwrite Default'),
                'values' => Photoslurp_PhotoslurpWidget_Block_Adminhtml_Photoslurpwidget_Grid::getValueArrayYesNo(),
                'name' => 'style_custom_enable',
                'after_element_html' => '<i>For further customization of the actual widgets, we recommend you overwrite the default widget CSS styles with your own</i>'
            ));

            $fieldset->addField("style_custom", "textarea", array(
                "label" => Mage::helper("photoslurpwidget")->__("Your Own CSS"),
                "name" => "style_custom"
            ));

			if (Mage::getSingleton("adminhtml/session")->getPhotoslurpwidgetData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getPhotoslurpwidgetData());
					Mage::getSingleton("adminhtml/session")->setPhotoslurpwidgetData(null);
				}
				elseif(Mage::registry("photoslurpwidget_data")) {
				    $form->setValues(Mage::registry("photoslurpwidget_data")->getData());
				}
				return parent::_prepareForm();
		}
}
