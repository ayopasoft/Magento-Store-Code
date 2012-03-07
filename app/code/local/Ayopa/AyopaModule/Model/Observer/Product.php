<?php
 
class Ayopa_AyopaModule_Model_Observer_Product
{
  /**
   * Inject one tab into the product edit page in the Magento admin
   *
   * @param Varien_Event_Observer $observer
   */
  public function injectTabs(Varien_Event_Observer $observer)
  {
    $block = $observer->getEvent()->getBlock();
     
    if ($block instanceof Mage_Adminhtml_Block_Catalog_Product_Edit_Tabs) {
      if ($this->_getRequest()->getActionName() == 'edit' || $this->_getRequest()->getParam('type')) {
        $block->addTab('ayopa-product-tab-01', array(
          'label'     => 'GroupBuyNSave',
          'content'   => $block->getLayout()->createBlock('adminhtml/template', 'ayopa-product-content', array('template' => 'ayopamodule/content.phtml'))->toHtml(),
        ));
      }
    }
  }
 
  /**
   * This method will run when the product is saved
   * Use this function to update the product model and save
   *
   * @param Varien_Event_Observer $observer
   */
  public function saveTabData(Varien_Event_Observer $observer)
  {
    if ($post = $this->_getRequest()->getPost()) {
 
      // Load the current product model
      $product = Mage::registry('product');
       
      /**
       * Update any product attributes here
       */
        
       try {
        // Uncomment the line below if you make changes to the product and want to save it
        //$product->save();
       }
       catch (Exception $e) {
        Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
       }
    }
  }
   
  /**
   * Shortcut to getRequest
   */
  protected function _getRequest()
  {
    return Mage::app()->getRequest();
  }
}