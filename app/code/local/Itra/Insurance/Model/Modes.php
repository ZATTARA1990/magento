<?php

class Itra_Insurance_Model_Modes
{
    public function toOptionArray()
    {
        /** @var Itra_Insurance_Helper_Data $helper */
        $helper = Mage::helper('insurance');

        return array(
            array('value' => $helper::DISABLED, 'label' => Mage::helper('insurance')->__('No')),
            array('value' => $helper::ENABLED, 'label' => Mage::helper('insurance')->__('Yes')),
        );
    }

}