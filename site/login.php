
<?php    
ob_start();
session_start();
require_once('../db/db.php'); 
include_once ("../db/callTaskClass.php");
		

//require_once('../herf/db/db.php'); 
if(isset($_SESSION['id']) and isset($_SESSION['role']))
{
	//header("location:index.php");
	//exit();
}

if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST["submit"]) and empty($_GET['id']))
	{ 
	    
		$email=filter_var( $_POST['email'],FILTER_SANITIZE_EMAIL);
		//=password_hash($_POST['pass1'],PASSWORD_DEFAULT);

		$pass1=$_POST['pass1'];
		if(empty($email))
		{
			$error['email']=error_message("الايميل");
		}
		
		else if (!(filter_var( $email,FILTER_VALIDATE_EMAIL)))
		{
			$error['email']="<span class='error-message'> ادخل الايميل بالطريقة الصحيحة  </span>";
			
		}
		
			if(empty($pass1))
		{
			$error['pass1']=error_message("ادخل كلمة المرور");
		}
		
		
			if(empty($error))
		   {
			   try{
					
					$log=$h->logins($email,$pass1);
					//var_dump($log);
					if(is_array($log)) 
					{
						if(!empty($_POST['remember']))
						 {
							setcookie("email",$_POST['email'],time()+3600*24*30);
							setcookie("pass",$_POST['pass1'],time()+3600*24*30);
							//echo "تم عمل كوكيز بنجاح";
						  }
						  
						$_SESSION['id']=$log['id'];
						$_SESSION['role']=$log['role'];
						$_SESSION['activation']=$log['activation'];
						$_SESSION['profile']=$log['profile'];
						//var_dump($_SESSION);
						header("location:index.php");
					}
					else 
					{
						echo "<div style='background-color: #FFC107;
							text-align: center;
							height: 4%;
							padding: 1%;'>";echo $h->logins($email,$pass1); echo"</div>";
					}
				} 
				catch(PDOException $e)
					{
					$done= $sql . "<br>" . $e->getMessage();
					}
					
					
				/*   */
					
						
		   }
	   
	}



?>


<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <link rel="icon" type="image/png" href="../img/logo.png">
     <title>حرف لبيع الاشغال اليدوية</title>

	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content="Validify Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements"
	/>
	<!--<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>-->
	<!-- Meta tag Keywords -->
	<!-- css files -->
	<link rel="stylesheet" href="../css/logstyle/style.css" type="text/css" media="all" />
	<!-- Style-CSS -->
	<link rel="stylesheet" href="../css/fontawesome-all.css">
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //css files -->
	<!-- web-fonts -->
	<link href="//fonts.googleapis.com/css?family=Nova+Round" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	<!-- //web-fonts -->
</head>

<body>
	<!-- title -->
	<h1>
		<span>مرحبا</span>
		<span>بك</span>
	
	</h1>
	<!-- //title -->
	<!-- content -->
	<div class="sub-main-w3">
		<form id="demo" novalidate action="#" method="post">
			<div class="form-group">
				<input type="email" class="form-control textbox" name="email" placeholder="البريد الالكتروني" required="" value="<?php if(isset($email)) echo $email;?>">
				<?php if (isset($error['email']))echo ($error['email']);?>
			</div>
			<div class="form-group">
				<input type="password" class="form-control textbox" name="pass1" placeholder="كلمة السر" required="" value="<?php if(isset($pass1)) echo $pass1;?>">
				<?php if (isset($error['pass1']))echo ($error['pass1']);?>
			</div>
			<div class="form-group">
				<input type="checkbox" name="remember" /><span class='message' >تذكرني</span><br><br>
			</div>
			<div class="form-group">
				<a href="sendingemail.php" style='color:white'/>هل نسيت كلمة السر؟</a><br><br>
			</div>
				<button class=" btn-default btn-osx btn-lg btn" type='submit'  name="submit">
				<span>دخول</span>
				</button>
				
				<button class=" btn-default btn-osx btn-lg btn"  type="submit" >
					<a href="registering.php">انشاء حساب</a>
				</button>
	
			<div class="alert alert-success hidden" role="alert">تم دخولك بنجاح</div>
		</form>
		<!-- //switch -->
	</div>
	<!-- //content -->

	<!-- copyright
	<div class="footer">
		<h5>
		<span></span>جميع
		<span></span>الحقوق
		<span></span>محفوظة
		<span>لحِرف</span>
	
	</h5>
	</div>
	 //copyright -->

	<!-- Jquery -->
	<script src="../js/jquery-2.2.3.min.js"></script>
	<!-- //Jquery -->
	<!-- validify plugin -->
	<script src="../js/validify.js"></script>
	<!--<script>
		$("#demo").validify({
			onSubmit: function (e, $this) {
				$this.find('.alert').removeClass('hidden')
			},
			onFormSuccess: function (form) {
				console.log("Form is valid now!")
			},
			onFormFail: function (form) {
				console.log("Form is not valid :(")
			}
		});
		$("#demo").validify({
			errorStyle: "validifyError",
			successStyle: "validifySuccess",
			emailFieldName: "email",
			emailCheck: true,
			requiredAttr: "required",
		});
	</script>-->
	<!-- //validify plugin -->

</body>

</html>