<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/8/2015
 * Time: 8:12 AM
 */

abstract class Mainstreethost_GatorTraxBoatBuilder_Model_Json_BoatHull_Option extends Mainstreethost_GatorTraxBoatBuilder_Model_Json_Abstract implements Mainstreethost_GatorTraxBoatBuilder_Model_Json_IAutojson
{
    private $name;
    private $id;
    private $required;

    function __construct()
    {

    }


    public function Hydrate($option)
    {
        $this->name = $option->getDefaultTitle();
        $this->id = $option->getOptionId();
        $this->required = (bool)$option->getIsRequire();

        return $this->jsonSerialize();
    }

    public function get($member)
    {
        return $this->$member;
    }
}