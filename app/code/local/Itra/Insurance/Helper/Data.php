<?php

class Itra_Insurance_Helper_Data extends Mage_Core_Helper_Abstract
{
    const ABSOLUTE_VALUE = 1;
    const PERCENT_OF_ORDER = 2;

    const DISABLED = 1;
    const ENABLED = 2;

    /**
     * @return bool
     */
    public function isEnabled()
    {
        $val = Mage::getStoreConfig('insurance_options/messages/insurance_mode');
        if ($val == self::DISABLED) {
            return false;
        }
        return true;
    }

    /**
     * @param $entity
     */
    public function setInsurance($entity)
    {

        if ($entity instanceof Mage_Sales_Model_Quote_Address) {
            $insurance_amount = $entity->getQuote()->getInsuranceAmount();
        } else {
            $insurance_amount = $entity->getOrder()->getInsuranceAmount();
        }

        $entity->setGrandTotal($entity->getGrandTotal() + $insurance_amount);
        $entity->setBaseGrandTotal($entity->getBaseGrandTotal() + $insurance_amount);

    }

    /**
     * @return mixed
     */
    public function getInsuranceAmount()
    {
        return $this->getQuote()->getInsuranceAmount();
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

    /**
     * @return Mage_Core_Model_Abstract
     */
    protected function getCheckout()
    {
        return Mage::getSingleton('checkout/session');
    }

    /**
     * @return Mage_Sales_Model_Quote
     */
    protected function getQuote()
    {
        return $this->getCheckout()->getQuote();
    }

}