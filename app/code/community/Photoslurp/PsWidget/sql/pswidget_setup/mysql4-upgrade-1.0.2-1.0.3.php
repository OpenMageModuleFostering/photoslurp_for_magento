<?php
$installer = $this;
$connection = $installer->getConnection();

$installer->startSetup();

$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'position',
	"varchar(255) NULL");

$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'additional_params',
	"text NULL");

$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidgetlang'), 'shop_this_look_text',
	"text NULL");

$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'autoscroll_limit',
	"int NULL");

$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidgetlang'), 'cta_button',
	"text NULL");

$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'enable_ga',
	"tinyint(1) NULL");

$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'submission_form_css_url',
	"text NULL");


$installer->endSetup();