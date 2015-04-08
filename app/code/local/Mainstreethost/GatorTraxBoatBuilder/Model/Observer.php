<?php

class Mainstreethost_GatorTraxBoatBuilder_Model_Observer
{

    public function __construct(Varien_Event_Observer $observer)
    {

        $checkCMSPage = Mage::app()->getFrontController()->getAction()->getFullActionName();
        if ($checkCMSPage === 'cms_page_view') {
            if ($this->isCustomerLoggedIn()) {
                $this->getCustomerCart();
                $this->getGatorProducts();
                $this->addProductToCart();
            }
        }
    }

    public function getGatorProducts()
    {
        $cmsIdentifier = Mage::getStoreConfig('boatbuildersettings/boatbuildersettingsgroup/boatbuildercmspage');
           if($cmsIdentifier == 'boat-builder') {
               $_productCollection = Mage::getModel('catalog/product')
                   ->getCollection()
                   ->addAttributeToSelect('*')
                   ->load();
               $_gatorBoatBuilderProducts = array();
               foreach ($_productCollection as $_product) {
                   array_push($_gatorBoatBuilderProducts, $_product);
               }
               return $_gatorBoatBuilderProducts;
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

        //THIS IS PLACE HOLDER DATA, WILL NEED TO PUSH WHAT YANNICK SENDS TO ME INTO THE CART


        $session = Mage::getSingleton('checkout/session');
        $session->getQuote()->delete();
        $session->clear();

        $cart = Mage::getModel('checkout/cart');
        $cart->setQuote($session->getQuote());

        $this->clearCustomerCart();

    }

    public function clearCustomerCart()
    {
        Mage::helper('gator/Cart')->ClearCart();
    }

    public function addProductToCart()
    {
        $product_model = Mage::getSingleton('catalog/product');
        $sku = "BOAT-MODEL-GEN-II";
        $product_id = $product_model->getIdBySku($sku);
        $product = $product_model->load($product_id);
        $qty = 1;

        $cart = Mage::getModel('checkout/cart');
        $cart->addProduct($product, array('qty' => $qty));
        $cart->save();
        Mage::getSingleton('checkout/session')->setCartWasUpdated(true);
    }
}
