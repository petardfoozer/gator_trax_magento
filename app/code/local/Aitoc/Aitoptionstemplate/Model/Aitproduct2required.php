<?php
/**
 * Custom Options Templates
 *
 * @category:    Aitoc
 * @package:     Aitoc_Aitoptionstemplate
 * @version      3.2.9
 * @license:     iMG8ryrQYpy7f1WPNeYUzChWzfnzPomRnwOzOdn2KA
 * @copyright:   Copyright (c) 2014 AITOC, Inc. (http://www.aitoc.com)
 */
/**
 * @copyright  Copyright (c) 2009 AITOC, Inc. 
 */

class Aitoc_Aitoptionstemplate_Model_Aitproduct2required extends Mage_Core_Model_Abstract
{
    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init('aitoptionstemplate/aitproduct2required');
    }
    
    public function updateProductRequiredOption($productId, $stores)
    {
        if(!empty($productId))
        {
            foreach($stores as $storeId)
            {
                $this->getResource()->updateProductRequireOption($productId,$storeId,0);
            }   
        }        
    }
}
?>