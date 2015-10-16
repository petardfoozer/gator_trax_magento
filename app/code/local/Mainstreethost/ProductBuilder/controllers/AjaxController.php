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
        $attributeCode = $this->getLookByAttribute(Mainstreethost_ProductBuilder_AjaxController::BOAT_ATTRIBUTE);

        if($attributeCode)
        {
            $boatLookProducts = Mage::getModel('catalog/product')
                ->getCollection()
                ->addAttributeToSelect('*')
                ->addAttributeToFilter(Mainstreethost_ProductBuilder_AjaxController::BOAT_ATTRIBUTE, array('eq' => $attributeCode));

            $return = array();
            foreach($boatLookProducts as $boatLookProduct)
            {
                $lookOptions = Mage::getModel('catalog/product_option')->getProductOptionCollection($boatLookProduct);
                foreach ($lookOptions as $lookOption) {
                    if ($lookOption->getType() === 'drop_down') {
                        $values = Mage::getSingleton('catalog/product_option_value')->getValuesCollection($lookOption);
                        foreach ($values as $value) {
                            $return[] = array("color", array("name" => $value->getTitle()));
                        }
                    }
                }
            }
            echo Mage::helper('pb')->ConvertToJson($return);
        }
        else
        {
            echo "error loading product options";
        }

    }


    public function boatfuelAction()
    {
        $attributeCode = $this->getFuelByAttribute(Mainstreethost_ProductBuilder_AjaxController::BOAT_ATTRIBUTE);

        Mage::log($attributeCode);
        if($attributeCode)
        {
            $boatFuelProducts = Mage::getModel('catalog/product')
                ->getCollection()
                ->addAttributeToSelect('*')
                ->addAttributeToFilter(Mainstreethost_ProductBuilder_AjaxController::BOAT_ATTRIBUTE, array('eq' => $attributeCode));

            $return = array();
            foreach($boatFuelProducts as $boatFuelProduct)
            {
                $fuelOptions = Mage::getModel('catalog/product_option')->getProductOptionCollection($boatFuelProduct);
                foreach ($fuelOptions as $fuelOption) {
                    if ($fuelOption->getType() === 'drop_down') {
                        $values = Mage::getSingleton('catalog/product_option_value')->getValuesCollection($fuelOption);
                        foreach ($values as $value) {
                            $return[] = array("tank size", array("size" => $value->getTitle()));
                        }
                    }
                }
            }
            echo Mage::helper('pb')->ConvertToJson($return);
        }
        else
        {
            echo "error loading product options";
        }
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

    public function getMotorByAttribute($attributeCode)
    {
        $attributeDetails = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attributeCode);
        $options = $attributeDetails->getSource()->getAllOptions(false);
        $selectedOptionId = false;

        foreach($options as $option)
        {
            if($option['label'] == 'Motor'):
                $selectedOptionId = $option['value'];
            endif;
        }

        return $selectedOptionId;
    }

    public function getInteriorByAttribute($attributeCode)
    {
        $attributeDetails = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attributeCode);
        $options = $attributeDetails->getSource()->getAllOptions(false);
        $selectedOptionId = false;

        foreach($options as $option)
        {
            if($option['label'] == 'Interior'):
                $selectedOptionId = $option['value'];
            endif;
        }

        return $selectedOptionId;
    }

    public function getDeckByAttribute($attributeCode)
    {
        $attributeDetails = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attributeCode);
        $options = $attributeDetails->getSource()->getAllOptions(false);
        $selectedOptionId = false;

        foreach($options as $option)
        {
            if($option['label'] == 'Deck'):
                $selectedOptionId = $option['value'];
            endif;
        }

        return $selectedOptionId;
    }

    public function getElectricalByAttribute($attributeCode)
    {
        $attributeDetails = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attributeCode);
        $options = $attributeDetails->getSource()->getAllOptions(false);
        $selectedOptionId = false;

        foreach($options as $option)
        {
            if($option['label'] == 'Electrical'):
                $selectedOptionId = $option['value'];
            endif;
        }

        return $selectedOptionId;
    }

    public function getFlooringByAttribute($attributeCode)
    {
        $attributeDetails = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attributeCode);
        $options = $attributeDetails->getSource()->getAllOptions(false);
        $selectedOptionId = false;

        foreach($options as $option)
        {
            if($option['label'] == 'Flooring'):
                $selectedOptionId = $option['value'];
            endif;
        }

        return $selectedOptionId;
    }

    public function getLookByAttribute($attributeCode)
    {
        $attributeDetails = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attributeCode);
        $options = $attributeDetails->getSource()->getAllOptions(false);
        $selectedOptionId = false;

        foreach($options as $option)
        {
            if($option['label'] == 'Look'):
                $selectedOptionId = $option['value'];
            endif;
        }

        return $selectedOptionId;
    }

    public function getFuelByAttribute($attributeCode)
    {
        $attributeDetails = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attributeCode);
        $options = $attributeDetails->getSource()->getAllOptions(false);
        $selectedOptionId = false;

        foreach($options as $option)
        {
            if($option['label'] == 'Fuel Tank'):
                $selectedOptionId = $option['value'];
            endif;
        }

        return $selectedOptionId;
    }

    public function getTrailerByAttribute($attributeCode)
    {
        $attributeDetails = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attributeCode);
        $options = $attributeDetails->getSource()->getAllOptions(false);
        $selectedOptionId = false;

        foreach($options as $option)
        {
            if($option['label'] == 'Trailer'):
                $selectedOptionId = $option['value'];
            endif;
        }

        return $selectedOptionId;
    }

    public function getSeatsByAttribute($attributeCode)
    {
        $attributeDetails = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attributeCode);
        $options = $attributeDetails->getSource()->getAllOptions(false);
        $selectedOptionId = false;

        foreach($options as $option)
        {
            if($option['label'] == 'Seats'):
                $selectedOptionId = $option['value'];
            endif;
        }

        return $selectedOptionId;
    }

    public function getAccessoriesByAttribute($attributeCode)
    {
        $attributeDetails = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attributeCode);
        $options = $attributeDetails->getSource()->getAllOptions(false);
        $selectedOptionId = false;

        foreach($options as $option)
        {
            if($option['label'] == 'Accessories'):
                $selectedOptionId = $option['value'];
            endif;
        }

        return $selectedOptionId;
    }
}