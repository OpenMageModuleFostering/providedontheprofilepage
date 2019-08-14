<?php

class Email_Template_Adminhtml_CustomController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('email_template')
            ->_title($this->__('Abandoned Email Template'));
      
        $this->_addContent($block);
        $this->_addContent($this->getLayout()->createBlock('adminhtml/template')
    ->setTemplate('custom_email_template/customtab.phtml')); 
    
        $this->renderLayout();
    }
    
    public function templateSettingAction()
    {
		
		 $this->loadLayout()
            ->_setActiveMenu('email_template')
            ->_title($this->__('Catched user Email Template '));

        // my stuff
        $this->_addContent($block);
        $this->_addContent($this->getLayout()->createBlock('adminhtml/template')
    ->setTemplate('custom_email_template/template_setting.phtml')); 

        $this->renderLayout();
		
		
		}
		
		
		public function purchaseReminderAction()
		{
			
			 $this->loadLayout()
            ->_setActiveMenu('email_template')
            ->_title($this->__('Purchase Reminder Email Template'));

        // my stuff
        $this->_addContent($block);
        $this->_addContent($this->getLayout()->createBlock('adminhtml/template')
    ->setTemplate('custom_email_template/purchase_reminder.phtml')); 

        $this->renderLayout();
			
			
			}

}
