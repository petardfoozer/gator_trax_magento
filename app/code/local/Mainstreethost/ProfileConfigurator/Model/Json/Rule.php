<?php

class Mainstreethost_ProfileConfigurator_Model_Json_Rule extends Mainstreethost_ProfileConfigurator_Model_Json_Abstract implements Mainstreethost_ProfileConfigurator_Model_Json_IAutojson
{
    //private $configurationId;
    private $id;
    private $optionId;
    private $optionValueId;
    private $targetOptionId;
    private $targetOptionValueId;
    private $operator;

    public function __construct()
    {

    }

    public function Hydrate($rule)
    {
        //$this->configurationId = (int)$rule->getConfigurationId();
        $this->id = (int)$rule->getRuleId();
        $this->optionId = Mage::helper('gator')->GetOptionIdFromOptionValueId($rule->getOptionValueId());
        $this->optionValueId = (int)$rule->getOptionValueId();
        $this->targetOptionId = Mage::helper('gator')->GetOptionIdFromOptionValueId($rule->getTargetOptionValueId());
        $this->targetOptionValueId = (int)$rule->getTargetOptionValueId();
        $this->operator = $rule->getOperator();

        return $this;
    }

    public function get($member)
    {
        return $this->$member;
    }
}