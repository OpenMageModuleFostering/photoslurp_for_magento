<?php
$installer = $this;
$connection = $installer->getConnection();

	$installer->startSetup();

	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'strict_products', "tinyint(1) NULL");
	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'empty_threshold', "tinyint(1) NULL");

$installer->endSetup();