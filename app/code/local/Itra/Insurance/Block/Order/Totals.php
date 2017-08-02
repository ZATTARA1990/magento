<?php

class Itra_Insurance_Block_Order_Totals extends Mage_Sales_Block_Order_Totals
{

    /**
     * @return Itra_Insurance_Block_Order_Totals
     */
    protected function _initTotals()
    {
        parent::_initTotals();

        /**
         * Add insurance
         */
        if (Mage::helper('insurance')->isEnabled()) {

            $this->addTotalBefore(new Varien_Object(array(
                'code'      => 'insurance',
                'value'     => $this->getSource()->getInsuranceAmount(),
                'base_value'=> $this->getSource()->getInsuranceAmount(),
                'label'     => $this->__('Shipping Insurance'),
            ), array('shipping', 'tax')));
        }

        return $this;


    }
}