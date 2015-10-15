<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/8/2015
 * Time: 4:02 PM
 */

class Mainstreethost_ProductBuilder_Helper_Rules extends Mage_Core_Helper_Abstract
{
    public function GetBoatAttributeGroupsByAttributeSetId($attributeId)
    {
        $groups = Mage::getModel('eav/entity_attribute_group')
            ->getResourceCollection()
            ->setAttributeSetFilter($attributeId)
            ->load()
            ->getAllIds();

        return $this->PruneAttributeGroupsByDefaultGroups($this->PrepareAttributeGroupForPrune($groups));
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
}