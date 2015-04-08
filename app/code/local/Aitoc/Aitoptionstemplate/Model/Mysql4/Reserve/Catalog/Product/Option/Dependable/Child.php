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
class Aitoc_Aitoptionstemplate_Model_Mysql4_Reserve_Catalog_Product_Option_Dependable_Child extends Mage_Core_Model_Mysql4_Abstract
{
    /**
     * Use is object new method for save of object
     *
     * @var boolean
     */
    protected $_useIsObjectNew = true;
    
    protected function _construct()
    {
        $this->_init('aitoptionstemplate/reserve_product_option_dependable_child','reserve_id');
    }
    
}