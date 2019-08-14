<?php

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
  
  //curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);
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


class Button_Pricelizer_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        
		$customer_email = $_POST['link_email']; 
  
         $currency_code = Mage::app()->getStore()->getCurrentCurrencyCode();
         $productid = $_POST['link_productid'];
		 $model = Mage::getModel('catalog/product');
		 $_product = $model->load($productid); 
		 $_product->getShortDescription(); 
		 $_product->getDescription();
		 $productname = $_product->getName();
		 $productprice = $_product->getPrice();
		 $_product->getSpecialPrice();
		 $producturl=$_product->getProductUrl(); 
		 $img_url   =$_product->getImageUrl();  
		 $_product->getSmallImageUrl();
		 $_product->getThumbnailUrl();
		
		$prod_arr[] = array('prod_name'=>$productname,'prod_price'=>$productprice,'prod_currency'=>$currency_code,'prod_url'=>$producturl,'prod_img_url'=> $img_url);
		$url1 ="www.pricelizer.com/users/AbandonedCart/";
		$another_arra = array('email'=>$customer_email,'plugin_user'=>'watchlist','cart_product' => $prod_arr);
 		//echo '<pre>';print_r($another_arra);
        $request = new RestRequest($url1,'POST',$another_arra);
        $request->execute();
        $req=json_decode($request->responseBody,true);
        if($req['success']=='1')
        {
		     echo json_encode(array('message'=>$req['msg']));
             	
		}
		elseif($req['success']=='0')
		{
			echo json_encode(array('message'=>$req['msg']));
			
			}

					
    }
}
