<?php
 
class Ayopa_AyopaModule_Model_Mysql4_Ayopamodule_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('ayopamodule/ayopamodule');
    }
}