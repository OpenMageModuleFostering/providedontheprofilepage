<?php
//-------------------------------DB Connection------------------------------------------------//
	require_once($_POST['mage']);
	Mage::init();			 
	$db =  Mage::helper("greenmodule")->dbconnection(); 
	
	//-------------------------------End DB Connection------------------------------------------------//
	
########################################################################################################################
#                                  Get value from abandoned_extensionsetting
##########################  ############################################################################################
	
    $read_data = Mage::getSingleton('core/resource')->getConnection('core_read') ;
	$write_data = Mage::getSingleton('core/resource')->getConnection('core_write');            
    $result = $read_data->fetchAll("select * from abandoned_extensionsetting");
    
    
########################################################################################################################
#                                  End Get value from abandoned_extensionsetting
##########################  ############################################################################################    
    
    $type = $_POST['type'];
    
    if($type=='catched_user')
    {
		
		$data = array("extension_name" =>$_POST["type"], "status" =>$_POST["catched_user"]); $where = "id = 1"; $write_data->update("abandoned_extensionsetting", $data, $where);
		echo 'Settings saved';
		
		}
		elseif($type=='1_click_signup')
		{	
		
		$data = array("extension_name" =>$_POST["type"], "status" =>$_POST["signup"]); $where = "id = 2"; $write_data->update("abandoned_extensionsetting", $data, $where);
		echo 'Settings saved';
			
			}
			
			elseif($type=='add_to_watchlist')
			{
				$data = array("extension_name" =>$_POST["type"], "status" =>$_POST["add_to_watch"]); $where = "id = 3"; $write_data->update("abandoned_extensionsetting", $data, $where);
		        echo 'Settings saved';
				
				}
				elseif($type=='pricelizer_logo')
				{
					$data = array("extension_name" =>$_POST["type"], "status" =>$_POST["pri_logo"]); $where = "id = 4"; $write_data->update("abandoned_extensionsetting", $data, $where);
		        echo 'Settings saved';
					
					}
					elseif($type=='link_footer')
					
					{
						$data = array("extension_name" =>$_POST["type"], "status" =>$_POST["footer_link"]); $where = "id = 5"; $write_data->update("abandoned_extensionsetting", $data, $where);
		        echo 'Settings saved';
						}
						elseif($type=='purchase_reminder')
						{
							
							$data = array("extension_name" =>$_POST["type"], "status" =>$_POST["reminder_status"]); $where = "id = 6"; $write_data->update("abandoned_extensionsetting", $data, $where);
		        echo 'Settings saved';
							
							
							}
							elseif($type=='outwards_communication')
							{
								
								$data = array("extension_name" =>$_POST["type"], "status" =>$_POST["outwards_com"]); $where = "id = 7"; $write_data->update("abandoned_extensionsetting", $data, $where);
		        echo 'Settings saved';
								
								}
								
								elseif($type=='site_logo')
								{
									$data = array("extension_name" =>$_POST["type"], "status" =>$_POST["site_logo"]); $where = "id = 8"; $write_data->update("abandoned_extensionsetting", $data, $where);
		        echo 'Settings saved';
									
									
									}
									
									elseif($type=='abandoned_cart_reminder')
								{
									$data = array("extension_name" =>$_POST["type"], "status" =>$_POST["aba_remin_setting"]); $where = "id = 9"; $write_data->update("abandoned_extensionsetting", $data, $where);
		        echo 'Settings saved';
									
									
									}
										
									elseif($type=='invite_abandonedcar_user')
								{
									$data = array("extension_name" =>$_POST["type"], "status" =>$_POST["invite_user"]); $where = "id = 10"; $write_data->update("abandoned_extensionsetting", $data, $where);
		        echo 'Settings saved';
									
									
									}
									
									
						
						
			
    
 ?>

