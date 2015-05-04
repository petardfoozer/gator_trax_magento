<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/7/2015
 * Time: 6:37 PM
 */

class Mainstreethost_ProductBuilder_Helper_Options extends Mage_Core_Helper_Abstract
{
    public function GetOptionNameById($id,$product)
    {
        if(is_int($id))
        {
            return $product->getProductOptionsCollection()->getItems()[$id];
        }

        return null;
    }
}