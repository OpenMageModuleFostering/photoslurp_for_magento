<?php
class Photoslurp_PsWidget_Model_Source_Export
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'all', 'label'=>Mage::helper('adminhtml')->__('All Visible')),
            array('value' => 'parent', 'label'=>Mage::helper('adminhtml')->__('Parent Only')),
            array('value' => 'simple', 'label'=>Mage::helper('adminhtml')->__('Child Only')),
//            array('value' => 'all_visible', 'label'=>Mage::helper('adminhtml')->__('Visible Only')),
        );
    }

}