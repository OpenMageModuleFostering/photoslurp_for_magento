<?php
class Photoslurp_PsWidget_Helper_Data extends Mage_Core_Helper_Abstract
{
    const FILE_NAME = 'photoslurp_export.csv';

    public function findWritablePath(){

        $config_path = Mage::getStoreConfig('export/export_configuration/path');

        if($config_path){
                    $filename = $config_path;
                    $dirname = dirname($filename);
                    if (!is_dir($dirname))
                    {
                        mkdir($dirname, 0755, true);
                    }
            return Mage::getBaseDir('base').'/'.$filename;
        }

        if(is_writable(Mage::getBaseDir('base'))){
            return Mage::getBaseDir('base').'/'.self::FILE_NAME;
        }

        if(is_writable(Mage::getBaseDir('media'))){
            return Mage::getBaseDir('media').'/'.self::FILE_NAME;
        }

        return false;
    }

    public function getExportedFileName(){
        return $this->findWritablePath();
    }
}
	 