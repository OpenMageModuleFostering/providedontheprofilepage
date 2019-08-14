<?php
require_once($_POST['mage_find']);
	Mage::init();			 
	$db =  Mage::helper("greenmodule")->dbconnection(); 
	//-------------------------------End DB Connection------------------------------------------------//	 
	//echo json_encode(array('email_id'=> $request));
	$req=json_decode($request->responseBody,true);
	$req_encode = json_encode(array('data'=> $request));
	//print_r($req_encode);
    //print_r($req);
    $read_data = Mage::getSingleton('core/resource')->getConnection('core_read') ;
	$write_data = Mage::getSingleton('core/resource')->getConnection('core_write'); 
	
	$sql_select = $read_data->fetchall("select * from abandon_email_template");
	$type = $_POST['type'];
	
	if($type=='invitation_email')
	{
	if(empty($sql_select))
	{
		$sql_insert = "insert into abandon_email_template (email_conetnt) values('".$_POST['editor1']."')";
	    $exc_sql = mysql_query($sql_insert);
		print_r("updated");
		}
		else
		{
			$sql_insert = "update  abandon_email_template set email_conetnt = '".$_POST['editor1']."' where template_type='abandoned_cart_template'";
	        $exc_sql = mysql_query($sql_insert);
	        print_r("Successfully updated");
			}
		}
		elseif($type=='catched_user')
		
		{
			echo 'catcheduser';
			
			$sql_insert = "update  abandon_email_template set email_conetnt = '".$_POST['editor1']."' where template_type='catched_user_template'";
	        $exc_sql = mysql_query($sql_insert);
	        print_r("Successfully updated");
			
		}
		
		elseif($type=='purchase_reminder')
		{
			
			$sql_insert = "update  abandon_email_template set email_conetnt = '".$_POST['editor1']."' where template_type='reminder_template'";
	        $exc_sql = mysql_query($sql_insert);
	        print_r("Successfully updated");
			
			}	
	
	
?>
