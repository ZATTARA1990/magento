<?php

class Shop_Teacher_Model_Resource_Teacher_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('shop_teacher/teacher', 'shop_teacher/teacher');
    }

    public function _initSelect()
    {
        parent::_initSelect();
        $this->getSelect()
            ->joinLeft(
                array('skills' => $this->getTable('shop_teacher/skills')),
                'main_table.t_id = skills.s_id',
                array('name')
            );
        return $this;
    }

}