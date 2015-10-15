<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/13/2015
 * Time: 2:22 PM
 */

class Mainstreethost_ProfileConfigurator_Block_Adminhtml_Configuration_Grid_Renderer extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $id = $row->getData($this->getColumn()->getIndex());

        $valueText = Mage::helper('pc')->GetAttributeValueById($id);

        return Mage::helper('pc')->__($valueText);
    }
}