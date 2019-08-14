<?php
class Photoslurp_PsWidget_Adminhtml_Pswidget_PswidgetbackendController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('pswidget/pswidgetbackend');
    }

	public function indexAction()
    {
       $this->loadLayout();
	   $this->_title($this->__("Photoslurp Product Export"));
	   $this->renderLayout();
    }

    public function exportAction()
    {
        $params = $this->getRequest()->getParams();
        try {
            $model = Mage::getModel('pswidget/cron');
            $model->manualExport($params['product_type']);
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Products have been exported'));
        }
        catch (Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/pswidget_pswidgetbackend');
    }
}