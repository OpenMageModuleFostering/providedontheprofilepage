 <?php 
  $cart = $_POST['cart'];
  
  if($cart !=0)
  {
	 $val = 'yes';
  }
  else
  {
	 $val ='no';
  }
  	  
  	 echo $val;        
?>
