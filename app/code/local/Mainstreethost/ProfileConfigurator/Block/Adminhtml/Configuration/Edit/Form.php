<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/11/2015
 * Time: 2:13 PM
 */

class Mainstreethost_ProfileConfigurator_Block_Adminhtml_Configuration_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        // Instantiate a new form to display our origin for editing.
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'pc_admin/configurations/edit',
                array(
                    '_current' => true,
                    'continue' => 0,
                )
            ),
            'method' => 'post',
        ));
        $form->setUseContainer(true);

        $configurations = $this->_getConfiguration();

        // Define a new fieldset. We need only one for our simple entity.
        $fieldset = $form->addFieldset(
            'general',
            array(
                'legend' => $this->__('Configuration Details')
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

    /**
     * This method makes life a little easier for us by pre-populating
     * fields with $_POST data where applicable and wrapping our post data
     * in 'originData' so that we can easily separate all relevant information
     * in the controller. You could of course omit this method entirely
     * and call the $fieldset->addField() method directly.
     */
    protected function _addFieldsToFieldset(
        Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()
            ->getPost('configurationData'));

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            $_data['name'] = "configurationData[$name]";
            $_data['title'] = $_data['label'];

            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getConfiguration()->getData($name);
            }

            $fieldset->addField($name, $_data['input'], $_data);
        }

        return $this;
    }

    /**
     * Retrieve the existing origin for pre-populating the form fields.
     * For a new origin entry, this will return an empty origin object.
     */
    protected function _getConfiguration()
    {
        if (!$this->hasData('configuration')) {
            // This will have been set in the controller.
            $configuration = Mage::registry('current_configuration');

            // Just in case the controller does not register the origin.
            if (!$configuration instanceof
                Mainstreethost_profileconfiguration_Model_Configuration) {
                $configuration = Mage::getModel(
                    'pc/Configuration'
                );
            }

            $this->setData('configuration', $configuration);
        }

        return $this->getData('configuration');
    }
}