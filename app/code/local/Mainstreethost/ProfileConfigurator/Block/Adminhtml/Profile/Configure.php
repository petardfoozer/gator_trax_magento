<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/13/2015
 * Time: 3:39 PM
 */


class Mainstreethost_ProfileConfigurator_Block_Adminhtml_Profile_Configure extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'pc';
        $this->_controller = 'adminhtml_profile';
        $profile = Mage::getModel('pc/profile')->load($this->getRequest()->getParams()['id']);
        $this->_mode = 'configure';
        $this->_headerText = $this->__(Mage::helper('pc')->GetAttributeValueById($profile->getProfileAttributeValueId()) . ' Configuration');

//        $this->_addButton('save_grid', array(
//            'class'   => 'save save_grid',
//            'label'   => Mage::helper('pc')->__('Save'),
//            'onclick' => 'submitGrid(0)',
//        ), 10);
//
//        $this->_addButton('save_and_continue_edit', array(
//            'class'   => 'save save_grid',
//            'label'   => Mage::helper('pc')->__('Save and Continue Edit'),
//            'onclick' => 'submitGrid(1)',
//        ), 10);
    }
}