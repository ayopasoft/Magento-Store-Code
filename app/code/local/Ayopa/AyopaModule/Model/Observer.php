<?php

class Ayopa_AyopaModule_Model_Observer extends Varien_Event_Observer{

	public function setFacebookId($observer)
    {
		$event = $observer->getEvent();
		$quote = $event->getQuote();
		$fb = $event->getRequest()->getPost('fb_id', '');

		$session = Mage::getSingleton('checkout/session');
		$session->setData('fb_id', $fb);
		
    }

    public function onSalesOrderPlaceBefore($observer) {
        //remove Ayopa option if fb_id is blank

		$session = Mage::getSingleton('checkout/session');
		$fb = $session->getData('fb_id', $fb);
		
		$order = $observer->getOrder();
			
        foreach ($order->getItemsCollection() as $item) {
          
			$_options = $item->getProductOptions();
			$count = 0;
			foreach ($_options['options'] as $option)
			{
				if ($option['label'] == 'GroupBuyNSave')
				{
					if (!$fb) {
						unset($_options['options'][$count]);
					}
				}
				
				$count++;
			}
			
			$item->setProductOptions($_options);
        }
    }

	public function onSalesOrderPlaceAfter($observer) {
		$session = Mage::getSingleton('checkout/session');
		$fb = $session->getData('fb_id', $fb);
				
		$order = $observer->getEvent()->getOrder();	
        
        foreach ($order->getItemsCollection() as $item) {
 
			$_options = $item->getProductOptions();

			foreach ($_options['options'] as $option)
			{
				/*	$fp = fopen('/var/www/vhosts/magentodev.happyjacksoftware.com/var/magento.txt','a+');
						        fwrite($fp, "------------[Sales Order Place After - Option]-----------------\n");
						        Ayopa_AyopaModule_Model_Observer::set_array_to_file($fp,$option,"a+");
						        fclose($fp); */	
				if ($option['label'] == 'GroupBuyNSave')
				{
					
					if ($fb != "") {
						$result = "0";
						$result = Ayopa_AyopaModule_Model_Observer::setAyopaParticipation($option['value'], $fb, $item->getQtyOrdered(), $item -> getPrice());
						Ayopa_AyopaModule_Model_Observer::saveAyopaParticipation($option['value'], $fb, $item->getQtyOrdered(), $item -> getPrice(), $result);
						Ayopa_AyopaModule_Model_Observer::resendAyopaParticipation();
					}
				}
			}
		}
	
			
    }

	public function resendAyopaParticipation(){
		$resend=Mage::getModel("ayopamodule/ayopamodule")->getCollection();
		$resend->addFieldToFilter('verification', '0');
		foreach ($resend as $item) {
			$result = Ayopa_AyopaModule_Model_Observer::setAyopaParticipation($item->getAuctionid(), $item->getBuyerid(), $item->getQuantity(), $item->getPrice());
			$model=Mage::getModel("ayopamodule/ayopamodule")->load($item->getId());
			$model->setVerification($result);
			$model->save();
		}
	}

	public function saveAyopaParticipation($auctionID, $buyerID, $qty, $price, $result){
		$model=Mage::getModel("ayopamodule/ayopamodule");
		$model->setAuctionid($auctionID);
		$model->setBuyerid($buyerID);
		$model->setQuantity($qty);
		$model->setPrice($price);
		$model->setVerification($result);
		$model->save();
	}
	
	public function setAyopaParticipation($auctionID, $buyerID, $qty, $price){
		
		$curl_handle=curl_init();
		curl_setopt($curl_handle,CURLOPT_URL,'http://beta.ayopasoft.com/AyopaServer/miva/set-auction-participation?auctionID='. 
												$auctionID . '&buyerID='.$buyerID.'&quantity='. $qty .'&price='. $price);
		curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
		curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
		$result = curl_exec($curl_handle);
		curl_close($curl_handle);
						
		return $result;
	}


	public function onAddToCartAfter(){
		/*//Get the checkout Session
		$session = Mage::getSingleton('checkout/session');
		$request = $observer->getEvent()->getRequest()->getParams();
		
		
		//Iterate through all Items in Cart
		foreach ($session->getQuote()->getAllItems() as $item){

		$program = Mage::getModel('catalog/product')->load($item->getProduct()>getId());
		$options = $program->getOptions();

		//Get the option you want to modify
		foreach($options as $option) {
		if ($option->getTitle() == 'OPTION NAME HERE'){
			$optionId= $option->getId();
		}
		}
		
		//Now get the Custom Options in cart
		$productOptions= $item->getProduct()->getTypeInstance(true)->
		getOrderOptions($item->getProduct());
		}*/
		
		$fp = fopen('/var/www/vhosts/magentodev.happyjacksoftware.com/var/magento.txt','a+');
				        fwrite($fp, "------------[Add to Cart After]-----------------\n");
				        
				        fclose($fp);
	}
	
	/** 
	 * Writes an array to a file.  Can be later used by include/require
	 * @param resource $file   : A file resource, (as returned from fopen)
	 * @param array    $array  : The array tp be written from
	 * @param string   $string : The initial variable name of the array,
	 *                           as it will appear in the file
	 */
	function set_array_to_file($file,$array,$string="\$array") {
	   fwrite($file,$string."=array();\r\n");
	   foreach ($array as $ind => $val) {
	      $str=$string."[".Ayopa_AyopaModule_Model_Observer::quote($ind)."]";
	      if (is_array($val)) {
	         if (Ayopa_AyopaModule_Model_Observer::has_no_sub_arrays($val)) {
	            fwrite($file,$str."=".Ayopa_AyopaModule_Model_Observer::compress_array($val).";\r\n");
	         } else {
	            Ayopa_AyopaModule_Model_Observer::set_array_to_file($file,$val,$str);
	         }
	      } else {
	         fwrite($file,$str."=".Ayopa_AyopaModule_Model_Observer::quote($val).";\r\n");
	      }
	   }
	}
	/**
	 * Checks if an array contains no arrays
	 * @param  arary $array : The array to be checked
	 * @return boolean      : true if $array contains no sub arrays
	 *                        false if it does
	 */
	function has_no_sub_arrays($array) {
	   if (!is_array($array)) {
	      return true;
	   }
	   foreach ($array as $sub) {
	      if (is_array($sub)) {
	         return false;
	      }
	   }
	   return true;
	}
	/**
	 * Compresses an array into a string:
	 * $array=array();
	 * $array[0]=0;
	 * $array["one"]="one";
	 * compress_array($array) will return 'array(0=>0,"one"=>"one")'
	 * @param array $array : the array to be compressed
	 * @return string      : the "compressed" string representation of $array
	 * @note               : works recursively, so $array can contain arrays
	 */
	function compress_array($array) {
	   if (!is_array($array)) {
	      return quote($array);
	   }
	   $strings=array();
	   foreach ($array as $ind => $val) {
	      $strings[]=Ayopa_AyopaModule_Model_Observer::quote($ind)."=>".
	                 (is_array($val)?compress_array($val):Ayopa_AyopaModule_Model_Observer::quote($val));
	   }
	   return "array(".implode(",",$strings).")";
	}
	/**
	 * Adds quotes to $val if its not an integer
	 * @param mixed $val : the value to be tested
	 */
	function quote($val) {
	   return is_int($val)?$val:"\"".$val."\"";
	}


}
