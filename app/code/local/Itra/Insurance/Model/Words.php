<?php

class Itra_Insurance_Model_Words
{
    public function toOptionArray()
    {
        /** @var Itra_Insurance_Helper_Data $helper */
        $helper = Mage::helper('insurance');

        return array(
            array('value' => $helper::ABSOLUTE_VALUE, 'label' => Mage::helper('insurance')->__('Absolute value')),
            array('value' => $helper::PERCENT_OF_ORDER, 'label' => Mage::helper('insurance')->__('% of order value')),
        );
    }

}