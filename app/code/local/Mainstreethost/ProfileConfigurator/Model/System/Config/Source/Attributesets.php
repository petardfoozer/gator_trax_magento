<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/20/2015
 * Time: 6:01 PM
 */

class Mainstreethost_ProfileConfigurator_Model_System_Config_Source_Attributesets
{
    public function toOptionArray()
    {
        $attributeSets = Mage::helper('pc')->GetAllAttributeSets();
        $returnArray = array(array(
            'value' => -1,
            'label' => '-Select an Attribute Set-'
        ));

        foreach($attributeSets as $attributeSet)
        {
            array_push($returnArray,array(
                'value' => $attributeSet->getAttributeSetId(),
                'label' => $attributeSet->getAttributeSetName()
            ));
        }

        return $returnArray;
    }
}