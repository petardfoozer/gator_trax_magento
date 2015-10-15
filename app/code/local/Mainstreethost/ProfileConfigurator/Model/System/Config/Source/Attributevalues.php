<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/20/2015
 * Time: 6:01 PM
 */

class Mainstreethost_ProfileConfigurator_Model_System_Config_Source_Attributevalues
{
    public function toOptionArray()
    {
        $attributes = Mage::getResourceModel('eav/entity_attribute_collection')->setEntityTypeFilter(4);
        $returnArray = array(array(
            'value' => -1,
            'label' => '-Select an Attribute-'
        ));

        foreach($attributes as $attribute)
        {
            array_push($returnArray,array(
                'value' => $attribute->getAttributeId(),
                'label' => Mage::helper('pc')->FormatAttributeLabelAndCode($attribute)
            ));
        }

        return $returnArray;
    }
}