
   <?php

   class Ayopa_Groupbuy_Model_Mysql4_Groupbuy extends Mage_Core_Model_Mysql4_Abstract

   {

       public function _construct()

       {   

           $this->_init('groupbuy/groupbuy', 'groupbuy_id');

       }

   }