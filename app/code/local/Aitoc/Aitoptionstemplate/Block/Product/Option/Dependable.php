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
class Aitoc_Aitoptionstemplate_Block_Product_Option_Dependable extends Mage_Core_Block_Template
{
    
    protected $_productInstance;
    protected $_return = array();
    /**
     * Get Product
     *
     * @return Mage_Catalog_Model_Product
     */
    public function getProduct()
    {
        if (!$this->_productInstance) {
            if ($product = Mage::registry('product')) {
                $this->_productInstance = $product;
            }
        }
        return $this->_productInstance;
    }

    /*
     * @param Mage_Catalog_Model_Product $product
     * @return string
     */
    public function getJsValues($product)
    {
        if(is_object($product) && ($product instanceof Mage_Catalog_Model_Product))
        {
            $this->_productInstance = $product;
            $this->_return = array();
        }
        $product = $this->getProduct();
        if(!$product->getId()) {
            return '{}';
        }
        if($product->getTypeId() == 'grouped')
        {
            $this->_addAssociatedProductsOptions();
        }
        //$product will have all options attached here, even the one from templates

        $collection = $this->_getCollectionOptionDependable($product);

        foreach($collection as $item) {
            $option = $product->getOptionById($item->getOptionId());
            $this->_addItems($item, $option);
        }

        if(empty($this->_return)){
            return false;
        }

        $return = new Varien_Object(array('data'=>$this->_return));
        return $return->toJson();
    }

    protected function _addAssociatedProductsOptions()
    {
        $product = $this->getProduct();
        foreach($product->getTypeInstance(true)->getAssociatedProducts($product) as $aProduct)
        {
            $aProduct = Mage::getModel('catalog/product')->load($aProduct->getId());
            //$product will have all options attached here, even the one from templates

            $collection = $this->_getCollectionOptionDependable($aProduct);

            foreach($collection as $item) {
                $option = $aProduct->getOptionById($item->getOptionId());
                $this->_addItems($item, $option, $aProduct->getId());
            }
        }
    }

    /*
     * @param Mage_Catalog_Model_Product $product
     * @return Aitoc_Aitoptionstemplate_Model_Mysql4_Product_Option_Dependable_Collection 
     */
    protected function _getCollectionOptionDependable($product)
    {
//        if(!$collection = $product->getAitDependableOptionsCollection()) {
            $collection = Mage::getModel('aitoptionstemplate/product_option_dependable')->getCollection();
            /** @var $collection Aitoc_Aitoptionstemplate_Model_Mysql4_Product_Option_Dependable_Collection */
            $_helper = Mage::helper('aitoptionstemplate');
            $collection->joinTemplates()->loadByProductOptions($product);
//        }
        return $collection;
    }

    /*
     * @param Aitoc_Aitoptionstemplate_Model_Product_Option_Dependable $item
     * @param Mage_Catalog_Product_Option $option
     * @param mixed $productId
     */
    protected function _addItems($item, $option, $productId = null)
    {
        $productIdAdd = (empty($productId)?'':'_'.$productId);
        $optionId = $item->getOptionId().$productIdAdd;

        if(!isset($this->_return[$optionId])) $this->_return[$optionId] = array();
        $row_id = $item->getOptionValueId().$productIdAdd;
        $children = $item->getDefaultChildren();
        if($item->getTemplateId()) {
            //if product have more than one template assigned template rows can be mixed, because of that we add template id to rows to make them unique
            $row_id = $item->getTemplateId() . $row_id;
            foreach($children as $id => $child_id) {
                $children[$id] = $item->getTemplateId() . $child_id;
            }
        }
        if(!empty($productIdAdd))
        {
            foreach($children as $id => $child_id)
            {
                $children[$id] = $child_id.$productIdAdd;
            }
        }
        
        $array = array(
            //on Frontend negative values are used for templates, positive - for default options
            'row_id' => $row_id,
            'child_rows' => implode(',', $children),
        );

        if(!empty($productId))
        {
            $array['product_id'] = $productId;
        }

        if(!$item->getOptionTypeId()) {
            $array['option_type'] = $option->getType();
        }
        $this->_return[$optionId][$item->getOptionTypeId().$productIdAdd] = $array;
    }
}