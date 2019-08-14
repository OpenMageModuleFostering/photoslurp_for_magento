<?php
class Photoslurp_PhotoslurpWidget_Helper_Data extends Mage_Core_Helper_Abstract
{
    const FILE_NAME = 'photoslurp_export.csv';

    public function getFileName(){
        return self::FILE_NAME;
    }
}
	 