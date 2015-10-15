<?php
/**
 * Custom Options Templates
 *
 * @category:    Aitoc
 * @package:     Aitoc_Aitoptionstemplate
 * @version      3.2.9
 * @license:     iMG8ryrQYpy7f1WPNeYUzChWzfnzPomRnwOzOdn2KA
 * @copyright:   Copyright (c) 2014 AITOC, Inc. (http://www.aitoc.com)
 */
class Aitoc_Aitoptionstemplate_Block_Product_Option_Dependable_Cart extends Aitoc_Aitoptionstemplate_Block_Product_Option_Dependable
{
    public function toDisplay()
    {
        return Mage::getConfig()->getModuleConfig('Aitoc_Aiteditablecart')->is('active', 'true');
    }

    /*
     * @return Mage_Sales_Model_Quote_Item
     */
    public function getCartItems()
    {
        return Mage::getSingleton('checkout/session')->getQuote()->getAllVisibleItems();
    }
}