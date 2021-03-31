
<?php
include_once('design/sidebar.php');

//لما ينتقل من صفحة المستخدم يختار مستخدم ولما ادمن يختار ادمن ...
if(isset($_GET['role']) and intval($_GET['role'])!=0)
{
	//var_dump($_GET);
	$role=intval($_GET['role']);
	if($role==1)$title="الادمن";
	if($role==2)$title="المستخدمين";
	if($role==3)$title="البائعين";
	
}
/* if(isset($_GET['role']) and intval($_GET['role'])!=0)
{
	var_dump($_GET);
	$role=intval($_GET['role']);
	$title=$_GET['name'];
} */

if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST["send"]) and empty($_GET['id']))
	{ 
	    
		$email=filter_var( $_POST['email'],FILTER_SANITIZE_EMAIL);
		$pass=$_POST['pass'];
		$pass1=$_POST['pass1'];
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$phone=$_POST['phone'];
		$role= intval($_POST['role']);
		$activation=intval($_POST['activation']);
		$addDate=date("yy-m-d");//$_POST['addDate'];
		$newname='profile';
		
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
			{
				$error['pass_error']="<span class='error-message'> كلمة المرور غير متطابقة </span>";
			}
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
					$newname=md5($namef.date("Ymdhis",time())).".".$mytype;
					move_uploaded_file($tmp_namef,"../upload/$newname");
					
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
		
					
		# send to data base
		
		if(empty($error))
	   {
		   try
			{
				//var_dump($_POST);
				//var_dump($_FILES);
				//echo $newname;
			   $done=$h->users($fname,$lname,$email,$newname ,$pass,$role,$activation,$addDate,$phone);
			} 
			catch(PDOException $e)
			{
				$done= $sql . "<br>" . $e->getMessage();
			}
			
		 }
	   
	}

if(isset($_GET['action'],$_GET['id']) and intval($_GET['id'])!=0 ){
	$id=intval($_GET['id']);
	
	
	switch($_GET['action'])
	{
		case "active":
				$h->activation( "users",$id) ;
				//notifications
				$sql="Select * from users where id=:id";
				$q=$con->prepare($sql);
				$q->execute(array("id"=>$id));
				$rows=$q->fetchall();
				if($q->rowcount()>0)
				{
					foreach($rows as $row)
					{
						$userID=$row['id'];
						$content="تم تنشيط حسابك يمكنك عرض منتجاتك واستقبال الطلبات ...الخ ";
						$url='../saller_cp/cp_adding.php';
						$h->notification($userID ,$url,"$content",0);
						
					}
				}
				echo "<meta http-equiv='refresh' content='0;url=\"users.php?role=$role&name=$title\"'/>";
				break;
		case "unactive":
				$h->no_activation( "users",$id);
				echo "<meta http-equiv='refresh' content='0;url=\"users.php?role=$role&name=$title\"'/>";
				break;
		case "delete":
				$h->delete_("users",$id) ;
				//echo "<span class='message'> <span class='num'>$id</span> </span>";  
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
						//var_dump($_POST);
						
					}	
						
					if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['send']) )
					{
						$id=$_POST['id'];
						$fname=$_POST['fname'];
						$lname=$_POST['lname'];
						$pass=$_POST['pass'];
						$pass1=$_POST['pass1'];
						$phone=$_POST['phone'];
						$role= intval($_POST['role']);
						$activation= intval($_POST['activation']);
						$email=filter_var( $_POST['email'],FILTER_SANITIZE_EMAIL);
						$newname=$profile;
						
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
								   
								    $done=$h->users($fname,$lname,$email,$newname ,$pass,$role,$activation,$addDate,$phone,$id);
									
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
										
															
            <div class="main-panel">
            <?php
				include_once('design/navbar.php');
		    ?>
            <div class="panel-header-sm">
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="title"></h5>
                            </div>
                            <div class="card-body">
															
									<form action=' ' method='post' enctype='multipart/form-data'>
										<div class="row">
										
										<div class="col-md-8" >
										<?php if (isset($done))echo "<div class='return_message'>". $done ."</div>";?>
										<br></div>
										<div class="col-md-5">
										
											<div class="form-group">
                                                <label>الشركة (معطل)</label>
                                                <input type="text" class="form-control" disabled="" placeholder="الشركة" value="s4 compuny">
                                            </div>
											
										</div><br>
										
										<div class="col-md-4">
											<div class="form-group">
												<label for="exampleInputEmail1">البريد الإلكتروني</label>
												<input type="email" class="form-control" placeholder="البريد الإلكتروني" name='email' value="<?php if(isset($email)) echo $email;?>">
													<?php if (isset($error['email']))echo ($error['email']);?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>الإسم الأول</label>
												<input type="text" class="form-control" placeholder="الإسم الأول"  name='fname' value="<?php if(isset($fname)) echo $fname; ?>">
													<?php if (isset($error['fname']))echo ($error['fname']);?>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>الإسم الأخير</label>
												<input type="text" class="form-control" placeholder="الإسم الأخير" name='lname' value="<?php if(isset($lname)) echo $lname;?>">
													<?php if (isset($error['lname']))echo ($error['lname']);?>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>الهاتف</label>
												<input type="text" class="form-control" placeholder="الإسم الأخير" name='phone' value="<?php if(isset($phone)) echo $phone;?>">
													<?php if (isset($error['phone']))echo ($error['phone']);?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>كلمة السر</label>
												<input type="password" class="form-control" name='pass' placeholder="كلمة السر" value="<?php ?>">
													<?php if (isset($error['pass']))echo ($error['pass']);?>
													
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>تأكيد  كلمة السر</label>
												<input type="password" class="form-control" name='pass1' placeholder="تأكيد كلمة السر" value="<?php ?>">
													<?php if (isset($error['pass1']))echo ($error['pass1']);
														if (isset($error['pass_error']))echo ($error['pass_error']);?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>تاريخ الاضافة</label>
												<input type="text" class="form-control" name='addDate' value="<?php if(isset($addDate))echo $addDate; else echo date("yy-m-d");?>" disabled>
													
											</div>
										</div>
										<script>
										function changecolor(){
											var labeltext=document.getElementById('1');
											labeltext.style.color="red";
										}
										</script>
										<div class="col-md-3">
										 
											<div class="form-check" >
												  <label class="form-check-label">
													<input type="radio" class="form-check-input" name="role" value='1' <?php if(isset($role) and ($role==1)) echo "checked";  ?> >مدير
												  </label>
												</div>
												<div class="form-check">
												  <label class="form-check-label">
													<input type="radio" class="form-check-input" name="role" value='2' <?php if(isset($role) and ($role==2)) echo "checked";?> >مشرف
												  </label>
												</div>
												<div class="form-check ">
												  <label class="form-check-label">
													<input type="radio" class="form-check-input" name="role" value='3' <?php if(isset($role) and ($role==3)) echo "checked";?> >محرر
												  </label>
												</div>
												<div class="form-check ">
												  <label class="form-check-label">
													<input type="radio" class="form-check-input" name="role" value='4' <?php if(isset($role) and ($role==4)) echo "checked";?> >مستخدم عادي
												  </label>
												</div>
												
												
										</div>
										<div class="col-md-3">
										 
											<div class="form-check" >
												  <label class="form-check-label">
													<input type="radio" class="form-check-input" name="activation" value='0' <?php if(isset($activation) and ($activation==0)) echo "checked";  if(!isset($activation)) echo "checked"; ?> >غير نشط
												  </label>
												</div>
												<div class="form-check">
												  <label class="form-check-label">
													<input type="radio" class="form-check-input" name="activation" value='1' <?php if(isset($activation) and ($activation==1)) echo "checked";?> >نشط
												  </label>
												</div>
												
												  
										</div>
												
												
												
										</div>
										
									</div>
															
                            </div>
                        </div>
						<br><br><br><br><br><br><br><br>
						
                    <div class="col-md-4">
                        <div class="card card-user">
                            
                            <div class="card-body">
                                <div class="author">
                                    <a href="#">
										
                                        <img class="avatar border-gray" src="../upload/<?php if(isset($profile)) echo $profile; else echo 'profile.jpg'?>" alt="...">
										<div class="form-check ">
											  <label class="form-check-label">
												<input type="file" class="form-check-input" name="img" value="if(isset($image)) echo $image;" hidden ><?php if(isset($image)) echo $image;?> تغيير البروفايل </input>
												</label><br>
												<?php if (isset($error['img']))echo ($error['img']);?>
										</div>
										
                                        <h5 class="title"><?php  if(isset($fname)) echo $fname.' '.$lname?></h5>
                                    </a>
                                    <p class="description">
                                       <?php // if(isset($name)) echo $name?>
                                    </p>
									<div class="col-md-3">
										<div class="form-group">
											
												<input type="text" class="form-control" name="id" hidden  value="<?php if(isset($id)) echo $id;?>">
											
											
											
										</div>
									</div>
                                </div>
								
								<input type="submit"  value="ارسال" name="send" class="btn-info btn" />
                                
                            </div>
                            <hr>
                            
                        </div>
                    </div>
					</div>
                </div>
            </div></form>
                       <?php
include_once('design/footer.php');
?>

