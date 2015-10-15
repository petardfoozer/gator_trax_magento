<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/7/2015
 * Time: 1:31 PM
 */

class Mainstreethost_ProductBuilder_Model_System_Config_Source_Cmspages
{
    public function toOptionArray()
    {
        $pages = Mage::getModel('cms/page')->getCollection()->load();
        $returnArray = array();

        foreach($pages as $page)
        {
            array_push($returnArray,array(
                'value' => $page->getIdentifier(),
                'label' => Mage::helper(('pb'))->__($page->getTitle())
            ));
        }

        return $returnArray;
    }
}
