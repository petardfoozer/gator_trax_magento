<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/11/2015
 * Time: 2:12 PM
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */

$this->startSetup();

/**
 * Note: there are many ways in Magento to achieve the same result of
 * creating a database table. For this tutorial, we have gone with the
 * Varien_Db_Ddl_Table method, but feel free to explore what Magento
 * does in CE 1.8.0.0 and earlier versions.
 */

//region profiles table
$profilesTable = new Varien_Db_Ddl_Table();
$profilesTable->setName($this->getTable('pc/profile'));
$profilesTable->addColumn(
    'profile_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => true,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => true
    )
);
$profilesTable->addColumn(
    'profile_attribute_value_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => false,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => false
    )
);
$profilesTable->addColumn(
    'created_at',
    Varien_Db_Ddl_Table::TYPE_DATETIME,
    null,
    array(
        'nullable' => false,
    )
);
$profilesTable->addColumn(
    'updated_at',
    Varien_Db_Ddl_Table::TYPE_DATETIME,
    null,
    array(
        'nullable' => false,
    )
);
$profilesTable->setOption('type','InnoDB');
$profilesTable->setOption('charset','utf8');
$this->getConnection()->createTable($profilesTable);
//endregion
//region configs table
$configsTable = new Varien_Db_Ddl_Table();
$configsTable->setName($this->getTable('pc/configuration'));
$configsTable->addColumn(
    'configuration_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => true,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => true
    )
);
$configsTable->addColumn(
    'profile_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => false,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => false
    )
);
$configsTable->addColumn(
    'option_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => false,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => false
    )
);
$configsTable->addColumn(
    'option_value_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => false,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => false
    )
);
$configsTable->addColumn(
    'created_at',
    Varien_Db_Ddl_Table::TYPE_DATETIME,
    null,
    array(
        'nullable' => false,
    )
);
$configsTable->addColumn(
    'updated_at',
    Varien_Db_Ddl_Table::TYPE_DATETIME,
    null,
    array(
        'nullable' => false,
    )
);
$configsTable->setOption('type','InnoDB');
$configsTable->setOption('charset','utf8');
$this->getConnection()->createTable($configsTable);

$rulesTable = new Varien_Db_Ddl_Table();
$rulesTable->setName($this->getTable('pc/rule'));
$rulesTable->addColumn(
    'rule_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => true,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => true
    )
);
$rulesTable->addColumn(
    'entity_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => false,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => false
    )
);
$rulesTable->addColumn(
    'option_value_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => false,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => false
    )
);
$rulesTable->addColumn(
    'operator',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    10,
    array(
        'auto_increment' => false,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => false
    )
);
$rulesTable->addColumn(
    'target_entity_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => false,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => false
    )
);
$rulesTable->addColumn(
    'target_entity_name',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    10,
    array(
        'auto_increment' => false,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => false
    )
);
$rulesTable->addColumn(
    'target_option_value',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => false,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => false
    )
);
$rulesTable->addColumn(
    'target_option_value_name',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    10,
    array(
        'auto_increment' => false,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => false
    )
);
$rulesTable->addColumn(
    'profile_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => false,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => true
    )
);
$rulesTable->addColumn(
    'configuration_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => false,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => false
    )
);
$rulesTable->addColumn(
    'created_at',
    Varien_Db_Ddl_Table::TYPE_DATETIME,
    null,
    array(
        'nullable' => false,
    )
);
$rulesTable->setOption('type','InnoDB');
$rulesTable->setOption('charset','utf8');
$this->getConnection()->createTable($rulesTable);



$this->endSetup();