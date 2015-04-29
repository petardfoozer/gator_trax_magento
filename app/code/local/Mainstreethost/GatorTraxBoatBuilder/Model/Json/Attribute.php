<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/28/2015
 * Time: 2:15 PM
 */

class Mainstreethost_GatorTraxBoatBuilder_Model_Json_Attribute
    extends Mainstreethost_GatorTraxBoatBuilder_Model_Json_Abstract
    implements Mainstreethost_GatorTraxBoatBuilder_Model_Json_IAutojson
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
        $this->id = Mage::helper('gator')->CamelCase($attribute->getFrontendLabel());
        $this->name = $attribute->getFrontendLabel();

        $products = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addFieldToFilter($attribute->getAttributeCode(),array('like' => '%%'))
            ->load();

        foreach ($products as $product)
        {
            array_push($this->collection,Mage::getModel('gator/Json_Product')->Hydrate($product));
        }



        return Mage::helper('gator')->ConvertToJson($this,true);
    }



    public function get($member)
    {
        return $this->$member;
    }
}