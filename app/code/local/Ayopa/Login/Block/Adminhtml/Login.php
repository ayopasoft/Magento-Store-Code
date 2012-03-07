<?php
class Ayopa_Login_Block_Adminhtml_Login extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_login';
    $this->_blockGroup = 'login';
    $this->_headerText = Mage::helper('login')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('login')->__('Add Item');
    parent::__construct();
  }
}