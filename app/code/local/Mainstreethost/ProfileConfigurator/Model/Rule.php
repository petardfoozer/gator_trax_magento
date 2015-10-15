<?php

class Mainstreethost_ProfileConfigurator_Model_Rule extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('pc/rule');
    }

    public function LoadByConfigurationId($configurationId)
    {
        return $this
            ->getCollection()
            ->addFieldToFilter('configuration_id',array('eq' => $configurationId))
            ->load();
    }

    public function LoadByProfileId($profileId)
    {
        return $this
            ->getCollection()
            ->addFieldToFilter('profile_id',array('eq' => $profileId))
            ->load();
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

        if ($this->isObjectNew()) {
            $this->setCreatedAt($timestamp);
        }

        return $this;
    }
}