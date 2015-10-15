<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/13/2015
 * Time: 3:39 PM
 */


class Mainstreethost_ProfileConfigurator_Block_Adminhtml_Configuration_Manage extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'pc';
        $this->_controller = 'adminhtml_configuration';
        $dependency = Mage::getModel('pc/configuration')->load($this->getRequest()->getParams()['id']);
        $this->_mode = 'manage';
        $this->_headerText = $this->__('Configuration Mapping');

//        $this->_addButton('save_grid', array(
//            'class'   => 'save save_grid',
//            'label'   => Mage::helper('pc')->__('Save'),
//            'onclick' => 'submitGrid(0)',
//        ), 10);
//
//        $this->_addButton('save_and_continue_edit', array(
//            'class'   => 'save save_grid',
//            'label'   => Mage::helper('da')->__('Save and Continue Edit'),
//            'onclick' => 'submitGrid(1)',
//        ), 10);
    }
}