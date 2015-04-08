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

/* AITOC static rewrite inserts start */
/* $meta=%default,Aitoc_Aitgroupedoptions% */
if(Mage::helper('core')->isModuleEnabled('Aitoc_Aitgroupedoptions')){
    class Aitoc_Aitoptionstemplate_Block_Rewrite_AdminhtmlCatalogProductEditTabSuperGroup_Aittmp extends Aitoc_Aitgroupedoptions_Block_Rewrite_AdminhtmlCatalogProductEditTabSuperGroup {} 
 }else{
    /* default extends start */
    class Aitoc_Aitoptionstemplate_Block_Rewrite_AdminhtmlCatalogProductEditTabSuperGroup_Aittmp extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Super_Group {}
    /* default extends end */
}

/* AITOC static rewrite inserts end */
class Aitoc_Aitoptionstemplate_Block_Rewrite_AdminhtmlCatalogProductEditTabSuperGroup extends Aitoc_Aitoptionstemplate_Block_Rewrite_AdminhtmlCatalogProductEditTabSuperGroup_Aittmp
{
    protected function _prepareCollection()
    {
        $allowProductTypes = array();
        foreach (Mage::getConfig()->getNode('global/catalog/product/type/grouped/allow_product_types')->children() as $type) {
            $allowProductTypes[] = $type->getName();
        }

        $collection = Mage::getModel('catalog/product_link')->useGroupedLinks()
            ->getProductCollection()
            ->setProduct($this->_getProduct())
            ->addAttributeToSelect('*')
            ->addFilterByRequiredOptions()
            ->addAttributeToFilter('type_id', $allowProductTypes);
            
// START AITOC OPTIONS TEMPLATE  
        
        $product2required = Mage::getResourceModel('aitoptionstemplate/aitproduct2required');
        
        $collection->getSelect()->joinLeft($product2required->getTable('aitoptionstemplate/aitproduct2required')." AS p2t"," p2t.product_id = e.entity_id");
                    
        $collection->getSelect()->where('p2t.required_options IS NULL OR p2t.required_options != 1');
        
// FINISH AITOC OPTIONS TEMPLATE            

        $this->setCollection($collection);
        
        return Mage_Adminhtml_Block_Widget_Grid::_prepareCollection();
    }

}