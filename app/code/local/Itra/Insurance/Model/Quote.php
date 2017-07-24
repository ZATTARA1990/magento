<?php

class Itra_Insurance_Model_Quote extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('insurance/quote');
    }
}