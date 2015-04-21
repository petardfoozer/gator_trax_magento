<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/11/2015
 * Time: 2:12 PM
 */ 
class Mainstreethost_ProfileConfigurator_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function AttributeValuesToOptionArray(Mage_Eav_Model_Entity_Attribute $attribute)
    {
        $storeId = Mage::app()->getStore()->getId();
        return $attribute->setStoreId($storeId)->getSource()->getAllOptions(false);
    }

    public function GetAttributeValueById($id)
    {
        return Mage::getModel('eav/entity_attribute_source_table')->getOptionText($id);
    }


    public function FormatAttributeLabelAndCode(Mage_Eav_Model_Entity_Attribute $attribute)
    {
        return $attribute->getFrontendLabel() . ' (' . $attribute->getAttributeCode() . ')';
    }


    public function GetCustomProductAttributes()
    {
        $attributeSets = $this->GetAllAttributeSets();
        $attributeSets = $this->RemoveDefaultAttributeSet($attributeSets);
        $attributeGroups = array();
        $attributes = array();

        foreach($attributeSets as $attributeSet)
        {
            $attributeGroups += $this->GetAttributeGroupsByAttributeSetId($attributeSet->getAttributeSetId());
        }

        foreach($attributeGroups as $key => $attributeGroup)
        {
            $attributes += Mage::getModel('eav/entity_attribute')
                ->getCollection()
                ->setAttributeGroupFilter($attributeGroup->getAttributeGroupId())
                ->load()
                ->getItems();
        }

        return $attributes;
    }



    public function GetAllAttributeSets()
    {
        return  Mage::getResourceModel('eav/entity_attribute_set_collection')
            ->load()
            ->getItems();
    }



    public function RemoveDefaultAttributeSet($attributeSets)
    {
        $defaultAttributeSetName = 'Default';

        foreach($attributeSets as $key => $attributeSet)
        {
            if($attributeSet->getAttributeSetName() === $defaultAttributeSetName)
            {
                unset($attributeSets[$key]);
            }
        }

        return $attributeSets;
    }


    public function GetAttributeGroupsByAttributeSetId($attributeId)
    {
        $groups = Mage::getModel('eav/entity_attribute_group')
            ->getResourceCollection()
            ->setAttributeSetFilter($attributeId)
            ->load()
            ->getAllIds();

        return $this->PruneAttributeGroupsByDefaultGroups($this->PrepareAttributeGroupForPrune($groups));
    }


    public function PruneAttributeGroupsByDefaultGroups($nonDefaultGroups)
    {
        $defaultGroups = Mage::getModel('eav/entity_attribute_group')
            ->getResourceCollection()
            ->setAttributeSetFilter(4)
            ->load()
            ->getAllIds();

        $defaultGroups = $this->PrepareAttributeGroupForPrune($defaultGroups);

        return $this->ReHydrateAttributeGroups(array_diff($nonDefaultGroups,$defaultGroups));
    }



    public function ReHydrateAttributeGroups($groups)
    {
        foreach($groups as $key => $group)
        {
            $groups[$key] = Mage::getModel('eav/entity_attribute_group')->load($key);
        }

        return $groups;
    }


    public function PrepareAttributeGroupForPrune($groups)
    {
        $returnArray = array();

        foreach($groups as $key => $group)
        {
            $returnArray[$group] = Mage::getModel('eav/entity_attribute_group')->load($group)->getData('attribute_group_name');
        }

        return $returnArray;
    }
}