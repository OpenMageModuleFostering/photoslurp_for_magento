<?php
$installer = $this;
$connection = $installer->getConnection();

$installer->startSetup();

	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidgetlang'), 'load_more_text', "text NULL");
	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'init_delay', "int NULL");
	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'thumb_overlay', "tinyint(1) NULL");
	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'varying_thumb_sizes', "tinyint(1) NULL");
	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'auto_scroll_carousel', "tinyint(1) NULL");
	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'one_photo_per_line', "tinyint(1) NULL");
	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'analytics_cookie_ttl', "int NULL");
	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'lightbox', "tinyint(1) NULL");
	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'fix_widget_analytics', "tinyint(1) NULL");

$installer->endSetup();