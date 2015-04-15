<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/13/2015
 * Time: 3:39 PM
 */


class Mainstreethost_DependentAttributes_Block_Adminhtml_Dependency_Manage extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'da';
        $this->_controller = 'adminhtml_dependency';
        $dependency = Mage::getModel('da/dependency')->load($this->getRequest()->getParams()['id']);

        /**
         * The $_mode property tells Magento which folder to use
         * to locate the related form blocks to be displayed in
         * this form container. In our example, this corresponds
         * to BrandDirectory/Block/Adminhtml/Brand/Edit/.
         */

        $this->_mode = 'manage';

        $this->_headerText = $this->__('Dependency Mapping') . ' - ' . Mage::helper('da')->GetAttributeById($dependency->getAttributeId())->getFrontendLabel() . ' depends on ' . Mage::helper('da')->GetAttributeById($dependency->getDependsOn())->getFrontendLabel();

        $this->_addButton('save_grid', array(
            'class'   => 'save save_grid',
            'label'   => Mage::helper('da')->__('Save'),
            'onclick' => 'submitGrid(0)',
        ), 10);

        $this->_addButton('save_and_continue_edit', array(
            'class'   => 'save save_grid',
            'label'   => Mage::helper('da')->__('Save and Continue Edit'),
            'onclick' => 'submitGrid(1)',
        ), 10);
    }
}