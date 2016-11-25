<?php

$installer = $this;

$tableSkills = $installer->getTable('shop_teacher/skills');
$tableTeacher = $installer->getTable('shop_teacher/teacher');

$installer->startSetup();

$installer->getConnection()->dropTable($tableSkills);
$tableOne = $installer->getConnection()
    ->newTable($tableSkills)
    ->addColumn('s_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => false,
    ))
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable' => false,
    ))
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable' => false,
    ))
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable' => false,
    ))
    ->addForeignKey('skill', 's_id', $tableTeacher, 't_id');

$installer->getConnection()->createTable($tableOne);


$tableTwo = $installer->getConnection()
    ->newTable($tableTeacher)
    ->addColumn('t_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'auto_increment' => true,
        'identity' => true,
        'nullable' => false,
        'primary' => true,
    ))
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable' => false,
    ))
    /* ->addColumn('skills', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
         'nullable' => true,
     ))*/
    ->addColumn('photo', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable' => false,
    ))
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable' => false,
    ))
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable' => false,
    ));


$installer->getConnection()->createTable($tableTwo);


$installer->endSetup();

