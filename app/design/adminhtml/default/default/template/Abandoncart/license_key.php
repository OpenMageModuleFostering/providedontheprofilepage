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

$data = array('email'=>$_POST['email'],'liscence_key'=>$_POST['liscence_key']);
	$url = "http://pricelizer.com/users/corporateLicence";
	//echo $_POST['mage_find'];
	$request = new RestRequest($url,'POST',$data);
	$request->execute();
	//print_r($request);

	//-------------------------------DB Connection------------------------------------------------//
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
    $result10 = $read_data->fetchAll("select * from Abandon_cart_licensekey");
    $useremail = $result10['0']['user_email'];
    if($useremail == "")
    {
						
					if($req['success']=='1')
					{
					 
					 $insert = "insert into Abandon_cart_licensekey (user_email,license_key,start_date,end_date,duration_type,user_id,package_name,list_abandon_cart,invitation_link,user_details) values('".$_POST['email']."','".$_POST['liscence_key']."','".$req['start_date']."','".$req['end_date']."','".$req['duration_type']."','".$req['user_id']."','".$req['package_name']."','".$req['list_abandon_cart']."','".$req['invitation_link']."','".$req['user_details']."')";
					 $insert_exc = mysql_query($insert);
					 
					 if($insert_exc)
					 {
						$img_success = Mage::getDesign()->getSkinUrl('images/gear-03.png'); 
						echo str_replace("frontend/base","adminhtml/default",$img_success);
						
						 }
						 elseif($req['success']=='0')
						 {
						   $img_success = Mage::getDesign()->getSkinUrl('images/gear-02.png');	 
						   echo str_replace("frontend/base","adminhtml/default",$img_success);
						   
						 }
						 else
						 {
							 $img_success = Mage::getDesign()->getSkinUrl('images/gear-01.png');
							 echo str_replace("frontend/base","adminhtml/default",$img_success);
							 
							 }
						
					}
					
				
	}

				else

				   {
								$update = "update Abandon_cart_licensekey set user_email='".$_POST['email']."',license_key='".$_POST['liscence_key']."',start_date='".$req['start_date']."',end_date='".$req['end_date']."',duration_type='".$req['duration_type']."',package_name='".$req['package_name']."',list_abandon_cart='".$req['list_abandon_cart']."',invitation_link='".$req['invitation_link']."',user_details='".$req['user_details']."' where user_id='".$req['user_id']."'";
								$ex_update = mysql_query($update);
								
								
								if($req['success']=='1')
								{
									 $img_success = Mage::getDesign()->getSkinUrl('images/gear-03.png'); 
									 echo str_replace("frontend/base","adminhtml/default",$img_success);
									 
									}
									else
									{
										$img_success = Mage::getDesign()->getSkinUrl('images/gear-02.png'); 
									    echo str_replace("frontend/base","adminhtml/default",$img_success);
									    
										
										}
					
				    }
	

?>
