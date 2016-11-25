<?php

class Shop_Teacher_Model_Teacher extends Mage_Core_Model_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('shop_teacher/teacher');
    }
    protected function _afterDelete()
    {
        $helper = Mage::helper('Shop_Teacher');
        @unlink($helper->getImagePath($this->getT_id()));
        return parent::_afterDelete();
    }

    public function getImageUrl()
    {
        $helper = Mage::helper('Shop_Teacher');
        if ($this->getT_id() && file_exists($helper->getImagePath($this->getT_id()))) {
            return $helper->getImageUrl($this->getT_id());
        }
        return null;
    }
}