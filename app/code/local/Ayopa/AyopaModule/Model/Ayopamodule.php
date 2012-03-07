<?php
class Ayopa_AyopaModule_Model_Ayopamodule extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('ayopamodule/ayopamodule');
    }
}