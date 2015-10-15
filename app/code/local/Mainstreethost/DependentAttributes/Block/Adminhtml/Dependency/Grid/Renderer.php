<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/13/2015
 * Time: 2:22 PM
 */

class Mainstreethost_DependentAttributes_Block_Adminhtml_Dependency_Grid_Renderer extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $value = $row->getData($this->getColumn()->getIndex());

        $attribute = Mage::getModel('catalog/resource_eav_attribute')->load($value);

        return Mage::helper('da')->FormatAttributeNameAndCode($attribute);
    }
}