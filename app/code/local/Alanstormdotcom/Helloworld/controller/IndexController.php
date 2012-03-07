<?php
class Alanstormdotcom_Helloworld_IndexController extends Mage_Core_Controller_Front_Action {        
    public function indexAction() {
        //echo 'Hello Index!';
		header('Content-Type: text/plain');			
		echo $config = Mage::getConfig()
		->loadModulesConfiguration('system.xml')		
		->getNode()
		->asXML();			
		exit;
        
    }
	public function goodbyeAction() {
		echo 'Goodbye World!';
	}        
	public function paramsAction() {
		echo '<dl>';            
		foreach($this->getRequest()->getParams() as $key=>$value) {
			echo '<dt><strong>Param: </strong>'.$key.'</dt>';
			echo '<dl><strong>Value: </strong>'.$value.'</dl>';
		}
		echo '</dl>';
	}
	
}
