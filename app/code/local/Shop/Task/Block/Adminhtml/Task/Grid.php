<?php

class Shop_Task_Block_Adminhtml_Task_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('shop_task/task')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $helper = Mage::helper('shop_task');

        $this->addColumn('t_id', array(
            'header' => $helper->__('Task ID'),
            'index' => 't_id'
        ));

        $this->addColumn('name', array(
            'header' => $helper->__('Name'),
            'index' => 'name',
            'type' => 'text',
        ));

        $this->addColumn('description', array(
            'header' => $helper->__('Description'),
            'index' => 'description',
            'type' => 'text',
        ));

        $this->addColumn('file', array(
            'header' => $helper->__('File'),
            'index' => 'file',
            'type' => 'text',
        ));


        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('task_id');
        $this->getMassactionBlock()->setFormFieldName('tasks');

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