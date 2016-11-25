<?php

class Shop_Teacher_Model_Resource_Teacher extends Mage_Core_Model_Mysql4_Abstract
{

    public function _construct()
    {
        $this->_init('shop_teacher/teacher', 't_id');
    }


}