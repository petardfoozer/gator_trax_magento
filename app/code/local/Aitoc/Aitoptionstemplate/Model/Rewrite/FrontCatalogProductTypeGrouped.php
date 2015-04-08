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
/* AITOC static rewrite inserts start */
/* $meta=%default,Aitoc_Aitgroupedoptions% */
if(Mage::helper('core')->isModuleEnabled('Aitoc_Aitgroupedoptions')){
    class Aitoc_Aitoptionstemplate_Model_Rewrite_FrontCatalogProductTypeGrouped_Aittmp extends Aitoc_Aitgroupedoptions_Model_Rewrite_FrontCatalogProductTypeGrouped {} 
 }else{
    /* default extends start */
    class Aitoc_Aitoptionstemplate_Model_Rewrite_FrontCatalogProductTypeGrouped_Aittmp extends Mage_Catalog_Model_Product_Type_Grouped {}
    /* default extends end */
}

/* AITOC static rewrite inserts end */
class Aitoc_Aitoptionstemplate_Model_Rewrite_FrontCatalogProductTypeGrouped extends Aitoc_Aitoptionstemplate_Model_Rewrite_FrontCatalogProductTypeGrouped_Aittmp
{
    public function getAssociatedProducts($product = null)
    {
        if (!$this->getProduct($product)->hasData($this->_keyAssociatedProducts)) {
            $associatedProducts = array();

            if (!Mage::app()->getStore()->isAdmin()) {
                $this->setSaleableStatus($product);
            }

            $collection = $this->getAssociatedProductCollection($product)
                ->addAttributeToSelect('*')
                ->addFilterByRequiredOptions()
                ->setPositionOrder()
                ->addStoreFilter($this->getStoreFilter($product))
                ->addAttributeToFilter('status', array('in' => $this->getStatusFilters($product)));
                
// START AITOC OPTIONS TEMPLATE  

            $product2required = Mage::getResourceModel('aitoptionstemplate/aitproduct2required');
            
            $collection->getSelect()->joinLeft($product2required->getTable('aitoptionstemplate/aitproduct2required')." AS p2t"," p2t.product_id = e.entity_id");
                        
            $collection->getSelect()->where('p2t.required_options IS NULL OR p2t.required_options != 1');
                
// FINISH AITOC OPTIONS TEMPLATE                
                
            foreach ($collection as $product) {
                $associatedProducts[] = $product;
            }

            $this->getProduct($product)->setData($this->_keyAssociatedProducts, $associatedProducts);
        }
        return $this->getProduct($product)->getData($this->_keyAssociatedProducts);
    }

}