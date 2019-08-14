<?php
$installer = $this;
$connection = $installer->getConnection();

	$installer->startSetup();
	$installer->getConnection()->addColumn($installer->getTable('pswidget/pswidget'), 'visible_products', "varchar(255) NULL");

	if (Mage::getModel('admin/block')) {

		if(!Mage::getModel('admin/block')->getCollection()->addFieldToFilter('block_name', 'pswidget/widget')->getFirstItem()->getId()){
			$installer->getConnection()->insertMultiple(
				$installer->getTable('admin/permission_block'),
				array(
					array('block_name' => 'pswidget/widget', 'is_allowed' => 1),
				)
			);
		}
	}

$installer->endSetup();