<?php
class Photoslurp_PsWidget_Model_Mysql4_Pswidget extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("pswidget/pswidget", "id");
    }
}