<?php

class Shop_Teacher_Block_Adminhtml_Teacher extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    protected function _construct()
    {
        parent::_construct();

        $helper = Mage::helper('Shop_Teacher');
        $this->_blockGroup = 'shop_teacher';
        $this->_controller = 'adminhtml_teacher';

        $this->_headerText = $helper->__('Teacher Management');
        $this->_addButtonLabel = $helper->__('Add teacher');
    }

}