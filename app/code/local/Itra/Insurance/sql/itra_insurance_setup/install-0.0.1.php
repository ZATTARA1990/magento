<?php

$installer = $this;
$conn = $installer->getConnection();


$tableSalesQuote = $installer->getTable('sales/quote');
$tableSalesOrder = $installer->getTable('sales/order');
$tableSalesInvoice = $installer->getTable('sales/invoice');
$tableSalesCreditmemo = $installer->getTable('sales/creditmemo');

$installer->startSetup();

$conn->addColumn($tableSalesQuote, 'insurance_amount', array(
    'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'scale'     => 4,
    'precision' => 12,
    'nullable' => true,
    'default' => null,
    'comment' => 'Insurance amount',
));
$conn->addColumn($tableSalesOrder, 'insurance_amount', array(
    'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'scale'     => 4,
    'precision' => 12,
    'nullable' => true,
    'default' => null,
    'comment' => 'Insurance amount',
));
$conn->addColumn($tableSalesInvoice, 'insurance_amount', array(
    'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'scale'     => 4,
    'precision' => 12,
    'nullable' => true,
    'default' => null,
    'comment' => 'Insurance amount',
));
$conn->addColumn($tableSalesCreditmemo, 'insurance_amount', array(
    'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'scale'     => 4,
    'precision' => 12,
    'nullable' => true,
    'default' => null,
    'comment' => 'Insurance amount',
));

$installer->endSetup();