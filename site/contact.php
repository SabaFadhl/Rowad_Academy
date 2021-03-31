<?php
session_start();    
ob_start();
require_once('../db/db.php'); 
include_once ("../db/callTaskClass.php");

if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST["submit"]) and empty($_GET['id']))
	{ 
	    
		//$email=filter_var( $_POST['email'],FILTER_SANITIZE_EMAIL);
		//$name=$_POST['name'];
		$message=$_POST['message'];
		$id=$_SESSION['id'];
		if(empty($message))
		{
			$error['message']=error_message("الرسالة");
		}
		
		else if(!preg_match('/^[a-zA-Zأ-ي\s]*$/u',$message))
		{
			$error['message']="<span class='error-message'> يجب ان يكون احرف فقط</span>";
		}
		
		
		/*if(empty($email))
		{
			$error['email']=error_message("الايميل");
		}
		
		else if (!(filter_var( $email,FILTER_VALIDATE_EMAIL)))
		{
			$error['email']="<span class='error-message'> ادخل الايميل بالطريقة الصحيحة  </span>";
			
		}*/
		
		
		
			if(empty($error))
		   {
			   try{
				   var_dump($_SESSION);
					 echo "<div style='background-color: #FFC107;text-align: center;height: 4%;padding: 1%;'>".$h->messages($message,$id)."</div>";
					 if(isset($_SESSION['id']) and isset($_SESSION['role']))
						{
							echo '<script>alert("تم ارسال رسالتك شكرا لتواصلك معنا")</script>';
							echo "<meta http-equiv='refresh' content='0;url=\"../site/index.php\"'/>";
							
						}
			      }           
					
				
				catch(PDOException $e)
					{
					$done= $sql . "<br>" . $e->getMessage();
					}						
		   }
	   
	}



?>




	<!-- Meta tag Keywords -->
	<!-- css files -->
	<link rel="stylesheet" href="../css/logstyle/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="../css/reg.css" type="text/css" media="all" />
	<!-- Style-CSS -->
	<link rel="stylesheet" href="../css/fontawesome-all.css">
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //css files -->
	<!-- web-fonts -->
	<link href="//fonts.googleapis.com/css?family=Nova+Round" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	<!-- //web-fonts -->

	<!-- title -->
	<h1>
		
	
	</h1>
	<!-- //title -->
	<!-- content -->
	<div class="sub-main-w3">
	
	
		<form id="demo" novalidate action="contact.php" method="post">
			<h2>للتواصل معنا:</h2>
		
			

			<div class="form-group">
				<!--<input type="text" class="form-control textbox wtext" name="message" placeholder=" الرسالة" required=""   value="<?php //if(isset($message)) echo $message; ?>">-->
				<textarea class="form-control textbox wtext messha" name="message"  rows="15" cols='75' placeholder="اكتب ماتريد ارسالة" value="<?php if(isset($message)) echo $message; ?>"> </textarea>
				<?php if (isset($error['message']))echo ($error['message']);?>
			</div>
			
			<div class="form-group-2">
				
					<button class="btn btn-default btn-osx btn-lg"  type="submit" name="submit">
				<span>ارسال</span>
				</button>
			</div>
			<div class="alert alert-success hidden" role="alert">تم دخولك بنجاح</div>
		</form>
		
		
		<!-- //switch -->
	</div>
	<!-- //content -->


	<!-- Jquery -->
	<script src="../js/jquery-2.2.3.min.js"></script>
	<!-- //Jquery -->
	<!-- validify plugin -->
	<script src="../js/validify.js"></script>

	<!-- //validify plugin -->

