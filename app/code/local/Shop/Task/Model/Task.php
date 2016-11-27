<?php

class Shop_Task_Model_Task extends Mage_Core_Model_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('shop_task/task');
    }
    protected function _afterDelete()
    {
        $helper = Mage::helper('shop_task');
        @unlink($helper->getFilePath($this->getT_id()));
        return parent::_afterDelete();
    }

    public function getFileUrl()
    {
        $helper = Mage::helper('shop_task');
        if ($this->getT_id() && file_exists($helper->getFilePath($this->getT_id()))) {
            return $helper->getFileUrl($this->getT_id());
        }
        return null;
    }
}