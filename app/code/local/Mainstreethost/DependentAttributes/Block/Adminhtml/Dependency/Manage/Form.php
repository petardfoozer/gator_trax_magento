<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/13/2015
 * Time: 3:40 PM
 */

class Mainstreethost_DependentAttributes_Block_Adminhtml_Dependency_Manage_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('msh/da/form.phtml');
        $this->setDestElementId('manage_form');
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


    protected function _getDependency()
    {
        if (!$this->hasData('dependency'))
        {
            // This will have been set in the controller.
            $dependency = Mage::registry('current_dependency');

            // Just in case the controller does not register the origin.
            if (!$dependency instanceof Mainstreethost_DependentAttributes_Model_Dependency)
            {
                $dependency = Mage::getModel('da/dependency');
            }

            $this->setData('dependency', $dependency);
        }

        return $this->getData('dependency');
    }



    public function GetTableHeaderHtml($attributeValues)
    {
        $html = '<th></th>';

        foreach($attributeValues as $attributeValue)
        {
            $html .= '<th>' . $attributeValue['label'] . '</th>';
        }

        return $html;
    }


    public function GetRowHtml($attributeValues,$dependsOnValues)
    {
        $html = '';

        foreach($attributeValues as $attributeValue)
        {
            $html .= '<tr>';
            $html .= '<td>' . $attributeValue['label'] . '</td>';

            foreach($dependsOnValues as $dependsOnValue)
            {
                $html .= '<td>' . $this->GetCheckboxHtml($attributeValue,$dependsOnValue) . '</td>';
            }

            $html .= '</tr>';
        }

        return $html;
    }


    public function GetCheckboxHtml($attributeValue,$dependsOnValue)
    {
        return '<input type="checkbox" name="[' . $attributeValue['value'] . ']-[' . $dependsOnValue['value'] . ']" />';
    }
}
