<?php

class Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Edit_Tab_Form3 extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
		$stores = Mage::app()->getStores();
		$stores_count = count($stores);


        $form = new Varien_Data_Form();
        $this->setForm($form);
		$fieldset2 = $form->addFieldset("pswidget_form_additional", array("legend" => Mage::helper("pswidget")->__("Advanced parameters")));

//		advanced section
		$fieldset2->addField("autoscroll_limit", "text", array(
			"label" => Mage::helper("pswidget")->__("Autoscroll Limit"),
			"name" => "autoscroll_limit",
			'after_element_html' => '<i>The number of pages to load before showing a Load More button. Leave blank for infinite scroll</i>'
		));

		$i = 0;
		foreach($stores as $store){
			if ($i == 0) {
				$fieldset2->addField("load_more_text_".$store->getId(), "text", array(
					"label" => Mage::helper("pswidget")->__("Load More Text"),
					"name" => "load_more_text_".$store->getId(),
					"class" => "load_more_text",
					'after_element_html' => '<br><b>['.$store->getCode().']</b>'

				));
			} else if ($i == $stores_count - 1) {
				$fieldset2->addField("load_more_text_".$store->getId(), "text", array(
					"name" => "load_more_text_".$store->getId(),
					"class" => "load_more_text",
					'after_element_html' => '<br><b>['.$store->getCode().']</b>'. '<br><i>Related to the autoscrollLimit parameter, this parameter relates to the text that will be displayed on the Load More button</i>'
				));
			}else{
				$fieldset2->addField("load_more_text_".$store->getId(), "text", array(
					"name" => "load_more_text_".$store->getId(),
					"class" => "load_more_text",
					'after_element_html' => '<br><b>['.$store->getCode().']</b>'

				));
			}
			$i++;
		};

		$fieldset2->addField('enable_ga', 'select', array(
			'label' => Mage::helper('pswidget')->__('Enable GA'),
			'values' => Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getValueArrayYesNo(),
			'name' => 'enable_ga',
			'after_element_html' => '<i>Enable Google Analytics. When this is enabled, all events collected from Photoslurp widgets will also be sent to the Google analytics property already configured on your website</i>'
		));

		$fieldset2->addField("init_delay", "text", array(
			"label" => Mage::helper("pswidget")->__("Init Delay"),
			"name" => "init_delay",
			'after_element_html' => '<i>In cases where other page elements end up interfering with the Photoslurp widget, a millisecond value can be set here to delay it’s loading and prevent interference</i>'
		));

		$i = 0;
		foreach($stores as $store){
			if ($i == 0) {
				$fieldset2->addField("cta_button_".$store->getId(), "text", array(
					"label" => Mage::helper("pswidget")->__("CTA Button"),
					"name" => "cta_button_".$store->getId(),
					"class" => "cta_button",
					'after_element_html' => '<br><b>['.$store->getCode().']</b>'

				));
			} else if ($i == $stores_count - 1) {
				$fieldset2->addField("cta_button_".$store->getId(), "text", array(
					"name" => "cta_button_".$store->getId(),
					"class" => "cta_button",
					'after_element_html' => '<br><b>['.$store->getCode().']</b>'. '<br><i>The text to be placed on a CTA button in the lightbox underneath the product image. Blank disables button</i>'
				));
			}else{
				$fieldset2->addField("cta_button_".$store->getId(), "text", array(
					"name" => "cta_button_".$store->getId(),
					"class" => "cta_button",
					'after_element_html' => '<br><b>['.$store->getCode().']</b>'

				));
			}
			$i++;
		};

		$fieldset2->addField('social_count', 'select', array(
			'label' => Mage::helper('pswidget')->__('Social Count'),
			'values' => Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getValueArrayYesNo(),
			'name' => 'social_count',
			'after_element_html' => '<i>Yes will show the number of likes and comments for each image in the lightbox when user hovers over it</i>'
		));

		$fieldset2->addField('thumb_overlay', 'select', array(
			'label' => Mage::helper('pswidget')->__('Thumb Overlay'),
			'values' => Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getValueArrayYesNo(),
			'name' => 'thumb_overlay',
			'after_element_html' => '<i>Enable mouseover effect on thumbnails in Gallery mode showing author details</i>'
		));

		$fieldset2->addField('varying_thumb_sizes', 'select', array(
			'label' => Mage::helper('pswidget')->__('Varying Thumb Sizes'),
			'values' => Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getValueArrayYesNo(),
			'name' => 'varying_thumb_sizes',
			'after_element_html' => '<i>Enable varying sized thumbnails in Gallery mode</i>'
		));

		$fieldset2->addField('auto_scroll_carousel', 'select', array(
			'label' => Mage::helper('pswidget')->__('Auto Scroll Carousel'),
			'values' => Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getValueArrayYesNo(),
			'name' => 'auto_scroll_carousel',
			'after_element_html' => '<i>Enable auto scrolling of images in carousel mode</i>'
		));

		$fieldset2->addField('one_photo_per_line', 'select', array(
			'label' => Mage::helper('pswidget')->__('One Photo Per Line'),
			'values' => Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getValueArrayYesNo(),
			'name' => 'one_photo_per_line',
			'after_element_html' => '<i>When enabled, ensures that only one photo per line is shown in Gallery mode on mobile</i>'
		));

		$fieldset2->addField("analytics_cookie_ttl", "text", array(
			"label" => Mage::helper("pswidget")->__("Analytics Cookie TTL"),
			"name" => "analytics_cookie_ttl",
			'after_element_html' => '<i>Sets the TTL (in days) of the cookie we set on user’s browsers for their interactions to count towards our conversion analytics</i>',
			'value'=>30
		));

		$fieldset2->addField("submission_form_css_url", "text", array(
			"label" => Mage::helper("pswidget")->__("Use a custom CSS file for the frontend uploader"),
			"name" => "submission_form_css_url",
			'after_element_html' => '<i>Enter a custom CSS URL here to change the look and feel of the frontend uploader</i>'
		));

		$fieldset2->addField('strict_products', 'select', array(
			'label' => Mage::helper('pswidget')->__('Strict Products'),
			'values' => Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getValueArrayYesNo(),
			'name' => 'strict_products',
			'after_element_html' => '<i>Ensures that product related photos are shown first, followed by all other photos in the campaign. Note: This parameter will overwrite allowEmpty</i>'
		));

		$fieldset2->addField('empty_threshold', 'select', array(
			'label' => Mage::helper('pswidget')->__('Empty Threshold'),
			'values' => Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getValueArrayYesNo(),
			'name' => 'empty_threshold',
			'after_element_html' => '<i>Set a threshold of the minimum number of product related images that should exist before showing our carousel</i>'
		));

		$fieldset2->addField('in_stock_only', 'select', array(
			'label' => Mage::helper('pswidget')->__('In Stock Only'),
			'values' => Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getValueArrayYesNo(),
			'name' => 'in_stock_only',
			"value" => 0,
			'after_element_html' => '<i>Only returns photos to products that are in stock. Feature needs to be enabled for your account</i>'
		));

		$fieldset2->addField('rights_cleared_only', 'select', array(
			'label' => Mage::helper('pswidget')->__('Rights Cleared Only'),
			'values' => Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getValueArrayYesNo(),
			'name' => 'rights_cleared_only',
			"value" => 0,
			'after_element_html' => '<i>Only return photos for which media rights have been granted</i>'
		));

		$fieldset2->addField('assigned_only', 'select', array(
			'label' => Mage::helper('pswidget')->__('Assigned Only'),
			'values' => Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getValueArrayYesNo(),
			'name' => 'assigned_only',
			"value" => 0,
			'after_element_html' => '<i>Only return photos that have products associated with them</i>'
		));

		$fieldset2->addField('visible_products', 'text', array(
			'label' => Mage::helper('pswidget')->__('Visible Products'),
			'name' => 'visible_products',
			'class' => 'validate-digits-range digits-range-2-6',
			'after_element_html' => '<i>Accepts a number between 2-6</i>'
		));

		$fieldset2->addField("collections", "text", array(
			"label" => Mage::helper("pswidget")->__("Collections"),
			"name" => "collections",
			'after_element_html' => '<i>Enter the name of one or more collections to filter results by</i>'
		));

		$fieldset2->addField('cookie_domain', 'text', array(
			'label' => Mage::helper('pswidget')->__('Cookie Domain'),
			'name' => 'cookie_domain',
			'after_element_html' => '<i>If specified all widget cookies will be set on given domain</i>'
		));

		$fieldset2->addField('bundled_jquery', 'select', array(
			'label' => Mage::helper('pswidget')->__('Bundled jQuery'),
			'values' => Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getValueArrayYesNo(),
			'name' => 'bundled_jquery',
			"value" => 0,
			'after_element_html' => '<i>Use the jQuery bundled version of our widget if you are not using jQuery or if we are unable to detect jQuery on your page</i>'
		));

		$fieldset2->addField("additional_params", "textarea", array(
			"label" => Mage::helper("pswidget")->__("Additional Params"),
			"name" => "additional_params"
		));

        if (Mage::getSingleton("adminhtml/session")->getPswidgetData()) {
            $form->setValues(Mage::getSingleton("adminhtml/session")->getPswidgetData());
            Mage::getSingleton("adminhtml/session")->setPswidgetData(null);
        } elseif (Mage::registry("pswidget_data")) {

			$values = Mage::registry("pswidget_data")->getData();

			if(Mage::registry("pswidget_translations")){
				foreach (Mage::registry("pswidget_translations") as $translation){
					$widget_lang_data = $translation->getData();
					$form_data['cta_button_'.$widget_lang_data['id_lang']] = $widget_lang_data['cta_button'];
					$form_data['load_more_text_'.$widget_lang_data['id_lang']] = $widget_lang_data['load_more_text'];
					$values = array_merge($values, $form_data);
				}
			}

			if (!empty($values)) {
				$form->setValues($values);
			}
		}
        return parent::_prepareForm();
    }
}
