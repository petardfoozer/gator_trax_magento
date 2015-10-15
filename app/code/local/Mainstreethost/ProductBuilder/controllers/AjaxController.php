<?php
/**
 * Created by PhpStorm.
 * User: bwalleshauser
 * Date: 4/7/2015
 * Time: 1:14 PM
 */

class Mainstreethost_ProductBuilder_AjaxController extends Mage_Core_Controller_Front_Action
{

    const BOAT_ATTRIBUTE = 'msh_boat_part_identifier';

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
        $hullProducts = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addFieldToFilter(Mainstreethost_ProductBuilder_AjaxController::BOAT_ATTRIBUTE, array('like' => '%%'))
            ->load()
            ->getItems();

        $return = array();
        $urlPrepend = Mage::getBaseUrl('media') . 'catalog/product';

        foreach($hullProducts as $hullProduct)
        {
            $return[] = array(
                "id" => (int)$hullProduct->getEntityId(),
                "name" => $hullProduct->getName(),
                "type" => "profile",
                "shortDesc" => $hullProduct->getShortDescription(),
                "image" => $urlPrepend . $hullProduct->getSmallImage(),
                "desc" => $hullProduct->getDescription(),
                "active" => ($hullProduct->getStatus() === "2" ? false : true)
            );
        }

        echo Mage::helper('pb')->ConvertToJson($return);
    }

    public function boatmotorAction()
    {

        $motorProducts = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addFieldToFilter(Mainstreethost_ProductBuilder_AjaxController::BOAT_ATTRIBUTE, array('like' => '%%'))
            ->load()
            ->getItems();

        $return = array();
        $urlPrepend = Mage::getBaseUrl('media') . 'catalog/product';

        foreach($motorProducts as $motorProduct)
        {
            $return[] = array(
                "id" => (int)$motorProduct->getEntityId(),
                "name" => $motorProduct->getName(),
                "type" => "profile",
                "shortDesc" => $motorProduct->getShortDescription(),
                "image" => $urlPrepend . $motorProduct->getSmallImage(),
                "desc" => $motorProduct->getDescription(),
                "active" => ($motorProduct->getStatus() === "2" ? false : true)
            );
        }

        echo Mage::helper('pb')->ConvertToJson($return);
    }

    public function boatinteriorAction()
    {
        $interiorProducts = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addFieldToFilter(Mainstreethost_ProductBuilder_AjaxController::BOAT_ATTRIBUTE, array('like' => '%%'))
            ->load()
            ->getItems();

        $return = array();
        $urlPrepend = Mage::getBaseUrl('media') . 'catalog/product';

        foreach($interiorProducts as $interiorProduct)
        {
            $return[] = array(
                "id" => (int)$interiorProduct->getEntityId(),
                "name" => $interiorProduct->getName(),
                "type" => "profile",
                "shortDesc" => $interiorProduct->getShortDescription(),
                "image" => $urlPrepend . $interiorProduct->getSmallImage(),
                "desc" => $interiorProduct->getDescription(),
                "active" => ($interiorProduct->getStatus() === "2" ? false : true)
            );
        }

        echo Mage::helper('pb')->ConvertToJson($return);
    }

    public function boatdeckAction()
    {
        $deckProducts = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addFieldToFilter(Mainstreethost_ProductBuilder_AjaxController::BOAT_ATTRIBUTE, 'Deck')
            ->load()
            ->getItems();

        $return = array();
        $urlPrepend = Mage::getBaseUrl('media') . 'catalog/product';

        foreach($deckProducts as $deckProduct)
        {
            $return[] = array(
                "id" => (int)$deckProduct->getEntityId(),
                "name" => $deckProduct->getName(),
                "type" => "profile",
                "shortDesc" => $deckProduct->getShortDescription(),
                "image" => $urlPrepend . $deckProduct->getSmallImage(),
                "desc" => $deckProduct->getDescription(),
                "active" => ($deckProduct->getStatus() === "2" ? false : true)
            );
        }

        echo Mage::helper('pb')->ConvertToJson($return);
    }

    public function boatectricalAction()
    {
        $electricalProducts = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addFieldToFilter(Mainstreethost_ProductBuilder_AjaxController::BOAT_ATTRIBUTE, array('like' => '%%'))
            ->load()
            ->getItems();

        $return = array();
        $urlPrepend = Mage::getBaseUrl('media') . 'catalog/product';

        foreach($electricalProducts as $electricalProduct)
        {
            $return[] = array(
                "id" => (int)$electricalProduct->getEntityId(),
                "name" => $electricalProduct->getName(),
                "type" => "profile",
                "shortDesc" => $electricalProduct->getShortDescription(),
                "image" => $urlPrepend . $electricalProduct->getSmallImage(),
                "desc" => $electricalProduct->getDescription(),
                "active" => ($electricalProduct->getStatus() === "2" ? false : true)
            );
        }

        echo Mage::helper('pb')->ConvertToJson($return);
    }

    public function boatflooringAction()
    {
        $flooringProducts = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addFieldToFilter(Mainstreethost_ProductBuilder_AjaxController::BOAT_ATTRIBUTE, array('like' => '%%'))
            ->load()
            ->getItems();

        $return = array();
        $urlPrepend = Mage::getBaseUrl('media') . 'catalog/product';

        foreach($flooringProducts as $flooringProduct)
        {
            $return[] = array(
                "id" => (int)$flooringProduct->getEntityId(),
                "name" => $flooringProduct->getName(),
                "type" => "profile",
                "shortDesc" => $flooringProduct->getShortDescription(),
                "image" => $urlPrepend . $flooringProduct->getSmallImage(),
                "desc" => $flooringProduct->getDescription(),
                "active" => ($flooringProduct->getStatus() === "2" ? false : true)
            );
        }

        echo Mage::helper('pb')->ConvertToJson($return);
    }

    public function boatlookAction()
    {
        $boatLookProducts = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter(Mainstreethost_ProductBuilder_AjaxController::BOAT_ATTRIBUTE, array('like'=>'%%'))
            ->load()
            ->getItems();

        $return = array();

        foreach($boatLookProducts as $boatLookProduct)
        {
            $return[] = array(
                "id" => (int)$boatLookProduct->getEntityId(),
                "name" => $boatLookProduct->getName(),
                "type" => "profile",
                "shortDesc" => $boatLookProduct->getShortDescription(),
                "desc" => $boatLookProduct->getDescription(),
                "active" => ($boatLookProduct->getStatus() === "2" ? false : true)
            );
        }
        echo Mage::helper('pb')->ConvertToJson($return);
    }

    public function boatfuelAction()
    {
        $fuelProducts = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addFieldToFilter(Mainstreethost_ProductBuilder_AjaxController::BOAT_ATTRIBUTE, array('like' => '%%'))
            ->load()
            ->getItems();

        $return = array();
        $urlPrepend = Mage::getBaseUrl('media') . 'catalog/product';

        foreach($fuelProducts as $fuelProduct)
        {
            $return[] = array(
                "id" => (int)$fuelProduct->getEntityId(),
                "name" => $fuelProduct->getName(),
                "type" => "profile",
                "shortDesc" => $fuelProduct->getShortDescription(),
                "image" => $urlPrepend . $fuelProduct->getSmallImage(),
                "desc" => $fuelProduct->getDescription(),
                "active" => ($fuelProduct->getStatus() === "2" ? false : true)
            );
        }

        echo Mage::helper('pb')->ConvertToJson($return);
    }

    public function boattrailerAction()
    {
        $trailerProducts = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addFieldToFilter(Mainstreethost_ProductBuilder_AjaxController::BOAT_ATTRIBUTE, array('like' => '%%'))
            ->load()
            ->getItems();

        $return = array();
        $urlPrepend = Mage::getBaseUrl('media') . 'catalog/product';

        foreach($trailerProducts as $trailerProduct)
        {
            $return[] = array(
                "id" => (int)$trailerProduct->getEntityId(),
                "name" => $trailerProduct->getName(),
                "type" => "profile",
                "shortDesc" => $trailerProduct->getShortDescription(),
                "image" => $urlPrepend . $trailerProduct->getSmallImage(),
                "desc" => $trailerProduct->getDescription(),
                "active" => ($trailerProduct->getStatus() === "2" ? false : true)
            );
        }

        echo Mage::helper('pb')->ConvertToJson($return);
    }

    public function boatseatsAction()
    {
        $seatProducts = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addFieldToFilter(Mainstreethost_ProductBuilder_AjaxController::BOAT_ATTRIBUTE, array('like' => '%%'))
            ->load()
            ->getItems();

        $return = array();
        $urlPrepend = Mage::getBaseUrl('media') . 'catalog/product';

        foreach($seatProducts as $seatProduct)
        {
            $return[] = array(
                "id" => (int)$seatProduct->getEntityId(),
                "name" => $seatProduct->getName(),
                "type" => "profile",
                "shortDesc" => $seatProduct->getShortDescription(),
                "image" => $urlPrepend . $seatProduct->getSmallImage(),
                "desc" => $seatProduct->getDescription(),
                "active" => ($seatProduct->getStatus() === "2" ? false : true)
            );
        }

        echo Mage::helper('pb')->ConvertToJson($return);
    }

    public function boataccessoriesAction()
    {
        $accessoriesProducts = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addFieldToFilter(Mainstreethost_ProductBuilder_AjaxController::BOAT_ATTRIBUTE, array('like' => '%%'))
            ->load()
            ->getItems();

        $return = array();
        $urlPrepend = Mage::getBaseUrl('media') . 'catalog/product';

        foreach($accessoriesProducts as $accessoriesProduct)
        {
            $return[] = array(
                "id" => (int)$accessoriesProduct->getEntityId(),
                "name" => $accessoriesProduct->getName(),
                "type" => "profile",
                "shortDesc" => $accessoriesProduct->getShortDescription(),
                "image" => $urlPrepend . $accessoriesProduct->getSmallImage(),
                "desc" => $accessoriesProduct->getDescription(),
                "active" => ($accessoriesProduct->getStatus() === "2" ? false : true)
            );
        }

        echo Mage::helper('pb')->ConvertToJson($return);
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