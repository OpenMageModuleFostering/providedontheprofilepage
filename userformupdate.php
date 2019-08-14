<?php
//-------------------------------DB Connection------------------------------------------------//

require_once($_POST['mage_find']);
Mage::init();			 
$db =  Mage::helper("greenmodule")->dbconnection(); 

//-------------------------------End DB Connection------------------------------------------------//
$abandon_cart = "select * from abandon_cart where id ='1'";
$exc_cart = mysql_query($abandon_cart);
$fetch_data = mysql_fetch_row($exc_cart);
//print_r($fetch_data);
$status_abandon = $fetch_data['1'];
$status_day = $fetch_data['2'];



$status = $_POST['status'];
$days =$_POST['day'];
$date = date("Y-m-d H:i:s"); 

	 
	if($status == '0')
	{

		$data_update = "update abandon_cart set abandon_status ='".$status."'";
		$update_exc = mysql_query($data_update);
		$msg = 'Sucessfully';
		echo json_encode(array('message'=>$msg));
	}
	elseif($status == '1')
	{
		
		$data_update = "update abandon_cart set abandon_status ='".$status."',day = '".$days."',date ='".$date."'";
		$update_exc = mysql_query($data_update);
		$msg = 'Sucessfully';
		echo json_encode(array('message'=>$msg));
		
	}
	 
	 ?>
