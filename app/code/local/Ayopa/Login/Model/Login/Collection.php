<?php
 
class Ayopa_Login_Model_Mysql4_Login_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('login/login');
    }
}