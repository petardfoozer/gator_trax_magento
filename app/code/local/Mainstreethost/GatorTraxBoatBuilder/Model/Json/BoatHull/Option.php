<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/8/2015
 * Time: 8:12 AM
 */

abstract class Mainstreethost_GatorTraxBoatBuilder_Model_Json_BoatHull_Option implements JsonSerializable
{
    protected $name;
    protected $id;
    protected $required;

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


    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'id' => $this->id,
            'isRequired' => $this->required
        ];
    }
}