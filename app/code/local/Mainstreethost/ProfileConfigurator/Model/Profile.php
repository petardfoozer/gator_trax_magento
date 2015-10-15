<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/11/2015
 * Time: 2:14 PM
 */

class Mainstreethost_ProfileConfigurator_Model_Profile extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('pc/profile');
    }


    public function LoadByAttributeValueId($attributeValueId)
    {
        return $this->getCollection()->addFieldToFilter('profile_attribute_value_id',array('eq' => $attributeValueId))->load()->getFirstItem();
    }

    protected function _beforeSave()
    {
        parent::_beforeSave();
        $this->_updateTimestamps();

        return $this;
    }

    protected function _updateTimestamps()
    {
        $timestamp = now();
        $this->setUpdatedAt($timestamp);

        if ($this->isObjectNew()) {
            $this->setCreatedAt($timestamp);
        }

        return $this;
    }
}