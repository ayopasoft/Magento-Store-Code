 
    <?php
 
     
 
    class Ayopa_Groupbuy_Block_Adminhtml_Groupbuy_Grid extends Mage_Adminhtml_Block_Widget_Grid
 
    {
 
        public function __construct()
 
        {
 
            parent::__construct();
 
            $this->setId('groupbuyGrid');
 
            // This is the primary key of the database

            $this->setDefaultSort('groupbuy_id');

            $this->setDefaultDir('ASC');

            $this->setSaveParametersInSession(true);

        }

     

        protected function _prepareCollection()

        {

            $collection = Mage::getModel('groupbuy/groupbuy')->getCollection();

            $this->setCollection($collection);

            return parent::_prepareCollection();

        }

     

        protected function _prepareColumns()

        {

            $this->addColumn('groupbuy_id', array(

                'header'    => Mage::helper('groupbuy')->__('ID'),

                'align'     =>'right',

                'width'     => '50px',

                'index'     => 'groupbuy_id',

            ));

     

            $this->addColumn('title', array(

                'header'    => Mage::helper('groupbuy')->__('Title'),

                'align'     =>'left',

                'index'     => 'title',

            ));

     

            /*

            $this->addColumn('content', array(

                'header'    => Mage::helper('groupbuy')->__('Item Content'),

                'width'     => '150px',

                'index'     => 'content',

            ));

            */

     

            $this->addColumn('created_time', array(

                'header'    => Mage::helper('groupbuy')->__('Creation Time'),

                'align'     => 'left',

                'width'     => '120px',

                'type'      => 'date',

                'default'   => '--',

                'index'     => 'created_time',

            ));

     

            $this->addColumn('update_time', array(

                'header'    => Mage::helper('groupbuy')->__('Update Time'),

                'align'     => 'left',

                'width'     => '120px',

                'type'      => 'date',

                'default'   => '--',

                'index'     => 'update_time',

            ));   

     

     

            $this->addColumn('status', array(

     

                'header'    => Mage::helper('groupbuy')->__('Status'),

                'align'     => 'left',

                'width'     => '80px',

                'index'     => 'status',

                'type'      => 'options',

                'options'   => array(

                    1 => 'Active',

                    0 => 'Inactive',

                ),

            ));

     

            return parent::_prepareColumns();

        }

     

        public function getRowUrl($row)

        {

            return $this->getUrl('*/*/edit', array('id' => $row->getId()));

        }

     

     

    }