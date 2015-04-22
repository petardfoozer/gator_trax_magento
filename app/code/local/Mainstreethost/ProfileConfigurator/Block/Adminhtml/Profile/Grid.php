<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/11/2015
 * Time: 2:13 PM
 */

class Mainstreethost_ProfileConfigurator_Block_Adminhtml_Profile_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('pc/profile_collection');
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl(
            'pc/profile/configure',
            array(
                'id' => $row->getId()
            )
        );
    }

    protected function _prepareColumns()
    {
        $this->addColumn('profile_id', array(
            'header' => $this->_getHelper()->__('ID'),
            'type' => 'number',
            'index' => 'configuration_id'
        ));

        $this->addColumn('profile_name', array(
            'header' => $this->_getHelper()->__('Profile Name'),
            'type' => 'text',
            'index' => 'profile_attribute_value_id',
            'renderer' => 'Mainstreethost_ProfileConfigurator_Block_Adminhtml_Profile_Grid_Renderer'
        ));

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

        $this->addColumn('action', array(
            'header' => $this->_getHelper()->__('Action'),
            'width' => '60px',
            'type' => 'action',
            'actions' => array(
                array(
                    'caption' => $this->_getHelper()->__('Configure'),
                    'url' => array(
                        'base' => 'pc'
                            . '/profile/configure',
                    ),
                    'field' => 'id'
                ),
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'profile_id',
        ));

        return parent::_prepareColumns();
    }

    protected function _getHelper()
    {
        return Mage::helper('pc');
    }



    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('profile_id');
        $this->getMassactionBlock()->setFormFieldName('profile_id');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> Mage::helper('pc')->__('Delete'),
            'url'  => $this->getUrl('*/*/massDelete', array('' => '')),        // public function massDeleteAction() in Mage_Adminhtml_Tax_RateController
            'confirm' => Mage::helper('pc')->__('Are you sure?')
        ));

        return $this;
    }
}