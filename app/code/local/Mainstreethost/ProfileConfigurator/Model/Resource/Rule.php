<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 2/11/2015
 * Time: 3:00 PM
 */

class Mainstreethost_ProfileConfigurator_Model_Resource_Rule extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('pc/rule','rule_id');
    }
}