<?php
class Magentotutorial_Helloworld_IndexController extends Mage_Core_Controller_Front_Action {        

    public function indexAction() {

        echo 'Hello Index!';

    }

	public function goodbyeAction() {
	    echo 'Goodbye World!';
	}

}