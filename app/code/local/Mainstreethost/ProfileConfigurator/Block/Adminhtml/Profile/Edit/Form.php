<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/11/2015
 * Time: 2:13 PM
 */

class Mainstreethost_ProfileConfigurator_Block_Adminhtml_Profile_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        // Instantiate a new form to display our origin for editing.
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'pc_admin/profile/edit',
                array(
                    '_current' => true,
                    'continue' => 0,
                )
            ),
            'method' => 'post',
        ));
        $form->setUseContainer(true);
        $profile = $this->_getProfile();
        $fieldset = $form->addFieldset(
            'general',
            array(
                'legend' => $this->__('Profile Name')
            )
        );


        $this->_addFieldsToFieldset($fieldset, array(
            'attribute_id' => array(
                'label' => $this->__('Profile Name'),
                'input' => 'select',
                'required' => true,
                'values' => Mage::helper('pc')->AttributeValuesToOptionArray(
                    Mage::getModel('eav/entity_attribute')
                        ->load(
                            Mage::getStoreConfig('profileconfiguratorsettings/profileconfiguratorgroup/profileconfiguratorattribute')
                        )
                )
            )
//            'depends_on' => array(
//                'label' => $this->__('Depends On'),
//                'input' => 'select',
//                'required' => true,
//                'values' => Mage::helper('da')->ConvertAttributeToOptionArray(Mage::helper('da')->GetCustomProductAttributes())
//            ),
        ));

        $this->setForm($form);

        return $this;
    }


    protected function _addFieldsToFieldset(Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()
            ->getPost('profileData'));

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name))
            {
                $_data['value'] = $requestValue;
            }

            $_data['name'] = "profileData[$name]";
            $_data['title'] = $_data['label'];

            if (!array_key_exists('value', $_data))
            {
                $_data['value'] = $this->_getProfile()->getData($name);
            }

            $fieldset->addField($name, $_data['input'], $_data);
        }

        return $this;
    }

    /**
     * Retrieve the existing origin for pre-populating the form fields.
     * For a new origin entry, this will return an empty origin object.
     */
    protected function _getProfile()
    {
        if (!$this->hasData('profile')) {
            $profile = Mage::registry('current_profile');

            if (!$profile instanceof Mainstreethost_ProfileConfiguration_Model_Profile)
            {
                $profile = Mage::getModel('pc/profile');
            }

            $this->setData('profile', $profile);
        }

        return $this->getData('profile');
    }
}