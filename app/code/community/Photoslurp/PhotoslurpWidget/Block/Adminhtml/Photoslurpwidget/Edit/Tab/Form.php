<?php

class Photoslurp_PhotoslurpWidget_Block_Adminhtml_Photoslurpwidget_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset("photoslurpwidget_form", array("legend" => Mage::helper("photoslurpwidget")->__("Configuration parameters")));

        $fieldset->addField('widget_enable', 'select', array(
            'label' => Mage::helper('photoslurpwidget')->__('Enable'),
            'values' => Photoslurp_PhotoslurpWidget_Block_Adminhtml_Photoslurpwidget_Grid::getValueArrayYesNo(),
            'name' => 'widget_enable',
            "class" => "required-entry",
            "required" => true,

        ));

        $fieldset->addField("widget_container_id", "text", array(
            "label" => Mage::helper("photoslurpwidget")->__("Widget Container Id"),
            "class" => "required-entry",
            "required" => true,
            "name" => "widget_container_id",
            'after_element_html' => "<i>Please choose a unique HTML container ID to hold the widget</i>"
        ));

        $fieldset->addField("widget_id", "text", array(
            "label" => Mage::helper("photoslurpwidget")->__("Widget Id"),
            "class" => "required-entry",
            "required" => true,
            "name" => "widget_id",
            'after_element_html' => "<br><i>A unique identifier for each of the widgets you use on your website</i>"
        ));

        $fieldset->addField('widget_type', 'select', array(
            'label' => Mage::helper('photoslurpwidget')->__('Widget Type'),
            'values' => Photoslurp_PhotoslurpWidget_Block_Adminhtml_Photoslurpwidget_Grid::getValueArray5(),
            'name' => 'widget_type',
            "class" => "required-entry",
            "required" => true,
            'after_element_html' => '<i>This is either set to carousel or gallery depending on how you would like to display your pictures. Carousel has been specifically designed to be placed on your product pages, and Gallery to be used as a separate gallery page<i>'

        ));

        $fieldset->addField("album_id", "text", array(
            "label" => Mage::helper("photoslurpwidget")->__("Album Id"),
            "class" => "required-entry",
            "required" => true,
            "name" => "album_id",
            'after_element_html' => '<i>This is the ID number of your campaign</i>'
        ));

        $fieldset->addField("page_limit", "text", array(
            "label" => Mage::helper("photoslurpwidget")->__("Page Limit"),
            "class" => "required-entry",
            "required" => true,
            "name" => "page_limit",
            "value" => 30,
            'after_element_html' => '<i>The number of images to load per page for both the Gallery and Carousel modes</i>'
        ));

        $fieldset->addField('page_type', 'select', array(
            'label' => Mage::helper('photoslurpwidget')->__('Page Type'),
            'values' => Photoslurp_PhotoslurpWidget_Block_Adminhtml_Photoslurpwidget_Grid::getValueArray10(),
            'name' => 'page_type',
            "class" => "required-entry",
            "required" => true,
            'after_element_html' => '<i>This parameter is used in analytics calculations</i>'
        ));
        $fieldset->addField('show_submit', 'select', array(
            'label' => Mage::helper('photoslurpwidget')->__('Show Submit'),
            'values' => Photoslurp_PhotoslurpWidget_Block_Adminhtml_Photoslurpwidget_Grid::getValueArrayYesNo(),
            'name' => 'show_submit',
            'after_element_html' => '<i>This parameter will enable the frontend upload widget, and display a Submit button</i>'
        ));
        $fieldset->addField("submit_text", "text", array(
            "label" => Mage::helper("photoslurpwidget")->__("Submit Text"),
            "name" => "submit_text",
            'after_element_html' => '<i>This is the text that will be displayed on the Submit button</i>'
        ));

        $fieldset->addField("add_photos_img", "text", array(
            "label" => Mage::helper("photoslurpwidget")->__("Add Photos Img"),
            "name" => "add_photos_img",
            'after_element_html' => '<i>This requires a URL to an image that will be displayed when there are no images yet in a particular album (for example when the productId parameter is used, and there are no photos for particular product yet). A banner inviting users to submit images is recommended to be used here</i>'
        ));

        $fieldset->addField("note_add_pics_text", "text", array(
            "label" => Mage::helper("photoslurpwidget")->__("Note Add Pics Text"),
            "name" => "note_add_pics_text",
            'after_element_html' => '<i>This is the text to be added on the top of your Gallery or Carousel, and can be used to let your users know how they can add their own pictures</i>'
        ));

        $fieldset->addField('note_add_pics_icons', 'multiselect', array(
            'label' => Mage::helper('photoslurpwidget')->__('Note Add Pics Icons'),
            'values' => Photoslurp_PhotoslurpWidget_Block_Adminhtml_Photoslurpwidget_Grid::getValueArray15(),
            'name' => 'note_add_pics_icons',
            'after_element_html' => '<i>This is related to noteAddPicsText and will add the icons of the services you have chosen to include in your campaign, letting users know which services they can use to add their own pictures</i>'
        ));
        $fieldset->addField('social_icons', 'select', array(
            'label' => Mage::helper('photoslurpwidget')->__('Social Icons'),
            'values' => Photoslurp_PhotoslurpWidget_Block_Adminhtml_Photoslurpwidget_Grid::getValueArrayYesNo(),
            'name' => 'social_icons',
            'after_element_html' => '<i>Enable social icons in the lightbox to allow users to share pictures back to social networks</i>'
        ));
        $fieldset->addField("image_height", "text", array(
            "label" => Mage::helper("photoslurpwidget")->__("Image Height, px"),
            "class" => "required-entry",
            "required" => true,
            "name" => "image_height",
            "value" => 200,
            'after_element_html' => '<i>This is an option specific to the Carousel widget type, and sets the height of the thumbnail images and therefore the carousel</i>'
        ));

        $fieldset->addField("image_width", "text", array(
            "label" => Mage::helper("photoslurpwidget")->__("Image Width, px"),
            "class" => "required-entry",
            "required" => true,
            "name" => "image_width",
            "value" => 200,
            'after_element_html' => '<i>This option is specific to the Gallery widget type, and sets the width of each thumbnail in the Gallery view</i>'
        ));

        if (Mage::getSingleton("adminhtml/session")->getPhotoslurpwidgetData()) {
            $form->setValues(Mage::getSingleton("adminhtml/session")->getPhotoslurpwidgetData());
            Mage::getSingleton("adminhtml/session")->setPhotoslurpwidgetData(null);
        } elseif (Mage::registry("photoslurpwidget_data")) {
            $form->setValues(Mage::registry("photoslurpwidget_data")->getData());
        }
        return parent::_prepareForm();
    }
}
