<?php

class Itra_Insurance_Block_Checkout_Onepage extends Mage_Checkout_Block_Onepage
{
    const ABSOLUTE_VALUE = 1;
    const PERCENT_OF_ORDER = 2;

    /**
     * @return array
     */
    public function getSteps()
    {
        $steps = array();

        if (!$this->isCustomerLoggedIn()) {
            $steps['login'] = $this->getCheckout()->getStepData('login');
        }
        if(Mage::helper('insurance')->isEnabled()) {
            $stepCodes = array('billing', 'shipping', 'shipping_method', 'insurance', 'payment', 'review');
        } else {
            $stepCodes = array('billing', 'shipping', 'shipping_method', 'payment', 'review');
        }

        foreach ($stepCodes as $step) {
            $steps[$step] = $this->getCheckout()->getStepData($step);
        }

        return $steps;
    }

    /**
     * @return float|int|mixed
     */
    public function getCostInsurance()
    {
        /** @var Mage_Sales_Model_Quote $qoute */
        $quote = $this->getQuote();

        $subTotal = $quote->getSubtotal();

        $insuranceType = Mage::getStoreConfig('insurance_options/messages/insurance_type');
        $insuranceValue = Mage::getStoreConfig('insurance_options/messages/insurance_value');

        $addCost = 0;

        if($insuranceType == self::ABSOLUTE_VALUE) {
            $addCost = $insuranceValue;
        }  elseif($insuranceType == self::PERCENT_OF_ORDER) {
            $addCost =  $insuranceValue * $subTotal/100;
        }

        return $addCost;
    }

}