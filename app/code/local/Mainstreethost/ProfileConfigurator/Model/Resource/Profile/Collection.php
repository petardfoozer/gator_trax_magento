<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/11/2015
 * Time: 2:14 PM
 */

class Mainstreethost_ProfileConfigurator_Model_Resource_Profile_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('pc/profile');
    }
}