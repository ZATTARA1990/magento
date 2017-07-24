<?php

class Itra_Insurance_Model_Words
{
    public function toOptionArray()
    {
        return array(
            array('value' => 1, 'label' => Mage::helper('insurance')->__('Absolute value')),
            array('value' => 2, 'label' => Mage::helper('insurance')->__('% of order value')),
        );
    }

}