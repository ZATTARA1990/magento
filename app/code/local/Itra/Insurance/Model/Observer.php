<?php

class Itra_Insurance_Model_Observer
{
    const USE_INSURANCE = 1;
    const DO_NOT_USE_INSURANCE = 2;

    /**
     * @param Varien_Event_Observer $observer
     */
    public function saveInsuranceInQuote(Varien_Event_Observer $observer)
    {
        if (Mage::helper('insurance')->isEnabled()) {
            if ($quote = $observer->getQuote()) {
                $useInsurance = Mage::app()->getRequest()->getPost('insurance');

                $cost = 0;
                if ($useInsurance == self::USE_INSURANCE) {
                    $cost = Mage::helper('insurance')->getCostInsurance();
                }
                $quote->setInsuranceAmount($cost);
                $quote->collectTotals();
                $quote->save();
            }
        }
    }

    /**
     * @param Varien_Event_Observer $observer
     */
    public function saveOrderBefore(Varien_Event_Observer $observer)
    {
        if (Mage::helper('insurance')->isEnabled() && $order = $observer->getEvent()->getOrder()) {
            if ($quote = $observer->getDataObject()->getQuote()) {
                $insurance_amount = $quote->getInsuranceAmount();
                $order->setInsuranceAmount($insurance_amount);
            }
        }
    }

}