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
 * @copyright  Copyright (c) 2010 AITOC, Inc. 
 */
  class Aitoc_Aitoptionstemplate_Model_Mysql4_Reserve_Catalog_Product_Optiontemplate extends Mage_Core_Model_Mysql4_Abstract
{
    
    protected function _construct()
    {
        $this->_init('aitoptionstemplate/reserve_catalog_product_optiontemplate','reserve_id');
    }
    
    public function saveData($templateId)
    {
        if(empty($templateId))
        {
            return ;
        }
        //reserving
        Mage::getResourceModel('aitoptionstemplate/reserve_catalog_product_option')->reserveTemplateOptions($templateId); 
        Mage::getResourceModel('aitoptionstemplate/reserve_catalog_product_required')->reserveRequiredProducts($templateId); 
        Mage::getResourceModel('aitoptionstemplate/reserve_catalog_product_template')->reserveTemplateProducts($templateId);
        Mage::getResourceModel('aitoptionstemplate/reserve_catalog_product_option_dependable')->reserveTemplateDependableOptions($templateId); 
        
        //reserving 
    }
    
}