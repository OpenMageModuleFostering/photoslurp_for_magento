<?php

class Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("pswidgetGrid");
				$this->setDefaultSort("id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("pswidget/pswidget")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("id", array(
				"header" => Mage::helper("pswidget")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "id",
				));
                        $this->addColumn('widget_enable', array(
						'header' => Mage::helper('pswidget')->__('Enable'),
						'index' => 'widget_enable',
						'type' => 'options',
						'options'=>Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getOptionArrayYesNo(),
						));

                $this->addColumn('page_type', array(
                    'header' => Mage::helper('pswidget')->__('Page Type'),
                    'index' => 'page_type',
                    'type' => 'options',
                    'options'=>Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getOptionArray10(),
                ));
						$this->addColumn('widget_type', array(
						'header' => Mage::helper('pswidget')->__('Widget Type'),
						'index' => 'widget_type',
						'type' => 'options',
						'options'=>Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getOptionArray5(),
						));
						
				$this->addColumn("album_id", array(
				"header" => Mage::helper("pswidget")->__("Album Id"),
				"index" => "album_id",
				));

				$this->addColumn("page_limit", array(
				"header" => Mage::helper("pswidget")->__("Page Limit"),
				"index" => "page_limit",
				));

				return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}


		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('id');
			$this->getMassactionBlock()->setFormFieldName('ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_pswidget', array(
					 'label'=> Mage::helper('pswidget')->__('Remove Pswidget'),
					 'url'  => $this->getUrl('*/adminhtml_pswidget/massRemove'),
					 'confirm' => Mage::helper('pswidget')->__('Are you sure?')
				));
			return $this;
		}
			
		static public function getOptionArray5()
		{
            $data_array=array();
            $data_array['']= 'Please select...';
			$data_array[1]='carousel';
			$data_array[2]='gallery';
            return($data_array);
		}
		static public function getValueArray5()
		{
            $data_array=array();
			foreach(Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getOptionArray5() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		
		static public function getOptionArray10()
		{
            $data_array=array();
            $data_array['']= 'Please select...';
			$data_array[1]='home';
			$data_array[2]='product';
			$data_array[3]='lookbook';
            return($data_array);
		}
		static public function getValueArray10()
		{
            $data_array=array();
			foreach(Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getOptionArray10() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}

	static public function getOptionArrayPosition()
	{
		$data_array=array();
		$data_array['product-content-bottom']='Product content bottom';
		$data_array['product-content-top']='Product content top';
		$data_array['product-media']='Product media';
		$data_array['product-page-bottom']='Product page bottom';
		$data_array['product-page-top']='Product page top';

		return($data_array);
	}
	static public function getValueArrayPosition()
	{
		$data_array=array();
		foreach(Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getOptionArrayPosition() as $k=>$v){
			$data_array[]=array('value'=>$k,'label'=>$v);
		}
		return($data_array);

	}
		
		static public function getOptionArray15()
		{
            $data_array=array(); 
			$data_array[1]='facebook ';
			$data_array[2]='twitter';
			$data_array[3]='instagram';
            return($data_array);
		}
		static public function getValueArray15()
		{
            $data_array=array();
			foreach(Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getOptionArray15() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}

        static public function getOptionArrayYesNo()
        {
            $data_array=array();
            $data_array[0]='No';
            $data_array[1]='Yes';
            return($data_array);
        }
        static public function getValueArrayYesNo()
        {
            $data_array=array();
            foreach(Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getOptionArrayYesNo() as $k=>$v){
                $data_array[]=array('value'=>$k,'label'=>$v);
            }
            return($data_array);

        }

		static public function getOptionArrayPhotoOrder()
		{
			$data_array=array();
			$data_array[0]='Newest first';
			$data_array[1]='Random';
			return($data_array);
		}
		static public function getValueArrayPhotoOrder()
		{
			$data_array=array();
			foreach(Photoslurp_PsWidget_Block_Adminhtml_Pswidget_Grid::getOptionArrayPhotoOrder() as $k=>$v){
				$data_array[]=array('value'=>$k,'label'=>$v);
			}
			return($data_array);

		}
		

}