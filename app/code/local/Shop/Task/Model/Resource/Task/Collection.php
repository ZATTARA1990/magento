<?php

class Shop_Task_Model_Resource_Task_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('shop_task/task');
    }

}