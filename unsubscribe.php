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
	$subscription_status = $read_data->fetchall("SELECT * FROM Abandoned_email_subscription where customer_id ='".$_POST['customer_id']."'");
	
	if(empty($subscription_status))
	{
	$sql = "insert into Abandoned_email_subscription (customer_id,customer_name,customer_email,subscribe_status) values('".$_POST['customer_id']."','".$_POST['customer_name']."','".$_POST['customer_email']."','no')";
	$exc_sql = mysql_query($sql);
	print_r('You have unsubscibed for email alert notification');
	
}
elseif($subscription_status['0']['subscribe_status']=="no")
{
	$sql = "update Abandoned_email_subscription set subscribe_status ='yes' where customer_id ='".$_POST['customer_id']."'";
		  $exc_sql = mysql_query($sql);
		 print_r('You have subscibed for email alert notification');
	
	}
	elseif($subscription_status['0']['subscribe_status']=="yes")
	{$sql = "update Abandoned_email_subscription set subscribe_status ='no' where customer_id ='".$_POST['customer_id']."'";
		  $exc_sql = mysql_query($sql);
		 print_r('You have unsubscibed for email alert notification');
		
		}
	
	
	

?>
