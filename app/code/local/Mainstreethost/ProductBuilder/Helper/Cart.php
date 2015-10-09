<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/7/2015
 * Time: 2:20 PM
 */

class Mainstreethost_ProductBuilder_Helper_Cart extends Mage_Core_Helper_Abstract
{
    public function ClearCart()
    {
        if(Mage::getSingleton('customer/session')->isLoggedIn())
        {
            $quote = Mage::getSingleton('checkout/session')->getQuote();

            foreach($quote->getAllItems() as $item)
            {
                $quote->deleteItem($item);
            }

            $quote->save();
        }
    }
}