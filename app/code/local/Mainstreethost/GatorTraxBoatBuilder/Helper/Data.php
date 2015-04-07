<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/7/2015
 * Time: 12:10 PM
 */ 
class Mainstreethost_GatorTraxBoatBuilder_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function ConvertToJson($data)
    {
        return json_encode($data);
    }


    public function FormatObjectForJsonConversion($data)
    {
        $returnArray = array();
        if (is_array($data) || is_object($data))
        {
            $reflector = new ReflectionClass($data);
            $properties = $reflector->getProperties();

            foreach ($properties as $property)
            {
                $returnArray[$property->getName()] = $this->FormatObjectForJsonConversion($data);
            }

            $return = $returnArray;
        }
        else
        {
            $return = $data;
        }

        return $return;
    }
}