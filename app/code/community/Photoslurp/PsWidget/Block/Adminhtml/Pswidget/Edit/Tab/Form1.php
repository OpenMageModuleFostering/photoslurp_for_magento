<?php
class Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Edit_Tab_Form1 extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

			$form = new Varien_Data_Form();
			$this->setForm($form);
			$fieldset = $form->addFieldset("pswidget_form", array("legend"=>Mage::helper("pswidget")->__("Style parameters")));

            $groups = array(
                array(
                    'code'  =>'submissionform',
                    'label' => 'Submission Form',
                    'fields' => array(
                        array('code'=>'style_submissionform_colourtop','label'=>'Colour Top','value'=>'', 'afterhtml'=>'<i>Default #4F5F6F</i>'),
                        array('code'=>'style_submissionform_colourbutton','label'=>'Colour Button','value'=>'', 'afterhtml'=>'<i>Default #5DADE2</i>'),
                        array('code'=>'style_submissionform_font','label'=>'Font','value'=>'', 'afterhtml'=>'<i>Default "Open Sans"</i>')
                    )
                ),
                array(
                    'code'  =>'taggingtitle',
                    'label'  => 'Tagging Title',
                    'fields' => array(
                        array('code'=>'style_taggingtitle_font_family','value'=>'','label'=>'Font Family', 'afterhtml'=>''),
                        array('code'=>'style_taggingtitle_font_style','value'=>'','label'=>'Font Style', 'afterhtml'=>''),
                        array('code'=>'style_taggingtitle_font_weight','value'=>'','label'=>'Font Weight', 'afterhtml'=>''),
                        array('code'=>'style_taggingtitle_font_color','value'=>'','label'=>'Font Color', 'afterhtml'=>''),
                        array('code'=>'style_taggingtitle_font_size','value'=>'','label'=>'Font Size', 'afterhtml'=>'')
                    )
                ),
                 array(
                     'code'  =>'thumbnail',
                     'label'  => 'Thumbnail',
                     'fields' => array(
                         array('code'=>'style_thumbnail_bg_color','label'=>'Background Color','value'=>'', 'afterhtml'=>''),
                         array('code'=>'style_thumbnail_border_color','label'=>'Border Color','value'=>'#fff', 'afterhtml'=>'')
                     )
                 ),
                array(
                    'code'  =>'carousel',
                    'label'  => 'Carousel',
                    'fields' => array(
                        array('code'=>'style_carousel_bg_color','label'=>'Background Color','value'=>'', 'afterhtml'=>''),
                    )
                ),
                array(
                    'code'  =>'popup',
                    'label'  => 'Popup',
                    'fields' => array(
                        array('code'=>'style_popup_bg_color','label'=>'Background Color','value'=>'', 'afterhtml'=>''),
                        array('code'=>'style_popup_title_font_family','label'=>'Title Font Family','value'=>'', 'afterhtml'=>''),
                        array('code'=>'style_popup_title_font_style','label'=>'Title Font Style','value'=>'', 'afterhtml'=>''),
                        array('code'=>'style_popup_title_font_weight','label'=>'Title Font Weight','value'=>'', 'afterhtml'=>''),
                        array('code'=>'style_popup_title_font_color','label'=>'Title Font Color','value'=>'', 'afterhtml'=>'')
                    )
                ),
                array(
                    'code'  =>'source',
                    'label'  => 'Source',
                    'fields' => array(
                        array('code'=>'style_source_font_family','label'=>'Font Family','value'=>'', 'afterhtml'=>''),
                        array('code'=>'style_source_font_style','label'=>'Font Style','value'=>'', 'afterhtml'=>''),
                        array('code'=>'style_source_font_weight','label'=>'Font Weight','value'=>'', 'afterhtml'=>''),
                        array('code'=>'style_source_font_color','label'=>'Font Color','value'=>'', 'afterhtml'=>'')
                    )
                ),
                array(
                    'code'  =>'productcaptionshop',
                    'label'  => 'Product Caption Shop',
                    'fields' => array(
                        array('code'=>'style_productcaptionshop_font_family','label'=>'Font Family','value'=>'', 'afterhtml'=>''),
                        array('code'=>'style_productcaptionshop_font_style','label'=>'Font Style','value'=>'', 'afterhtml'=>''),
                        array('code'=>'style_productcaptionshop_font_weight','label'=>'Font Weight','value'=>'', 'afterhtml'=>''),
                        array('code'=>'style_productcaptionshop_font_color','label'=>'Font Color','value'=>'', 'afterhtml'=>'')
                    )
                ),
                array(
                    'code'  =>'productdescription',
                    'label'  => 'Product Description',
                    'fields' => array(
                        array('code'=>'style_productdescription_font_family','label'=>'Font Family','value'=>'', 'afterhtml'=>''),
                        array('code'=>'style_productdescription_font_style','label'=>'Font Style','value'=>'', 'afterhtml'=>''),
                        array('code'=>'style_productdescription_font_weight','label'=>'Font Weight','value'=>'', 'afterhtml'=>''),
                        array('code'=>'style_productdescription_font_color','label'=>'Font Color','value'=>'', 'afterhtml'=>'')
                    )
                )
            );


            foreach ($groups as $group){
                    $fieldset->addField($group['code'], 'label' , array(
                        'after_element_html'=> $this->__('<b>%s</b>',$group['label'])
                    ));
                    foreach($group['fields'] as $field){
                        $fieldset->addField($field['code'], "text", array(
                            "label" => Mage::helper("pswidget")->__($field['label']),
                            "name" => $field['code'],
							"value"=> $field['value'],
                            'after_element_html'=> $field['afterhtml']
                        ));
                    }
            }


			if (Mage::getSingleton("adminhtml/session")->getPswidgetData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getPswidgetData());
					Mage::getSingleton("adminhtml/session")->setPswidgetData(null);
				}
				elseif(Mage::registry("pswidget_data")) {
					if (Mage::registry("pswidget_data")->getData()) {
				    	$form->setValues(Mage::registry("pswidget_data")->getData());
					}
				}
				return parent::_prepareForm();
		}
}
