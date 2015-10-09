<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/8/2015
 * Time: 5:45 PM
 */

class Mainstreethost_ProductBuilder_Model_Json_Rule
    extends Mainstreethost_ProductBuilder_Model_Json_Abstract
    implements Mainstreethost_ProductBuilder_Model_Json_IAutojson
{
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
        $this->id                   = (int)$rule->getRuleId();
        $this->optionId             = Mage::helper(('pb'))->GetOptionIdFromOptionValueId($rule->getOptionValueId());
        $this->optionValueId        = (int)$rule->getOptionValueId();
        $this->targetOptionId       = Mage::helper(('pb'))->GetOptionIdFromOptionValueId($rule->getTargetOptionValueId());
        $this->targetOptionValueId  = (int)$rule->getTargetOptionValueId();
        $this->operator             = $rule->getOperator();

        return $this;
    }



    public function get($member)
    {
        return $this->$member;
    }
}