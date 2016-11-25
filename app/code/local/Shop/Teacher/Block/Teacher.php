<?php

class Shop_Teacher_Block_Teacher extends Mage_Core_Block_Template
{

    public function getNewsCollection()
    {
        $newsCollection = Mage::getModel('shop_teacher/teacher')->getCollection();
        $newsCollection->setOrder('created_at', 'DESC');
        return $newsCollection;
    }

}