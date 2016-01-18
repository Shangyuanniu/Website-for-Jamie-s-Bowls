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
<div class="header2"><h5>Products!</h5></div>
<?php
/*if (isset($_SESSION['logged_user'])){
	$logged_user = $_SESSION['logged_user'];
    echo '<p>You are currently logged in as '.$logged_user.'. If you would like to log out. Click <a href="logout.php" class="green">here</a> to log out.</p></div><br>';

} */
?>

 

	<div class="wrap">
    
 <?php 
 $mysqli =  new mysqli('localhost','kitty','kittycat','info230_SP15_kitty');
 if(!empty($_GET['category'])){
	 //SELECT * FROM Images INNER JOIN ImagesToAlbums ON Images.i_id = ImagesToAlbums.i_id WHERE ImagesToAlbums.album_name=\''.$_GET['album'].'\'';

	 $query='SELECT * FROM Items INNER JOIN ItemsInCategories INNER JOIN Categories ON Items.i_id=ItemsInCategories.i_id AND Categories.c_id=ItemsInCategories.c_id 
	 WHERE Categories.c_name=\''.$_GET['category'].'\'';
 //print($query);
 }
 else{
 $query="SELECT * FROM Items";
  //print("hhi".$query);
 }//if isset category then select  from items inner join items in categories etc etc
$res = ($mysqli->query($query));
$row=$res->fetch_assoc();
if(!$row){
	
	print("<br><pre><p>       We are very sorry, but we do not have any items pertaining to this category yet. Please check back with us in a few days.</pre></p>");
}
while($row){			
echo'<div class='.'box'.'>
<div class='.'boxInner'.'>
<form action="product.php" method="GET">
<input type="image" src="'.$row['url'].'" alt="dress">
<input type="hidden" name="src" value="'.$row['url'].'"/>
<input type="hidden" name="name" value="'.$row['name'].'"/>
<input type="hidden" name="description" value="'.$row['description'].'"/>
<input type="hidden" name="price" value="'.$row['price'].'"/>
</form>
<div class='.'titleBox'.'>'.$row['name'].'</div></div></div>';;
$row=$res->fetch_assoc();
} 
 /* <div class="box">
    <div class="boxInner">
      <img src="images/bow2.jpeg" alt="dress">
      <div class="titleBox">Blue Sequined Bow</div>
    </div>
  </div>*/
  /* echo'<div class='.'box'.'>
   <div class='.'boxInner'.'>
   <form action="product.php" method="GET"><input type="image" src="images/bow2.jpeg" alt="dress">
   <input type="hidden" name="src" value="images/bow2.jpeg"/>
   <input type="hidden" name="name" value="Blue Sequined Bow"/></input></form><div class='.'titleBox'.'>Blue Sequined Bow</div></div></div>';*/
  ?>

</div>
<br><br><br><br>

<?php include 'inc/footer.php';?>
</body>

</html>