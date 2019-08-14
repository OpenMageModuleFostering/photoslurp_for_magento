<?php
class Photoslurp_PhotoslurpWidget_Adminhtml_PhotoslurpwidgetbackendController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
    {
       $this->loadLayout();
	   $this->_title($this->__("Photoslurp Product Export"));
	   $this->renderLayout();
    }

    public function exportAction()
    {
        try {
            $model = Mage::getModel('photoslurpwidget/cron');
            $model->manualExport();
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Products have been exported'));
        }
        catch (Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/adminhtml_photoslurpwidgetbackend');
    }
}