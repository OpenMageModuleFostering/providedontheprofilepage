<?php
class Priceliz_Statistics_IndexController extends Mage_Adminhtml_Controller_Action
{ 
    public function indexAction()
    {
		
		 $this->loadLayout();
       
        $this->_addContent($block);
        $this->_addContent($this->getLayout()->createBlock('adminhtml/template')
    ->setTemplate('pricelizerstatistics/pricelizerstatistics.phtml')); 
    
        $this->_setActiveMenu('priceliz_statistics')->renderLayout();     
    }  
    
    
    public function statisticsAction()
    {
		
		 $this->loadLayout()
            ->_setActiveMenu('priceliz_statistics')
            ->_title($this->__('Statistics View'));

        // my stuff
        $this->_addContent($block);
        $this->_addContent($this->getLayout()->createBlock('adminhtml/template')
    ->setTemplate('pricelizerstatistics/statisticsview.phtml')); 

        $this->renderLayout();
       
		
		}
		
		
		public function layerGrapghAction()
		{
			
			 $this->loadLayout()
            ->_setActiveMenu('priceliz_statistics')
            ->_title($this->__('Statistics Layer Grapgh'));

        // my stuff
        $this->_addContent($block);
        $this->_addContent($this->getLayout()->createBlock('adminhtml/template')
        ->setTemplate('pricelizerstatistics/statistics_layergrapgh.phtml')); 

        $this->renderLayout();
			
			
			}
			
			
			public function nonRegAction()
		{
			
			 $this->loadLayout()
            ->_setActiveMenu('priceliz_statistics')
            ->_title($this->__('Non Registered user statistics'));

        // my stuff
        $this->_addContent($block);
        $this->_addContent($this->getLayout()->createBlock('adminhtml/template')
        ->setTemplate('pricelizerstatistics/non_resgistered_statistics.phtml')); 

        $this->renderLayout();
			
			
			}
			
			
    
    
}
?>
