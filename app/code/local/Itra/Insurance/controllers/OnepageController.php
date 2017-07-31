<?php

require_once 'Mage/Checkout/controllers/OnepageController.php';

class Itra_Insurance_OnepageController extends Mage_Checkout_OnepageController
{
    /**
     * Shipping method save action
     */
    public function saveShippingMethodAction()
    {
        if ($this->_expireAjax()) {
            return;
        }
        if ($this->getRequest()->isPost()) {
            $shipping_method = $this->getRequest()->getPost('shipping_method', '');
            $useInsurance = $this->getRequest()->getPost('insurance');
            $result = $this->getOnepage()->saveShippingMethod($shipping_method, $useInsurance);

            if (!$result) {
                Mage::dispatchEvent(
                    'checkout_controller_onepage_save_shipping_method',
                    array(
                        'request' => $this->getRequest(),
                        'quote' => $this->getOnepage()->getQuote()));
                $this->getOnepage()->getQuote()->collectTotals();
                $this->_prepareDataJSON($result);

                $result['goto_section'] = 'payment';
                $result['update_section'] = array(
                    'name' => 'payment-method',
                    'html' => $this->_getPaymentMethodsHtml()
                );

            }
            $this->getOnepage()->getQuote()->collectTotals()->save();
            $this->_prepareDataJSON($result);
        }
    }
}