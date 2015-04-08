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
/* $meta=%default,Aitoc_Aiteditablecart% */
if(Mage::helper('core')->isModuleEnabled('Aitoc_Aiteditablecart')){
    class Aitoc_Aitoptionstemplate_Model_Rewrite_FrontBundleProductType_Aittmp extends Aitoc_Aiteditablecart_Model_Rewrite_FrontBundleProductType {} 
 }else{
    /* default extends start */
    class Aitoc_Aitoptionstemplate_Model_Rewrite_FrontBundleProductType_Aittmp extends Mage_Bundle_Model_Product_Type {}
    /* default extends end */
}

/* AITOC static rewrite inserts end */
class Aitoc_Aitoptionstemplate_Model_Rewrite_FrontBundleProductType extends Aitoc_Aitoptionstemplate_Model_Rewrite_FrontBundleProductType_Aittmp
{
    
    /**
     * Retrive bundle selections collection based on used options
     *
     * @param array $optionIds
     * @param Mage_Catalog_Model_Product $product
     * @return Mage_Bundle_Model_Mysql4_Selection_Collection
     */
    public function getSelectionsCollection($optionIds, $product = null)
    {
        if (version_compare(Mage::getVersion(), '1.5.0.0') >= 0)
        {
            $keyOptionIds = (is_array($optionIds) ? implode('_', $optionIds) : '');
            $key = $this->_keySelectionsCollection . $keyOptionIds;
            if (!$this->getProduct($product)->hasData($key)) {
                $storeId = $this->getProduct($product)->getStoreId();
                $selectionsCollection = Mage::getResourceModel('bundle/selection_collection')
                    ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
                    ->setFlag('require_stock_items', true)
                    ->setFlag('product_children', true)
                    ->setPositionOrder()
                    ->addStoreFilter($this->getStoreFilter($product))
                    ->setStoreId($storeId)
                    ->addFilterByRequiredOptions()
                    ->setOptionIdsFilter($optionIds);
    // START AITOC OPTIONS TEMPLATE  
    
                $product2required = Mage::getResourceModel('aitoptionstemplate/aitproduct2required');
                
                $selectionsCollection->getSelect()->joinLeft($product2required->getTable('aitoptionstemplate/aitproduct2required')." AS p2t"," p2t.product_id = e.entity_id", array('required_options'));
                            
                $selectionsCollection->getSelect()->where('p2t.required_options IS NULL OR p2t.required_options != 1');
    
    // FINISH AITOC OPTIONS TEMPLATE   
                if (!Mage::helper('catalog')->isPriceGlobal() && $storeId) {
                    $websiteId = Mage::app()->getStore($storeId)->getWebsiteId();
                    $selectionsCollection->joinPrices($websiteId);
                }
    
                $this->getProduct($product)->setData($key, $selectionsCollection);
            }
            return $this->getProduct($product)->getData($key);
       } else {       
           if (!$this->getProduct($product)->hasData($this->_keySelectionsCollection)) {
                $selectionsCollection = Mage::getResourceModel('bundle/selection_collection')
                    ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
                    ->setFlag('require_stock_items', true)
                    ->setPositionOrder()
                    ->addStoreFilter($this->getStoreFilter($product))
                    ->addFilterByRequiredOptions()
                    ->setOptionIdsFilter($optionIds);
                    
    // START AITOC OPTIONS TEMPLATE  
    
                $product2required = Mage::getResourceModel('aitoptionstemplate/aitproduct2required');
                
                $selectionsCollection->getSelect()->joinLeft($product2required->getTable('aitoptionstemplate/aitproduct2required')." AS p2t"," p2t.product_id = e.entity_id", array('required_options'));
                            
                $selectionsCollection->getSelect()->where('p2t.required_options IS NULL OR p2t.required_options != 1');
    
    // FINISH AITOC OPTIONS TEMPLATE                
                    
                $this->getProduct($product)->setData($this->_keySelectionsCollection, $selectionsCollection);
            }
            return $this->getProduct($product)->getData($this->_keySelectionsCollection);
       }
    }
    
}

?>