<?php   
ob_start();
require_once('../db/db.php'); 
include_once ("../db/callTaskClass.php");
session_start();		
	 



if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST["send"]) and empty($_GET['id']))
	{
	 
		$email=filter_var( $_POST['email'],FILTER_SANITIZE_EMAIL);
		$pass=$_POST['pass'];
		$pass1=$_POST['pass1'];
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$phone=$_POST['phone'];
		$role= intval($_POST['role']);
		$addDate=date("yy-m-d");//$_POST['addDate'];
		$image_name='profile';
		//$error[]=null;
		/* if(empty($name))
		{
			$error['name']=error_message("الاسم");
		}
		
		else if(!preg_match('/^[a-zA-Zأ-ي\s]*$/u',$name))
		{
			$error['name']="<span class='error-message'> يجب ان يكون احرف فقط</span>";
		} */
		if(empty($fname))
		{
			$error['fname']=error_message("الاسم الاول");
		}
		
		else if(!preg_match('/^[a-zA-Zأ-ي\s]*$/u',$fname))
		{
			$error['fname']="<span class='error-message'> يجب ان يكون احرف فقط</span>";
		}
		if(empty($lname))
		{
			$error['lname']=error_message("اللقب");
		}
		
		else if(!preg_match('/^[a-zA-Zأ-ي\s]*$/u',$lname))
		{
			$error['name']="<span class='error-message'> يجب ان يكون احرف فقط</span>";
		}
		if(empty($phone))
		{
			$error['phone']=error_message("رقم الهاتف");
		}
			else if(!preg_match('~^[71/73/77/70]{2}[0-9]{7}$~D',$phone))
		{
			$error['phone']="<span class='error-message'>يجب ادخال صيغة صحيحة تبدأ ب 71 او 73 او  77 ومكون من 9 ارقام </span>";
		}

		if(empty($email))
		{
			$error['email']=error_message("الايميل");
		}
		
		else if (!(filter_var( $email,FILTER_VALIDATE_EMAIL)))
		{
			$error['email']="<span class='error-message'> ادخل الايميل بالطريقة الصحيحة -_-  </span>";
			
		}
		
		if(empty($pass))
		{
			$error['pass']=error_message("كلمة المرور");
			
		}
		if(isset($pass) and isset($pass1))
		{
			$pass=password_hash($_POST['pass'],PASSWORD_DEFAULT);
			if(!password_verify($pass1,$pass) )
				$error['pass_error']="<span class='error-message'> كلمة المرور غير متطابقة </span>";
				
		}
		if(empty($pass1))
		{
			$error['pass1']=error_message("تأكيد كلمة المرور");
		}
		
		
		
		
		$namef=$_FILES['img']['name'];
		$sizef=$_FILES['img']['size'];
		$typef=$_FILES['img']['type'];
		$tmp_namef=$_FILES['img']['tmp_name'];
		$errorf=$_FILES['img']['error'];
		
		
		$mytypes=array("jpg","png","gif","jpeg");
			$ex=explode(".",$namef);
			$mytype=strtolower(end($ex));
			
		if(!empty($namef))
		{
			if(in_array($mytype,$mytypes))
			{
				if($sizef <=2000000)
				{
					$image_name=md5($namef.date("Ymdhis",time())).".".$mytype;
					move_uploaded_file($tmp_namef,"../upload/$image_name");
					
				}	
				else
				{
				  $error['img']="<span class='error-message'> حجم الملف اكبر من اللازم -_-  </span>";
				}
			}
			else
			{
				  $error['img']="<span class='error-message'> يجب ان يكون نوع الملف صورة -_-  </span>";
			}
			
		}
				/* else
				{
					$error['img']="<span class='error-message'> يجب اختيار صورة -_-  </span>";
				} */
					
			# send to data base
			//var_dump($error);
			if(empty($error))
		   {
			  
				try{
					
							if($role==4)
							{
								echo"<div style='background-color: #FFC107;
									text-align: center;
									height: 4%;
									width:100%;
									padding: 1%;'>". $h->users($fname,$lname,$email,$image_name,$pass,$role,1,$addDate,$phone)."</div>";
									//notification
							}
							else
							{
								echo"<div style='background-color: #FFC107;
									text-align: center;
									height: 4%;
									width:100%;
									padding: 1%;'>". $h->users($fname,$lname,$email,$image_name,$pass,$role,0,$addDate,$phone)."</div>";
									
							}
							echo "<meta http-equiv='refresh' content='0;url=\"../site/login.php\"'/>";
				}
				catch(PDOException $e)
					{
					$done= $sql . "<br>" . $e->getMessage();
					}
					
					
				/*   */
					
						
		   }
	   
	}

if(isset($_GET['action'],$_GET['id']) and intval($_GET['id'])!=0 ){
	$id=intval($_GET['id']);
	
	
	switch($_GET['action'])
	{
		case "active":
				$h->activation( "users",$id) ;
				echo "<meta http-equiv='refresh' content='0;url=\"users.php?role=$role&name=$title\"'/>";
				break;
		case "unactive":
				$h->no_activation( "users",$id);
				echo "<meta http-equiv='refresh' content='0;url=\"users.php?role=$role&name=$title\"'/>";
				break;
		case "delete":
				$h->delete_( "users",$id) ;
				echo "<span class='message'> <span class='num'>$id</span> </span>";  
				echo "<meta http-equiv='refresh' content='0;url=\"users.php?role=$role&name=$title\"'/>";
				break;
		 case "edit":
				$sql="Select * from users where  id=:id";
				$q=$con->prepare($sql);
				$q->execute(array("id"=>$id));
				$rows=$q->fetchall();
				if($q->rowcount()>0)
				{
					foreach($rows as $row)
					{
						$id=$row['id'];
						//$name=$row['username'];
						$fname=$row['first_name'];
						$lname=$row['last_name'];
						$email=$row['email'];
						$profile=$row['image_name'];
						$password=$row['password'];
						$phone=$row['phone'];
						$addDate=$row['add_date'];
						$role=$row['role'];
						$user=$row['role'];
						//var_dump($_POST);
						
					}	
						
					if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['send']) )
					{
						//var_dump($_POST);
						$id=$_POST['id'];
						$fname=$_POST['fname'];
						$lname=$_POST['lname'];
						$pass=$_POST['pass'];
						$pass1=$_POST['pass1'];
						$phone=$_POST['phone'];
						$role= intval($_POST['role']);
						//var_dump($role);
						$activation= 1;
						$email=filter_var( $_POST['email'],FILTER_SANITIZE_EMAIL);
						$newname=$profile;
						if(!empty($role) and $user==3 and $role==2)
						{
							$send_notification=true;
							$activation= 0;
							//var_dump($_POST);
							//var_dump("fffr");
						}
						if(!empty($role) and $user==2 and $role==3)
						{
							//var_dump("fffr");
							//$send_notification=true;
							//$activation= 0;
							//var_dump($_POST);
							$sql="Select orders.id from orders join products  where products.users_id=:id and products.id =orders.products_id and (role=1 or role=2) ";
							$q=$con->prepare($sql);
							$q->execute(array("id"=>$id));
							$rows=$q->fetchall();
							//var_dump($rows);
							if($q->rowcount()>0)
							{
								$send_notification=true;
								$activation= 1;
								$orders="يوجد لديه طلبات";
								$ord=true;
							}
							else{
								$orders="لا يوجد لديه طلبات";
							}
						
						}
						if(empty($fname))
						{
							$error['fname']=error_message("الاسم الاول");
						}
						
						else if(!preg_match('/^[a-zA-Zأ-ي\s]*$/u',$fname))
						{
							$error['fname']="<span class='error-message'> يجب ان يكون احرف فقط</span>";
						}
						if(empty($lname))
						{
							$error['lname']=error_message("اللقب");
						}
						
						else if(!preg_match('/^[a-zA-Zأ-ي\s]*$/u',$lname))
						{
							$error['name']="<span class='error-message'> يجب ان يكون احرف فقط</span>";
						}
						if(empty($phone))
						{
							$error['phone']=error_message("رقم الهاتف");
						}
						else if(!preg_match('~^[71/73/77/70]{2}[0-9]{7}$~D',$phone))
							{
								$error['phone']="<span class='error-message'>يجب ادخال صيغة صحيحة تبدأ ب 71 او 73 او  77 ومكون من 9 ارقام </span>";
							}
						
						if(empty($email))
						{
							$error['email']=error_message("الايميل");
						}
						
						else if (!(filter_var( $email,FILTER_VALIDATE_EMAIL)))
						{
							$error['email']="<span class='error-message'> ادخل الايميل بالطريقة الصحيحة -_-  </span>";
							
						}
						
						if(!empty($pass))
						{
							if(!empty($pass1))
							{
								$pass=password_hash($_POST['pass'],PASSWORD_DEFAULT);
								if(!password_verify($pass1,$pass) )
									$error['pass_error']="<span class='error-message'> كلمة المرور غير متطابقة </span>";									
								else
									{
										$password=$pass;
									}
										
							}
							else
							{
								$error['pass1']=error_message("تأكيد كلمة المرور");
							}
							
						}
						if(isset($_FILES['img']['name']))			
							{
								//var_dump($_FILES);
								$namefi=$_FILES['img']['name'];
								$sizefi=$_FILES['img']['size'];
								$typefi=$_FILES['img']['type'];
								$tmp_namefi=$_FILES['img']['tmp_name'];
								$errorfi=$_FILES['img']['error'];
								
									$mytypes=array("jpg","png","gif","jpeg");
									$ex=explode(".",$namefi);
									$mytype=strtolower(end($ex));
									
								if(!empty($namefi))
								{
									if(in_array($mytype,$mytypes))
									{
										if(isset($profile)and $profile!='profile')
											{
												$newname=$profile;
											}
										
										else $newname=md5($namefi.date("Ymdhis",time())).".".$mytype;//md5($namefi.date("Ymdhis",time())).".".$mytype;
											
											$dir="../upload/$newname";
											//$img="upload/$newname";
											move_uploaded_file($tmp_namefi,$dir);
											
										
									}
									else
									{
										  $error['f_type']="<br><span class='error'> يجب ان يكون نوع الملف صورة -_-  </span>";
									}
							
								}
							}
							else $newname=$profile;
							
						//var_dump($error);
						if(empty($error))
						   {
							   //var_dump($_POST);
							   
								    try{
								  // var_dump($activation);
								  $edit=$h->users($fname,$lname,$email,$newname ,$password,$role,$activation,$addDate,$phone,$id);
								   if($edit)
								   {
									    $done="تم تعديل معلومات الحساب";
										unset($_SESSION['profile']);
										unset($_SESSION['role']);
										$_SESSION['profile']=$newname ;
										$_SESSION['role']=$role ;
										//echo "<meta http-equiv='refresh' content='0;url=\"../site/index.php\"'/>";
										if(isset($ord)and $ord){
											 echo '<script>alert("سيتم تحويلك الى مشتري ولكن يجب عليك اكمال طلباتك السابقة")</script>';
											echo "<meta http-equiv='refresh' content='0;url=\"../site/index.php\"'/>";
											}
										else
										{
											echo '<script>alert("تم تعديل معلومات حسابك وسيتم نقلك للصفحة الرئيسية ")</script>';
											echo "<meta http-equiv='refresh' content='0;url=\"../site/index.php\"'/>";
										}
									}
								   else
								   {
									   $done="<span> لم يتم تعديل معلومات الحساب </span>";
								   }
								   echo "<div style='background-color: #FFC107;
									text-align: center;
									height: 4%;
									padding: 1%;'>$done</div>";
									//var_dump($edit);
									//var_dump($send_notification);
									if($edit and isset($send_notification))
								   {
									   if($activation==0)
									   {
										   //$role=$row['role'];
											$sqln="Select id from users where role=1";
											$qn=$con->prepare($sqln);
											$qn->execute(array("id"=>$id));
											$rowsn=$qn->fetchall();
											if($qn->rowcount()>0)
											{
												foreach($rowsn as $rown)
												{
													$admin_id=$rown['id'];
													$user_name=$fname." ".$lname;
													$content="  $user_name   قام بتحويل حسابه الى مشتري يرجى التأكيد ";
													$url="../cp/users.php?role=$role&name=البائعين";
													$h->notification($admin_id ,$url,$content,0);
												}
											}
									   }
									   else if ($activation==1)
									   {
										    //$role=$row['role'];
											$sqln="Select id from users where role=1";
											$qn=$con->prepare($sqln);
											$qn->execute(array("id"=>$id));
											$rowsn=$qn->fetchall();
											if($qn->rowcount()>0)
											{
												foreach($rowsn as $rown)
												{
													$admin_id=$rown['id'];
													$user_name=$fname." ".$lname;
													$content="  $user_name   يريد تحويل حسابه الى بائع و $orders";
													$url="../cp/users.php?role=$role&name=البائعين";
													$h->notification($admin_id ,$url,$content,0);
												}
											}
									   }
									   
								   }
								    //
								} 
								catch(PDOException $e)
								{
									$done= $sql . "<br>" . $e->getMessage();
								}
									
									
								/*   */
									
										
							}
						
						}
				}	
				break;
				default:echo "Error";break;
	}
								
}
														?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>

	 
    <link rel="icon" type="image/png" href="img/logo.png">

	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content="Validify Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements"
	/>
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- Meta tag Keywords -->
	<!-- css files -->
	<link rel="stylesheet" href="../css/logstyle/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="../css/reg.css" type="text/css" media="all" />
	<!-- Style-CSS -->
	<link rel="stylesheet" href="css/fontawesome-all.css">
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //css files -->
	<!-- web-fonts -->
	<link href="//fonts.googleapis.com/css?family=Nova+Round" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	<!-- //web-fonts -->
</head>

<
	<!---->
	<div class="sub-main-w3">
	
		<form id="demo" novalidate action=' ' method='post' enctype='multipart/form-data'>
		
		<input type="text" class="form-control" name="id" hidden  value="<?php if(isset($id)) echo $id;?>">
			<div class="author">
					<a href="#">
						
						<div>
								<label class="form-check-label">
								<input type="file" class="form-check-input" name="img" hidden > <img style="width:15%;margin-right: 42.25%;" class="avatar border-gray " src="../upload/<?php if(isset($profile)) echo $profile; else echo 'profile.jpg'?>">  <!--alt="..."-->
						
								</label><br>
								<?php if (isset($error['img']))echo ($error['img']);?>
						</div>
						
					</a>
					<p class="description">
						<?php // if(isset($name)) echo $name?>
					</p>
					
						<div class="form-group">
							
							
							
							
						</div>
				</div>
			
			                                                                                                                 <!--$done-->
			<?php if (isset($done))echo $done;?>
			
			<div class="form-group">
				<input type="text" class="form-control "  placeholder="الاسم الاول" required="" name='fname' value="<?php if(isset($fname)) echo $fname; ?>">
				<?php if (isset($error['fname']))echo ($error['fname']);?>
				</div>
			<div class="form-group">
				<input type="text" class="form-control textbox"  placeholder="اللقب" required="" name='lname' value="<?php if(isset($lname)) echo $lname;?>">
				<?php if (isset($error['lname']))echo ($error['lname']);?>
			</div>
				<div class="form-group">
				<input type="text" class="form-control textbox"  placeholder="رقم الهاتف" required="" name='phone' value="<?php if(isset($phone)) echo $phone;?>">
				<?php if (isset($error['phone']))echo ($error['phone']);?>
			</div>
				<div class="form-group">
				<input type="email" class="form-control textbox"  placeholder="البريد الالكتروني" required="" name='email' value="<?php if(isset($email)) echo $email;?>">
					<?php if (isset($error['email']))echo ($error['email']);?>
			</div>
				<div class="form-group">
				<input type="password" class="form-control textbox"   required="" name='pass' placeholder="كلمة السر" value="<?php ?>">
			<?php if (isset($error['pass']))echo ($error['pass']);?>
													
			</div>
				<div class="form-group">
				<input type="password" class="form-control textbox"  name='pass1' placeholder="تأكيد كلمة السر" value="<?php ?>" required="">
				
				<?php if (isset($error['pass1']))echo ($error['pass1']);
														if (isset($error['pass_error']))echo ($error['pass_error']);?>
														
			</div>
			
			<div class="form-group">
												<label></label>
												<input type="text" class="form-control" name='addDate' hidden  value="<?php if(isset($addDate))echo $addDate; else echo date("yy-m-d");?>" disabled >
													
											</div>
<!--<h2>لانشاء حساب اختار:</h2>-->
		
			<div class="continput">

	<ul class="uul">
		<li class="lli">
			<input checked type="radio" value='1'  name="role" <?php if(isset($role) and ($role==1)) echo "checked";?>>
			<label class="llable">مدير</label>
			<div class="bullet">
				<div class="line zero"></div>
			</div>
		</li>
		<li  class="lli">
			<input type="radio" value='2' name="role" <?php if(isset($role) and ($role==2)) echo "checked"; if(!isset($role))echo "checked" ?>>
			<label class="llable">مشرف </label>
			<div class="bullet">
				<div class="line zero"></div>
			</div>
		</li>
		<li  class="lli">
			<input type="radio" value='3' name="role" <?php if(isset($role) and ($role==3)) echo "checked"; if(!isset($role))echo "checked" ?>>
			<label class="llable">محرر </label>
			<div class="bullet">
				<div class="line zero"></div>
			</div>
		</li>
		<li  class="lli">
			<input type="radio" value='3' name="role" <?php if(isset($role) and ($role==4)) echo "checked"; if(!isset($role))echo "checked" ?>>
			<label class="llable">مستخدم </label>
			<div class="bullet">
				<div class="line zero"></div>
			</div>
		</li>
		
		
	</ul>
</div>

	<div class="form-group-2">
				
					<button class="btn btn-default btn-osx btn-lg"  type="submit" name="send">
					<span><?php if(isset($id)) echo "حفظ التعديل"; else echo "إنشاء ";?></span>
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
	<script>
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
	</script>
	<!-- //validify plugin -->

</body>

</html>