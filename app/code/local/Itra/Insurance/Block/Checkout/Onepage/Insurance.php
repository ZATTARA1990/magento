<?php

class Itra_Insurance_Block_Checkout_Onepage_Insurance extends Mage_Checkout_Block_Onepage_Abstract
{
    public function _construct()
    {
        parent::_construct();
        
        $this->getCheckout()->setStepData('insurance', array(
            'label' => Mage::helper('checkout')->__('Shipping insurance'),
            'is_show' => $this->isShow()
        ));
    }
}