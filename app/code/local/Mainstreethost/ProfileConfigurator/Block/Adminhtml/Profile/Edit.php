<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/11/2015
 * Time: 2:13 PM
 */

class Mainstreethost_ProfileConfigurator_Block_Adminhtml_Profile_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'pc';
        $this->_controller = 'adminhtml_profile';
        $this->_mode = 'edit';
        $newOrEdit = $this->getRequest()->getParam('id')
            ? $this->__('Edit')
            : $this->__('New');
        $this->_headerText =  $newOrEdit . ' ' . $this->__('Profile');

//        $this->_addButton('save_and_continue_edit', array(
//            'class'   => 'save',
//            'label'   => Mage::helper('da')->__('Save and Continue Edit'),
//            'onclick' => 'editForm.submit($(\'edit_form\').action + \'back/edit/\')',
//        ), 10);
    }
}