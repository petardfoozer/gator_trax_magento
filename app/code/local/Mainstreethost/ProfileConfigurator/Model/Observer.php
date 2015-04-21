<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/17/2015
 * Time: 3:26 PM
 */

class Mainstreethost_ProfileConfigurator_Model_Observer
{
    public function ModifyOriginShippingAddress(Varien_Event_Observer $observer)
    {
        Mage::helper('da')->ModifyOriginAddress($observer->getAddress()->getRegionCode());
    }
}