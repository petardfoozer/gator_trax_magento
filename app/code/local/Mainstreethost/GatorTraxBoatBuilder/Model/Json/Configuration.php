<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/28/2015
 * Time: 6:39 PM
 */

class Mainstreethost_GatorTraxBoatBuilder_Model_Json_Configuration
    extends Mainstreethost_GatorTraxBoatBuilder_Model_Json_Abstract
    implements Mainstreethost_GatorTraxBoatBuilder_Model_Json_IAutojson
{
    private $id;
    private $name;
    private $optionId;
    private $optionValueId;
    private $rules;


    public function __construct()
    {
        $this->rules = array();
    }

    public function Hydrate($configuration)
    {
        $this->id               = (int)$configuration->getConfigurationId();
        $this->name             = Mage::helper('gator')->GetOptionValueNameFromId($configuration->getOptionId(),$configuration->getOptionValueId()) . ' ' . Mage::helper('gator')->GetOptionNameFromId($configuration->getOptionId());
        $this->optionId         = $configuration->getOptionId();
        $this->optionValueId    = $configuration->getOptionValueId();








        return $this;
    }



    public function get($member)
    {
        return $this->$member;
    }
}