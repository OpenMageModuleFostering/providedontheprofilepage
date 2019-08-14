<?php
    //-------------------------------DB Connection------------------------------------------------//
    $config  = Mage::getConfig()->getResourceConnectionConfig("default_setup");
    $_host = $config->host;
    $_uname = $config->username;
    $_pass = $config->password;
    $_dbname = $config->dbname;
    $_host; ///likewise
    $db_handle = mysql_connect($_host , $_uname, $_pass);
    $db_found = mysql_select_db($_dbname, $db_handle);
    $smtp = Mage::getBaseDir().'/smtp/newsmtp/classes/class.phpmailer.php';
    include($smtp); 
    //-------------------------------End DB Connection------------------------------------------------//		 

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

    class Greenacorn_Greenmodule_FrontController extends Mage_Core_Controller_Front_Action
    {  
        public function maildataAction()
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
            Mage::getBaseUrl(); 
            $read1 = Mage::getSingleton('core/resource')->getConnection('core_read') ;
            $write1 = Mage::getSingleton('core/resource')->getConnection('core_write'); 

            $config  = Mage::getConfig()->getResourceConnectionConfig("default_setup");
            $_host = $config->host;
            $_uname = $config->username;
            $_pass = $config->password;
            $_dbname = $config->dbname;
            $_host; ///likewise
            $db_handle = mysql_connect($_host , $_uname, $_pass);
            $db_found = mysql_select_db($_dbname, $db_handle);

            $url ="http://www.pricelizer.com/users/AbandonedCart/";
            $select_query = mysql_query('select sales_flat_quote.created_at,sales_flat_quote.items_qty,sales_flat_quote.entity_id,
            sales_flat_quote.base_currency_code,sales_flat_quote.grand_total,sales_flat_quote.customer_email,sales_flat_quote.customer_firstname
            ,sales_flat_quote_item.name ,sales_flat_quote_item.quote_id,sales_flat_quote_item.product_id,sales_flat_quote_item.price from sales_flat_quote_item INNER JOIN sales_flat_quote ON sales_flat_quote.entity_id = sales_flat_quote_item.quote_id where sales_flat_quote.entity_id ="'.$_GET['entity_id'].'" AND sales_flat_quote_item.quote_id ="'.$_GET['entity_id'].'" ');

            $i=0;
            $abandon_arr = array();
            while($row = mysql_fetch_array($select_query))
            {


                if($i==0)
                {
                    $abandon_arr['email']=$row['customer_email'];
                }


                $log_url ="SELECT * FROM log_url_info where url_id ='14'"; 

                $log_exc = mysql_query($log_url);
                $exc = mysql_fetch_row($log_exc);
                $exc['1'];	
                $get_url_query = "SELECT DISTINCT value  from catalog_product_entity_varchar where attribute_id ='85' AND entity_id ='".$row['product_id']."'";
                $exe_get = mysql_query($get_url_query);
                $pr_url = mysql_fetch_row($exe_get);

                $exc['1'].'media/catalog/product'.$pr_url['0'];
                $get_url_query1 = "SELECT DISTINCT value  from catalog_product_entity_varchar where attribute_id ='98' AND entity_id ='".$row['product_id']."'";
                $exe_get1 = mysql_query($get_url_query1);
                $pr_url1= mysql_fetch_row($exe_get1);

                //print_r($pr_url1);
                echo '<br>';
                $exc['1'].'index.php/'.$pr_url1['0'];	 
                $_GET['item_id'];	

                $explode_item_id = explode(',',$_GET['item_id']); 

                foreach($explode_item_id as $items_id)
                {
                    $select_abandon = "select * from Abandon_added_product where added_user_id ='".$_GET['customer_id']."' AND  added_prod_id='".$items_id."'";
                    $exc_abandon = mysql_query($select_abandon);
                    $fetch_abandon_cart = mysql_fetch_array($exc_abandon);

                    if(mysql_num_rows($exc_abandon)>0) 
                    {

                        $update_abandon = "update Abandon_added_product set abandon_email_status ='0' where added_prod_id='".$items_id."'";
                        $exc_update = mysql_query($update_abandon);
                    }
                    else
                    {

                        $insert_abandon = "insert into Abandon_added_product (added_user_id,added_prod_id,added_entity_id,abandon_email_status	) values ('".$_GET['customer_id']."','".$items_id."','".$_GET['entity_id']."','0')";  
                        $exc_insert_abandon = mysql_query($insert_abandon);

                    }

                }

                $prod_arr[] = array('prod_name'=>$row['name'],'prod_price'=>$row['price'],'prod_currency'=>$row['base_currency_code'],'prod_url'=>$exc['1'].'index.php/'.$pr_url1['0'],'prod_img_url'=>$exc['1'].'media/catalog/product'.$pr_url['0']);

                $i++;

            }

            $abandon_arr['plugin_user']='abandoned';
            $abandon_arr['liscence_key']='';

            $abandon_arr['cart_product']=$prod_arr;
            $decode_data =  $abandon_arr;
            $request = new RestRequest($url,'POST',$decode_data);
            $request->execute();
            $req=json_decode($request->responseBody,true);
            echo '<input type="hidden" id="red_url" value="'.$req["url"].'">';
            if($req['success']=='1') 
            {
            ?>
            <script>
                var val_data = document.getElementById("red_url").value;
                window.location = val_data;	
            </script>
            <?php
            }
            elseif($req['success']=='0')
            {
            ?>
            <script>
                alert('<?php echo $req['msg'];  ?>');
            </script>
            <?php
            }    
        }  




        public function guestuserAction()
        {
            $CartSession = Mage::getSingleton('checkout/session');
            $cart_product=array();

            foreach($CartSession->getQuote()->getAllItems() as $key=>$item)
            {

                $product_id = $item->getProductId();
                $product_name = $item->getName();
                $cart_product[$key]['prod_name'] =$product_name;
                $productExPrice  = $item->getPrice(); // price excluding tax
                $cart_product[$key]['prod_price'] = $productExPrice;
                $productIncPrice = $item->getPriceInclTax(); // price excluding tax
                $product = Mage::getModel('catalog/product')->load($item->getProductId());
                $productMediaConfig = Mage::getModel('catalog/product_media_config');
                $cart_product[$key]['prod_img_url'] =$productMediaConfig->getMediaUrl($product->getthumbnail());

                $my_product_url = $product->getProductUrl($item->getProductId()); 
                $cart_product[$key]['prod_url'] = $my_product_url;
                $currency_code = Mage::app()->getStore()->getCurrentCurrencyCode();
                $cart_product[$key]['prod_currency'] = $currency_code;
                $item_name .= $product_name;
                $item_url .= $my_product_url;
                $img_url .= $productMediaConfig->getMediaUrl($product->getthumbnail()); 
                $pr_name[] = $product_name; 
            }
            $item_name_pr = implode('<br>',$pr_name);
            $logo_src = Mage::getDesign()->getSkinUrl('images/',array('_area'=>'frontend/rwd'));
            $remove_base = $logo_src.'logo.gif';
            $logo_url_data = str_replace('/base','',$remove_base);
            $logo_url = '<img src="'.$logo_url_data.'">';
            $site_url = Mage::getBaseUrl();
            Mage::app()->getStore()->getName();
            $email = $_GET['user_email'];
            $mail   = new PHPMailer; // call the class
            $mail->IsSMTP();
            $mail->SMTPSecure = "";
            //$mail->SMTPDebug  = 2;  
            $mail->Host = 'ssl://smtpout.asia.secureserver.net'; // platinum.waxspace.com Hostname of the mail server
            $mail->Port = '465'; //Port of the SMTP like to be 25, 80, 465 or 587
            $mail->SMTPAuth = true; //Whether to use SMTP authentication
            $mail->Username = 'bugs@webenturetech.com';
            $mail->Password = 'bugs@123'; //Password for SMTP authentication
            //$mail->AddReplyTo("admin@quiconnaitunbon.com.com", "Admin"); //reply-to address
            $mail->SetFrom("karl.lillrud@maneer.se"); //From address of the mail 
            //$mail->SMTPSecure = "tls";
            // put your while loop here like below, 

            //sending link
            $link = "".$base_url."greenmodule/front/maildata/".'?entity_id='.$_GET['entity_id'].'&customer_id='.$_GET['customer_id'].'&item_id='.$_GET['item_id'];		
            $cur_date = date("l d F ");
            $customer_id =$_GET['customer_id']; // set this to the ID of the customer.
            $customer_data = Mage::getModel('customer/customer')->load($customer_id);
            $customer_name = $customer_data['firstname']; 	
            $read = Mage::getSingleton('core/resource')->getConnection('core_read') ;
            $write = Mage::getSingleton('core/resource')->getConnection('core_write'); 
            $abandon_days = $read->fetchall("select * from abandon_cart");
            $alert_days =  $abandon_days['0']['day'];
            $getemaildata = $read->fetchall("select * from abandon_email_template");  
            $firstname = "FIRSTNAME";
            $site_url = "PRODUCTNAME";
            $xdays    = "XDAYSFROMSETTINGS";
            $unsubscribe_key = "UNSUBSCRIBE";
            $date_data = "DATE";
            $culogo    = "CULOGO";
            $unsubs_url_key = $base_url.'greenmodule/front/unsub/?unsubs='.$_GET['customer_id'];
            $pstring = $getemaildata['1']['email_conetnt'];
            $modifieddata =  str_replace($firstname,$email,$pstring);
            $modifieddata1 =  str_replace($site_url,$item_name_pr,$modifieddata);	
            $modifieddata3 =  str_replace($xdays,$alert_days,$modifieddata1);
            $modified_data1 = str_replace($date_data,$cur_date,$modifieddata3);
            $modified_logo = str_replace($culogo,$logo_url,$modified_data1);
            $modifieddata4 = str_replace($unsubscribe_key,$unsubs_url_key,$modified_logo);
            $facebook = "FACEBOOK";
            $linkedin = "LINKEDIN";
            $twitter  = "TWITTER";
            $google   = "GOOGLE";
            $simple_signup = '1CLICKSIGNUP';
            $pricelizerlink = 'PRICELIZERLOGO';
            $flink = "FLINK";
            //$sitelogo = 'PRICELIZERLOGO';
            //$facebook_key = "<a href =".$link."><img src ='".$base_site_url."skin/frontend/base/default/images/facebook.jpeg.png' style='width:24px; height:24px; margin-right:10px;' ></a>";
            //$twitter_key =   "<a href =".$link."><img src ='".$base_site_url."skin/frontend/base/default/images/tweet.jpeg.png' style='width:24px; height:24px; margin-right:10px;' ></a>";
            //$linkedin_key =  $message .= "<a href =".$link."><img src ='".$base_site_url."skin/frontend/base/default/images/linked.jpeg.png' style='width:24px; height:24px; margin-right:10px;' ></a>";
            //$google_key = "<a href =".$link."><img src ='".$base_site_url."skin/frontend/base/default/images/google.jpeg.png' style='width:24px; height:24px; margin-right:0px;' ></a></td></tr>";
            $signup_url = "<a href =".$link.">1-Click Signup</a>";
            //$signup_url = "<button type='button' onclick = 'window.location.href=".$link."'>1-Click Sign Up</button>";
            $pricelizer_link = "<a href ='http://www.pricelizer.com'><img src ='http://www.pricelizer.com/img/pricelizer_logo.png' style='width:175px; height:auto; margin-right:0px;' ></a>"; 
            $flink_url = "<a style='color:#989898;margin-left:10px; text-decoration:none;' href='http://www.pricelizer.com'>Powered by Pricelizer</a>";
            $modifieddata5 = str_replace($facebook,$facebook_key,$modifieddata4);
            $modifieddata6 = str_replace($linkedin,$linkedin_key,$modifieddata5);
            $modifieddata7 = str_replace($twitter,$twitter_key,$modifieddata6);
            $signup_button = str_replace($google, $google_key,$modifieddata7);
            $pricelizer_logo_link = str_replace($simple_signup,$signup_url,$signup_button);
            $footer_link = str_replace($flink,$flink_url,$pricelizer_logo_link);
            $modifieddata2 = str_replace($pricelizerlink,$pricelizer_link,$footer_link);
            $mail->Subject = "Abandoned Cart Alert"; //Subject od your mail
            $mail->AddAddress($email, "fghgfhgfh"); //To address who will receive this email

            //$to = "ajay010791@gmail.com";
            //$subject = "Abandon Cart Alert"; 
            $headers = "From: Cart reminder";   
            $headers .= "Reply-To: ". ($to) . "\r\n";
            $headers .= "CC: ajay.singh@webeneturetech.com";
            $headers  = "MIME-Version: 1.0" . PHP_EOL;
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $message = '<html><body>';
            $message .= '<table rules="all" cellpadding="10" border="0" >';

            $unsuburl  = "<a href ='".$unsubs_url_key."'><span style='color:#999'>click here</span></a>";
            $message .= "</body></html>";	
            $unsubs	="UNCLICK";
            $entire_content =  str_replace($unsubs,$unsuburl,$modifieddata2);	 
            $message .= $entire_content;

            $mail->MsgHTML($message); //Put your body of the message you can place html code here
            $send = $mail->Send(); //Send the mails

            if($send){ 
                echo "send"; 
            }		

            $read_data = Mage::getSingleton('core/resource')->getConnection('core_read') ;
            $write_data = Mage::getSingleton('core/resource')->getConnection('core_write'); 	
            $result10 = $read_data->fetchAll("select * from Abandon_cart_licensekey"); 
            $registered_user_email = $result10['0']['user_email'];
            $registered_user_license_key = $result10['0']['license_key'];
            //print_r($result10);

            $prod_arr[] = array('prod_name'=>$product_name,'prod_price'=>$productExPrice,'prod_currency'=>$currency_code,'prod_url'=>$my_product_url,'prod_img_url'=>$productMediaConfig->getMediaUrl($product->getthumbnail()));

            $url1 ="http://www.pricelizer.com/users/AbandonedCart/";
            $prod_arr= array('email'=>$_GET['user_email'],'plugin_user'=>'catched','liscence_key'=>$registered_user_license_key,'user_id'=>$_GET['user_id'],'social'=>$_GET['social'],'cart_product'=>$prod_arr);
            //echo '<pre>';print_r($prod_arr);
            //die;
            $request = new RestRequest($url1,'POST',$prod_arr);
            //echo '<pre>';print_r($request);
            $request->execute();
            $config  = Mage::getConfig()->getResourceConnectionConfig("default_setup");

            $req=json_decode($request->responseBody,true);
            echo '<pre>'; print_r($req);

            echo '<input type="hidden" id="red_url1" value="'.$req["url"].'">';

            if($req['success']=='1') 
            {
            ?>
            <script>
                var val_data = document.getElementById("red_url1").value;
                window.location = val_data;	
            </script>
            <?php
            }
            elseif($req['success']=='0')
            {
            ?>
            <script>
                alert('<?php echo $req['msg'];  ?>');
            </script>
            <?php
            }    

        }

        public function unsubAction()

        {
            $get_val = $_GET['unsubs'];

            $update_abandon = "update Abandoned_email_subscription set subscribe_status ='no' where customer_id='".$get_val."'";
            $exc_update = mysql_query($update_abandon);
            if( $exc_update)
            {
                echo 'success';
            ?>
            <script>
                alert('You have successfully Unsubscribed');
                window.location.href = "http://magento.pricelizer.com";

            </script>

            <?php
            }
            else
            {
                echo 'failed';
            }

        }



    }
?>
