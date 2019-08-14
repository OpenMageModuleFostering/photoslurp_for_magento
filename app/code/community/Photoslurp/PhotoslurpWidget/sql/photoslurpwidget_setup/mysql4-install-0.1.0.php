<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT

CREATE TABLE photoslurp_widget (
  id int(11) NOT NULL AUTO_INCREMENT,
  widget_enable tinyint(1) DEFAULT NULL,
  widget_container_id varchar(255) DEFAULT NULL,
  widget_id varchar(255) DEFAULT NULL,
  widget_type varchar(255) DEFAULT NULL,
  album_id varchar(255) DEFAULT NULL,
  product_id varchar(255) DEFAULT NULL,
  lang varchar(255) DEFAULT NULL,
  page_limit int(11) DEFAULT NULL,
  page_type varchar(255) DEFAULT NULL,
  show_submit tinyint(1) DEFAULT NULL,
  submit_text text DEFAULT NULL,
  add_photos_img text DEFAULT NULL,
  note_add_pics_text text DEFAULT NULL,
  note_add_pics_icons varchar(255) DEFAULT NULL,
  social_icons tinyint(1) DEFAULT NULL,
  image_height int(11) DEFAULT NULL,
  image_width int(11) DEFAULT NULL,

  style_submissionform_colourtop varchar(255) DEFAULT NULL,
  style_submissionform_colourbutton varchar(255) DEFAULT NULL,
  style_submissionform_font varchar(255) DEFAULT NULL,

  style_taggingtitle_font_family varchar(255) DEFAULT NULL,
  style_taggingtitle_font_style varchar(255) DEFAULT NULL,
  style_taggingtitle_font_weight varchar(255) DEFAULT NULL,
  style_taggingtitle_font_color varchar(255) DEFAULT NULL,
  style_taggingtitle_font_size varchar(255) DEFAULT NULL,

  style_thumbnail_bg_color varchar(255) DEFAULT NULL,
  style_thumbnail_border_color varchar(255) DEFAULT NULL,

  style_carousel_bg_color varchar(255) DEFAULT NULL,

  style_popup_bg_color varchar(255) DEFAULT NULL,
  style_popup_title_font_family varchar(255) DEFAULT NULL,
  style_popup_title_font_style varchar(255) DEFAULT NULL,
  style_popup_title_font_weight varchar(255) DEFAULT NULL,
  style_popup_title_font_color varchar(255) DEFAULT NULL,

  style_source_font_family varchar(255) DEFAULT NULL,
  style_source_font_style varchar(255) DEFAULT NULL,
  style_source_font_weight varchar(255) DEFAULT NULL,
  style_source_font_color varchar(255) DEFAULT NULL,

  style_productcaptionshop_font_family varchar(255) DEFAULT NULL,
  style_productcaptionshop_font_style varchar(255) DEFAULT NULL,
  style_productcaptionshop_font_weight varchar(255) DEFAULT NULL,
  style_productcaptionshop_font_color varchar(255) DEFAULT NULL,

  style_productdescription_font_family varchar(255) DEFAULT NULL,
  style_productdescription_font_style varchar(255) DEFAULT NULL,
  style_productdescription_font_weight varchar(255) DEFAULT NULL,
  style_productdescription_font_color varchar(255) DEFAULT NULL,

  style_custom longtext DEFAULT NULL,
  style_custom_enable tinyint(1) DEFAULT NULL,



  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 6
AVG_ROW_LENGTH = 4096
CHARACTER SET utf8
COLLATE utf8_general_ci;

SQLTEXT;

$installer->run($sql);
//demo 
//Mage::getModel('core/url_rewrite')->setId(null);
//demo 
$installer->endSetup();
	 