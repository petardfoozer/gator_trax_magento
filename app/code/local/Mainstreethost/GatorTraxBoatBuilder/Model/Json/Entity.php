<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/28/2015
 * Time: 7:34 AM
 */

class Mainstreethost_GatorTraxBoatBuilder_Model_Json_Entity extends Mainstreethost_GatorTraxBoatBuilder_Model_Json_Abstract implements Mainstreethost_GatorTraxBoatBuilder_Model_Json_IAutojson
{
    private $id;
    private $name;
    private $collection;
    private $attributes;


    public function construct()
    {

    }


    public function Hydrate($product)
    {
        $product = Mage::getModel('catalog/product')->load($product->getEntityId());
        $this->id = Mage::helper('gator')->CamelCase($product->getName());
        $this->name = $product->getName();

        if(Mage::helper('gator')->DoesProductHaveAttribute($product,Mage::getStoreConfig('profileconfiguratorsettings/profileconfiguratorgroup/profileconfiguratorattribute')))
        {
            array_push($this->collection, Mage::getModel('gator/Json_Collection')->Hydrate($option));
        }
        else
        {
            foreach ($product->getOptions() as $option)
            {
                array_push($this->attributes, Mage::getModel('gator/Json_Collection')->Hydrate($option));
            }
        }
        return Mage::helper('gator')->ConvertToJson($this);
    }


    public function get($member)
    {
        return $this->$member;
    }
}