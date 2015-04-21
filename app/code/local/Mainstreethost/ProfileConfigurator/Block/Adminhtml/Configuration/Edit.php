<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/11/2015
 * Time: 2:13 PM
 */

class Mainstreethost_profileconfigurator_Block_Adminhtml_Configuration_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'pc';
        $this->_controller = 'adminhtml_configuration';
        $this->_mode = 'edit';
        $newOrEdit = $this->getRequest()->getParam('id')
            ? $this->__('Edit')
            : $this->__('New');
        $this->_headerText =  $newOrEdit . ' ' . $this->__('Configuration');

//        $this->_addButton('save_and_continue_edit', array(
//            'class'   => 'save',
//            'label'   => Mage::helper('da')->__('Save and Continue Edit'),
//            'onclick' => 'editForm.submit($(\'edit_form\').action + \'back/edit/\')',
//        ), 10);
    }
}