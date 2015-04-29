<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/28/2015
 * Time: 5:27 PM
 */

class Mainstreethost_GatorTraxBoatBuilder_Model_Json_Profile
    extends Mainstreethost_GatorTraxBoatBuilder_Model_Json_Abstract
    implements Mainstreethost_GatorTraxBoatBuilder_Model_Json_IAutojson
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
        $this->id                   = (int)$profile->getProfileId();
        $this->name                 = Mage::helper('gator')->GetAttributeValueById($profile->getProfileAttributeValueId());
        $configurationCollection    = Mage::getModel('pc/configuration')->LoadByProfileId($profile->getProfileId());

        foreach ($configurationCollection as $configuration)
        {
            array_push($this->configurations,Mage::getModel('gator/Json_Configuration')->Hydrate($configuration));
        }





        return $this;
    }



    public function get($member)
    {
        return $this->$member;
    }
}