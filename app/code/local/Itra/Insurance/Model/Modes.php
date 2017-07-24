<?php

class Itra_Insurance_Model_Modes
{
    public function toOptionArray()
    {
        return array(
            array('value' => 1, 'label' => Mage::helper('insurance')->__('No')),
            array('value' => 2, 'label' => Mage::helper('insurance')->__('Yes')),
        );
    }

}