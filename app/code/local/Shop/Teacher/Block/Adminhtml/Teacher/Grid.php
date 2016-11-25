<?php

class Shop_Teacher_Block_Adminhtml_Teacher_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('shop_teacher/teacher')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

       $helper = Mage::helper('Shop_Teacher');

        $this->addColumn('t_id', array(
            'header' => $helper->__('Teacher ID'),
            'index' => 't_id'
        ));

        $this->addColumn('name', array(
            'header' => $helper->__('Name'),
            'index' => 'name',
            'type' => 'text',
        ));

        $this->addColumn('photo', array(
            'header' => $helper->__('Photo'),
            'index' => 'photo',
            'type' => 'image',
        ));

        $this->addColumn('skills', array(
            'header' => $helper->__('Skills'),
            'index' => 'skills',
            'type' => 'text',
        ));


        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('t_id');
        $this->getMassactionBlock()->setFormFieldName('teacher');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => $this->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
        ));
        return $this;
    }

    public function getRowUrl($model)
    {
        return $this->getUrl('*/*/edit', array(
            't_id' => $model->getT_id(),
        ));
    }

}