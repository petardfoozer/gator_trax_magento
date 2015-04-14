<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/11/2015
 * Time: 2:13 PM
 */

class Mainstreethost_DependentAttributes_Block_Adminhtml_Dependency_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'da';
        $this->_controller = 'adminhtml_dependency';

        /**
         * The $_mode property tells Magento which folder to use
         * to locate the related form blocks to be displayed in
         * this form container. In our example, this corresponds
         * to BrandDirectory/Block/Adminhtml/Brand/Edit/.
         */
        $this->_mode = 'edit';

        $newOrEdit = $this->getRequest()->getParam('id')
            ? $this->__('Edit')
            : $this->__('New');
        $this->_headerText =  $newOrEdit . ' ' . $this->__('Dependency');

//        $this->_addButton('save_and_continue_edit', array(
//            'class'   => 'save',
//            'label'   => Mage::helper('da')->__('Save and Continue Edit'),
//            'onclick' => 'editForm.submit($(\'edit_form\').action + \'back/edit/\')',
//        ), 10);
    }
}