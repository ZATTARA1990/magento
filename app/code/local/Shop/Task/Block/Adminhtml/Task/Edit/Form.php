<?php

class Shop_Task_Block_Adminhtml_Task_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $helper = Mage::helper('shop_task');
        $model = Mage::registry('current_task');

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array(
                't_id' => $this->getRequest()->getParam('t_id')
            )),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $fieldset = $form->addFieldset('task_form', array('legend' => $helper->__('Task Information')));

        $fieldset->addField('name', 'text', array(
            'label' => $helper->__('Name'),
            'required' => true,
            'name' => 'name',
        ));

        $fieldset->addField('description', 'editor', array(
            'label' => $helper->__('Description'),
            'required' => true,
            'name' => 'description',
        ));

        $fieldset->addField('file', 'file', array(
            'label' => $helper->__('File'),
            'required' => true,
            'name' => 'file',
        ));


        $form->setUseContainer(true);
        $form->setValues($model->getData());

        $this->setForm($form);

        return parent::_prepareForm();
    }

}