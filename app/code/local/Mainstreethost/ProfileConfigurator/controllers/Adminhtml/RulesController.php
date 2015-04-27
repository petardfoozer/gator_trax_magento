<?php

class Mainstreethost_ProfileConfigurator_Adminhtml_RulesController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
            $this->_title($this->__('Rules Configuration'));


            $block = $this->getLayout()
                ->createBlock('pc/adminhtml_rule');

            $this->loadLayout()
                ->_addContent($block)
                ->renderLayout();

    }

    public function addAction()
    {
        $rule = Mage::getModel('pc/rule');

        if($ruleId = $this->getRequest()->getParam('id', false))
        {
            $rule->load($ruleId);

            if (!$rule->getId())
            {
                $this->_getSesssion()->addError($this->__('This rule no longer exists!'));

                return $this->_redirect('pc/rules/index');
            }
        }

        if($postData = $this->getRequest()->getPost('ruleData'))
        {
            try
            {
                foreach($postData as $key => $value){
                    $postData[$key] = (int)$value;
                }

                $rule->addData($postData);
                $rule->save();

                $this->_getSession()->addSuccess($this->__('The rule has been saved'));
                return $this->_redirect('pc/rules/index'/**, array('id' => $rule->getRuleId())**/);
            }
            catch(Exception $e)
            {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }
        }

        Mage::register('current_rule', $rule);
        $block = $this->getLayout()->createBlock('pc/adminhtml_rule_edit');
        $this->loadLayout()->_addContent($block)->renderLayout();

    }

    public function deleteAction()
    {
        $rule = Mage::getModel('pc/rule');

        if($ruleId = $this->getRequest()->getParam('id', false))
        {
            $rule->load($ruleId);
        }

        if(!$rule->getRuleId())
        {
            $this->_getSession()->addError($this->__('This rule no longer exists!'));
            /** AGAIN!! we will not want to redirect if there is a failure, as this will be ajaxd in, but for now it will re-direct to profile/index */
            return $this->_redirect('pc/rules/index');
        }

        try
        {
            $rule->delete();
            $this->_getSession()->addSuccess($this->__('The profile has been deleted.'));
        }
        catch(Exception $e)
        {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect('pc/rules/index');

    }

    public function findAction()
    {
        $rule = Mage::getModel('pc/rule');

        if($ruleId = $this->getRequest()->getParam('id', false))
        {
            $rule->load($ruleId);

            if (!$rule->getId())
            {
                $this->_getSesssion()->addError($this->__('This rule does not exist!'));

                return $this->_redirect('pc/rules/index');
            }
        }

        if($postData = $this->getRequest()->getPost('ruleData'))
        {
            echo json_encode($postData);
        }

    }

    public function testAction()
    {
        return true;
    }

}