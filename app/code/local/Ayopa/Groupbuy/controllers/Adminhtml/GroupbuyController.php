  
     <?php
  
      
  
     class Ayopa_Groupbuy_Adminhtml_GroupbuyController extends Mage_Adminhtml_Controller_Action
  
     {
  
      
  
         protected function _initAction()
  
         {
  
             $this->loadLayout()
  
                 ->_setActiveMenu('groupbuy/items')
 
                 ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
 
             return $this;
 
         }   
 
        
 
         public function indexAction() {
 
             $this->_initAction();       
 
             $this->_addContent($this->getLayout()->createBlock('groupbuy/adminhtml_groupbuy'));
 
             $this->renderLayout();
 
         }
 
      
 
         public function editAction()
 
         {
 
             $groupbuyId     = $this->getRequest()->getParam('id');
 
             $groupbuyModel  = Mage::getModel('groupbuy/groupbuy')->load($groupbuyId);
 
      
 
             if ($groupbuyModel->getId() || $groupbuyId == 0) {
 
      
 
                 Mage::register('groupbuy_data', $groupbuyModel);
 
      
 
                 $this->loadLayout();
 
                 $this->_setActiveMenu('groupbuy/items');
 
                
 
                 $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
 
                 $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
 
                
 
                 $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
 
                
 
                 $this->_addContent($this->getLayout()->createBlock('groupbuy/adminhtml_groupbuy_edit'))
 
                      ->_addLeft($this->getLayout()->createBlock('groupbuy/adminhtml_groupbuy_edit_tabs'));
 
                    
 
                 $this->renderLayout();
 
             } else {
 
                 Mage::getSingleton('adminhtml/session')->addError(Mage::helper('groupbuy')->__('Item does not exist'));
 
                 $this->_redirect('*/*/');
 
             }
 
         }
 
        
 
         public function newAction()
 
         {
 
             $this->_forward('edit');
 
         }
 
        
 
         public function saveAction()
 
         {
 
             if ( $this->getRequest()->getPost() ) {
 
                 try {
 
                     $postData = $this->getRequest()->getPost();
 
                     $groupbuyModel = Mage::getModel('groupbuy/groupbuy');
 
                    
 
                     $groupbuyModel->setId($this->getRequest()->getParam('id'))
 
                         ->setTitle($postData['title'])
 
                         ->setContent($postData['content'])
 
                         ->setStatus($postData['status'])
 
                         ->save();
 
                    
 
                     Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
 
                     Mage::getSingleton('adminhtml/session')->setGroupbuyData(false);
 
      
 
                     $this->_redirect('*/*/');
 
                     return;
 
                 } catch (Exception $e) {
 
                     Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
 
                     Mage::getSingleton('adminhtml/session')->setGroupbuyData($this->getRequest()->getPost());
 
                     $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
 
                     return;
 
                 }
 
             }
 
             $this->_redirect('*/*/');
 
         }
 
        
 
         public function deleteAction()
 
         {
 
             if( $this->getRequest()->getParam('id') > 0 ) {
 
                 try {
 
                     $groupbuyModel = Mage::getModel('groupbuy/groupbuy');
 
                    
 
                     $groupbuyModel->setId($this->getRequest()->getParam('id'))
 
                         ->delete();
 
                        
 
                     Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
 
                     $this->_redirect('*/*/');
 
                 } catch (Exception $e) {
 
                     Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
 
                     $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
 
                 }
 
             }
 
             $this->_redirect('*/*/');
 
         }
 
         /**
          * Product grid for AJAX request
          * Sort and filter result for example.
          */

         public function gridAction()

         {

             $this->loadLayout();

             $this->getResponse()->setBody(

                    $this->getLayout()->createBlock('importedit/adminhtml_groupbuy_grid')->toHtml()

             );

         }

     }