<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/13/2015
 * Time: 3:40 PM
 */

class Mainstreethost_ProfileConfigurator_Block_Adminhtml_Profile_Configure_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('msh/pc/form.phtml');
        $this->setDestElementId('configure_form');
        $this->setSaveUrl($this->getUrl('pc_admin/configuration/save'));
        $this->setDeleteUrl($this->getUrl('pc_admin/configuration/delete'));
    }

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id' => 'configure_form',
            'action' => $this->getUrl(
                'pc_admin/profile/configure',
                array(
                    '_current' => true
                )
            ),
            'method' => 'post',
        ));

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }




    public function GetDependentProducts()
    {
        $attributeSetId = Mage::getStoreConfig('profileconfiguratorsettings/profileconfiguratorgroup/attributesetfordependentproducts');

        $products = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('attribute_set_id',array('eq' => $attributeSetId))
            ->load()
            ->getItems();

        return $products;
    }

    public function GetProductOptions($product)
    {
        $options = array();
        Mage::getSingleton('catalog/product_option')->unsetOptions();
        $product = Mage::getModel('catalog/product')->load($product->getEntityId());

        if($product->getHasOptions())
        {
            Mage::getSingleton('catalog/product_option')->unsetData();
            Mage::getSingleton('catalog/product_option')->unsetOldData();
            $options = $product->getOptions();
        }

        return $options;
    }



    protected function _getProfile()
    {
        if (!$this->hasData('profile'))
        {
            // This will have been set in the controller.
            $profile = Mage::registry('current_profile');

            // Just in case the controller does not register the origin.
            if (!$profile instanceof Mainstreethost_ProfileConfigurator_Model_Profile)
            {
                $profile = Mage::getModel('pc/profile');
            }

            $this->setData('profile', $profile);
        }

        return $this->getData('profile');
    }


    public function doesConfigurationExist($profileId,$optionId,$optionValueId)
    {
        $response = FALSE;
        $config = Mage::getModel('pc/configuration')
            ->getCollection()
            ->addFieldToFilter('profile_id',
                array(
                    array('eq' => $profileId)
                )
            )
            ->addFieldToFilter('option_id',
                array(
                    array('eq' => $optionId),
                )
            )
            ->addFieldToFilter('option_value_id',
                array(
                    array('eq' => $optionValueId),
                )
            )
            ->load()
            ->getItems();

        if(count($config))
        {
            $response = TRUE;
        }

        return $response;
    }
}
