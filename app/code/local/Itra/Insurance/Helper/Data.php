<?php

class Itra_Insurance_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @return bool
     */
    public function isEnabled()
    {
        $val = Mage::getStoreConfig('insurance_options/messages/insurance_mode');
        if ($val == 1) {
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