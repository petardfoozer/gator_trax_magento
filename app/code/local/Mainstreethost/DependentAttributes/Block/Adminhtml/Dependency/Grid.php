<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/11/2015
 * Time: 2:13 PM
 */

class Mainstreethost_DependentAttributes_Block_Adminhtml_Dependency_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _prepareCollection()
    {
        /**
         * Tell Magento which collection to use to display in the grid.
         */
        $collection = Mage::getResourceModel('da/dependency_collection');
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    public function getRowUrl($row)
    {
        /**
         * When a grid row is clicked, this is where the user should
         * be redirected to - in our example, the method editAction of
         * BrandController.php in BrandDirectory module.
         */
        return $this->getUrl(
            'dependency/dependency/manage',
            array(
                'id' => $row->getId()
            )
        );
    }

    protected function _prepareColumns()
    {
        /**
         * Here, we'll define which columns to display in the grid.
         */
        $this->addColumn('dependency_id', array(
            'header' => $this->_getHelper()->__('ID'),
            'type' => 'number',
            'index' => 'dependency_id',
        ));

        $this->addColumn('attribute', array(
            'header' => $this->_getHelper()->__('Attribute'),
            'type' => 'text',
            'index' => 'attribute_id',
            'renderer' => 'Mainstreethost_DependentAttributes_Block_Adminhtml_Dependency_Grid_Renderer'
        ));

        $this->addColumn('depends_on', array(
            'header' => $this->_getHelper()->__('Depends On'),
            'type' => 'text',
            'index' => 'depends_on',
            'renderer' => 'Mainstreethost_DependentAttributes_Block_Adminhtml_Dependency_Grid_Renderer'
        ));

        $this->addColumn('created_at', array(
            'header' => $this->_getHelper()->__('Created'),
            'type' => 'datetime',
            'index' => 'created_at',
        ));

        $this->addColumn('updated_at', array(
            'header' => $this->_getHelper()->__('Updated'),
            'type' => 'datetime',
            'index' => 'updated_at',
        ));

        /**
         * Finally, we'll add an action column with an edit link.
         */
        $this->addColumn('action', array(
            'header' => $this->_getHelper()->__('Action'),
            'width' => '50px',
            'type' => 'action',
            'actions' => array(
                array(
                    'caption' => $this->_getHelper()->__('Manage'),
                    'url' => array(
                        'base' => 'dependency'
                            . '/dependency/manage',
                    ),
                    'field' => 'id'
                ),
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'dependency_id',
        ));

        return parent::_prepareColumns();
    }

    protected function _getHelper()
    {
        return Mage::helper('da');
    }



    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('dependency_id');
        $this->getMassactionBlock()->setFormFieldName('dependency_id');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> Mage::helper('da')->__('Delete'),
            'url'  => $this->getUrl('*/*/massDelete', array('' => '')),        // public function massDeleteAction() in Mage_Adminhtml_Tax_RateController
            'confirm' => Mage::helper('da')->__('Are you sure?')
        ));

        return $this;
    }
}