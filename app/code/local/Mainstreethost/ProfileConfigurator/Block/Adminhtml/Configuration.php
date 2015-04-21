<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/11/2015
 * Time: 2:13 PM
 */

class Mainstreethost_ProfileConfigurator_Block_Adminhtml_Configuration extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        parent::_construct();

        $this->_blockGroup = 'pc';
        $this->_controller = 'adminhtml_configuration';
        $this->_headerText = Mage::helper('pc')->__('Profile Configuration');
    }

    public function getCreateUrl()
    {
        return $this->getUrl('profileconfigurator/configurations/edit');
    }
}