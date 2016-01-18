<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Jamie's Bows: Add bow</title>
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
        
        if (isset($_POST['submit'])){
			
		
			
			
			
            $name = htmlspecialchars($_POST['name']);
            $desc = htmlspecialchars($_POST['description']);
            $price = htmlspecialchars($_POST['price']);
            $date = date('Y-m-d');
			
			
			if ( ! empty( $_FILES[ 'newphoto' ] ) ) {
$newPhoto = $_FILES[ 'newphoto' ];
$originalName = $newPhoto['name'];
if ( $newPhoto[ 'error' ] == 0 ) {
$tempName = $newPhoto[ 'tmp_name' ];
move_uploaded_file( $tempName, "images/$originalName");
$_SESSION['photos'][] = $originalName;
//print("The file $originalName was uploaded successfully.\n");
} else {
print("Error: The file $originalName was not uploaded.\n");
}
}


           /* $newFile = $_FILES['newphoto'];

            $originalName = $newFile['name'];
            
            $size_in_bytes = $newFile['size'];
            $type = $newFile['type'];
            $error = $newFile['error'];

            if ($error == 0){
            $ext = pathinfo($originalName, PATHINFO_EXTENSION);
            $tempName = $newFile['tmp_name'];
            $newName = time() . "." . $ext;
            move_uploaded_file($tempName, "images/$newName");
            $_SESSION['add_photo'][] = $newName;
			*/

            if (strlen($name) > 255){
                $name = substr($name, 0, 255);
            }

            if (strlen($desc) > 255){
                $desc = substr($desc, 0, 255);
            }

           
            $taken = date('Y-m-d');
            

            require_once 'config.php';

            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

           



		   if ($mysqli->connect_errno) {
                printf("Connect failed to mysqli: %s\n", $mysqli->connect_error);
                exit();
            }

            $name = $mysqli->real_escape_string($name);
				$desc =$mysqli->real_escape_string($desc);
				$price =$mysqli->real_escape_string($price);
			
			
			
			
			$sql = "INSERT INTO Items ( `name`, `url`, `price`, `description`) VALUES 
                                ('$name', 'images/$originalName', '$price', '$desc')";

            if ($mysqli->query($sql)){
					//WRITE CODE HERE:ADD TO CHECKED CATEGORIES
					$q="SELECT `i_id` FROM `Items` WHERE url='images/$originalName' AND name='$name' AND price='$price' AND description='$desc'";
					$res=$mysqli->query($q);
					if($res){
            			$arr=$res->fetch_row();
						$idd=$arr[0];
						print("<h5>inserted $idd</h5>");
            			$catarr=$_POST['category'];
            			foreach($catarr as $cat){
            				//add to itemsincategories
							
            				$sq="INSERT INTO `ItemsInCategories`(`c_id`, `i_id`) VALUES ('$cat','$idd')";
            				if($mysqli->query($sq))
								print("<h5>inserted into $cat</h5>");
            			}
        			
            
                    echo "<br><h5>Your new bow has been added!</h5><br>";
                
                    } 
			}else {
                printf("Connect failed when adding 1: %s\n", $mysqli->connect_error);
                exit();
            }

        
        }elseif (isset($_POST['additem'])){
            echo "<h5>Add a new product</h5>";

            echo "<form action='add.php' class='avantiform' method='POST' enctype='multipart/form-data'>
                        <br>
                        <div> Check all categories to add item to:<br><br>"; 
						
						
						 $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$sq="SELECT `c_id`,`c_name` FROM `Categories`";
if ($res=$mysqli->query($sq)){

          while($row=$res->fetch_assoc()){
          $c=$row['c_name'];
		  $i=$row['c_id'];
						
						echo "<input type='checkbox' name='category[]' value='$i'>$c<br>";
		  }
}

						
						echo "</div><br><br><div>
                            <label for=\"name\">Name of item: </label>
                            <input id=\"name\" type=\"text\" name=\"name\"  autofocus/>
                        </div>
                        <br><br>
                        <div>
                            <label for=\"description\">Description: </label>
                            <input id=\"description\" type=\"text\" name=\"description\"  />
                        </div>
                        <br><br>
                        <div>
                            <label for=\"price\">Price: </label>
                            <input id=\"price\" type=\"text\" name=\"price\"  />
                        </div>
                        <br><br>
                        
                        <div> 
                            <label for=\"newphoto\">Select a photo from your computer: </label>
                            <input type='file' name='newphoto' class='upload'/>
                        </div>
                        <br><br>

                        <div>
                        <button type=\"submit\" class=\"buttons\" name=\"submit\">Add a new product!</button></div>
                    </form><br><br>";
						echo '<br><br><br><br><br><br><br>';

            }
elseif(isset($_POST['categinsert'])){
$name=$_POST['categ'];
$id=$_POST['selimg'];
//print("selimg $id");

//sql to insert category
 require_once 'config.php';

            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            if ($mysqli->connect_errno) {
                printf("Connect failed to mysqli: %s\n", $mysqli->connect_error);
                exit();
            }
$sq="SELECT `url` FROM `Items` WHERE `i_id`=$id";
if ($res=$mysqli->query($sq)){

          $row=$res->fetch_row();
          $img=$row[0];

            $sql = "INSERT INTO `Categories` ( `c_name`, `img_url`) VALUES 
                                ('$name', '$img')";

            if ($mysqli->query($sql)){
            
                echo "<br><h5>Your new category has been added!</h5><br>";
                
            } else {
                printf("Connect failed when adding 1: %s\n", $mysqli->connect_error);
                exit();
            }
}
else{
echo 'Please select a valid image to serve as representative for the category in the menu.';
}

//print inserted success
}






        
        } 
		else        {
            echo "You are not logged in. Please go <a href='login.php'>here</a> to login!";
        }
    

    ?>


 </div>
        </div>
        
        <!--content end-->


<?php include 'inc/footer.php';?>
</body>



</html>