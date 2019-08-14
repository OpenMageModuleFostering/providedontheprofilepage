<?php
class Greenacorn_Greenmodule_FrontmoduleController extends Mage_Core_Controller_Front_Action
{
						public function autoLoginAction()
						{
						  $templatePath = 'Abandoncart/loginwithsocialmedia.phtml';
                         echo $output = Mage::app()->getLayout()->createBlock("core/template")->setData('area','frontend')->setTemplate($templatePath)->toHtml();

						}
							
}

 
