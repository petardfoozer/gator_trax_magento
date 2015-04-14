<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/7/2015
 * Time: 1:09 PM
 */

class Mainstreethost_GatorTraxBoatBuilder_Model_Json_BoatModel_Boatmodel extends Mainstreethost_GatorTraxBoatBuilder_Model_Json_Abstract implements Mainstreethost_GatorTraxBoatBuilder_Model_Json_IAutojson
{
    private $sku;
    private $imagePath;
    private $boatModelName;
    private $description;
    private $shortDescription;

    function __construct()
    {
    }


    public function Hydrate($boatModel)
    {
        $this->sku              = $boatModel->getSku();
        $this->imagePath        = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'catalog/product' . $boatModel->getImage();
        $this->boatModelName    = $boatModel->getAttributeText('msh_boat_model');
        $this->description      = $boatModel->getDescription();
        $this->shortDescription = $boatModel->getShortDescription();

        return $this->jsonSerialize();
    }


    public function get($member)
    {
        return $this->$member;
    }
}