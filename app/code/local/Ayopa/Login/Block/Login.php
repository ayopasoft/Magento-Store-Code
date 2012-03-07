<?php
class Ayopa_Login_Block_Login extends Mage_Core_Block_Template
{
 public function _prepareLayout()
    {
  return parent::_prepareLayout();
    }
     
     public function getLogin()    
     {
        if (!$this->hasData('login')) {
            $this->setData('login', Mage::registry('login'));
        }
        return $this->getData('login');
         
    }
}