<?php 
ini_set('display_errors', 1);
class RestRequest
{
 protected $url;
 protected $verb;
 protected $requestBody;
 protected $requestLength;
 protected $username;
 protected $password; 
 protected $acceptType;
 public $responseBody;
 protected $responseInfo;
 protected $contentType;

 public function __construct ($url = null, $verb = 'GET', $requestBody = null)
 {
  $this->url    = $url;
  $this->verb    = $verb;
  $this->requestBody  = $requestBody;
  $this->requestLength  = 0;
  $this->username   = null;
  $this->password   = null;
  $this->acceptType  = 'application/json';
  $this->contentType  = 'application/x-www-form-urlencoded';
  $this->responseBody  = null;
  $this->responseInfo  = null;

  if ($this->requestBody !== null)
  {
   $this->buildPostBody();
  }
 }

 public function flush ()
 {
  $this->requestBody  = null;
  $this->requestLength  = 0;
  $this->verb    = 'GET';
  $this->responseBody  = null;
  $this->responseInfo  = null;
 }

 public function execute ()
 {
  $ch = curl_init();
  $this->setAuth($ch);

  try
  {
   switch (strtoupper($this->verb))
   {
    case 'GET':
     $this->executeGet($ch);
     break;
    case 'POST':
     $this->executePost($ch);
     break;
    case 'PUT':
     $this->executePut($ch);
     break;
    case 'DELETE':
     $this->executeDelete($ch);
     break;
    default:
     throw new InvalidArgumentException('Current verb (' . $this->verb . ') is an invalid REST verb.');
   }
  }
  catch (InvalidArgumentException $e)
  {
   curl_close($ch);
   throw $e;
  }
  catch (Exception $e)
  {
   curl_close($ch);
   throw $e;
  }
 }

 public function buildPostBody ($data = null)
 {
  $data = ($data !== null) ? $data : $this->requestBody;

  if (!is_array($data))
  {
   throw new InvalidArgumentException('Invalid data input for postBody.  Array expected');
  }

  $data = http_build_query($data, '', '&');
  $this->requestBody = $data;
 }

 protected function executeGet ($ch)
 {  
  $this->doExecute($ch); 
 }

 protected function executePost ($ch)
 {
  if (!is_string($this->requestBody))
  {
   $this->buildPostBody();
  }

  curl_setopt($ch, CURLOPT_POSTFIELDS, $this->requestBody);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));

  $this->doExecute($ch);
 }

 protected function executePut ($ch)
 {
  if (!is_string($this->requestBody))
  {
   $this->buildPostBody();
  }

  $this->requestLength = strlen($this->requestBody);

  $fh = fopen('php://temp', 'rw+');
  fwrite($fh, $this->requestBody);
  rewind($fh);

  curl_setopt($ch, CURLOPT_INFILE, $fh);
  curl_setopt($ch, CURLOPT_INFILESIZE, $this->requestLength);
  curl_setopt($ch, CURLOPT_PUT, true);

  $this->doExecute($ch);

  fclose($fh);
 }

 protected function executeDelete ($ch)
 {
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

  $this->doExecute($ch);
 }

 protected function doExecute (&$curlHandle)
 {
  $this->setCurlOpts($curlHandle);
  $this->responseBody = curl_exec($curlHandle);
  $this->responseInfo = curl_getinfo($curlHandle);

  curl_close($curlHandle);
 }

 protected function setCurlOpts (&$curlHandle)
 {
  curl_setopt($curlHandle, CURLOPT_TIMEOUT, 10);
  curl_setopt($curlHandle, CURLOPT_URL, $this->url);
  curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array ('Accept: ' . $this->acceptType));
  curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array ('Content-Type: ' . $this->contentType));
  
  curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);
  curl_getinfo($curlHandle);
 }

 protected function setAuth (&$curlHandle)
 {
  if ($this->username !== null && $this->password !== null)
  {
   curl_setopt($curlHandle, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
   curl_setopt($curlHandle, CURLOPT_USERPWD, $this->username . ':' . $this->password);
  }
 } 
}

    $data = array('email'=>$_POST['reg_user_email'],'liscence_key'=>$_POST['reg_user_lkey']);
	$url = "http://www.pricelizer.com/users/corporateLicence/";
	$request = new RestRequest($url,'POST',$data);
	$request->execute();
	//-------------------------------DB Connection------------------------------------------------//
	require_once($_POST['mage_find']);
	Mage::init();			 
	$db =  Mage::helper("greenmodule")->dbconnection(); 
	//-------------------------------End DB Connection------------------------------------------------//	 
	//print_r($request);
	$req=json_decode($request->responseBody,true);
	print_r($req); 
	echo json_encode(array('data'=>$req));
	if($req['success']=='1')
			{
			$update = "update Abandon_cart_licensekey set user_email='".$_POST['reg_user_email']."',license_key='".$_POST['reg_user_lkey']."',start_date='".$req['start_date']."',end_date='".$req['end_date']."',duration_type='".$req['duration_type']."',package_name='".$req['package_name']."',list_abandon_cart='".$req['list_abandon_cart']."',invitation_link='".$req['invitation_link']."',user_details='".$req['user_details']."' where user_id='".$req['user_id']."'";
			$ex_update = mysql_query($update);	
			}
	
        $req['abandoned_user_count'];
        $req['catched_user_count'];
        $read4 = Mage::getSingleton('core/resource')->getConnection('core_read') ;
		$write4 = Mage::getSingleton('core/resource')->getConnection('core_write'); 
        $select =$read4->fetchall("select * from Abandon_cart_users ");
          
          if(empty($select))
          {
			  $insert = "insert into Abandon_cart_users (Abandoned_cart,Catched_user) values ('".$req['abandoned_user_count']."','".$req['catched_user_count']."')";
              $insert_exc = mysql_query($insert);
			  }
			  else
			  {
				  $update_users_count = "update Abandon_cart_users set Abandoned_cart ='".$req['abandoned_user_count']."', Catched_user ='".$req['catched_user_count']."' where id='1'";
				  $update_users_exc = mysql_query($update_users_count);
				  }
          
          

?>
