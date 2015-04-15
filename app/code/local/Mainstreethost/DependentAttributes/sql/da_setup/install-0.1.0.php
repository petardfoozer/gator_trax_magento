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
$table = new Varien_Db_Ddl_Table();
$table->setName($this->getTable('da/dependency'));

$table->addColumn(
    'dependency_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => true,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => true
    )
);

$table->addColumn(
    'attribute_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => false,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => false
    ),
    'Attribute Id of primary Attribute'
);

$table->addColumn(
    'depends_on',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => false,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => true
    ),
    'Attribute Id of Attribute that primary Attribute depends on'
);

$table->addColumn(
    'dependencies',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    5000,
    array(
        'nullable' => true,
    ),
    'Serialized data for dependency relationships between attributes'
);

//I guess we can add these for sorting?
$table->addColumn(
    'created_at',
    Varien_Db_Ddl_Table::TYPE_DATETIME,
    null,
    array(
        'nullable' => false,
    )
);
$table->addColumn(
    'updated_at',
    Varien_Db_Ddl_Table::TYPE_DATETIME,
    null,
    array(
        'nullable' => false,
    )
);

/**
 * These two important lines are often missed.
 */
$table->setOption('type', 'InnoDB');
$table->setOption('charset', 'utf8');
$this->getConnection()->createTable($table);


$table_map = new Varien_Db_Ddl_Table();
$table_map->setName($this->getTable('da/dependency_map'));

$table_map->addColumn(
    'dependency_map_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => true,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => true
    )
);

$table_map->addColumn(
    'attribute_code',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    5000,
    array(
        'nullable' => true,
    )
);

$table_map->addColumn(
    'attribute_code_value_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => false,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => false
    )
);

$table_map->addColumn(
    'depends_on',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    5000,
    array(
        'nullable' => true,
    )
);

$table_map->addColumn(
    'depends_on_value_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => false,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => false
    )
);

$table_map->setOption('type', 'InnoDB');
$table_map->setOption('charset', 'utf8');
$this->getConnection()->createTable($table_map);

$this->endSetup();