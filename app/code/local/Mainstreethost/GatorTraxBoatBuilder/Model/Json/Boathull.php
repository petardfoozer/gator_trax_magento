<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/7/2015
 * Time: 3:44 PM
 */

class Mainstreethost_GatorTraxBoatBuilder_Model_Json_Boathull extends Mainstreethost_GatorTraxBoatBuilder_Model_Json_Abstract implements Mainstreethost_GatorTraxBoatBuilder_Model_Json_IAutojson
{
    private $boatHulls;
    private $thirtyEight;
    private $fortyFour;
    private $fifty;
    private $fiftyFour;


    function __construct()
    {
        $this->boatHulls = array();
    }


    public function Hydrate($boatHulls)
    {
        $boatHulls = $this->SortBoatHulls($boatHulls);

        foreach($boatHulls as $boatHull)
        {
            array_push($this->boatHulls,Mage::getModel('gator/Json_BoatHull_Boathull')->Hydrate($boatHull));
        }

        return Mage::helper('gator')->ConvertToJson($this->jsonSerialize());
    }


            //quick and dirty sort
    private function SortBoatHulls($boatHulls)
    {
        $returnArray = array();

        $attributeOptions = Mage::getModel('catalog/resource_eav_attribute')->load(
            Mage::getModel('eav/entity_attribute')
                ->loadByCode('catalog_product','msh_hull_bottom_size')
                ->setStoreId(Mage::app()->getStore()->getId())
                ->getAttributeId())
            ->getSource()->getAllOptions(false);

        foreach($attributeOptions as $attributeOption)
        {
            foreach($boatHulls as $key => $boatHull)
            {
                if($attributeOption['label'] === $boatHull->getAttributeText('msh_hull_bottom_size'))
                {
                    $returnArray[$key] = $boatHull;
                    unset($boatHulls[$key]);
                }
            }
        }

        return $returnArray;
    }



    public function get($member)
    {
        return $this->$member;
    }
}