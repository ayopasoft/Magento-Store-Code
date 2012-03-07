
<?php

 

class Ayopa_Groupbuy_Block_Adminhtml_Groupbuy extends Mage_Adminhtml_Block_Widget_Grid_Container

{

    public function __construct()

    {

        $this->_controller = 'adminhtml_groupbuy';

        $this->_blockGroup = 'groupbuy';

        $this->_headerText = Mage::helper('groupbuy')->__('Item Manager');

        $this->_addButtonLabel = Mage::helper('groupbuy')->__('Add Item');

        parent::__construct();

    }