<?php

class Shop_Teacher_Block_Adminhtml_Teacher_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected function _construct()
    {
        $this->_blockGroup = 'shop_teacher';
        $this->_controller = 'adminhtml_teacher';
    }

    public function getHeaderText()
    {
        $helper = Mage::helper('Shop_Teacher');
        $model = Mage::registry('current_teacher');

        if ($model->getId()) {
            return $helper->__("Edit Teachers item '%s'", $this->escapeHtml($model->getName()));
        } else {
            return $helper->__("Add Teachers item");
        }
    }
}