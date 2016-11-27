<?php

class Shop_Task_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getFilePath($id = 0, $ext = 'docx')
    {
        $path = Mage::getBaseDir('media') . '/task';
        if ($id) {
            return "{$path}/{$id}.{$ext}";
        } else {
            return $path;
        }
    }

    public function getFileUrl($id = 0, $ext = 'docx')
    {
        $url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'task/';
        if ($id) {
            return $url . $id . '.' . $ext;
        } else {
            return $url;
        }
    }
}