 
    <?php
 
     
 
    class Ayopa_Groupbuy_Block_Adminhtml_Groupbuy_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
 
    {
 
        protected function _prepareForm()
 
        {
 
            $form = new Varien_Data_Form();
 
            $this->setForm($form);
 
            $fieldset = $form->addFieldset('groupbuy_form', array('legend'=>Mage::helper('groupbuy')->__('Item information')));

           

            $fieldset->addField('title', 'text', array(

                'label'     => Mage::helper('groupbuy')->__('Title'),

                'class'     => 'required-entry',

                'required'  => true,

                'name'      => 'title',

            ));

     

            $fieldset->addField('status', 'select', array(

                'label'     => Mage::helper('groupbuy')->__('Status'),

                'name'      => 'status',

                'values'    => array(

                    array(

                        'value'     => 1,

                        'label'     => Mage::helper('groupbuy')->__('Active'),

                    ),

     

                    array(

                        'value'     => 0,

                        'label'     => Mage::helper('groupbuy')->__('Inactive'),

                    ),

                ),

            ));

           

            $fieldset->addField('content', 'editor', array(

                'name'      => 'content',

                'label'     => Mage::helper('groupbuy')->__('Content'),

                'title'     => Mage::helper('groupbuy')->__('Content'),

                'style'     => 'width:98%; height:400px;',

                'wysiwyg'   => false,

                'required'  => true,

            ));

           

            if ( Mage::getSingleton('adminhtml/session')->getGroupbuyData() )

            {

                $form->setValues(Mage::getSingleton('adminhtml/session')->getGroupbuyData());

                Mage::getSingleton('adminhtml/session')->setGroupbuyData(null);

            } elseif ( Mage::registry('groupbuy_data') ) {

                $form->setValues(Mage::registry('groupbuy_data')->getData());

            }

            return parent::_prepareForm();

        }

    }