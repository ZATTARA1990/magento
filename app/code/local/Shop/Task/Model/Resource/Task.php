<?php

class Shop_Task_Model_Resource_Task extends Mage_Core_Model_Mysql4_Abstract
{

    public function _construct()
    {
        $this->_init('shop_task/task', 't_id');
    }

}