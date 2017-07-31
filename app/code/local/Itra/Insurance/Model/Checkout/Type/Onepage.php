<?php

class Itra_Insurance_Model_Checkout_Type_Onepage extends Mage_Checkout_Model_Type_Onepage
{
    const USE_INSURANCE = 1;
    const DO_NOT_USE_INSURANCE = 2;

    /**
     * Specify quote shipping method
     *
     * @param   string $shippingMethod
     * @param   bool $useInsurance
     * @return  array
     */
    public function saveShippingMethod($shippingMethod, $useInsurance)
    {
        if (empty($shippingMethod)) {
            return array('error' => -1, 'message' => Mage::helper('checkout')->__('Invalid shipping method.'));
        }
        $rate = $this->getQuote()->getShippingAddress()->getShippingRateByCode($shippingMethod);
        if (!$rate) {
            return array('error' => -1, 'message' => Mage::helper('checkout')->__('Invalid shipping method.'));
        }
        $this->getQuote()->getShippingAddress()
            ->setShippingMethod($shippingMethod);

        if(Mage::helper('insurance')->isEnabled()) {
            $cost = 0;
            if ($useInsurance == self::USE_INSURANCE) {
                $cost = Mage::helper('insurance')->getCostInsurance();
            }
            $this->getQuote()->setInsuranceAmount($cost);
        }
        $this->getQuote()->collectTotals();
        $this->getQuote()->save();


        $this->getCheckout()
            ->setStepData('shipping_method', 'complete', true)
            ->setStepData('payment', 'allow', true);

        return array();
    }
}