<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/28/2015
 * Time: 6:39 PM
 */

class Mainstreethost_ProductBuilder_Model_Json_Configuration
    extends Mainstreethost_ProductBuilder_Model_Json_Abstract
    implements Mainstreethost_ProductBuilder_Model_Json_IAutojson
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
        $this->name             = Mage::helper(('pb'))->GetOptionValueNameFromId($configuration->getOptionId(),$configuration->getOptionValueId()) . ' ' . Mage::helper(('pb'))->GetOptionNameFromId($configuration->getOptionId());
        $this->optionId         = $configuration->getOptionId();
        $this->optionValueId    = $configuration->getOptionValueId();
        $rules                  = Mage::getModel('pc/rule')->LoadByConfigurationId($configuration->getConfigurationId());

        foreach ($rules as $rule)
        {
            array_push($this->rules,Mage::getModel('pb/Json_Rule')->Hydrate($rule));
        }

        return $this;
    }



    public function get($member)
    {
        return $this->$member;
    }
}