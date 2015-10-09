<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/7/2015
 * Time: 1:14 PM
 */

class Mainstreethost_ProductBuilder_AjaxController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        echo "This is the mother fucking controller";
    }

    public function saveAction()
    {
        $post = $this->getRequest()->getParams();
        Mage::helper('pb/Cart')->ClearCart();
    }
    
    
    
    
    public function boatmodelsAction()
    {
        $modelAttr = Mage::getModel('eav/entity_attribute')->load(
            Mage::getStoreConfig('profileconfiguratorsettings/profileconfiguratorgroup/profileconfiguratorattribute')
        )->getAttributeCode();

        $products = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addFieldToFilter($modelAttr,array('like' => '%%'))
            ->load()
            ->getItems();

        $return = array();
        $urlPrepend = Mage::getBaseUrl('media') . 'catalog/product';

        foreach($products as $product)
        {
            $return[] = array(
                "id" => (int)$product->getEntityId(),
                "name" => $product->getName(),
                "type" => "profile",
                "shortDesc" => $product->getShortDescription(),
                "image" => $urlPrepend . $product->getSmallImage(),
                "desc" => $product->getDescription(),
                "active" => ($product->getStatus() === "2" ? false : true)
            );
        }

        echo Mage::helper('pb')->ConvertToJson($return);
    }
    
    
    
    public function boathullAction()
    {
        
    }
    





    public function rulesAction()
    {
        $params         = count($this->getRequest()->getParams()) ? $this->getRequest()->getParams() : json_decode(file_get_contents('php://input'), true);
        $return         = array();
        $profileId      = $params['profileId'];
        $optionId       = $params['optionId'];
        $optionValueId  = $params['optionValueId'];

        $attributeSetId = Mage::getStoreConfig('profileconfiguratorsettings/profileconfiguratorgroup/attributesetfordependentproducts');

        $sections = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('attribute_set_id',array('eq' => $attributeSetId))
            ->load()
            ->getItems();

        foreach ($sections as $section)
        {
            $returnOptions = array();
            $options = Mage::helper('pb')->GetProductOptions($section);

            foreach ($options as $option)
            {
                $returnValues = array();
                $values = $option->getValues();

                foreach ($values as $value)
                {
                    $returnRules = array();

                    $rules = Mage::getModel('pc/rule')->getCollection()
                        ->addFieldToFilter('profile_id',(int)$profileId)
                        ->addFieldToFilter('option_id',(int)$option->getOptionId())
                        ->addFieldToFilter('option_value_id',(int)$value->getOptionTypeId())
                        ->load()
                        ->getItems();

                    foreach ($rules as $rule)
                    {
                        $product = Mage::getModel('catalog/product')->load($rule->getTargetEntityId());

                        $returnRules[] = array(
                            'section'   => array('name' => $product->getName()),
                            'operator'  => array('name' => $rule->getOperator()),
                            'attribute' => array('name' => $product->getOptions()[($rule->getTargetOptionId())]->getTitle()),
                            'value'     => array('name' => $product->getOptions()[($rule->getTargetOptionId())]->getValues()[$rule->getTargetOptionValueId()]->getTitle()),
                            'id'        => $rule->getRuleId()
                        );
                    }

                    $returnValues[] = array(
                        'id'    => $value->getOptionTypeId(),
                        'name'  => $value->getTitle(),
                        'rules' => $returnRules
                    );
                }

                $returnOptions[] = array(
                    'id'        => $option->getOptionId(),
                    'name'      => $option->getTitle(),
                    'values'    => $returnValues
                );
            }

            $return[] = array(
                'id'            => $section->getEntityId(),
                'name'          => $section->getName(),
                'attributes'    => $returnOptions
            );
        }

        echo Mage::helper('pb')->ConvertToJson($return);
    }



    public function addruleAction()
    {
        $params                 = count($this->getRequest()->getParams()) ? $this->getRequest()->getParams() : json_decode(file_get_contents('php://input'), true);
        $return                 = array();
        $profileId              = $params['profileId'];
        $optionId               = $params['optionId'];
        $optionValueId          = $params['optionValueId'];
        $operator               = $params['operator'];
        $targetEntityId         = $params['targetEntityId'];
        $targetOptionId         = $params['targetOptionId'];
        $targetOptionValueId    = $params['targetOptionValueId'];

        $newRule = Mage::getModel('pc/rule');

        $existingRule = Mage::getModel('pc/rule')->getCollection()
            ->addFieldToFilter('profile_id',$profileId)
            ->addFieldToFilter('option_id',$optionId)
            ->addFieldToFilter('option_value_id',$optionValueId)
            ->addFieldToFilter('target_entity_id',$targetEntityId)
            ->addFieldToFilter('target_option_id',$targetOptionId)
            ->addFieldToFilter('target_option_value_id',$targetOptionValueId)
            ->load()
            ->getItems();

        if(!count($existingRule))
        {
            $newRule->setProfileId($profileId);
            $newRule->setOptionId($optionId);
            $newRule->setOptionValueId($optionValueId);
            $newRule->setOperator($operator);
            $newRule->setTargetEntityId($targetEntityId);
            $newRule->setTargetOptionId($targetOptionId);
            $newRule->setTargetOptionValueId($targetOptionValueId);
            $newRule->save();

            $return = array(
                'status'    => 'success',
                'id'        => $newRule->getRuleId()
            );
        }
        else
        {
            $return = array(
                'status' => 'error'
            );
        }

        echo Mage::helper('pb')->ConvertToJson($return);
    }


    public function removeruleAction()
    {
        $params = count($this->getRequest()->getParams()) ? $this->getRequest()->getParams() : json_decode(file_get_contents('php://input'), true);
        $return = array();
        $ruleId = $params['ruleId'];

        Mage::getModel('pc/rule')->load($ruleId)->delete();


        $return = array(
            'status' => 'success'
        );

        echo Mage::helper('pb')->ConvertToJson($return);
    }
    
}