<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/11/2015
 * Time: 2:14 PM
 */

class Mainstreethost_ProfileConfigurator_Model_Configuration extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('pc/configuration');
    }

    public function LoadByProfileId($profileId)
    {
        return $this->getCollection()->addFieldToFilter('profile_id',array('eq' => $profileId))->load();
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