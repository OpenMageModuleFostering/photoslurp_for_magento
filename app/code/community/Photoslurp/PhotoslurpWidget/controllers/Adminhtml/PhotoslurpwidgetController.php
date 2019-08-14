<?php

class Photoslurp_PhotoslurpWidget_Adminhtml_PhotoslurpwidgetController extends Mage_Adminhtml_Controller_Action
{
		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("photoslurpwidget/photoslurpwidget")->_addBreadcrumb(Mage::helper("adminhtml")->__("Photoslurpwidget  Manager"),Mage::helper("adminhtml")->__("Photoslurpwidget Manager"));
				return $this;
		}
		public function indexAction() 
		{
			    $this->_title($this->__("Photoslurp Widget"));
			    $this->_title($this->__("Manager Photoslurpwidget"));

				$this->_initAction();
				$this->renderLayout();
		}
		public function editAction()
		{			    
			    $this->_title($this->__("Photoslurp Widget"));
				$this->_title($this->__("Photoslurpwidget"));
			    $this->_title($this->__("Edit Item"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("photoslurpwidget/photoslurpwidget")->load($id);
				if ($model->getId()) {
					Mage::register("photoslurpwidget_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("photoslurpwidget/photoslurpwidget");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Photoslurp Widget Manager"), Mage::helper("adminhtml")->__("Photoslurpwidget Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Photoslurpwidget Description"), Mage::helper("adminhtml")->__("Photoslurpwidget Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("photoslurpwidget/adminhtml_photoslurpwidget_edit"))->_addLeft($this->getLayout()->createBlock("photoslurpwidget/adminhtml_photoslurpwidget_edit_tabs"));
					$this->renderLayout();
				} 
				else {
					Mage::getSingleton("adminhtml/session")->addError(Mage::helper("photoslurpwidget")->__("Item does not exist."));
					$this->_redirect("*/*/");
				}
		}

		public function newAction()
		{

		$this->_title($this->__("PhotoslurpWidget"));
		$this->_title($this->__("Photoslurpwidget"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("photoslurpwidget/photoslurpwidget")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("photoslurpwidget_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("photoslurpwidget/photoslurpwidget");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Photoslurp Widget Manager"), Mage::helper("adminhtml")->__("Photoslurpwidget Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Photoslurp Widget Description"), Mage::helper("adminhtml")->__("Photoslurpwidget Description"));


		$this->_addContent($this->getLayout()->createBlock("photoslurpwidget/adminhtml_photoslurpwidget_edit"))->_addLeft($this->getLayout()->createBlock("photoslurpwidget/adminhtml_photoslurpwidget_edit_tabs"));

		$this->renderLayout();

		}
		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();


				if ($post_data) {

					try {

						
					$post_data['note_add_pics_icons']=implode(',',$post_data['note_add_pics_icons']);

						$model = Mage::getModel("photoslurpwidget/photoslurpwidget")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Photoslurpwidget was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setPhotoslurpwidgetData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setPhotoslurpwidgetData($this->getRequest()->getPost());
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
						$model = Mage::getModel("photoslurpwidget/photoslurpwidget");
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
                      $model = Mage::getModel("photoslurpwidget/photoslurpwidget");
					  $model->setId($id)->delete();
				}
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
			}
			$this->_redirect('*/*/');
		}
			
}
