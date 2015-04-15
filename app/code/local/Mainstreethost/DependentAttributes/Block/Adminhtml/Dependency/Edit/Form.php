<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/11/2015
 * Time: 2:13 PM
 */

class Mainstreethost_DependentAttributes_Block_Adminhtml_Dependency_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        // Instantiate a new form to display our origin for editing.
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'da_admin/dependency/edit',
                array(
                    '_current' => true,
                    'continue' => 0,
                )
            ),
            'method' => 'post',
        ));
        $form->setUseContainer(true);

        $dependency = $this->_getDependency();

        // Define a new fieldset. We need only one for our simple entity.
        $fieldset = $form->addFieldset(
            'general',
            array(
                'legend' => $this->__('Dependency Details')
            )
        );

        // Add the fields that we want to be editable.
        $this->_addFieldsToFieldset($fieldset, array(
            'attribute_id' => array(
                'label' => $this->__('Attribute'),
                'input' => 'select',
                'required' => true,
                'values' => Mage::helper('da')->ConvertAttributeToOptionArray(Mage::helper('da')->GetCustomProductAttributes())
            ),
            'depends_on' => array(
                'label' => $this->__('Depends On'),
                'input' => 'select',
                'required' => true,
                'values' => Mage::helper('da')->ConvertAttributeToOptionArray(Mage::helper('da')->GetCustomProductAttributes())
            ),



            /**
             * Note: we have not included created_at or updated_at.
             * We will handle those fields ourselves in the model
             * before saving.
             */
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
            ->getPost('dependencyData'));

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            // Wrap all fields with originData group.
            $_data['name'] = "dependencyData[$name]";

            // Generally, label and title are always the same.
            $_data['title'] = $_data['label'];

            // If no new value exists, use the existing origin data.
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getDependency()->getData($name);
            }

            // Finally, call vanilla functionality to add field.
            $fieldset->addField($name, $_data['input'], $_data);
        }

        return $this;
    }

    /**
     * Retrieve the existing origin for pre-populating the form fields.
     * For a new origin entry, this will return an empty origin object.
     */
    protected function _getDependency()
    {
        if (!$this->hasData('dependency')) {
            // This will have been set in the controller.
            $dependency = Mage::registry('current_dependency');

            // Just in case the controller does not register the origin.
            if (!$dependency instanceof
                Mainstreethost_DependentAttributes_Model_Dependency) {
                $dependency = Mage::getModel(
                    'da/dependency'
                );
            }

            $this->setData('dependency', $dependency);
        }

        return $this->getData('dependency');
    }
}