<?php

class Shop_Task_Block_Adminhtml_Task_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected function _construct()
    {
        $this->_blockGroup = 'shop_task';
        $this->_controller = 'adminhtml_task';
    }

    public function getHeaderText()
    {
        $helper = Mage::helper('shop_task');
        $model = Mage::registry('current_task');

        if ($model->getT_id()) {
            return $helper->__("Edit Task item '%s'", $this->escapeHtml($model->getName()));
        } else {
            return $helper->__("Add Task item");
        }
    }

}