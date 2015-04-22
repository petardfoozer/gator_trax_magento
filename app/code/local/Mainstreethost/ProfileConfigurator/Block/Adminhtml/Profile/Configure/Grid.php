<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/13/2015
 * Time: 6:11 PM
 */

class Mainstreethost_ProfileConfigurator_Block_Adminhtml_Configuration_Manage_Grid extends Mage_Adminhtml_Block_Widget_Grid
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
        $dependency = Mage::getModel('da/dependency')->load($this->getRequest()->getParam('id'));
        $attributeCode = Mage::helper('da')->GetAttributeById($dependency->getAttributeId())->getAttributeCode();
        $dependsOn = Mage::helper('da')->GetAttributeById($dependency->getDependsOn())->getAttributeCode();
        $dependencyMap = Mage::getModel('da/dependency_map')
                            ->getCollection()
                            ->addFieldToFilter('attribute_code',array('eq' => $attributeCode))
                            ->addFieldToFilter('depends_on',array('eq' => $dependsOn));

        $this->setCollection($dependencyMap);

        return parent::_prepareCollection();
    }


    protected function _prepareColumns()
    {
        $this->addColumn('placeholder', array(
            'header' => $this->_getHelper()->__(''),
            'type' => 'text',
            'index' => '',
        ));

        $this->addColumn('depends_on', array(
            'header' => $this->_getHelper()->GetAttributeValueById($dependency->getDependsOnValueId()),
            'type' => 'text',
            'index' => 'attribute_code_value_id',
        ));



//        $this->addColumn('depends_on', array(
//            'header' => $this->_getHelper()->__('Depends On'),
//            'type' => 'text',
//            'index' => 'depends_on',
//            'renderer' => 'Mainstreethost_DependentAttributes_Block_Adminhtml_Dependency_Grid_Renderer'
//        ));
//
//        $this->addColumn('created_at', array(
//            'header' => $this->_getHelper()->__('Created'),
//            'type' => 'datetime',
//            'index' => 'created_at',
//        ));
//
//        $this->addColumn('updated_at', array(
//            'header' => $this->_getHelper()->__('Updated'),
//            'type' => 'datetime',
//            'index' => 'updated_at',
//        ));
//
//        /**
//         * Finally, we'll add an action column with an edit link.
//         */
//        $this->addColumn('action', array(
//            'header' => $this->_getHelper()->__('Action'),
//            'width' => '50px',
//            'type' => 'action',
//            'actions' => array(
//                array(
//                    'caption' => $this->_getHelper()->__('Manage'),
//                    'url' => array(
//                        'base' => 'dependency'
//                            . '/dependency/manage',
//                    ),
//                    'field' => 'id'
//                ),
//            ),
//            'filter' => false,
//            'sortable' => false,
//            'index' => 'dependency_id',
//        ));

        return parent::_prepareColumns();
    }

    protected function _getHelper()
    {
        return Mage::helper('da');
    }



}