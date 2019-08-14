<?php
$installer = $this;
$connection = $installer->getConnection();

$installer->startSetup();

	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'user_name', "varchar(255) NULL");
	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'toc_link', "text NULL");

$installer->endSetup();