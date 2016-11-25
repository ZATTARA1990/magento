<?php

class Shop_Teacher_Adminhtml_TeacherController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('Shop_Teacher');

        $contentBlock = $this->getLayout()->createBlock('shop_teacher/adminhtml_teacher');
        $this->_addContent($contentBlock);
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = (int)$this->getRequest()->getParam('t_id');
        Mage::register('current_teacher', Mage::getModel('shop_teacher/teacher')->load($id));

        $this->loadLayout()->_setActiveMenu('Shop_Teacher');
        $this->_addContent($this->getLayout()->createBlock('shop_teacher/adminhtml_teacher_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        $id = $this->getRequest()->getParam('t_id');
        if ($data = $this->getRequest()->getPost()) {
            try {
                $helper = Mage::helper('Shop_Teacher');
                $model = Mage::getModel('shop_teacher/teacher');

                $model->setData($data)->setT_id($id);

                if (!$model->getCreated_at()) {
                    $model->setCreated(now());
                }


                $model->save();

                $id = $model->getT_id();


                if (isset($_FILES['photo']['name']) && $_FILES['photo']['name'] != '') {
                    $uploader = new Varien_File_Uploader('photo');
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg'));
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);
                    $uploader->save($helper->getImagePath(),$id.'.'.$uploader->getFileExtension()); // Upload the image

                    $path = $helper->getImagePath($id);

                    $data = array_merge($data, array('photo' => $path));

                } else {
                    if (isset($data['photo']['delete']) && $data['photo']['delete'] == 1) {
                        @unlink($helper->getImagePath($id));
                    }
                }


                $model->setData($data)->setT_id($id);
                if (!$model->getCreated()) {
                    $model->setCreated(now());
                }


                $model->save();


                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Teacher was saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id' => $id
                ));
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }


    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('t_id')) {
            try {
                Mage::getModel('shop_teacher/teacher')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Teacher was deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $teachers = $this->getRequest()->getParam('teacher', null);

        if (is_array($teachers) && sizeof($teachers) > 0) {
            try {
                foreach ($teachers as $id) {
                    Mage::getModel('shop_teacher/teacher')->setT_id($id)->delete();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d teachers have been deleted',
                    sizeof($teachers)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select teachers'));
        }
        $this->_redirect('*/*');
    }

}