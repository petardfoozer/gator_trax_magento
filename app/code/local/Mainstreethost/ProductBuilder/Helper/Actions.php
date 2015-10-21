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
        try {
            foreach ($boatPartProductCollection as $boatPartProduct) {
                $partOptions = Mage::getModel('catalog/product_option')->getProductOptionCollection($boatPartProduct);
                foreach ($partOptions as $partOption) {
                    $optionTitle = $partOption->getDefaultTitle();
                    if ($partOption->getType() === 'drop_down') {
                        $values = Mage::getSingleton('catalog/product_option_value')->getValuesCollection($partOption);
                        foreach ($values as $value) {
                            if($boatPart === 'Fuel Tank' || 'Look')
                            {
                                $return[] = array("value" => $value->getTitle());
                            }
                            else
                            {
                                $return[] = array(array("title" => $optionTitle, "value" => $value->getTitle()));
                            }
                        }
                    }
                }
            }
            return $return;
        } catch(Exception $e){
            return $e->getMessage();
        }
    }



}