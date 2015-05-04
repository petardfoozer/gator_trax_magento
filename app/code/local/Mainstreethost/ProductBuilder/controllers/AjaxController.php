<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/7/2015
 * Time: 1:14 PM
 */

class Mainstreethost_ProductBuilder_AjaxController extends Mage_Core_Controller_Front_Action
{
    public function saveAction()
    {
        $post = $this->getRequest()->getParams();
        Mage::helper('pb/Cart')->ClearCart();
    }
}