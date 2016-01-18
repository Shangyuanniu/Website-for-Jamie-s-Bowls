<?php session_start();
	if (isset($_SESSION['logged_user'])) {
		$olduser = $_SESSION['logged_user'];
		unset( $_SESSION[ 'logged_user' ] );
	} else {
		$olduser = false;
	}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Jamie's Bows: Login</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 481px)" href="css/style.css">
    <link rel="shortcut icon" href="images/icon.png"/>
    <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 480px)" href="css/small-device.css" />
    <link href='http://fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet' type='text/css'>
</head>
<body>
	<?php include 'inc/nav.php'; ?>
    	<div id="content">
    		<div id="text">
				<h1>Log out</h1>
				<br>
				<?php 
					if ($olduser){
						echo "<p> You have successfully logged out.
						Please click <a href='login.php' class='green'>here</a> to login again.
						</p>";
					} else{
						echo "<p>You aren't logged in! Please click <a href='login.php' class='green'>here</a> to login</p>";
					}
				?>

				
			</div>
		</div>
</body>



</html>