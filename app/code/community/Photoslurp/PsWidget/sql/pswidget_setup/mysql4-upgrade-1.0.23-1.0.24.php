<?php
$installer = $this;
$connection = $installer->getConnection();

	$installer->startSetup();
	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'cookie_domain', "text NULL");
	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidgetlang'), 'add_photos_img', "text NULL");

$installer->endSetup();