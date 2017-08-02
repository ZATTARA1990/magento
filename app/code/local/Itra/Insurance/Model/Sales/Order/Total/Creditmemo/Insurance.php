<?php

class Itra_Insurance_Model_Sales_Order_Total_Creditmemo_Insurance extends Mage_Sales_Model_Order_Creditmemo_Total_Abstract
{
    /**
     * @param Mage_Sales_Model_Order_Creditmemo $creditmemo
     * @return Itra_Insurance_Model_Sales_Order_Total_Creditmemo_Insurance
     */
    public function collect(Mage_Sales_Model_Order_Creditmemo $creditmemo)
    {
        parent::collect($creditmemo);
        if (Mage::helper('insurance')->isEnabled()) {
            Mage::helper('insurance')->setInsurance($creditmemo);
        }
        return $this;
    }
}
