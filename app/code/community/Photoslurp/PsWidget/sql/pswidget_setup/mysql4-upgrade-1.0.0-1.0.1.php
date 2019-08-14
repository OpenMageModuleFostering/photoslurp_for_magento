<?php

$installer = $this;
$connection = $installer->getConnection();

$installer->startSetup();

$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'random_order',
	"tinyint(1) DEFAULT NULL");

$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'allow_empty',
	'tinyint(1) DEFAULT NULL');

$installer->endSetup();