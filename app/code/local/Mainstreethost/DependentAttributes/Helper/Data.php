<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/11/2015
 * Time: 2:12 PM
 */ 
class Mainstreethost_DependentAttributes_Helper_Data extends Mage_Core_Helper_Abstract
{
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


    public function ConvertAttributeToOptionArray($attributes)
    {
        $returnArray = array();

        foreach($attributes as $attribute)
        {
            $returnArray[$attribute->getAttributeId()] = $this->FormatAttributeNameAndCode($attribute);
        }

        return $returnArray;
    }


    public function FormatAttributeNameAndCode($attribute)
    {
        return $attribute->getFrontendLabel() . ' (' . $attribute->getAttributeCode() . ')';
    }



    public function UnserializeDependencyMap($map)
    {
        if($unserializedMap = unserialize($map))
        {
            return $unserializedMap;
        }

        return array();
    }


    public function GetAttributeById($id)
    {
        return Mage::getModel('eav/entity_attribute')->load($id);
    }



    public function GetAttributeValues($attributeId)
    {
        $attributeValues = array();
        $attribute = Mage::getModel('eav/entity_attribute')->load($attributeId);

        if($attribute->usesSource())
        {
            $attributeDetails = Mage::getModel('eav/config')->getAttribute('catalog_product', $attribute->getAttributeCode());
            $attributeValues = $attributeDetails->getSource()->getAllOptions(true, true);

            foreach($attributeValues as $key => $attributeValue)
            {
                if(empty($attributeValue['label']))
                {
                    unset($attributeValues[$key]);
                }
            }
        }


        return $attributeValues;
    }



    public function GetAttributeValueById($id)
    {
        return Mage::getModel('eav/entity_attribute_source_table')->getOptionText($id);
    }


    public function GetAttributeValueLabelById($id)
    {
        return $this->GetAttributeValueById($id);
    }




    public function GetAttributeNameById($id)
    {
        return Mage::getModel('eav/entity_attribute')->load($id)->getAttributeCode();
    }



    public function ParseFormData($data,$attributeCode,$dependsOn)
    {
        $returnArray = array();

        foreach($data as $datum)
        {
            $attributeCodeValueId = $this->StripSquareBrackets(explode('-',$datum)[0]);
            $dependsOnValueId = $this->StripSquareBrackets(explode('-',$datum)[1]);

            array_push($returnArray,array(
                'attribute_code' => $attributeCode,
                'attribute_code_value_id' => $attributeCodeValueId,
                'depends_on' => $dependsOn,
                'depends_on_value_id' => $dependsOnValueId
            ));
        }

        return $returnArray;
    }


    public function StripSquareBrackets($string)
    {
        return str_replace(']','',str_replace('[','',$string));
    }

}