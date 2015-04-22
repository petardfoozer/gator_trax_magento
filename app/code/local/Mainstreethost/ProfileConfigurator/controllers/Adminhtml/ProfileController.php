<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/11/2015
 * Time: 2:15 PM
 */

class Mainstreethost_ProfileConfigurator_Adminhtml_ProfileController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Profile Configuration'));


        $block = $this->getLayout()
            ->createBlock('pc/adminhtml_profile');

        $this->loadLayout()
            ->_addContent($block)
            ->renderLayout();
    }


    public function configureAction()
    {
        $this->_title($this->__('Product Configuration'));
        $profile = Mage::getModel('pc/profile');

        if ($profileId = $this->getRequest()->getParam('id', false))
        {
            $profile->load($profileId);

            if (!$profile->getId())
            {
                $this->_getSession()->addError(
                    $this->__('This profile no longer exists.')
                );
                return $this->_redirect(
                    'pc/profile/index'
                );
            }
        }

        Mage::register('current_profile', $profile);

        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('pc/adminhtml_profile_configure'));
        $this->renderLayout();







//        $block = $this->getLayout()->createBlock('pc/adminhtml_profile_manage_tabs');
//
//        //$block->removeButton('save');
//
//        $this->loadLayout()
//            ->_addContent($block)
//            ->renderLayout();

    }




    public function editAction()
    {
        $profile = Mage::getModel('pc/profile');

        if ($profileId = $this->getRequest()->getParam('id', false))
        {
            $profile->load($profileId);

            if (!$profile->getId())
            {
                $this->_getSession()->addError(
                    $this->__('This profile no longer exists.')
                );
                return $this->_redirect('pc/profile/index');
            }
        }

        if ($postData = $this->getRequest()->getPost('profileData'))
        {
            if($postData['profile_attribute_value_id'] < 0)
            {
                $this->_getSession()->addError(
                    $this->__('Please select a profile name.')
                );
                return $this->_redirect('pc/profile/edit');
            }

            try
            {
                $profile->addData($postData);
                $profile->save();

                $this->_getSession()->addSuccess(
                    $this->__('The profile has been saved.')
                );

                return $this->_redirect('pc/profile/configure',array(
                        'id' => $profile->getProfileId()
                    ));
            }
            catch (Exception $e)
            {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }
        }

        Mage::register('current_profile', $profile);
        $block = $this->getLayout()->createBlock('pc/adminhtml_profile_edit');
        $this->loadLayout()
            ->_addContent($block)
            ->renderLayout();
    }

    public function deleteAction()
    {
        $profile = Mage::getModel('pc/profile');

        if ($profileId = $this->getRequest()->getParam('id', false))
        {
            $profile->load($profileId);
        }

        if (!$profile->getProfileId())
        {
            $this->_getSession()->addError(
                $this->__('This profile no longer exists.')
            );

            return $this->_redirect('pc/profile/index');
        }

        try
        {
            $profile->delete();
            $this->_getSession()->addSuccess(
                $this->__('The profile has been deleted.')
            );
        }
        catch (Exception $e)
        {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect('pc/profile/index');
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
                    ->isAllowed('pc/profile');
                break;
        }

        return $isAllowed;
    }


    public function massDeleteAction()
    {
        $profileIds = $this->getRequest()->getParam('profile_id'); // $this->getMassactionBlock()->setFormFieldName('tax_id'); from Mage_Adminhtml_Block_Tax_Rate_Grid
        if(!is_array($profileIds))
        {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('pc')->__('Please select profiles.'));
        }
        else
        {
            try
            {
                $profileModel = Mage::getModel('pc/profile');
                foreach ($profileIds as $profileId) {
                    $profileModel->load($profileId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('pc')->__('Total of %d record(s) were deleted.', count($profileIds))
                );
            }
            catch (Exception $e)
            {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }
}