<?php

class Shop_Task_Adminhtml_TaskController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('shop_task');

        $contentBlock = $this->getLayout()->createBlock('shop_task/adminhtml_task');
        $this->_addContent($contentBlock);
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = (int) $this->getRequest()->getParam('t_id');
        Mage::register('current_task', Mage::getModel('shop_task/task')->load($id));

        $this->loadLayout()->_setActiveMenu('shop_task');
        $this->_addContent($this->getLayout()->createBlock('shop_task/adminhtml_task_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        $id = $this->getRequest()->getParam('t_id');
        if ($data = $this->getRequest()->getPost()) {
            try {
                $helper = Mage::helper('shop_task');
                $model = Mage::getModel('shop_task/task');

                $model->setData($data)->setT_id($id);

                if (!$model->getCreated_at()) {
                    $model->setCreated(now());
                }


                $model->save();

                $id = $model->getT_id();


                if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
                    $uploader = new Varien_File_Uploader('file');
                    $uploader->setAllowedExtensions(array('docx', 'xlsx'));
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);
                    $ext = $uploader->getFileExtension();
                    $path = Mage::getBaseDir('media') . '/task';
                    $uploader->save($path,$id.'.'.$ext);

                    $data = array_merge($data, array('file' => 'task/'.$id.'.'.$ext));


                  //  $data = array_merge($data, array('file' => $path.'/'.$id.'.'.$ext));

                } else {
                    if (isset($data['file']['delete']) && $data['file']['delete'] == 1) {
                        @unlink($helper->getFilePath($id));
                    }
                }


                $model->setData($data)->setT_id($id);
                               $model->save();


                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Task was saved successfully'));
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
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                Mage::getModel('dsnews/news')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('News was deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $tasks = $this->getRequest()->getParam('tasks', null);

        if (is_array($tasks) && sizeof($tasks) > 0) {
            try {
                foreach ($tasks as $id) {
                    Mage::getModel('shop_task/task')->setT_id($id)->delete();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d tasks have been deleted', sizeof($tasks)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select tasks'));
        }
        $this->_redirect('*/*');
    }

}