<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/7/2015
 * Time: 3:44 PM
 */

class Mainstreethost_GatorTraxBoatBuilder_Model_Json_Boatmodel implements JsonSerializable
{
    private $boatModels;


    function __construct()
    {
        $this->boatModels = array();
    }


    public function Hydrate($boatModels)
    {
        foreach($boatModels as $boatModel)
        {
            array_push($this->boatModels,Mage::getModel('gator/Json_BoatModel_Boatmodel')->Hydrate($boatModel));
        }

        return Mage::helper('gator')->ConvertToJson($this->jsonSerialize());
    }


    public function jsonSerialize()
    {
        return [
            'boatModelCollection' => $this->boatModels
        ];
    }

}