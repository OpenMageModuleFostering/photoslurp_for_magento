<?php
$installer = $this;
$connection = $installer->getConnection();

	$installer->startSetup();
	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'collections', "varchar(255) NULL");

$installer->endSetup();