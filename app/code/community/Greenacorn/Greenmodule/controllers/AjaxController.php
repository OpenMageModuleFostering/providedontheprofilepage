<?php
    class Greenacorn_Greenmodule_AjaxController extends Mage_Core_Controller_Front_Action
    {
        public function callAjaxAction()
        {
            $this->loadLayout()
            ->_setActiveMenu('green_menu')
            ->_title($this->__('Call Ajax'));

            // my stuff
            $this->_addContent($block);
            $this->_addContent($this->getLayout()->createBlock('adminhtml/template')
            ->setTemplate('Abandoncart/extension_setting.php')); 

            $this->renderLayout();

        }

    }
?>
