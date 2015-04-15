<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/11/2015
 * Time: 2:15 PM
 */

class Mainstreethost_DependentAttributes_Adminhtml_DependencyController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Instantiate our grid container block and add to the page content.
     * When accessing this admin index page, we will see a grid of all
     * brands currently available in our Magento instance, along with
     * a button to add a new one if we wish.
     */
    public function indexAction()
    {
        // instantiate the grid container
        $dependencyBlock = $this->getLayout()
            ->createBlock('da/adminhtml_dependency');

        // Add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($dependencyBlock)
            ->renderLayout();
    }

    /**
     * This action handles both viewing and editing existing brands.
     */


    public function manageAction()
    {
        /**
         * Retrieve existing brand data if an ID was specified.
         * If not, we will have an empty brand entity ready to be populated.
         */
        $dependency = Mage::getModel('da/dependency');

        if ($dependencyId = $this->getRequest()->getParam('id', false))
        {
            $dependency->load($dependencyId);

            if (!$dependency->getId())
            {
                $this->_getSession()->addError(
                    $this->__('This dependency no longer exists.')
                );
                return $this->_redirect(
                    'dependency/dependency/index'
                );
            }
        }

        Mage::register('current_dependency', $dependency);

        // Instantiate the form container.
        $dependencyManageBlock = $this->getLayout()->createBlock('da/adminhtml_dependency_manage');

        $dependencyManageBlock->removeButton('save');



        // Add the form container as the only item on this page.
        $this->loadLayout()
            ->_addContent($dependencyManageBlock)
            ->renderLayout();

    }




    public function editAction()
    {
        /**
         * Retrieve existing brand data if an ID was specified.
         * If not, we will have an empty brand entity ready to be populated.
         */
        $dependency = Mage::getModel('da/dependency');

        if ($dependencyId = $this->getRequest()->getParam('id', false))
        {
            $dependency->load($dependencyId);

            if (!$dependency->getId())
            {
                $this->_getSession()->addError(
                    $this->__('This dependency no longer exists.')
                );
                return $this->_redirect(
                    'dependency/dependency/index'
                );
            }
        }

        // process $_POST data if the form was submitted
        if($postData = $this->getRequest()->getPost('dependencyData'))
        {

            $attributeCode = Mage::helper('da')->GetAttributeById($dependency->getAttributeId())->getAttributeCode();
            $dependsOn = Mage::helper('da')->GetAttributeById($dependency->getDependsOn())->getAttributeCode();


            $dependencyMap = Mage::getModel('da/dependency_map')
                ->getCollection()
                ->addFieldToFilter('attribute_code',array('eq' => $attributeCode))
                ->addFieldToFilter('depends_on',array('eq' => $dependsOn))
                ->load()
                ->getItems();

            if(empty($dependencyMap))
            {
                try {
                    $dependency->addData($postData);
                    $dependency->save();

                    $this->_getSession()->addSuccess(
                        $this->__('The dependency has been saved.')
                    );

                    // redirect to remove $_POST data from the request

                    return $this->_redirect(
                        'dependency/dependency/manage',
                    array('id' => $dependency->getDependencyId())
                    );
                } catch (Exception $e) {
                    Mage::logException($e);
                    $this->_getSession()->addError($e->getMessage());
                }
            }
            else
            {
                $this->_getSession()->addWarning(
                    $this->__('This dependency already exists!  You can edit it below.')
                );

                $existingDependency = Mage::getModel('da/dependency')->loadByAttributeIdAndDependsOn($postData['attribute_id'],$postData['depends_on']);

                return $this->_redirect(
                    'dependency/dependency/manage',
                array('id' => $existingDependency->getDependencyId())
                );
            }




            /**
             * If we get to here, then something went wrong. Continue to
             * render the page as before, the difference this time being
             * that the submitted $_POST data is available.
             */
        }

        // Make the current brand object available to blocks.
        Mage::register('current_dependency', $dependency);

        // Instantiate the form container.
        $dependencyEditBlock = $this->getLayout()->createBlock('da/adminhtml_dependency_edit');

        // Add the form container as the only item on this page.
        $this->loadLayout()
            ->_addContent($dependencyEditBlock)
            ->renderLayout();
        
    }

    public function deleteAction()
    {
        $dependency = Mage::getModel('da/dependency');

        if ($dependencyId = $this->getRequest()->getParam('id', false)) {
            $dependency->load($dependencyId);
        }

        if (!$dependency->getDependencyId())
        {
            $this->_getSession()->addError(
                $this->__('This dependency no longer exists.')
            );

            return $this->_redirect(
                'dependency/dependency/index'
            );
        }

        $attributeCode = Mage::helper('da')->GetAttributeById($dependency->getAttributeId())->getAttributeCode();
        $dependsOn = Mage::helper('da')->GetAttributeById($dependency->getDependsOn())->getAttributeCode();


        $dependencyMap = Mage::getModel('da/dependency_map')
            ->getCollection()
            ->addFieldToFilter('attribute_code',array('eq' => $attributeCode))
            ->addFieldToFilter('depends_on',array('eq' => $dependsOn))
            ->load()
            ->getItems();

        try {
            $dependency->delete();

            foreach($dependencyMap as $map)
            {
                $map->delete();
            }


            $this->_getSession()->addSuccess(
                $this->__('The dependency has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'dependency/dependency/index'
        );
    }

    /**
     * Thanks to Ben for pointing out this method was missing. Without
     * this method the ACL rules configured in adminhtml.xml are ignored.
     */
    protected function _isAllowed()
    {
        /**
         * we include this switch to demonstrate that you can add action
         * level restrictions in your ACL rules. The isAllowed() method will
         * use the ACL rule we have configured in our adminhtml.xml file:
         * - acl
         * - - resources
         * - - - admin
         * - - - - children
         * - - - - - smashingmagazine_branddirectory
         * - - - - - - children
         * - - - - - - - brand
         *
         * eg. you could add more rules inside brand for edit and delete.
         */
        $actionName = $this->getRequest()->getActionName();
        switch ($actionName) {
            case 'index':
            case 'edit':
            case 'delete':
                // intentionally no break
            default:
                $adminSession = Mage::getSingleton('admin/session');
                $isAllowed = $adminSession
                    ->isAllowed('da/dependency');
                break;
        }

        return $isAllowed;
    }


    public function massDeleteAction()
    {
        $dependencyIds = $this->getRequest()->getParam('dependency_id');      // $this->getMassactionBlock()->setFormFieldName('tax_id'); from Mage_Adminhtml_Block_Tax_Rate_Grid
        if(!is_array($dependencyIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('da')->__('Please select dependencies.'));
        } else {
            try {
                $dependencyModel = Mage::getModel('da/dependency');
                foreach ($dependencyIds as $dependencyId) {
                    $dependencyModel->load($dependencyId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('da')->__('Total of %d record(s) were deleted.', count($dependencyIds))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }



    public function saveAction()
    {
        $redirectBack = (bool)$this->getRequest()->getParam('back', false);
        if ($data = $this->getRequest()->getPost())
        {

            $id = $this->getRequest()->getParam('id');
            $model = Mage::getModel('da/dependency');

            if($id)
            {
                $model->load($id);

                if(!$model->getDependencyId())
                {
                    $attributeCode = Mage::helper('da')->GetAttributeById($id)->getAttributeCode();
                    $dependsOn = Mage::helper('da')->GetAttributeById($id)->getAttributeCode();

                    $dependencyMap = Mage::getModel('da/dependency_map')
                        ->getCollection()
                        ->addFieldToFilter('attribute_code',array('eq' => $attributeCode))
                        ->addFieldToFilter('depends_on',array('eq' => $dependsOn))
                        ->load()
                        ->getItems();

                    foreach($dependencyMap as $map)
                    {
                        $dependencyMap->delete();
                    }

                    $this->_getSession()->addError(
                        Mage::helper('da')->__('This dependency no longer exists.')
                    );
                    $this->_redirect('*/*/');
                    return;
                }

                $attributeCode = Mage::helper('da')->GetAttributeById($model->getAttributeId())->getAttributeCode();
                $dependsOn = Mage::helper('da')->GetAttributeById($model->getDependsOn())->getAttributeCode();

                $dependencyMap = Mage::getModel('da/dependency_map')
                    ->getCollection()
                    ->addFieldToFilter('attribute_code',array('eq' => $attributeCode))
                    ->addFieldToFilter('depends_on',array('eq' => $dependsOn))
                    ->load()
                    ->getItems();

                foreach($dependencyMap as $map)
                {
                    $map->delete();
                }

                $data = Mage::helper('da')->ParseFormData($data[$attributeCode],$attributeCode,$dependsOn);

                try
                {
                    foreach($data as $datum)
                    {
                        Mage::getModel('da/dependency_map')->setData($datum)->save();
                    }

                    $this->_getSession()->addSuccess(
                        Mage::helper('da')->__('The dependency has been saved.')
                    );
                }
                catch (Mage_Core_Exception $e)
                {
                    $this->_getSession()->addError($e->getMessage());
                    $redirectBack = true;
                }
                catch (Exception $e)
                {
                    $this->_getSession()->addError(Mage::helper('da')->__('Unable to save the dependency.'));
                    $redirectBack = true;
                    Mage::logException($e);
                }
            }

            if ($redirectBack)
            {
                $this->_redirect('da_admin/dependency/manage', array('id' => $id));
                return;
            }
        }

        $this->_redirect('*/*/');
    }
}