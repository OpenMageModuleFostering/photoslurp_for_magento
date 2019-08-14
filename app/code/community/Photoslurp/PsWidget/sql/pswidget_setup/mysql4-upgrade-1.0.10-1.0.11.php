<?php
$installer = $this;
$connection = $installer->getConnection();

	$installer->startSetup();

	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'submission_form_url', "text NULL");
	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'in_stock_only', "tinyint(1) NULL");
	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'rights_cleared_only', "tinyint(1) NULL");
	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'assigned_only', "tinyint(1) NULL");

$installer->endSetup();