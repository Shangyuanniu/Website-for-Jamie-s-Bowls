<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Jamie's Bows</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 481px)" href="css/style.css">
    <link rel="shortcut icon" href="images/icon.png"/>
    <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 480px)" href="css/small-device.css" />
    <link href='http://fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet' type='text/css'>
</head>
<body class="no-touch">
<?php include 'inc/nav.php';?>

<div>
</div>
<?php

 $name=$_GET['name'];
echo '<br><div class="header2"><h5>'.$name.'</h5><br>';
/*if (isset($_SESSION['logged_user'])){
	$logged_user = $_SESSION['logged_user'];
    echo '<p>You are currently logged in as '.$logged_user.'. If you would like to log out. Click <a href="logout.php" class="green">here</a> to log out.</p></div><br>';

} */

?>

 

	<div class="wrap">
    
	<!--categories nav end-->
  
 <!-- <div class="box">
    <div class="boxInner">
      <img src="images/bow2.jpeg" alt="dress">
      <div class="titleBox">Blue Sequined Bow</div>
    </div>
  </div>
  -->
  <?php
  $url=$_GET['src'];
  //$name=$_GET['name'];
  echo'<div class='.'box1'.'><div class='.'boxInner1'.'><img src="'.$url.'" alt = "A pretty bow"/></div></div>
  
   <div class="box10"><p class="p2" >'.$_GET['description'].'<br><br><br></p>
   <div class="price">Price: $'.$_GET['price'].'.00<br><br><br>
   <div class="avantiform">
   <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
		
			<!-- Identify your business so that you can collect the payments. -->
<input type="hidden" name="business" value="jrj1104@gmail.com">

<!-- Specify a PayPal Shopping Cart Add to Cart button. -->
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="add" value="1">

<!-- Specify details about the item that buyers will purchase. -->
<input type="hidden" name="item_name"
value="'.$name.'">
<input type="hidden" name="amount" value="'.$_GET['price'].'.00">
<input type="hidden" name="currency_code" value="USD">


 <!-- Provide the buyer with a text box option field. -->
    <input type="hidden" name="on0"
            value="Client Message">Please tell me how and where to have your order delivered and whether you have any specific design requests:<br />
        <textarea name="os0" maxlength="499" placeholder="Please enter your message here!"></textarea>


		<div class="button">

<!-- Display the payment button. -->
<input type="image" name="submit" src="images/button.png" alt="PayPal - The safer, easier way to pay online">
<img 
src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" alt="">
  		</div> 
 
</form>	

<form name="_xclick" target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="business" value="jrj1104@gmail.com">
<input type="image" src="images/b1.png" name="submit" alt="Make payments with PayPal its fast, free and secure!">
<input type="hidden" name="display" value="1">
</form>
  		
  </div>
		
			</div></div>
			
			
			
			
			
			
			
			

';?>
  <!--<div class="box10"><div class="boxInner">Description wil go here<br><br><br>price here<br><br>quantity here<br><br><br><br>user msg here<br> paypal button here but to the right</div>
  </div>';
  ?> 

			
			<form name="_xclick" target="paypal" action="" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="business" value="">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="item_name" value="HTML book">
<input type="hidden" name="amount" value="24.99">
<input type="image" src="images/button.png" border="0" name="submit" alt="Make payments with PayPal, its fast, free and secure!">
<input type="hidden" name="add" value="1">


https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif
https://www.paypal.com/en_US/i/btn/view_cart.gif

  -->
  
  
</div>
</div>


<?php include 'inc/footer.php';?>
</body>

</html>