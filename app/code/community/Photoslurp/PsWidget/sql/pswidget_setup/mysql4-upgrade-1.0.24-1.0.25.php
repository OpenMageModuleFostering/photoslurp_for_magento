<?php
$installer = $this;
$connection = $installer->getConnection();
	$installer->startSetup();
	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'bundled_jquery', "tinyint(1) NULL");
$installer->endSetup();