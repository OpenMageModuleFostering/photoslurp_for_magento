<?php

class Photoslurp_PsWidget_Adminhtml_Pswidget_PswidgetController extends Mage_Adminhtml_Controller_Action
{
		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("pswidget/pswidget")->_addBreadcrumb(Mage::helper("adminhtml")->__("Pswidget  Manager"),Mage::helper("adminhtml")->__("Pswidget Manager"));
				return $this;
		}

		protected function _isAllowed()
		{
			return Mage::getSingleton('admin/session')->isAllowed('pswidget/pswidget');
		}

		public function indexAction() 
		{
			    $this->_title($this->__("Photoslurp Widget"));
			    $this->_title($this->__("Manager Pswidget"));

				$this->_initAction();
				$this->renderLayout();
		}
		public function editAction()
		{			    
			    $this->_title($this->__("Photoslurp Widget"));
				$this->_title($this->__("Pswidget"));
			    $this->_title($this->__("Edit Item"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("pswidget/pswidget")->load($id);

				$translations = array();
				foreach(Mage::app()->getStores() as $store){
					$translations[] = Mage::getModel("pswidget/pswidgetlang")->load($this->getIdWidgetLang($id,$store->getId()));
				}

				if ($model->getId()) {
					Mage::register("pswidget_data", $model);
					Mage::register("pswidget_translations", $translations);

					$this->loadLayout();
					$this->_setActiveMenu("pswidget/pswidget");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Photoslurp Widget Manager"), Mage::helper("adminhtml")->__("Pswidget Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Pswidget Description"), Mage::helper("adminhtml")->__("Pswidget Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("pswidget/adminhtml_pswidget_edit"))->_addLeft($this->getLayout()->createBlock("pswidget/adminhtml_pswidget_edit_tabs"));
					$this->renderLayout();
				} 
				else {
					Mage::getSingleton("adminhtml/session")->addError(Mage::helper("pswidget")->__("Item does not exist."));
					$this->_redirect("*/*/");
				}
		}

		public function newAction()
		{

		$this->_title($this->__("PsWidget"));
		$this->_title($this->__("Pswidget"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("pswidget/pswidget")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("pswidget_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("pswidget/pswidget");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Photoslurp Widget Manager"), Mage::helper("adminhtml")->__("Pswidget Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Photoslurp Widget Description"), Mage::helper("adminhtml")->__("Pswidget Description"));


		$this->_addContent($this->getLayout()->createBlock("pswidget/adminhtml_pswidget_edit"))->_addLeft($this->getLayout()->createBlock("pswidget/adminhtml_pswidget_edit_tabs"));

		$this->renderLayout();

		}


		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();

				if ($post_data) {

					try {

						$model = Mage::getModel("pswidget/pswidget")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->save();

						foreach(Mage::app()->getStores() as $store) {
							$this->saveTranslations(
								$model->getId(),
								$store->getId(),
								array(
									'submit_text' => $post_data['submit_text_'.$store->getId()],
									'cta_button' => $post_data['cta_button_'.$store->getId()],
									'load_more_text' => $post_data['load_more_text_'.$store->getId()],
									'shop_this_look_text' => $post_data['shop_this_look_text_'.$store->getId()],
									'note_add_pics_text' => $post_data['note_add_pics_text_'.$store->getId()],
									'add_photos_img' => $post_data['add_photos_img_'.$store->getId()],
								)
							);
						}

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Pswidget was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setPswidgetData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setPswidgetData($this->getRequest()->getPost());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					return;
					}

				}
				$this->_redirect("*/*/");
		}



		public function deleteAction()
		{
				if( $this->getRequest()->getParam("id") > 0 ) {
					try {
						$model = Mage::getModel("pswidget/pswidget");
						$model->setId($this->getRequest()->getParam("id"))->delete();
						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
						$this->_redirect("*/*/");
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					}
				}
				$this->_redirect("*/*/");
		}

		
		public function massRemoveAction()
		{
			try {
				$ids = $this->getRequest()->getPost('ids', array());
				foreach ($ids as $id) {
                      $model = Mage::getModel("pswidget/pswidget");
					  $model->setId($id)->delete();
				}
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
			}
			$this->_redirect('*/*/');
		}

		private function saveTranslations($id_widget,$id_lang,$data = array()){
			try {
				Mage::getModel("pswidget/pswidgetlang")
					->setIdWidget($id_widget)
					->setIdLang($id_lang)
					->addData($data)
					->setId($this->getIdWidgetLang($id_widget, $id_lang))
					->save();
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
				Mage::getSingleton("adminhtml/session")->setPswidgetData($this->getRequest()->getPost());
			}
		}

		private function getIdWidgetLang($id_widget,$id_lang){
			return Mage::getModel("pswidget/pswidgetlang")->getCollection()
					-> addFilter('id_widget', $id_widget)
					-> addFilter('id_lang', $id_lang)
					-> getFirstItem()
					-> getId();
		}

}
