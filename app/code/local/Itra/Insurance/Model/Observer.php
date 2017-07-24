<?php

class Itra_Insurance_Model_Observer
{

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

    /**
     * @param Varien_Event_Observer $observer *
     */
    public function saveInvoiceBefore(Varien_Event_Observer $observer)
    {
        if (Mage::helper('insurance')->isEnabled() && $invoice = $observer->getEvent()->getInvoice()) {
            if ($order = $observer->getDataObject()->getOrder()) {
                $amount = $order->getInsuranceAmount();
                $invoice->setInsuranceAmount($amount + $invoice->getFeeAmount());
                $invoice->setInsuranceAmount($amount + $invoice->getBaseFeeAmount());
            }
        }
    }

    /**
     * @param Varien_Event_Observer $observer *
     */
    public function saveCreditmemoBefore(Varien_Event_Observer $observer)
    {
        if (Mage::helper('insurance')->isEnabled() && $creditmemo = $observer->getEvent()->getCreditmemo()) {
            if ($order = $observer->getDataObject()->getOrder()) {
                $amount = $order->getInsuranceAmount();
                $creditmemo->setInsuranceAmount($amount + $creditmemo->getFeeAmount());
                $creditmemo->setInsuranceAmount($amount + $creditmemo->getBaseFeeAmount());
            }
        }
    }

}