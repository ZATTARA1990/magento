<?php

class Shop_Task_Block_Adminhtml_Task extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    protected function _construct()
    {
        parent::_construct();

        $helper = Mage::helper('shop_task');
        $this->_blockGroup = 'shop_task';
        $this->_controller = 'adminhtml_task';

        $this->_headerText = $helper->__('Task Management');
        $this->_addButtonLabel = $helper->__('Add Task');
    }

}