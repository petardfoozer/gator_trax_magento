<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/7/2015
 * Time: 1:09 PM
 */

class Mainstreethost_GatorTraxBoatBuilder_Model_Json_BoatHull_Boathull implements JsonSerializable
{
    private $sku;
    private $boatHullName;
    private $bottomSizeOption;
    private $bottomSizeOptionName;
    private $canHaveHybridRake;
    private $hybridRakeOption;
    private $canHaveHuntDeck;
    private $huntDeckOption;
    private $hullThicknessOption;

    function __construct()
    {}


    public function Hydrate(Mage_Catalog_Model_Product $boatHull)
    {
        $this->sku                      = $boatHull->getSku();
        $this->boatHullName             = $boatHull->getName();
        $this->bottomSizeOption         = Mage::getModel('gator/Json_BoatHull_Option_Bottomsize')->Hydrate($boatHull->getProductOptionsCollection()->getItems()[$boatHull->getData('msh_hull_bottom_size_option_id')],$boatHull);
        $this->canHaveHybridRake        = (bool)$boatHull->getData('msh_allow_hybrid_rake');
        $this->hybridRakeOption         = ($this->canHaveHybridRake ? Mage::getModel('gator/Json_BoatHull_Option_Hybridrake')->Hydrate($boatHull->getProductOptionsCollection()->getItems()[$boatHull->getData('msh_hybrid_rake_option_id')]) : null);
        $this->canHaveHuntDeck          = (bool)$boatHull->getData('msh_allow_hunt_deck');
        $this->huntDeckOption           = ($this->canHaveHuntDeck ? Mage::getModel('gator/Json_BoatHull_Option_Huntdeck')->Hydrate($boatHull->getProductOptionsCollection()->getItems()[$boatHull->getData('msh_hunt_deck_option_id')]) : null);
        $this->hullThicknessOption      = Mage::getModel('gator/Json_BoatHull_Option_Hullthickness')->Hydrate($boatHull->getProductOptionsCollection()->getItems()[$boatHull->getData('msh_hull_thickness_option_id')]);

        return $this->jsonSerialize();
    }








    public function jsonSerialize()
    {
        return [
            'sku' => $this->sku,
            'boatHullName' => $this->boatHullName,
            'bottomSizeOption' => $this->bottomSizeOption,
            'canHaveHybridRake' => $this->canHaveHybridRake,
            'hybridRakeOption' => $this->hybridRakeOption,
            'canHaveHuntDeck' => $this->canHaveHuntDeck,
            'huntDeckOption' => $this->huntDeckOption,
            'hullThicknessOption' => $this->hullThicknessOption
        ];
    }
}