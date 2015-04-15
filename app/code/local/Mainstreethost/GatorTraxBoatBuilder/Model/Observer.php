<?php

class Mainstreethost_GatorTraxBoatBuilder_Model_Observer
{
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
}