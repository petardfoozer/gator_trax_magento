<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/11/2015
 * Time: 2:14 PM
 */

class Mainstreethost_DependentAttributes_Model_Dependency extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        /**
         * This tells Magento where the related resource model can be found.
         *
         * For a resource model, Magento will use the standard model alias -
         * in this case 'dos' - and look in
         * config.xml for a child node <resourceModel/>. This will be the
         * location that Magento will look for a model when
         * Mage::getResourceModel() is called
         * .
         */
        $this->_init('da/dependency');
    }

    /**
     * This method is used in the grid and form for populating the dropdown.
     */

    protected function _beforeSave()
    {
        parent::_beforeSave();

        if($this->getAttributeId() === $this->getDependsOn())
        {
            Mage::throwException('An attribute cannot depend on itself!');
        }

        $this->_updateTimestamps();

        return $this;
    }

    protected function _updateTimestamps()
    {
        $timestamp = now();

        /**
         * Set the last updated timestamp.
         */
        $this->setUpdatedAt($timestamp);

        /**
         * If we have a brand new object, set the created timestamp.
         */
        if ($this->isObjectNew()) {
            $this->setCreatedAt($timestamp);
        }

        return $this;
    }
}