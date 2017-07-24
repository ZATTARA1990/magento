<?php

class Itra_Insurance_Model_Sales_Order_Total_Invoice_Insurance extends Mage_Sales_Model_Order_Invoice_Total_Abstract
{
    /**
     * @param Mage_Sales_Model_Order_Invoice $invoice
     * @return Itra_Insurance_Model_Sales_Order_Total_Invoice_Insurance
     */
    public function collect(Mage_Sales_Model_Order_Invoice $invoice)
    {
        parent::collect($invoice);
        if (Mage::helper('insurance')->isEnabled()) {
            Mage::helper('insurance')->setInsurance($invoice);
        }
        return $this;
    }
}
