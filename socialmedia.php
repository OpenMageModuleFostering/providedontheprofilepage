<?php
//-------------------------------DB Connection------------------------------------------------//
require_once($_POST['mage_find']);
Mage::init();			 
$db =  Mage::helper("greenmodule")->dbconnection(); 
//-------------------------------End DB Connection------------------------------------------------//

$fbapi = $_POST['fbkey'];
$_POST['mage_find'];

        $read4 = Mage::getSingleton('core/resource')->getConnection('core_read') ;
		$write4 = Mage::getSingleton('core/resource')->getConnection('core_write'); 
		$result5 = $read4->fetchAll("SELECT * FROM Abandon_social_media_login"); 
		
		 echo $base_url = $result5['0']['social_id'];
 if($base_url=="")
 {

		echo $insert_abandon = 'insert into Abandon_social_media_login (provider,oauth_token) values("social_media","'.$fbapi.'") ';
		$update_exc = mysql_query($insert_abandon);
		echo 'Successfully updated';
}
else
{
	echo $insert_abandon = 'update Abandon_social_media_login  set oauth_token = "'.$fbapi.'" where social_id="1"';
	$update_exc = mysql_query($insert_abandon);
	echo 'Successfully updated';
	
	}

?>
