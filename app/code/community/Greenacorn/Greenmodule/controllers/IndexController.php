<?php
class Greenacorn_Greenmodule_IndexController extends Mage_Adminhtml_Controller_Action
{  
  
    
    public function abandonedCartAction()
    
    {
		
		 $this->loadLayout()
            ->_setActiveMenu('green_menu')
            ->_title($this->__('Abandoned Cart'));

        // my stuff
       $this->_addContent($block);
        $this->_addContent($this->getLayout()->createBlock('adminhtml/template')
    ->setTemplate('Abandoncart/abandoncart.phtml')); 

        $this->renderLayout();
		
		}
    
    public function extensionSettingAction()
    
    {
		
		$this->loadLayout()
            ->_setActiveMenu('green_menu')
            ->_title($this->__('Extension Setting'));

        // my stuff
        $this->_addContent($block);
        $this->_addContent($this->getLayout()->createBlock('adminhtml/template')
    ->setTemplate('Abandoncart/extensionsetting.phtml')); 

        $this->renderLayout();
		
		
		
		}
		
		public function emailTemplateAction()
		{
			
			$this->loadLayout()
            ->_setActiveMenu('green_menu')
            ->_title($this->__('Email Template'));

        // my stuff
        $this->_addContent($block);
        $this->_addContent($this->getLayout()->createBlock('adminhtml/template')
    ->setTemplate('Abandoncart/email_template.phtml')); 

        $this->renderLayout();
			
			
			}
    
    
}



