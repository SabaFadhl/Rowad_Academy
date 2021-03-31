<?php
ob_start();
require_once('../db/db.php');
require_once('../db/callTaskClass.php');
session_start();
if(!isset($_SESSION['admin_id']) or !isset($_SESSION['admin_role']) or (intval($_SESSION['admin_role'])!=1 and intval($_SESSION['admin_role'])!=2 and intval($_SESSION['admin_role'])!=3))
{
	header("location:login.php");
	exit();
}

?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/ICON.png">
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    \<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <!--<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
     CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/now-ui-dashboard.css?v=1.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/demo/demo.css" rel="stylesheet" />
    <!-- ARABIC GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">
	 <link href="font-awesome.min.css" rel="stylesheet" />
	 <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
   
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="black">
            <!--
        ||||class="active"
    -->
            <div class="logo">
                <a href="index.php" class="simple-text logo-mini">
                    <img src="assets/img/logo.png" class='logoimg'>
                </a>
                <a href="#" class="simple-text logo-normal">
                    <p style=" font-family: 'Calibri', Sakkal Majalla, Monotype Koufi  !important;">ميديا ماكس </p><!-- <img src="assets/img/logo-linakaloda.svg"> -->
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    
					<?php 
						echo right_list('index','fa fa-gears design_app','لوحة التحكم'); 
                        $r=$_SESSION['admin_role'];
                        $sql="select * from roles where id =:r";
                            $q=$con->prepare($sql);
                            $q->execute(array("r"=>$r));
                            $rows=$q->fetchall();
                            //var_dump($rows);
                            if($q->rowcount()>0)
                            {
                                foreach($rows as $row)
                                {
                                    $acounts=$row['acounts'];
                                    $orders=$row['orders'];
                                    $slides=$row['slides'];
                                    $users=$row['users'];
                                    $products=$row['products'];
                                    $offers=$row['offers'];
                                    $addresses=$row['addresses'];
                                    $locations=$row['locations'];
                                    $messages=$row['messages'];
                                    $granted_roles=$row['granted_roles'];
                               }
                            }
						 
						if(isset($orders) and $orders==1)
                        echo "<li class='dropdown'>
                            <a href='tables.php' class='dropdown-toggle' data-toggle='dropdown'>
                                <i class='now-ui-icons design_bullet-list-67'></i>
                                <p>الطلبات</p>
                            </a>
                            <div class='dropdown'>
                            <div class='dropdown-menu drop_tables'>
                            <a class='dropdown-item' href='orders.php?name=كل الطلبات'>كل الطلبات</a><br>
                            <a class='dropdown-item' href='orders.php?role=1&name=جديدة'>جديدة</a><br>
                            <a class='dropdown-item' href='orders.php?role=2&name=قيد التجهيز'>قيد التجهيز</a><br>
                            <a class='dropdown-item' href='orders.php?role=3&name=الدفع'>الدفع</a><br>
                            <a class='dropdown-item' href='orders.php?role=4&name=مكتملة'>مكتملة</a><br>
                            </div>
                            </div>
                        </li>";	
						
				
						if(isset($granted_roles) and $granted_roles==1) echo right_list('roles.php','fa fa-users design_app','منح الصلاحيات');
						if(isset($acounts) and $acounts==1) echo right_list('user_pro.php?action=insert','fa fa-user design_app','اضافة حسابات');
						if(isset($slides) and $slides==1) echo right_list('slides.php','fa fa-users design_app',' السلايدات');	
						if(isset($users) and $users==1) echo right_list('users.php?name=المستخدمين','fa fa-users design_app','المستخدمين');			
						if(isset($products) and $products==1) echo right_list('products','fa fa-shopping-basket design_app','المنتجات'); 
						if(isset($offers) and $offers==1) echo right_list('offers','fa fa-magic design_app','العروض'); 
						if(isset($addresses) and $addresses==1) echo right_list('addresses','fa fa-home design_app','العناوين'); 
						if(isset($locations) and $locations==1) echo right_list('locations','fa fa-map-marker design_app','الاماكن'); 
						if(isset($messages) and $messages==1) echo right_list('messages','fa fa-envelope-open design_app','الرسائل'); 
						
						
					?>
						
                </ul>
            </div>
        </div>