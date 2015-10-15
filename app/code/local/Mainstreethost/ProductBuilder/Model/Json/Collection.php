<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/28/2015
 * Time: 11:26 AM
 */

class Mainstreethost_ProductBuilder_Model_Json_Collection extends Mainstreethost_ProductBuilder_Model_Json_Abstract implements Mainstreethost_ProductBuilder_Model_Json_IAutojson
{
    private $id;
    private $name;
    private $attributes;


    public function construct()
    {

    }


    public function Hydrate($option)
    {
        $this->id       = Mage::helper(('pb'))->CamelCase($option->getName());
        $this->name     = $option->getName();


        $i = 1;
        foreach($option->getOptions() as $attribute)
        {
            //array_push($collection,Mage::getModel('pb/Json_Collection'));
        }

        return Mage::helper(('pb'))->ConvertToJson($this);
    }


    public function get($member)
    {
        return $this->$member;
    }
}
