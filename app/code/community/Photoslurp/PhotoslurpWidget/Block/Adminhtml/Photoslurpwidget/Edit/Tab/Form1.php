<?php
class Photoslurp_PhotoslurpWidget_Block_Adminhtml_Photoslurpwidget_Edit_Tab_Form1 extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

			$form = new Varien_Data_Form();
			$this->setForm($form);
			$fieldset = $form->addFieldset("photoslurpwidget_form", array("legend"=>Mage::helper("photoslurpwidget")->__("Style parameters")));

            $groups = array(
                array(
                    'code'  =>'submissionform',
                    'label' => 'Submission Form',
                    'fields' => array(
                        array('code'=>'style_submissionform_colourtop','label'=>'Colour Top', 'afterhtml'=>'<i>Default #4F5F6F</i>'),
                        array('code'=>'style_submissionform_colourbutton','label'=>'Colour Button', 'afterhtml'=>'<i>Default #5DADE2</i>'),
                        array('code'=>'style_submissionform_font','label'=>'Font', 'afterhtml'=>'<i>Default "Open Sans"</i>')
                    )
                ),
                array(
                    'code'  =>'taggingtitle',
                    'label'  => 'Tagging Title',
                    'fields' => array(
                        array('code'=>'style_taggingtitle_font_family','label'=>'Font Family'),
                        array('code'=>'style_taggingtitle_font_style','label'=>'Font Style'),
                        array('code'=>'style_taggingtitle_font_weight','label'=>'Font Weight'),
                        array('code'=>'style_taggingtitle_font_color','label'=>'Font Color'),
                        array('code'=>'style_taggingtitle_font_size','label'=>'Font Size')
                    )
                ),
                 array(
                     'code'  =>'thumbnail',
                     'label'  => 'Thumbnail',
                     'fields' => array(
                         array('code'=>'style_thumbnail_bg_color','label'=>'Background Color'),
                         array('code'=>'style_thumbnail_border_color','label'=>'Border Color')
                     )
                 ),
                array(
                    'code'  =>'carousel',
                    'label'  => 'Carousel',
                    'fields' => array(
                        array('code'=>'style_carousel_bg_color','label'=>'Background Color'),
                    )
                ),
                array(
                    'code'  =>'popup',
                    'label'  => 'Popup',
                    'fields' => array(
                        array('code'=>'style_popup_bg_color','label'=>'Background Color'),
                        array('code'=>'style_popup_title_font_family','label'=>'Title Font Family'),
                        array('code'=>'style_popup_title_font_style','label'=>'Title Font Style'),
                        array('code'=>'style_popup_title_font_weight','label'=>'Title Font Weight'),
                        array('code'=>'style_popup_title_font_color','label'=>'Title Font Color')
                    )
                ),
                array(
                    'code'  =>'source',
                    'label'  => 'Source',
                    'fields' => array(
                        array('code'=>'style_source_font_family','label'=>'Font Family'),
                        array('code'=>'style_source_font_style','label'=>'Font Style'),
                        array('code'=>'style_source_font_weight','label'=>'Font Weight'),
                        array('code'=>'style_source_font_color','label'=>'Font Color')
                    )
                ),
                array(
                    'code'  =>'productcaptionshop',
                    'label'  => 'Product Caption Shop',
                    'fields' => array(
                        array('code'=>'style_productcaptionshop_font_family','label'=>'Font Family'),
                        array('code'=>'style_productcaptionshop_font_style','label'=>'Font Style'),
                        array('code'=>'style_productcaptionshop_font_weight','label'=>'Font Weight'),
                        array('code'=>'style_productcaptionshop_font_color','label'=>'Font Color')
                    )
                ),
                array(
                    'code'  =>'productdescription',
                    'label'  => 'Product Description',
                    'fields' => array(
                        array('code'=>'style_productdescription_font_family','label'=>'Font Family'),
                        array('code'=>'style_productdescription_font_style','label'=>'Font Style'),
                        array('code'=>'style_productdescription_font_weight','label'=>'Font Weight'),
                        array('code'=>'style_productdescription_font_color','label'=>'Font Color')
                    )
                )
            );


            foreach ($groups as $group){
                    $fieldset->addField($group['code'], 'label' , array(
                        'after_element_html'=> $this->__('<b>%s</b>',$group['label'])
                    ));
                    foreach($group['fields'] as $field){
                        $fieldset->addField($field['code'], "text", array(
                            "label" => Mage::helper("photoslurpwidget")->__($field['label']),
                            "name" => $field['code'],
                            'after_element_html'=> $field['afterhtml']
                        ));
                    }
            }


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
