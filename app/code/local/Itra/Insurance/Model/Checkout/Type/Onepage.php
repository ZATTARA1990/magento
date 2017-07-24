<?php

class Itra_Insurance_Model_Checkout_Type_Onepage extends Mage_Checkout_Model_Type_Onepage
{
    const USE_INSURANCE = 1;
    const DO_NOT_USE_INSURANCE = 2;

    /**
     * @param $useInsurance
     * @param $cost
     * @return array
     */
    public function saveInsurance($useInsurance, $cost = 0)
    {
        if (empty($useInsurance) || ($useInsurance == self::USE_INSURANCE && !$cost)) {
            return array('error' => -1, 'message' => $this->_helper->__('Invalid data.'));
        }

            /** @var Mage_Sales_Model_Quote $quote */
            $quote = $this->getQuote();

            $quote->setInsuranceAmount($cost);
            $quote->collectTotals();
            $quote->save();

        $this->getCheckout()
            ->setStepData('insurance', 'allow', true)
            ->setStepData('insurance', 'complete', true)
            ->setStepData('payment', 'allow', true);

        return array();
    }
}