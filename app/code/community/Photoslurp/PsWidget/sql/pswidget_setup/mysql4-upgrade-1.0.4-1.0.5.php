<?php
$installer = $this;
$connection = $installer->getConnection();

$installer->startSetup();

$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'social_count',
	"tinyint(1) NULL");

$installer->endSetup();