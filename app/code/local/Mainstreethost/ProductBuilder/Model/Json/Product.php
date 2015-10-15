<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/28/2015
 * Time: 2:40 PM
 */

class Mainstreethost_ProductBuilder_Model_Json_Product
    extends Mainstreethost_ProductBuilder_Model_Json_Abstract
    implements Mainstreethost_ProductBuilder_Model_Json_IAutojson
{
    private $id;
    private $name;
    private $description;
    private $imageFilePath;
    private $profile;

    public function __construct()
    {

    }

    public function Hydrate($product)
    {
        $this->id               = (int)$product->getEntityId();
        $this->name             = $product->getName();
        $this->description      = $product->getDescription();
        $this->imageFilePath    = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'catalog/product' . $product->getImage();
        $this->profile          = Mage::getModel('pb/Json_Profile')->Hydrate(Mage::getModel('pc/profile')->LoadByAttributeValueId($product->getMshBoatModel()));

        



        return $this;
    }



    public function get($member)
    {
        return $this->$member;
    }
}