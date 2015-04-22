<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/13/2015
 * Time: 3:40 PM
 */

class Mainstreethost_ProfileConfigurator_Block_Adminhtml_Profile_Configure_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('msh/pc/form.phtml');
        $this->setDestElementId('configure_form');
    }

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id' => 'configure_form',
            'action' => $this->getUrl(
                'pc_admin/profile/configure',
                array(
                    '_current' => true
                )
            ),
            'method' => 'post',
        ));

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }




    public function GetDependentProducts()
    {
        $attributeSetId = Mage::getStoreConfig('profileconfiguratorsettings/profileconfiguratorgroup/attributesetfordependentproducts');

        $products = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('attribute_set_id',array('eq' => $attributeSetId))
            ->load()
            ->getItems();

        return $products;
    }

    public function GetProductOptions($product)
    {
        $options = array();
        $product = Mage::getModel('catalog/product')->load($product->getEntityId());

        if($product->getHasOptions())
        {
            $options = $product->getOptions();
        }

        return $options;
    }



    protected function _getProfile()
    {
        if (!$this->hasData('profile'))
        {
            // This will have been set in the controller.
            $profile = Mage::registry('current_profile');

            // Just in case the controller does not register the origin.
            if (!$profile instanceof Mainstreethost_ProfileConfigurator_Model_Profile)
            {
                $profile = Mage::getModel('pc/profile');
            }

            $this->setData('profile', $profile);
        }

        return $this->getData('profile');
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
