<?php
session_start();
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
<?php include 'inc/nav.php';?>
 <!--content-->
        <div class="wrap">
            <div class="content">
<br><br><br>
<?php
	
	$username = filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING) ;
	$password = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING) ;

				
				if (!empty($username) && !empty($password)){
					require_once 'config.php';

					$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
					$username = $mysqli->real_escape_string($username);
                    $password = $mysqli->real_escape_string($password);
					$res = ($mysqli->query("SELECT salt FROM Login"));
					$row=$res->fetch_assoc();
                    $salt=$row['salt'];					

					$hashed_password = hash("sha256", $password . $salt);

//print($hashed_password);
//print("");

					$query = "SELECT * FROM Login WHERE username = '$username' AND password = '$hashed_password'";

					$result = $mysqli->query($query);


					if ($result && $result->num_rows == 1 ) { 
						echo "<p>Congratulations you have successfully logged in! </p>";
						$_SESSION['logged_user'] = $username;


						//echo "<br>

						//<p>Logging in allows you to add, edit, and delete products</p>";

						//echo "<p>If you would like to log out. Click <a href='logout.php' class=\"green\">here</a> to log out.</p>";

					/*	// add new item
						echo '<form action="add.php" method="POST" class="avantiform" >
							Add a new product: select a category
				            <select name="categ">';
								
								//require_once 'config.php';
				                //$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
								//prevents empty albums from being in options
								$qry='SELECT c_name FROM Categories';
								$result= $mysqli->query($qry);
								$row=$result->fetch_assoc();
				                while($row){
									echo '<option label="'.$row['c_name'].'">'.$row['c_name'].'</option>';
									$row=$result->fetch_assoc();
								}
						
						// delete or change item		
				        echo '    </select>
							<button type="submit" name="categgodelete" class="buttons"> Add item </button><br>
						</form>
						<form action="update.php" method="POST" class="avantiform" >
						Select Item To Delete or Update: 
						            <select name="selimg"> ';
										
										require_once 'config.php';
						                $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
										//prevents empty albums from being in options
										$qry='SELECT * FROM Items';
										$result= $mysqli->query($qry);
										$row=$result->fetch_assoc();
						                while($row){
											echo '<option value= "'.$row['i_id'].'" label="'.$row['i_id'].' '.$row['name'].'">'.$row['i_id'].' '.$row['name'].'</option>';
											$row=$result->fetch_assoc();
										}
										
						echo            '</select>
									<button type="submit" name="itemgodelete" class= "buttons">Modify</button><br>
						</form> ';

*/
					} else {
						echo "<p>There was an error logging in. Please check your username and password and then try again!</p>";
						
					}
					
					
				}
				
				
									if (isset($_SESSION['logged_user'])){
						$logged_user = $_SESSION['logged_user'];
						echo "<p>You are currently logged in as $logged_user. 

						Logging in allows you to add, edit, and delete product pages. ";
						

						echo "If you would like to log out, click <a href='logout.php' class=\"green\">here</a> to log out.</p><br>";

						//add new category
						echo '<form action="add.php" method="POST" class="avantiform" >
							Add a new category:<br><br>
							Name:
				            <input type="text" name="categ"></input>
							Sample Item From This Category:
							<select name="selimg"> ';
										
										require_once 'config.php';
						                $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
										//prevents empty albums from being in options
										$qry='SELECT * FROM Items';
										$result= $mysqli->query($qry);
										$row=$result->fetch_assoc();
						                while($row){
											echo '<option value= "'.$row['i_id'].'" label="'.$row['i_id'].' '.$row['name'].'">'.$row['i_id'].' '.$row['name'].'</option>';
											$row=$result->fetch_assoc();
										}
										
						echo '</select>
							<button type="submit" name="categinsert" class="buttons">Add category</button><br></form>';
								
								
						//delete old category
                          echo '<form action="update.php" method="POST" class="avantiform" >
							Delete a Category: <br><br> <select name="selcateg">';
								
								require_once 'config.php';
				                $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
								//prevents empty albums from being in options
								$qry='SELECT c_name, c_id FROM Categories';
								$result= $mysqli->query($qry);
								$row=$result->fetch_assoc();
				                while($row){
									echo '<option value= "'.$row['c_id'].'" label="'.$row['c_id'].' '.$row['c_name'].'">'.$row['c_id'].' '.$row['c_name'].'</option>';
									$row=$result->fetch_assoc();
								}
						
						// edit or delete item	
				        echo '    </select><button type="submit" name="categdelete" class="buttons">Delete Category</button><br>
						</form>';
						// add new item
						echo '<form action="add.php" method="POST" class="avantiform" >
							Add a new product: <br><br>';
							/*<br><br>select a category: 
				            <select name="categ">';
								
								require_once 'config.php';
				                $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
								//prevents empty albums from being in options
								$qry='SELECT c_name FROM Categories';
								$result= $mysqli->query($qry);
								$row=$result->fetch_assoc();
				                while($row){
									echo '<option label="'.$row['c_name'].'">'.$row['c_name'].'</option>';
									$row=$result->fetch_assoc();
								}
						
						// edit or delete item	
				        echo '    </select>*/


							echo'<button type="submit" name="additem" class="buttons">Add an item</button><br>
						</form>
						<form action="update.php" method="POST" class="avantiform" >
						Modify a Product: <br><br>
						Select Product To Delete or Update: 
						            <select name="selimg"> ';
										
										require_once 'config.php';
						                $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
										//prevents empty albums from being in options
										$qry='SELECT * FROM Items';
										$result= $mysqli->query($qry);
										$row=$result->fetch_assoc();
						                while($row){
											echo '<option value= "'.$row['i_id'].'" label="'.$row['i_id'].' '.$row['name'].'">'.$row['i_id'].' '.$row['name'].'</option>';
											$row=$result->fetch_assoc();
										}
										
						echo            '</select>
									<button type="submit" name="itemgodelete" class="buttons">Modify</button><br>
						</form> ';
						echo '<br><br><br><br><br><br><br>';

					} else {
						echo '
						<form action="login.php" method="POST" class="avantiform">
							<div>
							Enter your username and password to edit, add, or delete entries.<br><br><br><br>
							<label for="username">Username: </label>
							<input id="username" type="text" name="username"  required autofocus/>
							</div>
							<br><br>
							<div>
							<label for="password">Password: </label>
							<input id="password" type="password" name="password"  required autofocus/>
							</div>
							<br><br>
							<div>
							<button type="submit" name="submit" class="buttons">Submit</button>
							</div>
						</form>	';

					}
	?>

           
                
            </div>
        </div>
		
		<!--content end-->
<!--<script src='js/script.js'></script>-->

<?php include 'inc/footer.php';?>
</body>



</html>