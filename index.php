<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Jamie's Bows - Hair Accessories</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 481px)" href="css/style.css">
    <link rel="shortcut icon" href="images/icon.png"/>
    <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 480px)" href="css/small-device.css" />
    <link href='http://fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet' type='text/css'>
</head>
<body class="no-touch">
<?php include 'inc/nav.php';
/*if (isset($_SESSION['logged_user'])){
	$logged_user = $_SESSION['logged_user'];
    echo '<div class="header2"><p>You are currently logged in as '.$logged_user.'. If you would like to log out. Click <a href="logout.php" class="green">here</a> to log out.</p></div>';

} */?>

<!-- <div>
<img class="title" src="images/logo1.png" alt="dress">
</div> -->
<!--Slideshow-->

<div id="slideshow-wrap">
        <input type="radio" id="button-1" name="controls" checked="checked"/>
        <label for="button-1"></label>
        <input type="radio" id="button-2" name="controls"/>
        <label for="button-2"></label>
        <input type="radio" id="button-3" name="controls"/>
        <label for="button-3"></label>
        <input type="radio" id="button-4" name="controls"/>
        <label for="button-1" class="arrows" id="arrow-1">></label>
        <label for="button-2" class="arrows" id="arrow-2">></label>
        <label for="button-3" class="arrows" id="arrow-3">></label>
        <div id="slideshow-inner">
            <ul>
                <li id="slide1">
                    <a href="products.php"><img src="images/slide1.jpg" alt="Click here!"></a>
                    <div class="description">
                        <input type="checkbox" id="show-description-1"/>

                    </div>
                </li>
                <li id="slide2">
                    <a href="products.php"><img src="images/slide2.jpg" alt="Click here!"></a>
                    <div class="description">
                        <input type="checkbox" id="show-description-2"/>
                    
                    </div>
                </li>
                <li id="slide3">
                    <a href="products.php"><img src="images/sl3.jpg" alt="Click here!"/> </a>
                    
                    <div class="description">
                        <input type="checkbox" id="show-description-3"/>

                    </div>
                </li>
            </ul>
        </div>
    </div>

<div id="slide-stacked">
<a href="outerwear.php"><img src="images/slide1.png" alt="Sweaters" class="stacked"></a>
<a href="dresses.php"><img src="images/slide4.png" alt="New Casual Dresses" class="stacked"></a>
<a href="dresses.php"><img src="images/slide2.png" alt="Formal Dresses" class="stacked"> </a>
<a href="accessories.php"><img src="images/slide5.png" alt="jewelry accessories" class="stacked"></a>
<a href="accessories.php"><img src="images/slide3.png" alt="Accessories" class="stacked"></a>
</div>
<br><br><br><br>
<div class="p1">
<p>
<strong>Welcome to Jamie's Bows! Each and every bow is handmade by me, Jamie Jett. Here you can find a wide variety of fashionable and affordable bows and hair accessories for you and your cheerleading team. There are also bows for every outfit in your wardrobe. Come check it out by clicking one of the categories below!</strong></p>
</div>
<br><br><br><br>
<div class="wrap2">
<?php 
$mysqli =  new mysqli('localhost','kitty','kittycat','info230_SP15_kitty');
$res = ($mysqli->query("SELECT * FROM Categories"));
$row=$res->fetch_assoc();
while($row){			
echo
'<div class="box2">
    <div class="boxInner">
	<form action="products.php" method="GET">
<input type="image" src="'.$row['img_url'].'" alt="dress">
<input type="hidden" name=\''.'category'.'\' value="'.$row['c_name'].'"/></form>
<div class="titleBox">'.$row['c_name'].'</div>
  </div>
  </div>';
  $row=$res->fetch_assoc();
} 
 /* <div class="box2">
    <div class="boxInner">
      <a href="products.php"><img src="images/bow5.jpg" alt="dress"></a>
      <div class="titleBox">New Arrivals</div>
    </div>
  </div>
  <div class="box2">
    <div class="boxInner">
      <a href="products.php"><img src="images/bow3.jpg" alt="dress"></a>
      <div class="titleBox">Sales</div>
    </div>
  </div>*/
  ?>
</div>
        <!--categories
        
        <div class="category_1">
            <a href="products.php"><img src="images/category_1.jpg" width="100%" alt="" /></a>
        </div>
        <div class="category_2">
            <a href="products.php"><img src="images/category_1.jpg" width="100%" alt="" /></a>
        </div>
        <div class="category_3">
            <a href="products.php"><img src="images/category_1.jpg" width="100%" alt="" /></a>
        </div>-->
       
        <!--categories end-->
        <br><br><br><br>

<?php include 'inc/footer.php';?>
</body>



</html>