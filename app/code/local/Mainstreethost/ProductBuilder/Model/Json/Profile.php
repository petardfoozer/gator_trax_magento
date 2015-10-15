<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/28/2015
 * Time: 5:27 PM
 */

class Mainstreethost_ProductBuilder_Model_Json_Profile
    extends Mainstreethost_ProductBuilder_Model_Json_Abstract
    implements Mainstreethost_ProductBuilder_Model_Json_IAutojson
{
    private $id;
    private $name;
    private $configurations;


    public function __construct()
    {
        $this->configurations = array();
    }

    public function Hydrate($profile)
    {
        $this->id       = (int)$profile->getProfileId();
        $this->name     = Mage::helper(('pb'))->GetAttributeValueById($profile->getProfileAttributeValueId());
        $configurations = Mage::getModel('pc/configuration')->LoadByProfileId($profile->getProfileId());

        foreach ($configurations as $configuration)
        {
            array_push($this->configurations,Mage::getModel('pb/Json_Configuration')->Hydrate($configuration));
        }

        return $this;
    }



    public function get($member)
    {
        return $this->$member;
    }
}