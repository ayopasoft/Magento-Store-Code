<?php
 
class Ayopa_AyopaModule_Model_Mysql4_Ayopamodule extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('ayopamodule/ayopamodule', 'id');
    }
}