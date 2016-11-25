<?php

class Shop_Teacher_Model_Resource_Teacher_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('shop_teacher/teacher', 'shop_teacher/teacher');
    }

}