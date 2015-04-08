<?php
/**
 * Custom Options Templates
 *
 * @category:    Aitoc
 * @package:     Aitoc_Aitoptionstemplate
 * @version      3.2.9
 * @license:     iMG8ryrQYpy7f1WPNeYUzChWzfnzPomRnwOzOdn2KA
 * @copyright:   Copyright (c) 2014 AITOC, Inc. (http://www.aitoc.com)
 */
/**
 * @copyright  Copyright (c) 2009 AITOC, Inc. 
 */

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$row = $installer->getTableRow('catalog/product', 'entity_id', 0);
Mage::getConfig()->getResourceModel()->loadToXml(Mage::getConfig());
$last_id_old = Mage::getConfig()->getNode('general/aitoptionstemplate/default_product_id', 'default');
$last_id_old = intval($last_id_old);

$installer->run("
INSERT INTO {$this->getTable('catalog/product')} (`entity_id`, `entity_type_id`, `attribute_set_id`, `type_id`, `sku`, `created_at`, `updated_at`, `has_options`, `required_options`) 
VALUES(NULL, 4, 1, 'simple', 'aitoptionstemplate_special_product', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0);
    ");
$last_id = $installer->getConnection()->lastInsertId();
$last_id = intval($last_id);

$product = Mage::getModel('catalog/product');
/* @var $product Mage_Catalog_Model_Product */
//$product->load($last_id);
$product->setId($last_id);
$product->addAttributeUpdate('name', '!DO NOT DELETE ME! AITOC Custom Options Templates special product',Mage_Core_Model_App::ADMIN_STORE_ID);

Mage::getConfig()->saveConfig('general/aitoptionstemplate/default_product_id',$last_id);


$installer->run("
    UPDATE {$this->getTable('catalog/product_option')} SET product_id = $last_id WHERE product_id = $last_id_old;
    DELETE FROM {$this->getTable('catalog/product')} where entity_id = $last_id_old;
");
if (count($row))
{
    $installer->run("
        DELETE FROM {$this->getTable('catalog/product')} where entity_id = 0;
    ");
}
$installer->endSetup();