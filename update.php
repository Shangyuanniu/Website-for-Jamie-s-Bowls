<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Jamie's Bows: Update</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 481px)" href="css/style.css">
    <link rel="shortcut icon" href="images/icon.png"/>
    <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 480px)" href="css/small-device.css" />
    <link href='http://fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet' type='text/css'>
</head>
<body>
<?php include 'inc/nav.php';
/*if (isset($_SESSION['logged_user'])){
	$logged_user = $_SESSION['logged_user'];
    echo '<div class="header2"><p>You are currently logged in as '.$logged_user.'. If you would like to log out. Click <a href="logout.php" class="green">here</a> to log out.</p></div>';

}*/?>
 <!--content-->
        <div class="wrap">
            <div class="content">
<br><br><br>

	<?php 
		if (isset($_SESSION['logged_user'])){


			require_once 'config.php';
			$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

			
			$id = "";
			// user clicked update button
			if(isset($_POST['update_submit'])){
					
				$name = htmlspecialchars($_POST['name']);
				$desc = htmlspecialchars($_POST['description']);
				$price = htmlspecialchars($_POST['price']);
				$id = intval($_GET['id']);
				
				
				$name = $mysqli->real_escape_string($name);
				$desc =$mysqli->real_escape_string($desc);
				$price =$mysqli->real_escape_string($price);
			

				$qry = "UPDATE `Items` SET name='$name', description='$desc', price='$price'  WHERE i_id='$id'";
				

				$result = $mysqli->query($qry);

				if ($result){
			//WRITE CODE HERE:REMOVE FROM ALL CATEGORIES, THEN READD TO CHECKED CATEGORIES					
			$idd=$id;
			$q="DELETE FROM `ItemsInCategories` WHERE i_id=$idd";
			$mysqli->query($q);
			$catarr=$_POST['category'];
			foreach($catarr as $cat){
				//add to itemsincategories
				$sq=" INSERT INTO `ItemsInCategories`(`c_id`, `i_id`) VALUES ('$cat','$idd')";
				$mysqli->query($sq);
			}
			
					echo "<h5>Your bow has been successfully updated.</h5>";
					
				} else {
					echo "";
				}
			}

			// user clicked delete button
			elseif(isset($_POST['delete_submit'])){
				$id = intval($_GET['id']);

				$qry = "DELETE FROM `Items` WHERE i_id =$id";

				$result = $mysqli->query($qry);

				if ($result){
					$qry = "DELETE FROM `ItemsInCategories` WHERE i_id =$id";

				    $result = $mysqli->query($qry);
					echo "<h5>Your bow has been successfully deleted.</h5>";
					
				} else {
					echo "";
				}
				
			}
elseif(isset($_POST['categdelete'])){
//delete category stuff
$id =$_POST['selcateg'];
//print("<h5>$id<h5>");

				$qry = "DELETE FROM `Categories` WHERE c_id =$id";

				$result = $mysqli->query($qry);

				if ($result){
						$qry = "DELETE FROM `ImagesInCategories` WHERE c_id =$id";

				      $result = $mysqli->query($qry);
					echo "<h5>Your category has been successfully deleted.</h5>";
					
				} else {
					echo "<h5>There was some error deleting this category.<h5>";
				}

			

				//if ($result){
					//echo "<h5>Any items prefviously associeted with this category will still remain intact, so if you would like to delete them, please do so individually for each item.</h5>";
					
				//} else {
				//	echo "There was some error with the images belonging to this category";
				//}


}




			 elseif(isset($_POST['selimg']) ){
            	$id = $_POST['selimg'];

				$qry = "SELECT * FROM `Items` WHERE i_id ='$id'";

				$result= $mysqli->query($qry);
				$row=$result->fetch_assoc();
				$name = $row['name'];
				$desc = $row['description'];
				$price = $row['price'];

				echo "<h5>How would you like to change $name? </h5><br>";

				//echo "<strong><pre>    If you would like to delete $name, please click the button below:</pre></strong>";

	    		echo "<form action=\"update.php?id=$id\" method=\"POST\" class='avantiform'>
				    If you would like to delete $name, please click the button below:<br><br>
	    			<button type=\"submit\" class=\"buttons\" name=\"delete_submit\">Delete your product!</button>
	    			</form><br>
	    		";
				// form to change / update
				echo "<form action=\"update.php?id=$id\" class='avantiform' method=\"POST\">
	    			<br>
					                        <div> Check all categories this item will belong to after the updates, you can use this to remove an item from a single or multiple categories:<br><br>"; 
						
						
						 $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$sq="SELECT `c_id`,`c_name` FROM `Categories`";
if ($res=$mysqli->query($sq)){

          while($row=$res->fetch_assoc()){
          $c=$row['c_name'];
		  $i=$row['c_id'];
						
						echo "<input type='checkbox' name='category[]' value='$i'>$c<br>";
		  }
}

						
						echo "</div><br><br>
					<div>
						<label for=\"name\">Name of item: </label>
						<input id=\"name\" type=\"text\" name=\"name\" value='$name' autofocus/>
					</div>
					<br><br>
					<div>
						<label for=\"description\">Description: </label>
						<input id=\"description\" type=\"text\" name=\"description\" value='$desc' />
					</div>
					<br><br>
					<div>
						<label for=\"price\">Price: </label>
						<input id=\"price\" type=\"text\" name=\"price\" value='$price' />
					</div>
					<br><br>
					
					<div>
	    			<button type=\"submit\" class=\"buttons\" name=\"update_submit\">Edit your product!</button></div>
	    		</form><br><br>";
echo '<br><br><br><br><br><br><br>';
	    		
				
            } 

            //if (empty($id) && !isset($_POST['delete_submit']) && !isset($_POST['update_subm']) && ){
              // echo "<div class=\"error\">Please return to <a href='login.php'>the admin panel</a> to select a product to modify!</div>";
           // }

			

		$mysqli->close();	
		} else
		{
			echo "You are not logged in. Please go <a href='login.php'>here</a> to login!";
		}

	?>


 </div>
        </div>
		
		<!--content end-->


<?php include 'inc/footer.php';?>
</body>



</html>