<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/28/2015
 * Time: 2:15 PM
 */

class Mainstreethost_ProductBuilder_Model_Json_Attribute
    extends Mainstreethost_ProductBuilder_Model_Json_Abstract
    implements Mainstreethost_ProductBuilder_Model_Json_IAutojson
{
    private $id;
    private $name;
    private $collection;

    public function __construct()
    {
        $this->collection = array();
    }

    public function Hydrate($attribute)
    {
        $this->id = Mage::helper(('pb'))->CamelCase($attribute->getFrontendLabel());
        $this->name = $attribute->getFrontendLabel();

        $products = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addFieldToFilter($attribute->getAttributeCode(),array('like' => '%%'))
            ->load();

        foreach ($products as $product)
        {
            array_push($this->collection,Mage::getModel('pb/Json_Product')->Hydrate($product));
        }



        return Mage::helper(('pb'))->ConvertToJson($this,true);
    }



    public function get($member)
    {
        return $this->$member;
    }
}