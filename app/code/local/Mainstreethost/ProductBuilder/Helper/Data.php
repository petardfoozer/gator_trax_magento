<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/7/2015
 * Time: 12:10 PM
 */ 
class Mainstreethost_ProductBuilder_Helper_Data extends Mage_Core_Helper_Abstract
{
    //http://www.mendoweb.be/blog/php-convert-string-to-camelcase-string/
    public function CamelCase($str, array $noStrip = [])
    {
        // non-alpha and non-numeric characters become spaces
        $str = preg_replace('/[^a-z0-9' . implode("", $noStrip) . ']+/i', ' ', $str);
        $str = trim($str);
        // uppercase the first character of each word
        $str = ucwords($str);
        $str = str_replace(" ", "", $str);
        $str = lcfirst($str);

        return $str;
    }


    public function ConvertToJson($data,$pretty = FALSE)
    {
        if($pretty)
        {
            return json_encode($data,JSON_PRETTY_PRINT);
        }

        return json_encode($data);
    }



    public function FormatObjectForJsonConversion($data)
    {
        $returnArray = array();
        if (is_array($data) || is_object($data))
        {
            $reflector = new ReflectionClass($data);
            $properties = $reflector->getProperties();

            foreach ($properties as $property)
            {
                $returnArray[$property->getName()] = $this->FormatObjectForJsonConversion($data);
            }

            $return = $returnArray;
        }
        else
        {
            $return = $data;
        }

        return $return;
    }


    #region attribute stuff
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


    public function GetEntityAttributes($entityId)
    {
        $product = Mage::getModel('catalog/product')->load($entityId);

        $attributes = $product->getAttributes();

        return $attributes;
    }


    public function DoesProductHaveAttribute(Mage_Catalog_Model_Product $product, $attributeId)
    {
        return in_array(Mage::getModel('eav/entity_attribute')->load($attributeId)->getDefaultTitle(),$product->getData());
    }


    public function GetAttributeValueById($id)
    {
        $attributeId = Mage::getStoreConfig('profileconfiguratorsettings/profileconfiguratorgroup/profileconfiguratorattribute');
        $attribute_code = Mage::getModel('eav/entity_attribute')->load($attributeId);
        $attribute_details = Mage::getSingleton("eav/config")->getAttribute("catalog_product", $attribute_code);
        $options = $attribute_details->getSource()->getAllOptions(false);

        foreach($options as $option)
        {
            if($option['value'] === $id)
            {
                return $option['label'];
            }
        }

        return '';
    }


    #endregion


    public function GetOptionNameFromId($optionId)
    {
                //sigh
        return Mage::getModel('catalog/product')->load(Mage::getModel('catalog/product_option')->load($optionId)->getProductId())->getOptions()[$optionId]->getDefaultTitle();
    }


    public function GetOptionValueNameFromId($optionId,$optionValueId)
    {
                //double sigh
        return Mage::getModel('catalog/product')->load(Mage::getModel('catalog/product_option')->load($optionId)->getProductId())->getOptions()[$optionId]->getValues()[$optionValueId]->getDefaultTitle();
    }


    public function GetOptionIdFromOptionValueId($optionValueId)
    {
        return (int)Mage::getModel('catalog/product_option_value')->load($optionValueId)->getOptionId();
    }
}