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

    protected function _prepareForm()
    {
        // Instantiate a new form to display our origin for editing.
        $form = new Varien_Data_Form(array(
            'id' => 'manage_form',
            'action' => $this->getUrl(
                'da_admin/dependency/save',
                array(
                    '_current' => true
                )
            ),
            'method' => 'post',
        ));

//        $fieldSet = $form->addFieldset(
//            'general',
//            array(
//                'legend' => $this->__('Dependency Mapping')
//            )
//        );
//
//        $dependency = Mage::getModel('da/dependency')->load($this->getRequest()->getParam('id'));
//        $attributeValues = $this->GetAttributeValues($dependency->getAttributeId());
//        $dependsOnValues = $this->GetAttributeValues($dependency->getDependsOn());
//
//
//        foreach($attributeValues as $attributeValue)
//        {
//            foreach($dependsOnValues as $dependsOnValue)
//            {
//                $fieldSet->addField($this->GetElementName($attributeValue['value'],$dependsOnValue['value']), 'checkbox',
//                    array(
//                        'label' => $this->GetElementName($attributeValue['value'],$dependsOnValue['value']),
//                        'name' => $this->GetElementName($attributeValue['value'],$dependsOnValue['value'])
//                    ));
//            }
//        }

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
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


    public function GetTableLabelLeft($attributeId,$numOfAttributeValues)
    {
        $html = '<tr>';
        $html .= '<th class="vertical-header" rowspan="' . ($numOfAttributeValues + 1) . '">';
        $html .= Mage::helper('da')->FormatStringVertical(Mage::helper('da')->GetAttributeNameById($attributeId));
        $html .= '</th>';
        $html .= '</tr>';

        return $html;
    }


    public function GetTableLabelTop($dependsOn,$numOfDependsOnValues)
    {
        $html = '<th colspan="2"></th>';
        $html .= '<th class="horizontal-header" colspan="' . $numOfDependsOnValues . '">';
        $html .= strtoupper(Mage::helper('da')->GetAttributeNameById($dependsOn));
        $html .= '</th>';

        return $html;
    }


    public function GetTableHeaderHtml($attributeValues)
    {
        $html = '<th colspan="2"></th>';

        foreach($attributeValues as $attributeValue)
        {
            $html .= '<th>' . $attributeValue['label'] . '</th>';
        }

        return $html;
    }


    public function GetRowHtml($attributeValues,$dependsOnValues,$dependencyMap,$attributeId, $dependsOn)
    {
        $html = '';

        foreach($attributeValues as $attributeValue)
        {
            $html .= '<tr>';
            $html .= '<th>' . $attributeValue['label'] . '</th>';

            foreach($dependsOnValues as $dependsOnValue)
            {
                $checked = false;

                foreach($dependencyMap as $dependency)
                {
                    if($attributeValue['value'] === $dependency->getAttributeCodeValueId() && $dependsOnValue['value'] === $dependency->getDependsOnValueId())
                    {
                        $checked = true;
                        break;
                    }
                }

                $html .= '<td ' . ($checked ? 'class="checktrue"' : '') . ' onclick="clickable(this.firstElementChild)">' . $this->GetCheckboxHtml($attributeValue,$dependsOnValue,$checked) . '</td>';
            }

            $html .= '</tr>';
        }

        return $html;
    }


    public function GetCheckboxHtml($attributeValue,$dependsOnValue,$checked = false)
    {
        return '<input value="' . $this->GetElementName($attributeValue['value'],$dependsOnValue['value']) . '" onclick="unbindcheck(this)" id="' . $this->GetElementName($attributeValue['value'],$dependsOnValue['value']) .'" type="checkbox" name="' . Mage::helper('da')->GetAttributeCodeById($this->_getDependency()->getAttributeId()) . '[]" ' . ($checked ? 'checked' : '') . '/>';
    }


    public function GetElementName($attributeValue,$dependsOnValue)
    {
        return '[' . $attributeValue . ']-[' . $dependsOnValue . ']';
    }


    public function GetDependencyMap($id)
    {
        $dependency = Mage::getModel('da/dependency')->load($this->getRequest()->getParam('id'));
        $attributeCode = Mage::helper('da')->GetAttributeById($dependency->getAttributeId())->getAttributeCode();
        $dependsOn = Mage::helper('da')->GetAttributeById($dependency->getDependsOn())->getAttributeCode();
        $dependencyMap = Mage::getModel('da/dependency_map')
            ->getCollection()
            ->addFieldToFilter('attribute_code',array('eq' => $attributeCode))
            ->addFieldToFilter('depends_on',array('eq' => $dependsOn))
            ->load()
            ->getItems();

        return $dependencyMap;
    }
}
