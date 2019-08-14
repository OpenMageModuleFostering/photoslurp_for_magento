<?php

class Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
		$stores = Mage::app()->getStores();
		$stores_count = count($stores);


        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset("pswidget_form", array("legend" => Mage::helper("pswidget")->__("Configuration parameters")));

		$fieldset->addField('widget_enable', 'select', array(
            'label' => Mage::helper('pswidget')->__('Enable'),
            'values' => Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getValueArrayYesNo(),
            'name' => 'widget_enable',
            "class" => "required-entry",
            "required" => true,

        ));

		$fieldset->addField("user_name", "text", array(
			"label" => Mage::helper("pswidget")->__("User Name"),
			"class" => "required-entry",
			"required" => true,
			"name" => "user_name",
			'after_element_html' => "<br><i>Your Photoslurp user name</i>"
		));

//        $fieldset->addField("widget_container_id", "text", array(
//            "label" => Mage::helper("pswidget")->__("Widget Container Id"),
//            "class" => "required-entry",
//            "required" => true,
//            "name" => "widget_container_id",
//			'after_element_html' => "<i>Please choose a unique HTML container ID to hold the widget</i>"
//        ));

        $fieldset->addField("widget_id", "text", array(
            "label" => Mage::helper("pswidget")->__("Widget Id"),
            "class" => "required-entry",
            "required" => true,
            "name" => "widget_id",
            'after_element_html' => "<br><i>A unique identifier for each of the widgets you use on your website</i>"
        ));

		$fieldset->addField("album_id", "text", array(
			"label" => Mage::helper("pswidget")->__("Album Id"),
			"class" => "required-entry",
			"required" => true,
			"name" => "album_id",
			'after_element_html' => '<i>This is the ID number of your campaign</i>'
		));

        $fieldset->addField('widget_type', 'select', array(
            'label' => Mage::helper('pswidget')->__('Widget Type'),
            'values' => Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getValueArray5(),
            'name' => 'widget_type',
            "class" => "required-entry",
            "required" => true,
            'after_element_html' => '<i>This is either set to carousel or gallery depending on how you would like to display your pictures. Carousel has been specifically designed to be placed on your product pages, and Gallery to be used as a separate gallery page<i>'
        ));

		$fieldset->addField('page_type', 'select', array(
			'label' => Mage::helper('pswidget')->__('Page Type'),
			'values' => Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getValueArray10(),
			'name' => 'page_type',
			"class" => "required-entry",
			"required" => true,
			'after_element_html' => '<i>This parameter is used in analytics calculations</i>'
		));

		$fieldset->addField('position', 'select', array(
			'label' => Mage::helper('pswidget')->__('Position'),
			'values' => Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getValueArrayPosition(),
			'name' => 'position',
			"class" => "required-entry",
			"required" => true,
			'after_element_html' => '<i>Position on product page</i>'
		));

		$fieldset->addField("page_limit", "text", array(
			"label" => Mage::helper("pswidget")->__("Page Limit"),
			"class" => "required-entry",
			"required" => true,
			"name" => "page_limit",
			"value" => 15,
			'after_element_html' => '<i>The number of images to load per page for both the Gallery and Carousel modes</i>'
		));

		$fieldset->addField("toc_link", "text", array(
			"label" => Mage::helper("pswidget")->__("T&C Link for Frontend Uploader"),
			"required" => true,
			"name" => "toc_link",
			'after_element_html' => '<i>The link to your T&C page that users will have to agree to when uploading photos using the frontend uploader</i>',
		));

		$fieldset->addField('random_order', 'select', array(
			'label' => Mage::helper('pswidget')->__('Photo Order'),
			'values' => Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getValueArrayPhotoOrder(),
			'name' => 'random_order'
		));

		$fieldset->addField('allow_empty', 'select', array(
			'label' => Mage::helper('pswidget')->__('Allow Empty'),
			'values' => Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getValueArrayYesNo(),
			'name' => 'allow_empty',
			'after_element_html' => '<i>When set to no, this option will ensure that all photos are returned on product pages when a product does not have any photos associated with it</i>'
		));

        $fieldset->addField('show_submit', 'select', array(
            'label' => Mage::helper('pswidget')->__('Show Submit'),
            'values' => Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getValueArrayYesNo(),
            'name' => 'show_submit',
            'after_element_html' => '<i>This parameter will enable the frontend upload widget, and display a Submit button</i>'
        ));



		$i = 0;
		foreach($stores as $store){
			if ($i == 0) {
				$fieldset->addField("submit_text_".$store->getId(), "text", array(
					"label" => Mage::helper("pswidget")->__("Submit Text"),
					"name" => "submit_text_".$store->getId(),
					"class" => "submit_text",
					'after_element_html' => '<br><b>['.$store->getCode().']</b>'

				));
			} else if ($i == $stores_count - 1) {
				$fieldset->addField("submit_text_".$store->getId(), "text", array(
					"name" => "submit_text_".$store->getId(),
					"class" => "submit_text",
					'after_element_html' => '<br><b>['.$store->getCode().']</b>'. '<br><i>This is the text that will be displayed on the Submit button</i>'
				));
			}else{
				$fieldset->addField("submit_text_".$store->getId(), "text", array(
					"name" => "submit_text_".$store->getId(),
					"class" => "submit_text",
					'after_element_html' => '<br><b>['.$store->getCode().']</b>'

				));
			}
			$i++;
		};

		$i = 0;
		foreach($stores as $store){
			if ($i == 0) {
				$fieldset->addField("shop_this_look_text_".$store->getId(), "text", array(
					"label" => Mage::helper("pswidget")->__("Shop This Look Text"),
					"name" => "shop_this_look_text_".$store->getId(),
					"class" => "shop_this_look_text",
					'after_element_html' => '<br><b>['.$store->getCode().']</b>'

				));
			} else if ($i == $stores_count - 1) {
				$fieldset->addField("shop_this_look_text_".$store->getId(), "text", array(
					"name" => "shop_this_look_text_".$store->getId(),
					"class" => "shop_this_look_text",
					'after_element_html' => '<br><b>['.$store->getCode().']</b>'
				));
			}else{
				$fieldset->addField("shop_this_look_text_".$store->getId(), "text", array(
					"name" => "shop_this_look_text_".$store->getId(),
					"class" => "shop_this_look_text",
					'after_element_html' => '<br><b>['.$store->getCode().']</b>'

				));
			}
			$i++;
		};

        $fieldset->addField("add_photos_img", "text", array(
            "label" => Mage::helper("pswidget")->__("Add Photos Img"),
            "name" => "add_photos_img",
            'after_element_html' => '<i>This requires a URL to an image that will be displayed when there are no images yet in a particular album (for example when the productId parameter is used, and there are no photos for particular product yet). A banner inviting users to submit images is recommended to be used here</i>'
        ));

		$i = 0;
		foreach($stores as $store){
			if ($i == 0) {
				$fieldset->addField("note_add_pics_text_".$store->getId(), "text", array(
					"label" => Mage::helper("pswidget")->__("Note Add Pics Text"),
					"name" => "note_add_pics_text_".$store->getId(),
					'after_element_html' => '<br><b>['.$store->getCode().']</b>'

				));
			} else if ($i == $stores_count - 1) {
				$fieldset->addField("note_add_pics_text_".$store->getId(), "text", array(
					"name" => "note_add_pics_text_".$store->getId(),
					'after_element_html' => '<br><b>['.$store->getCode().']</b>'. '<br><i>This is the text to be added on the top of your Gallery or Carousel, and can be used to let your users know how they can add their own pictures</i>'
				));
			}else{
				$fieldset->addField("note_add_pics_text_".$store->getId(), "text", array(
					"name" => "note_add_pics_text_".$store->getId(),
					'after_element_html' => '<br><b>['.$store->getCode().']</b>'

				));
			}
			$i++;
		};

        $fieldset->addField('social_icons', 'select', array(
            'label' => Mage::helper('pswidget')->__('Social Icons'),
            'values' => Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getValueArrayYesNo(),
			'value' => 1,
            'name' => 'social_icons',
            'after_element_html' => '<i>Enable social icons in the lightbox to allow users to share pictures back to social networks</i>'
        ));

        $fieldset->addField("image_height", "text", array(
            "label" => Mage::helper("pswidget")->__("Image Height, px"),
            "class" => "required-entry",
            "required" => true,
            "name" => "image_height",
            "value" => 200,
            'after_element_html' => '<i>This is an option specific to the Carousel widget type, and sets the height of the thumbnail images and therefore the carousel</i>'
        ));

        $fieldset->addField("image_width", "text", array(
            "label" => Mage::helper("pswidget")->__("Image Width, px"),
            "class" => "required-entry",
            "required" => true,
            "name" => "image_width",
            "value" => 200,
            'after_element_html' => '<i>This option is specific to the Gallery widget type, and sets the width of each thumbnail in the Gallery view</i>'
        ));

        if (Mage::getSingleton("adminhtml/session")->getPswidgetData()) {
            $form->setValues(Mage::getSingleton("adminhtml/session")->getPswidgetData());
            Mage::getSingleton("adminhtml/session")->setPswidgetData(null);
        } elseif (Mage::registry("pswidget_data")) {

			$values = Mage::registry("pswidget_data")->getData();

			if(Mage::registry("pswidget_translations")){
				foreach (Mage::registry("pswidget_translations") as $translation){
					$widget_lang_data = $translation->getData();
					$form_data['submit_text_'.$widget_lang_data['id_lang']] = $widget_lang_data['submit_text'];
					$form_data['shop_this_look_text_'.$widget_lang_data['id_lang']] = $widget_lang_data['shop_this_look_text'];
					$form_data['note_add_pics_text_'.$widget_lang_data['id_lang']] = $widget_lang_data['note_add_pics_text'];
					$values = array_merge($values, $form_data);
				}
			}


			if (!empty($values)) {
				if($values['image_height'] <= 0) $values['image_height'] = 200;
				if($values['image_width'] <= 0) $values['image_width'] = 200;
				$form->setValues($values);
			}
		}
        return parent::_prepareForm();
    }
}
