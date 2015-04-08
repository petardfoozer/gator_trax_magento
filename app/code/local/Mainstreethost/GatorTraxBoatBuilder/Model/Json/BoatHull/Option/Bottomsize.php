<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/8/2015
 * Time: 8:10 AM
 */

class Mainstreethost_GatorTraxBoatBuilder_Model_Json_BoatHull_Option_Bottomsize extends Mainstreethost_GatorTraxBoatBuilder_Model_Json_BoatHull_Option
{
    public function Hydrate($option,$product)
    {
        $this->name = ' ' . $option->getDefaultTitle() . ' with ' . $product->getData('msh_hull_side_size');
        $this->id = $option->getOptionId();
        $this->required = (bool)$option->getIsRequire();

        return $this->jsonSerialize();
    }

}