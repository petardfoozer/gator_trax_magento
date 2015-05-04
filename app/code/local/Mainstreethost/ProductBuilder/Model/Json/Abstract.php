<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/8/2015
 * Time: 6:06 PM
 */

abstract class Mainstreethost_ProductBuilder_Model_Json_Abstract implements JsonSerializable
{
    public function jsonSerialize()
    {
        $returnArray = array();

        foreach ((new ReflectionClass($this))->getProperties() as $property)
        {
            $returnArray[$property->getName()] = $this->get($property->getName());
        }

        return $returnArray;
    }
}