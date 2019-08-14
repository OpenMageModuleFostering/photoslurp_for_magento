<?php
class Photoslurp_PsWidget_Model_Source_Store
{

    public function toOptionArray() {
        return Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, false);
    }

}