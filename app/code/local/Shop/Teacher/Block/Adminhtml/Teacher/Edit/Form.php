<?php

class Shop_Teacher_Block_Adminhtml_Teacher_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $helper = Mage::helper('Shop_Teacher');
        $model = Mage::registry('current_teacher');

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array(
                't_id' => $this->getRequest()->getParam('t_id')
            )),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));



        $fieldset = $form->addFieldset('teacher_form', array('legend' => $helper->__('Teacher Information')));

        $fieldset->addField('name', 'text', array(
            'label' => $helper->__('Name'),
            'required' => true,
            'name' => 'name',
        ));

        /*$fieldset->addField('skils', 'select', array(
            'label' => $helper->__('Skills'),
            'required' => true,
            'name' => 'skills',
        ));*/

        $fieldset->addField('photo', 'image', array(
            'label' => $helper->__('Photo'),
            'required' => true,
            'name' => 'photo',
        ));



        $form->setUseContainer(true);
        $formData = array_merge($model->getData(), array('photo' => $model->getImageUrl()));
        $form->setValues($formData);

        $this->setForm($form);


    /*

        if($data = Mage::getSingleton('adminhtml/session')->getFormData()){
            $form->setValues($data);
        } else {
            $form->setValues($model->getData());
        }*/

        return parent::_prepareForm();
    }

}

