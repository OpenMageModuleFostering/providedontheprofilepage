<?php
class Pricelizer_Module_LicensceController extends Mage_Core_Controller_Front_Action
{
	
	public function licensceAction()
	{
		$config  = Mage::getConfig()->getResourceConnectionConfig("default_setup");
        $_host = $config->host;
        $_uname = $config->username;
        $_pass = $config->password;
        $_dbname = $config->dbname;
        echo $_host; ///likewise
		$this->loadLayout();
       
       echo $this->_addContent($block);
       echo $this->_addContent($this->getLayout()->createBlock('adminhtml/template')
    ->setTemplate('Abandoncart/abandoncart.phtml')); 
     
         
        $this->_setActiveMenu('green_menu')->renderLayout(); 
		
		}
	
	
	
	
	
	
	
	}








?>
