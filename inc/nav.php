
<div id="logo">
<a href="index.php"><img src="images/logo2.png" alt="Logo" class="avanti"></a>

</div>

    
    <!--<a href="dresses.php"><img src="images/hamburger.png" class="hamburger" alt="menu"><p class="menu">Menu</p></a>-->

    <div class="mobile-nav">
     <div class="menu-btn" id="nav-icon">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
     </div>

     <div class="responsive-menu">
        <ul>
           <li><a href="index.php">Home</a></li>
           <li><a href="products.php">Products</a></li>
           <li><a href="contact.php">Contact</a></li>
        </ul>
     </div>
</div>

    <nav>
        <ul>
           <li><a href="index.php">Home</a></li>
           <li><a href="products.php">Products</a>
              <ul>
			  <?php
			  $mysqli =  new mysqli('localhost','kitty','kittycat','info230_SP15_kitty');
$res = ($mysqli->query("SELECT * FROM Categories"));
$row=$res->fetch_assoc();
while($row){	
$catname= preg_replace('/\s+/', '+', $row['c_name']);		
echo'<li><a href="products.php?category='.$catname.'">'.$row['c_name'].'</a></li>';
$row=$res->fetch_assoc();
} 
                   /*echo' <li><a href="products.php">Cheerleaders</a></li>
                    <li><a href="products.php">New arrivals</a></li>
                    <li><a href="products.php">Sales</a></li>';*/
?>
              </ul>
           </li>
		   <?php
		   			if(isset($_SESSION['logged_user'])){
						echo '<li><a href="login.php">Admin Page</a></li>';
						echo'<li><a href="logout.php" class="green">Log Out</a></li>';
					}
			  ?>
           <li><a href="contact.php">Contact</a></li>
		   
        </ul>
    </nav>