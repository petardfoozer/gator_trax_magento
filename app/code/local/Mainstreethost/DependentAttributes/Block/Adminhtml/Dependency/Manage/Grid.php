<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/13/2015
 * Time: 6:11 PM
 */

class Mainstreethost_DependentAttributes_Block_Adminhtml_Dependency_Manage_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('da_manage_grid');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }


    protected function _prepareCollection()
    {

        $dependencyMap = array();
        $dependency = Mage::getModel('da/dependency')
            ->getCollection()
            ->addFieldToFilter('dependency_id',array('eq' => $this->getRequest()->getParam('id')))
            ->load()
            ->getFirstItem();

        if($dependency->getDependencyId())
        {
            $dependencyMap = Mage::helper('da')->UnserializeDependencyMap($dependency->getDependencies());
        }



    }
}