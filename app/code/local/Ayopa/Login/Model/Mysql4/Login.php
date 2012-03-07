<?php
class Ayopa_Login_Model_Mysql4_Login extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {   
        // Note that the web_id refers to the key field in your database table.
        $this->_init('login_login', 'login_id');
    }
}