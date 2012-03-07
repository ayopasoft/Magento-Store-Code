 
    <?php
 
     
 
    class Ayopa_Groupbuy_Block_Adminhtml_Groupbuy_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
 
    {
 
        public function __construct()
 
        {
 
            parent::__construct();
 
                   
 
            $this->_objectId = 'id';

            $this->_blockGroup = 'groupbuy';

            $this->_controller = 'adminhtml_groupbuy';

     

            $this->_updateButton('save', 'label', Mage::helper('groupbuy')->__('Save Item'));

            $this->_updateButton('delete', 'label', Mage::helper('groupbuy')->__('Delete Item'));

        }

     

        public function getHeaderText()

        {

            if( Mage::registry('groupbuy_data') && Mage::registry('groupbuy_data')->getId() ) {

                return Mage::helper('groupbuy')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('groupbuy_data')->getTitle()));

            } else {

                return Mage::helper('groupbuy')->__('Add Item');

            }

        }

    }