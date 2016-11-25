<?php

class Shop_Teacher_IndexController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {

        $teachers = Mage::getModel('shop_teacher/teacher')->getCollection();
        $viewUrl = Mage::getUrl('teacher/index/view');

        echo '<h1>Teachers!</h1>';
        foreach ($teachers as $item) {
            echo '<h2><a href="' . $viewUrl . '?id=' . $item->getT_id() . '">' . $item->getName() . '</a></h2>';
        }
    }

    public function viewAction()
    {
        $teacherId = Mage::app()->getRequest()->getParam('id', 0);
        $teacher = Mage::getModel('shop_teacher/teacher')->load($teacherId);

        if ($teacher->getT_id() > 0) {
            echo '<h1>' . $teacher->getName() . '</h1>';
            echo '<div class="content">' . $teacher->getPhoto() . '</div>';
        } else {
            $this->_forward('noRoute');
        }
    }

}