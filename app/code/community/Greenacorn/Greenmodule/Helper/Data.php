<?php ob_start();
class Greenacorn_Greenmodule_Helper_Data extends Mage_Core_Helper_Abstract
{
function abandon_cart() 
    {
		$base1_url = Mage::getBaseUrl();
      ?>
      
    <?php
$cart_qty = (int) Mage::getModel('checkout/cart')->getQuote()->getItemsQty();
if($cart_qty!=0)
{
    $read_data = Mage::getSingleton('core/resource')->getConnection('core_read') ;
	$write_data = Mage::getSingleton('core/resource')->getConnection('core_write');            
    $result = $read_data->fetchAll("select * from abandoned_extensionsetting");	
    if($result['0']['status']=='on')
    {
$sessionCustomer = Mage::getSingleton("customer/session");
if(!$sessionCustomer->isLoggedIn()) {
 

    
       $read4 = Mage::getSingleton('core/resource')->getConnection('core_read') ;
		$write4 = Mage::getSingleton('core/resource')->getConnection('core_write'); 
		$result5 = $read4->fetchAll("SELECT * FROM log_url_info where url_id ='14'"); 
		//print_r($result5);
		 $base_url = $result5['0']['url'];
         $cart_qty = (int) Mage::getModel('checkout/cart')->getQuote()->getItemsQty();
        $modules = Mage::getConfig()->getNode('modules')->children();
		$modulesArray = (array)$modules;  
		$resource = Mage::getSingleton('core/resource');
									$readConnection = $resource->getConnection('core_read');
									$query = 'SELECT * FROM ' . $resource->getTableName('Abandon_cart_licensekey');
									$results = $readConnection->fetchAll($query); 
									$packagename = $results['0']['package_name']; 
									if($packagename=="LARGE"||$packagename=="MEDIUM"||$packagename=="Pro"||$packagename=="XXL"||$packagename=="Flex")
									{
		 if(isset($modulesArray['Greenacorn_Greenmodule']))
			
		 { 
 
	          if($cart_qty!=0)  { 
				  
				   } else { echo ' ';}
				    }
				 else
				   {
					echo 'Module does not exist';
					}	 
				  
				  ?>
				  
				<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
			
				 <script>
					 
						var isOk = false;
						var isFirst = false;
					    window.onload=function(){
					    window.onbeforeunload = function(e) {
						isOk=true;
						if(!isFirst)
							return 'You have product(s) in your cart that will be deleted if you leave this site. Do you want us to alert you if the price drop on any of the products in your cart?Click stay on the page to let us guide you!?';
							
						else
							return false;
					};

					}; 
					jQuery( document ).ready(function() {
							 jQuery("body").click(function() {
							window.onbeforeunload = null;
						});
						jQuery( "button" )
						 .on("mouseenter", function() {
							window.onbeforeunload = null;
						});
					});
										
					    setInterval(function () {
					    if(isOk==true)
						{
							isOk=false;
							isFirst= true;
							window.onbeforeunload = null;
							var cart = <?php echo $cart_qty; ?>;
							
							 jQuery.ajax({
								url:"/checkcart.php",
								type:'POST',
								data:'cart='+cart,
								success:function(results)
								{
									if(results != 'no')
									{	
										window.location.href='<?php  echo $base1_url; ?>abandon/frontmodule/autoLogin';
										
									}
								}
							});
						}
					},1000);
					</script> 
				  
				  <?php  
                         }
                     }


                 }

          }
          
         
    }//------------End funcion--------------------------//
	
	function dbconnection()
	{
		
	//-------------------------------DB Connection------------------------------------------------//
         $config  = Mage::getConfig()->getResourceConnectionConfig("default_setup");
         $_host = $config->host;
         $_uname = $config->username;
         $_pass = $config->password;
         $_dbname = $config->dbname;
         $_host; ///likewise
		 $db_handle = mysql_connect($_host , $_uname, $_pass);
		 $db_found = mysql_select_db($_dbname, $db_handle);
//-------------------------------End DB Connection------------------------------------------------//		 

		}
		
		function find_mage()
		{
	    echo $url = Mage::getBaseDir('app').'/Mage.php';

			}
	}//------------End main helper class--------------------------//
ob_end_flush();?>
