<?php

class Itra_Insurance_Model_Sales_Quote_Address_Total_Insurance extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
    const SHIPPING_ADDRESS_TYPE = 'shipping';

    /**
     * @param Mage_Sales_Model_Quote_Address $address
     * @return Itra_Insurance_Model_Sales_Quote_Address_Total_Insurance
     */
    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        parent::collect($address);
        if (Mage::helper('insurance')->isEnabled() && $address->getAddressType() == self::SHIPPING_ADDRESS_TYPE) {
            Mage::helper('insurance')->setInsurance($address);
        }
        return $this;
    }

    /**
     * @param Mage_Sales_Model_Quote_Address $address
     * @return Itra_Insurance_Model_Sales_Quote_Address_Total_Insurance
     */
    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        parent::fetch($address);
        if (Mage::helper('insurance')->isEnabled() && $address->getAddressType() == self::SHIPPING_ADDRESS_TYPE) {
            $quote = $address->getQuote();
            $insurance_amount = $quote->getInsuranceAmount();
            $address->addTotal(array(
                'code' => $this->getCode(),
                'title' => Mage::helper('insurance')->__('Cost of insurance'),
                'value' => $insurance_amount
            ));
        }
        return $this;
    }
}