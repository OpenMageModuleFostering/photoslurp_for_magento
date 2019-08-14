<?php
class Photoslurp_PhotoslurpWidget_Model_Mysql4_Photoslurpwidget extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("photoslurpwidget/photoslurpwidget", "id");
    }
}