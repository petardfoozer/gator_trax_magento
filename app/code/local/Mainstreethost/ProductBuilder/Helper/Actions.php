<?php

class Mainstreethost_ProductBuilder_Helper_Actions extends Mage_Core_Helper_Abstract
{
    public function getAttributeCode($attributeCode, $boatPart)
    {
        $attributeDetails = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attributeCode);
        $options = $attributeDetails->getSource()->getAllOptions(false);
        $selectedOptionId = false;

        foreach($options as $option)
        {
            if($option['label'] === $boatPart):
                $selectedOptionId = $option['value'];
            endif;
        }

        return $selectedOptionId;
    }

    public function getBoatPartProductCollection($attributeConstant, $optionId)
    {
        try {
            $boatPartProductCollection = Mage::getModel('catalog/product')
                ->getCollection()
                ->addAttributeToSelect('*')
                ->addAttributeToFilter($attributeConstant, array('eq' => $optionId));
            return $boatPartProductCollection;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function getCustomOptionsCollection($boatPartProductCollection, $boatPart)
    {
        $return = array();
        $valuesArray = array();
        try {
            if($boatPart === 'Electrical') {
                foreach ($boatPartProductCollection as $boatPartProduct) {
                    $partOptions = Mage::getModel('catalog/product_option')->getProductOptionCollection($boatPartProduct);
                    foreach ($partOptions as $partOption) {
                        $values = Mage::getSingleton('catalog/product_option_value')->getValuesCollection($partOption);

                        // Array formatting for Electrical Products
                        foreach ($values as $value) {
                            $valuesArray[] = array("product_options" => array(
                                "name" => $value->getTitle(),
                                "type" => $value->getId(),
                                "id" => $value->getId(),
                                "rules" => [],
                                "active" => true,
                            )

                            );
                        }
                    }
                }
                foreach ($boatPartProductCollection as $boatPartProduct) {
                    $partOptions = Mage::getModel('catalog/product_option')->getProductOptionCollection($boatPartProduct);
                    foreach ($partOptions as $partOption) {
                        $optionTitle = $partOption->getDefaultTitle();
                        $return[] = array(
                        "name" => "electrical_products",
                        "id" => 1,
                        "type" => 1,
                        "products" => array(
                            "id" => 1,
                            "name" => "Accessories",
                            "products" => array(
                                "type" => 1,
                                "name" => $optionTitle,
                                "id" => 1,
                                "product_options" => (
                                $valuesArray
                                )
                            )
                        )
                    );
                    }
                }
                return $return;
            }
//                if ($boatPart === 'Electrical') {
//                    $return = array(
//                        "name" => "electrical_products",
//                        "id" => 1,
//                        "type" => 1,
//                        "products" => array(
//                            "id" => 1,
//                            "name" => "Accessories",
//                            "products" => array(
//                                "type" => 1,
//                                "name" => $optionTitle,
//                                "id" => 1,
//                                "product_options" => (
//                                $valuesArray
//                                )
//                            )
//                        )
//                    );
//                }
//            foreach ($boatPartProductCollection as $boatPartProduct) {
//                $partOptions = Mage::getModel('catalog/product_option')->getProductOptionCollection($boatPartProduct);
//                foreach ($partOptions as $partOption) {
//                    if ($partOption->getType() === 'drop_down') {
//                        $values = Mage::getSingleton('catalog/product_option_value')->getValuesCollection($partOption);
//
//                        foreach ($values as $value) {
//                            $mergeArray[] = array("product_options" => array(
//                                "name" => $value->getTitle(),
//                                "type" => $value->getId(),
//                                "id" => $value->getId(),
//                                "rules" => [],
//                                "active" => true,
//                            )
//
//                            );
//                        }
//                    }
//                }
//            }

            // Array formatting for Boat Look, Fuel Tank, Trailer, Flooring

            if($boatPart === 'Look' || $boatPart === 'Fuel Tank' || $boatPart === 'Trailer' || $boatPart === 'Flooring') {
                foreach($boatPartProductCollection as $boatPartProduct){
                    $partOptions = Mage::getModel('catalog/product_option')->getProductOptionCollection($boatPartProduct);
                    foreach ($partOptions as $partOption) {
                        $optionTitle = $partOption->getDefaultTitle();
                        $values = Mage::getSingleton('catalog/product_option_value')->getValuesCollection($partOption);

                        foreach ($values as $value) {
                            $valuesArray[] = array(
                                "name" => $value->getTitle(),
                                "type" => $value->getId(),
                                "id" => $value->getId(),
                                "rules" => [],
                                "active" => true,
                            );
                        }
                    }
                }
                return $valuesArray;
            }

            if($boatPart === 'Interior')
            {
                foreach($boatPartProductCollection as $boatPartProduct)                {
                    $partOptions = Mage::getModel('catalog/product_option')->getProductOptionCollection($boatPartProduct);
                    foreach($partOptions as $partOption)
                    {
                        $optionTitle = $partOption->getDefaultTitle();
                        $values = Mage::getSingleton('catalog/product_option_value')->getValuesCollection($partOption);

                        foreach($values as $value)
                        {
                            $valuesArray[] = array(
                                "id"    => $value->getId(),
                                "type"  => $value->getId(),
                                "name"  => $value->getTitle(),
                                "rules" => [],
                                "active"=> true
                            );
                        }
                    }
                }
                return $valuesArray;
            }

            if($boatPart === 'Deck')
            {
                foreach($boatPartProductCollection as $boatPartProduct)                {
                    $partOptions = Mage::getModel('catalog/product_option')->getProductOptionCollection($boatPartProduct);
                    foreach($partOptions as $partOption)
                    {
                        $optionTitle = $partOption->getDefaultTitle();
                        $values = Mage::getSingleton('catalog/product_option_value')->getValuesCollection($partOption);

                        foreach($values as $value)
                        {
                            $valuesArray[] = array(
                                "id"    => $value->getId(),
                                "type"  => $value->getId(),
                                "name"  => $value->getTitle(),
                                "rules" => [],
                                "active"=> true
                            );
                        }
                    }
                }
                return $valuesArray;
            }


                        //Array Formatting for Interior

//                      if($boatPart === 'Interior')
//                      {
//                                $return[] = array(
//                                    "name"      => "boat_interior_positions",
//                                    "id"        => $value->getId(),
//                                    "type"      => $value->getId(),
//                                    "positions" => array(
//                                        "name"  => "positions",
//                                        "id"    => $value->getId(),
//                                        "type"  => array(
//                                            "name"              => "port",
//                                            "alternative_name"  => "left",
//                                            "type"              => $value->getId(),
//                                            "id"                => $value->getId(),
//                                            "boxes"             => array(
//                                                "id"            => $value->getId(),
//                                                "type"          => $value->getId(),
//                                                "name"          => $value->getTitle(),
//                                                "rules"         => [],
//                                                "active"        => true
//                                            ),
//                                            array(
//                                                "name"              => "center",
//                                                "alternative_name"  => "middle",
//                                                "type"              => $value->getId(),
//                                                "id"                => $value->getId(),
//                                                "boxes"             => array(
//                                                    "id"            => $value->getId(),
//                                                    "type"          => $value->getId(),
//                                                    "name"          => $value->getTitle(),
//                                                    "rules"         => [],
//                                                    "active"        => true
//
//                                                )
//                                            ),
//                                            array(
//                                                "name"              => "starboard",
//                                                "alternative_name"  => "right",
//                                                "type"              => $value->getId(),
//                                                "id"                => $value->getId(),
//                                                "boxes"             => array(
//                                                    "id"            => $value->getId(),
//                                                    "type"          => $value->getId(),
//                                                    "name"          => $value->getTitle(),
//                                                    "rules"         => [],
//                                                    "active"        => true
//                                                )
//                                            )
//                                        )
//                                    )
//                                );
//                            }
//

        } catch(Exception $e){
            return $e->getMessage();
        }
    }



}