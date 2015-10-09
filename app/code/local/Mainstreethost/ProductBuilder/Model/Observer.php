<?php

class Mainstreethost_ProductBuilder_Model_Observer
{

    public function __construct(Varien_Event_Observer $observer)
    {

        $checkCMSPage = Mage::app()->getFrontController()->getAction()->getFullActionName();
        if ($checkCMSPage === 'cms_page_view') {
            if ($this->isCustomerLoggedIn()) {
                $this->getCustomerCart();
                $this->getpbProducts();
//                $this->addProductToCart();
            }
        }
    }

    public function getpbProducts()
    {
        $cmsIdentifier = Mage::getStoreConfig('boatbuildersettings/boatbuildersettingsgroup/boatbuildercmspage');
           if($cmsIdentifier == 'boat-builder') {
               $_productCollection = Mage::getModel('catalog/product')
                   ->getCollection()
                   ->addAttributeToSelect('*')
                   ->load();
               $_pbBoatBuilderProducts = array();
               foreach ($_productCollection as $_product) {
                   array_push($_pbBoatBuilderProducts, $_product);
               }
               return $_pbBoatBuilderProducts;
           }
    }

    public function isCustomerLoggedIn()
    {
        if(Mage::getSingleton('customer/session')->isLoggedIn()){
            return true;
        }
        else{
            return false;
        }
    }

    public function getCustomerCart()
    {
        $session = Mage::getSingleton('checkout/session');
        $session->getQuote()->delete();
        $session->clear();

        $cart = Mage::getModel('checkout/cart');
        $cart->setQuote($session->getQuote());

        $this->clearCustomerCart();

    }

    public function clearCustomerCart()
    {
        Mage::helper('pb/Cart')->ClearCart();
    }

//    public function addProductToCart()
//    {
//
//
//        //THIS IS PLACE HOLDER DATA, WILL NEED TO PUSH WHAT YANNICK SENDS TO ME INTO THE CART
//        $product_model = Mage::getSingleton('catalog/product');
//        $sku = "BOAT-MODEL-GEN-II";
//        $product_id = $product_model->getIdBySku($sku);
//        $product = $product_model->load($product_id);
//        $qty = 1;
//
//        $cart = Mage::getModel('checkout/cart');
//        $cart->addProduct($product, array('qty' => $qty));
//        $cart->save();
//        Mage::getSingleton('checkout/session')->setCartWasUpdated(true);
//    }
}
