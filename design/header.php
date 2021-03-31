<!DOCTYPE html>
<?php
//ini_set('display_errors', '0');
ob_start();
session_start();
require_once('../db/db.php'); 
include_once ("../db/callTaskClass.php");
//include_once ("../db/functions.php");
//var_dump($_SESSION);?>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/ICON.png">
    <link rel="icon" type="image/png" href="../img/logo.png">
     <title>ميديا ماكس</title>

    <link href="../css/bootstrap4/bootstrap.min.css" rel="stylesheet" />
    <link href="../css/main_styles.css" rel="stylesheet" />
    <link href="../css/responsive.css" rel="stylesheet" /> 
    <link href="../plugins/OwlCarousel2-2.2.1/animate.css" rel="stylesheet" />
    <link href="../plugins/OwlCarousel2-2.2.1/owl.carousel.css" rel="stylesheet" />
    <link href="../plugins/OwlCarousel2-2.2.1/owl.theme.default.css" rel="stylesheet" />
    <link href="../plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../styles/contact_styles.css" rel="stylesheet" />
    <link href="../css/cart.css" rel="stylesheet" />
    <link href="../css/cart_responsive.css" rel="stylesheet" />
	<link rel="stylesheet" href="../css/product1.css">
  <link rel="stylesheet" href="../css/cp_show_pro.css">
</head>
<body>


    <!-- Search Wrapper Area Start -->
 

    <div class="super_container">
        <header class="header trans_300">

            

            <!-- Main Navigation -->

            <div class="main_nav_container">
                <div class="container">
                    <div class="row" >
                        <div class="col-lg-12 text-right">
                           
                            <nav class="navbar">
							
							
							<ul class="navbar_user">
							 <li class="nav-item dropdown menu_item checkout" style="padding-right:0%">
<span>
        <a class="" href="#" id="nav" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">  <!--dropdown-toggle الاشاره -->
		
         <img src="../upload/<?php  if(isset($_SESSION['profile'])) echo $_SESSION['profile']; else echo "profile.jpg";?>" style="
    width: 40px;
    height: 40px;
    border-radius: inherit;" title="تسجيل الدخول ومشترياتي وتسجيل الخروج "> 
        </a >
          <div class="dropdown-menu" aria-labelledby="nav" id="noti" style="margin: 3% -134%;">
          <span class="dropdown-item " href="">
		  <?php 
		  if(isset($_SESSION['id']))
			{
				//var_dump($_SESSION);
				$edituser=$_SESSION['id'];
				echo "<a href='../site/myPurchases.php' style='width: auto;
						font-size: 0.7em;'>مشترياتي</a>  <div class='dropdown-divider'></div>";
				echo "<a href='../site/logout.php' style='width: auto;
						font-size: 0.7em;'>تسجيل الخروج</a>   <div class='dropdown-divider'></div> ";
				echo "<a href='../site/registering.php?action=edit&id=$edituser' style='width: auto;
						font-size: 0.7em;'>تعديل حسابي </a>  ";
			}
			else
			{ 
				echo "<span><a href='../site/login.php' style='width: auto;
						font-size: 0.7em;'>تسجيل الدخول</a><span> ";
					 
			}
	?>
	</span>

      
		  
        </div>
		</span>
      
	  	<style>
	.input-group{margin: 0;
    margin-right: -3px;
    margin-left: 5px;
	position: relative;
	    display: flex;
    width: 100%;}
	
	.input-group-addon{
		      background-color: rgb(255 255 255);
    height: 30px;
    font-size: 0.55em;
    border: medium none;
    margin-top: 3.7% !important;
   
    border: 1px solid black;
    border-radius: 10px 10px 10px 10px;

	}
	.input-group-addon i {
    width: 17px;
}
.now-ui-icons {
    display: inline-block;
    font: normal normal normal 14px/1 'Nucleo Outline';
    font-size: inherit;
    speak: none;
    text-transform: none;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.form-control{
	margin-right: 0 !important;
}
</style>

									
	<li class=" nav-item menu_item checkout ">
		<a href="../site/cart.php" class="nocircle" >
			<i class="fa fa-shopping-cart" aria-hidden="true" title="سلة المشتريات"></i>
			<?php 
			if(isset($_SESSION['shopping_cart']))
			{
				$rows=count($_SESSION['shopping_cart']);
					if(!empty($rows))
					{
						if($rows>0)
						{
							$num=$rows;
							echo "<span id='checkout_items' class='checkout_items'>$num</span>";
							//echo "<h1 style='color:white'>$num </h1>";
							
							//echo "<meta http-equiv='refresh' content='0'/>";

						}
						
					}
			}
			?>
			
		</a>
	</li>

	
	

	
</ul>
<ul class="navbar_menu">

								 <li> <!--<input class="searching" placeholder="ابحث هنا">-->
<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

// Check connection
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt select query execution
if(isset($_POST["submit"]) )
{
	
$str=$_POST["search"];

//$sth=$con->prepare("SELECT name,period,price FROM products WHERE name= '$str'");



}
?>
	 <form style="direction:  ltr;border: none;display: block;
    margin-top: 0em;" method="post" action="../site/search.php">
		<div class="input-group no-border" title="البحث عن اي منتج">
		<input  type="text"  class="form-control forser" placeholder="بحث..." name='search' value='<?php if(isset($str) )echo $str;?>'>
		<input type="submit" name="submit" class="input-group-addon" style="font-family: FontAwesome" value="&#xf002;">
			
		
	</div>
	
</form>
					
									</li>
									


</li>
<li><a href="../site/contact.php" >تواصل معنا</a></li>
<li><a href="../site/handscraft.php		">خدماتنا</a> </li>
<li><a href="../site/showAll.php		">العروض</a> </li>
<li><a href="../site/Index">الرئيسية</a> </li>
 </ul>
	<div class="logo_container">
		<a href="../site/index.php"><span><span >ميديا ماكس لتقنية المعلومات</span><a href="../site/index.php"><img  style="max-width:5rem;"id="logo" src="../img/herf logo _white.png" ></a></span></a>
 	</div>
	<div class="hamburger_container">
		<i class="fa fa-bars" aria-hidden="true"></i>
	</div>
			</nav>
				</div>
					</div>
						</div>
		</div>

        </header>

        <div class="fs_menu_overlay"></div>
                <div class="hamburger_menu">
            <div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
            <div class="hamburger_menu_content text-right">
                <ul class="menu_top_nav">
				<li><a href="../site/contact.php" >تواصل معنا</a></li>
				<li><a href="../site/handscraft.php		">خدماتنا</a> </li>
				<li><a href="../site/showAll.php		">العروض</a> </li>
				<li><a href="../site/Index">الرئيسية</a> </li>

      </li>
	  
	  	 <li> <!--<input class="searching" placeholder="ابحث هنا">-->
<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

// Check connection
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt select query execution
if(isset($_POST["submit"]) )
{
$str=$_POST["search"];
//$sth=$con->prepare("SELECT name,period,price FROM products WHERE name= '$str'");



}
?>
	 <form style="direction:  ltr;border: none;display: block;margin-top: 0em;" method="post" action="../site/search.php">
		<div class="input-group no-border">
			<input  type="text"  class="form-control forser input-group-addon" placeholder="بحث..." name='search'>
			<!--<input type="submit" name="submit" class="input-group-addon" style="font-family: FontAwesome" value="&#xf002;"/>-->
		</div>
	</form>
					
									</li>
						
						
	   		<li class="dropdown menu_item">

        <?php 
						if(isset($_SESSION['id']) and isset($_SESSION['role']) and intval($_SESSION['role']==2) )//and $_SESSION['activation']==1
						{
							echo "<li class='menu_item dropdown'><a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
								<span class='sr-only' >(current)</span> لوحة التحكم
								</a >
								
								<div class='dropdown-menu mobi' aria-labelledby='navbarDropdown' id='menu'>
								
								  <a class='dropdown-item' href='../saller_cp/cp_adding.php'> اضافة منتج</a>
								  <a class='dropdown-item' href='../saller_cp/cp_products.php'> عرض المنتجات</a>
								  <a class='dropdown-item' href='../saller_cp/cp_seller.php'>المبيعات </a>
								  <div class='dropdown-divider'></div>
								  <a class='dropdown-item' href='../saller_cp/cp_order.php' >الطلبات </a>
								  <a class='dropdown-item' href='../saller_cp/cp_offeradding.php' >اضافة عرض </a>
								  
								</div>
							  </li>";
							 
						}
						//var_dump($_SESSION);
					?>
      </li>
	 
	  
	 
                </ul>
            </div>
        </div>
        </div>