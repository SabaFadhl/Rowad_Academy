
<?php include_once("../design/header.php"); 
	if(!isset($_SESSION['id']) and !isset($_SESSION['role']))
	{
		header("location:index.php");
		exit();
	}
	else
	{
		$users_id=$_SESSION['id'];
	}
?>
				
	
  <link rel="stylesheet" href="../css/product1.css">
  <link rel="stylesheet" href="../css/cp_add.css">
			<!--try-->
	
								
					
					
				
<?php    
if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST["add"]))
{
	//var_dump($_POST);
	//var_dump($_FILES);
	$name=$_POST['name'];//password_hash($_POST['pass'],PASSWORD_DEFAULT);
	$price=$_POST['price'];
	$cat_id=$_POST['cat_id'];
	$period=$_POST['period'];
	$description=$_POST['description'];
	$addDate=date("yy-m-d");//$_POST['addDate'];
	$newname[1]='no';
	$newname[2]='no';
	$newname[3]='no';
	$newname[4]='no';
	//var_dump($newname);
	if(empty($name))
		{
			$error['name']=error_message("اسم المنتج ");
		}
		
	else if(!preg_match('/^[a-zA-Zأ-ي\s]*$/u',$name))
		{
			$error['name']="<span class='error-message'> يجب ان يكون احرف فقط</span>";
		}
	if(empty($price))
		{
			$error['price']=error_message("السعر");
		}
	else if(!preg_match('/^[1-40000\s]*$/u',$price))
		{
			$error['price']="<span class='error-message'> الرجاء ادخال ارقام فقط</span>";
		}
	if(empty($period))
		{
			$error['period']=error_message("الفترة");
		}
	else if(!preg_match('/^[1-40000\s]*$/u',$period))
		{
			$error['period']="<span class='error-message'> الرجاء ادخال ارقام فقط</span>";
		}
	if(empty($description))
		{
			$error['description']=error_message("وصف المنتج ");
			
		}
		
	else if(!preg_match('/^[a-zA-Zأ-ي\s]*$/u',$description))
		{
			$error['description']="<span class='error-message'> يجب ان يكون احرف فقط</span>";
		}
	
	for($i=1;$i<=4;$i++)
	{
		$namef=$_FILES["img$i"]['name'];
		$sizef=$_FILES["img$i"]['size'];
		$typef=$_FILES["img$i"]['type'];
		$tmp_namef=$_FILES["img$i"]['tmp_name'];
		$errorf=$_FILES["img$i"]['error'];
		
		echo $namef;
		$mytypes=array("jpg","png","gif","jpeg");
		$ex=explode(".",$namef);
		$mytype=strtolower(end($ex));
		
		if(!empty($namef))
		{
			if(in_array($mytype,$mytypes))
			{
				if($sizef <=2000000)
				{
					$newname[$i] = md5($namef.date("Ymdhis",time())).".".$mytype;
					move_uploaded_file($tmp_namef,"../upload/$newname[$i]");
					
				}	
				else
				{
				  $error["img$i"]="<span class='error-message'> حجم الملف اكبر من اللازم -_-  </span>";
				}
			}
			else
			{
				  $error["img$i"]="<span class='error-message'> يجب ان يكون نوع الملف صورة -_-  </span>";
			}
		}
	}
	if(empty($error))
	{
		try
		{
			echo  "<div style='background-color: #FFC107;
					text-align: center;
					height: 4%;
					padding: 1%;'>".$h->products($users_id,$cat_id,$name,$description,"0",$price,date("Y-m-d"),$period,$newname[1],$newname[2],$newname[3],$newname[4])."</div>";
		}
		catch(PDOException $e)
		{
			$done= $sql . "<br>" . $e->getMessage();
		}
	}
	
	
}
						
?>


  						
					
						<section class="cat_product_area section_gap">
		<div class="container-fluid">
					
						<form action="cp_adding.php" method="post" class="dirofform" enctype='multipart/form-data'>
						
												<h3 class="mb-30">  لاضافة منتج  </h3>
							<div class="latest_product_inner row">
							
						<div class="col-lg-8 col-md-8 col-sm-8">
							<div class="mt-10 mmb-10">
										<input type="text" name="name" placeholder="اسم المنتج" placeholder = "اسم المنتج" value="<?php if(isset($name)) echo $name;?>" required class="single-input">
									<?php if (isset($error['name']))echo ($error['name']);?>
									</div>
									
									<div class="mt-10 mmb-10">
										<input type="text" name="price"  placeholder = "سعر المنتج" value="<?php if(isset($price)) echo $price;?>" required class="single-input">
									<?php if (isset($error['price']))echo ($error['price']);?>
									</div>
									<select class="selecting" name='cat_id'>
										<?php
											 if (isset($cat_id))
												echo $h->fill_select(categories,$cat_id);
											 else
												echo $h->fill_select(categories);
										
										
										?>
									</select>
									<div class="form-group">
												<label></label>
												<input type="text" class="form-control" name='addDate' hidden  value="<?php if(isset($addDate))echo $addDate; else echo date("yy-m-d");?>" disabled >
													
											</div>
									
									<div class="mt-10 mmb-10">
										<textarea  class="single-textarea"  name="description" placeholder="وصف المنتج" onfocus="this.placeholder = ''" onblur="this.placeholder = 'وصف المنتج'" value="" required><?php if(isset($description)) echo $description;?></textarea>
									<?php if (isset($error['description']))echo ($error['description']);?>
									</div>
									<div class="mt-10 mmb-10">
										ايام<input type="text" name="period"  placeholder = " فترة تجهيز المنتج بالارقامٍ" value="<?php if(isset($period)) echo $period;?>" required class="single-input">
									<?php if (isset($error['period']))echo ($error['period']);?>
									</div>
						</div>
						
						<div class="col-lg-4 col-md-4 col-sm-4">
						
							

							<h4 class="mb-30">لاضافة صور من جميع الاتجاهات</h4>
								<section class="cat_product_area section_gap">
		<div class="container-fluid">
					
					
							<div class="latest_product_inner row">
							<div class="col-lg-6 col-md-6 col-sm-6">
						 <a href="#">
									

		
                                       <div>
											  <label class="form-check-label">
												<input type="file" class="form-check-input" name="img1" hidden > <img style="width:30%;margin-right: 42.25%;" class="avatar border-gray " src="../upload/<?php if(isset($profile)) echo $profile; else echo 'front.png'?>"> <?php if(isset($_FILES['img1']['name'])) echo  "تم"; else echo '<div style="color:black;text-align:center;padding-right:20px;">اختر صوره</div>'?> <!--alt="..."-->
										 </input>
												</label><br>
												<?php if (isset($error['img1']))echo ($error['img1']);?>
										</div>
										
                                        
                                    </a>
									</div>
									
									
									
										<div class="col-lg-6 col-md-6 col-sm-6">
									
											 <a href="#">
												<div>
													  <label class="form-check-label">
														<input type="file" class="form-check-input" name="img2" hidden > <img style="width:30%;margin-right: 42.25%;" class="avatar border-gray " src="../upload/<?php if(isset($profile)) echo $profile; else echo 'left.png'?>"><?php if(isset($_FILES['img2']['name'])) echo  "تم"; else echo '<div style="color:black;text-align:center;padding-right:20px;">اختر صوره</div>'?>  <!--alt="..."-->
												 </input>
														</label><br>
														<?php if (isset($error['img2']))echo ($error['img2']);?>
												</div>
											</a>
									</div>
									
									
									
									<div class="col-lg-6 col-md-6 col-sm-6">
										 <a href="#">
											
										   <div>
												  <label class="form-check-label">
													<input type="file" class="form-check-input" name="img3" hidden > <img style="width:30%;margin-right: 42.25%;" class="avatar border-gray " src="../upload/<?php if(isset($profile)) echo $profile; else echo 'back.png'?>"><?php if(isset($_FILES['img3']['name'])) echo "تم"; else echo '<div style="color:black;text-align:center;padding-right:20px;">اختر صوره</div>'?>  <!--alt="..."-->
											 </input>
													</label><br>
													<?php if (isset($error['img3']))echo ($error['img3']);?>
											</div>
											
										</a>
									
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6">
											 <a href="#">
												<div>
													  <label class="form-check-label">
														<input type="file" class="form-check-input" name="img4" hidden > <img style="width:30%;margin-right: 42.25%;" class="avatar border-gray " src="../upload/<?php if(isset($profile)) echo $profile; else echo 'right.png'?>"><?php if(isset($_FILES['img4']['name'])) echo  "تم"; else echo '<div style="color:black;text-align:center;padding-right:20px;">اختر صوره</div>'?>  <!--alt="..."-->
												 </input>
														</label><br>
														<?php if (isset($error['img4']))echo ($error['img4']);?>
												</div>
											</a>
									</div>
									
									</div>
									
									</div>
									
									</section>
								
									
									
							
						</div>
						
					
						</div>
									
				<br>
				<br>
				<br>
					<button class="btn btn-default btn-osx btn-lg add"  type="submit" name="add">
				<span> اضافة</span>

				</button>
		
							</form>
				
						</div>
						</section>
						
						
					
					
	
	
 


    <?php include("../design/footer.php");?>