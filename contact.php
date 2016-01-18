<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Jamie's Bows - Contact</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 481px)" href="css/style.css">
    <link rel="shortcut icon" href="images/icon.png"/>
    <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 480px)" href="css/small-device.css" />
    <link href='http://fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet' type='text/css'>
</head>
<body>
<div id="background">
<?php include 'inc/nav.php';
/*if (isset($_SESSION['logged_user'])){
	$logged_user = $_SESSION['logged_user'];
    echo '<div class="header2"><p>You are currently logged in as '.$logged_user.'. If you would like to log out. Click <a href="logout.php" class="green">here</a> to log out.</p></div>';

}*/
?>

<?php

	/* throw in an isset to fix the INDEX errors */
	

	/* today's date and time */
	$submit_date = date("y-m-d");
	$submit_time = date("h:i:sa");

	/* header to be placed at the top of the form */
	$header = "Let me know what you think!";

	/* empty variables to store form info */
	$name = "";
	$phone = "";
	$email = "";
	$date = "";
	$reason = "";
	$message = "";
	$info = "";
	$errors = '';

	/* empty variables to store potential errors */
	$nameerror = "";
	$phoneerror = "";
	$emailerror = "";
	$reasonerror = "";
	$messageerror = "";

	/* check to make sure there are no errors */
	if (isset($_POST['submit'])){
		$name = htmlspecialchars($_POST['name']);
		$phone = htmlspecialchars($_POST['phone']);
		$email = htmlspecialchars($_POST['email']);
		$reason = htmlspecialchars($_POST['reason']);
		$message = htmlspecialchars($_POST['message']);
		$date = htmlspecialchars($_POST['date']);


		/* functions to check inputs */
		function checkphone($number_input){
		$parsed = str_replace( array('(',')','-',), '', $number_input);
		$pos = strpos($parsed,'1');
		if (is_numeric($parsed)==false)
			return 'invalid';
		elseif ($pos == 0 && strlen($parsed) == 11){
			$sansone=substr_replace($parsed,'',0,1);
			return $sansone;
		}
		elseif (strlen($parsed) !== 10)
			return 'short';
		else
			return $parsed;
		}

		function checkname($name_input){
			if (preg_match("/[^A-Za-z\- ]/",$name_input))
				return 'invalid';
			else
				return 'valid';
		}

		function checkmessage($message_input){
			if (preg_match("/[^A-Za-z\.\!\?\(\)\-\, ]/",$message_input))
				return "invalid";
			else
				return "valid";
		}


		/* creating error messages based on errors */
		if (empty($name))
			$nameerror = "<div class='error'>Please enter your name</div><br>";

		if (strlen($name)>0){
			$func_name = checkname($name);
			if ($func_name == 'invalid')
				$nameerror = "<div class='error'>Please enter a name containing only letters A-Z and hyphens</div><br>";
			}
		if (strlen($name)<4)
			$nameerror = "<div class='error'>Please enter a name longer than 3 characters</div><br>";

		if (strlen($name)>40)
			$nameerror = "<div class='error'>Please enter a name shorter than 40 characters</div><br>";

		

		if (empty($email))
			$emailerror = "<div class='error'>Please enter an email address</div><br>";

		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			$emailerror = "<div class='error'>This is not a valid email</div><br>";

		if (empty($phone))
			$phoneerror = "<div class='error'>Please enter a phone number</div><br>";

		if (strlen($phone) > 0){
		    	$num = checkphone($phone);
		    	if ($num == 'invalid')
		    		$phoneerror = "<div class='error'>Please enter a valid phone number</div><br>";
		    	elseif ($num =='short')
		    		$phoneerror = "<div class='error'>Please enter a ten-digit phone number</div><br>";
		    	else
		    		$phone = $num;
			}

		if (empty($reason))
			$reasonerror = "<div class='error'>Please select a reason for visiting</div><br>";

		if (empty($message))
			$messageerror = "<div class='error'>Message field is empty</div><br>";

		if (strlen($message)>0){
			$mes = checkmessage($message);
			if ($mes == "invalid")
				$messageerror = "<div class='error'>Please enter a message containing only letters A-Z and the .,!,?,-,(,) characters</div><br>";
			}
		if (strlen($message) < 11)
			$messageerror = "<div class='error'>Please enter a message longer than 10 characters</div><br>";

		if (strlen($message) >499)
			$messageerror = "<div class='error'>Please enter a message shorter than 500 characters</div><br>";

		if (empty($nameerror) && empty($phoneerror) && empty($emailerror) && empty($reasonerror) && empty($messageerror)){
			$header = "THANKS FOR YOUR SUBMISSION!";
			$info = "<p>Name: $name</p>
					 <p>Phone: $phone</p>
					 <p>Date visited: $date</p>
					 <p>E-Mail: $email</p>
					 <p>Reason: $reason</p>
					 <p>Message: $message</p>";
			$name = "";
			$phone = "";
			$email = "";
			$date = "";
			$reason = "";
			$message = "";
			$info = "";
			$errors = '';

			
			
		    $recipient="yvs4@cornell.edu"; 
		    $subject="Jamie's Bows Feedback";
		    $sender= $name;
		    $senderEmail= $email;
		    $message= $message;

		    $mailBody="Name: $sender\nEmail: $senderEmail\n\n$message";

		    mail($recipient, $subject, $mailBody);// "From: $sender <$senderEmail>");

		    //$thankYou="<p>Thank you! Your message has been sent.</p>";



			

					 }
		else{
			$header = "OOPS! AN ERROR WAS FOUND IN YOUR FORM!";
			$errors = "<p>$nameerror</p>
					   <p>$phoneerror</p>
					   <p>$emailerror</p>
					   <p>$reasonerror</p>
					   <p>$messageerror</p>";}
		}


?>


	<div class="header">
	<?php 

	echo "<h5>$header</h5>"; //<h5>$errors</h5>";   

	?>

	</div>
	<div>

</div>
	<form action = "contact.php" method ="POST" class="avantiform">
		<div>
			<label for="name">Name</label>
			<input id="name" type="text" name="name" value="<?php echo $name ?>" required/>
			<?php echo $nameerror ?>
		</div>
		<div>
			<label for="email">E-Mail</label>
			<input id="email" type="text" name="email" value="<?php echo $email ?>" required/>
			<?php echo $emailerror ?>
		</div>
		<div>
			<label for="phone">Phone Number</label>
			<input id="phone" type="text" name="phone" value="<?php echo $phone ?>" required />
			<?php echo $phoneerror ?>
		</div>
		<div>
			<label for="date">When did you visit Jamie's Bows?</label>
			<input id="date" type="date" name="date" min="1999-05-01" max="<?php echo date('Y-m-d') ?>" value="<?php echo $date ?>" required/>
		</div>
		<div>
			<label for="reason"> Why did you visit Jamie's Bows?</label><br>
			<select id="reason" name="reason">
				<option> Shopping for cheerleading accessories </option>
				<option> Shopping for fun </option>
				<option> Looking for a gift </option>
				<option> Just curious! </option>
			</select>
		</div>
		<div>
			<label for="message">Comments?</label>
			<textarea id="message" name="message" maxlength="499" placeholder="Please enter your message here!" required><?php echo $message ?></textarea>
			<?php echo $messageerror ?>
		</div>
		<div class="button">
   			<button type="submit" class="buttons" name="submit">Submit</button>
  		</div> 
  		<div>
  			<?php echo $info ?>
  		</div>
	</form>
<br>
<br>
<br>
<br>
<br>
<!--<script src='js/script.js'></script>-->
<?php include 'inc/footer.php';?>
</div></body>




</html>