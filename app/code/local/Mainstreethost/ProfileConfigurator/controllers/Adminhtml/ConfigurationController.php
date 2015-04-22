<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/11/2015
 * Time: 2:15 PM
 */

class Mainstreethost_ProfileConfigurator_Adminhtml_ConfigurationController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Product Configuration'));


        $block = $this->getLayout()
            ->createBlock('pc/adminhtml_configuration');

        $this->loadLayout()
            ->_addContent($block)
            ->renderLayout();
    }


    public function manageAction()
    {
        $configuration = Mage::getModel('pc/configuration');

        if ($configurationId = $this->getRequest()->getParam('id', false))
        {
            $configuration->load($configurationId);

            if (!$configuration->getId())
            {
                $this->_getSession()->addError(
                    $this->__('This configuration no longer exists.')
                );
                return $this->_redirect(
                    'profileconfiguration/configurations/index'
                );
            }
        }

        Mage::register('current_configuration', $configuration);
        $block = $this->getLayout()->createBlock('pc/adminhtml_configuration_manage');

        //$block->removeButton('save');

        $this->loadLayout()
            ->_addContent($block)
            ->renderLayout();

    }




    public function editAction()
    {
        $configuration = Mage::getModel('pc/configuration');

        if ($profileId = $this->getRequest()->getParam('id', false))
        {
            $configuration->load($profileId);

            if (!$configuration->getId())
            {
                $this->_getSession()->addError(
                    $this->__('This configuration no longer exists.')
                );
                return $this->_redirect(
                    'pc/configuration/index'
                );
            }
        }

        if ($postData = $this->getRequest()->getPost('configurationData'))
        {
            try
            {
                $configuration->addData($postData);
                $configuration->save();

                $this->_getSession()->addSuccess(
                    $this->__('The configuration has been saved.')
                );


                return $this->_redirect(
                    'pc/configuration/manage',
                    array('id' => $configuration->getConfigurationId())
                );
            }
            catch (Exception $e)
            {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }
        }

        Mage::register('current_configuration', $configuration);
        $block = $this->getLayout()->createBlock('pc/adminhtml_configuration_edit');
        $this->loadLayout()
            ->_addContent($block)
            ->renderLayout();
    }

    public function deleteAction()
    {
        $configuration = Mage::getModel('pc/configuration');

        if ($configurationId = $this->getRequest()->getParam('id', false))
        {
            $configuration->load($configurationId);
        }

        if (!$configuration->getConfigurationId())
        {
            $this->_getSession()->addError(
                $this->__('This configuration no longer exists.')
            );

            return $this->_redirect(
                'pc/configuration/index'
            );
        }

        try
        {
            $configuration->delete();
            $this->_getSession()->addSuccess(
                $this->__('The configuration has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'pc/configuration/index'
        );
    }


    protected function _isAllowed()
    {
        $actionName = $this->getRequest()->getActionName();
        switch ($actionName) {
            case 'index':
            case 'edit':
            case 'delete':
            default:
                $adminSession = Mage::getSingleton('admin/session');
                $isAllowed = $adminSession
                    ->isAllowed('pc/configuration');
                break;
        }

        return $isAllowed;
    }


    public function massDeleteAction()
    {
        $configurationIds = $this->getRequest()->getParam('configuration_id');      // $this->getMassactionBlock()->setFormFieldName('tax_id'); from Mage_Adminhtml_Block_Tax_Rate_Grid
        if(!is_array($configurationIds))
        {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('da')->__('Please select configurations.'));
        }
        else
        {
            try
            {
                $configurationModel = Mage::getModel('pc/configuration');
                foreach ($configurationIds as $configurationId) {
                    $configurationModel->load($configurationId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('pc')->__('Total of %d record(s) were deleted.', count($configurationIds))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }
}