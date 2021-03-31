
<?php include_once("../design/header.php"); 
//ini_set('display_errors', '0');
	if((!isset($_SESSION['id']) and !isset($_SESSION['role'])) or $_SESSION['role']!=2)
	{
		header("location:../site/index.php");
		exit();
	}
	else
	{
		$users_id=$_SESSION['id'];
		$_SESSION['activation']=1;
	}
	
if(isset($_GET['nid']) and isset($_GET['action']) )
{
	$idn=$_GET['nid'];
	if($_GET['action']=='seen')
	{
		//var_dump($id);
		$sql="update notifications set seen =1 where id =:id";
		$q=$con->prepare($sql);
		$q->execute(array("id"=>$idn));
		echo "<meta http-equiv='refresh' content='0;url=\"../saller_cp/cp_adding.php\"'/>";
	}
}
//var_dump($users_id);
?>
				
	
  <link rel="stylesheet" href="../css/product1.css">
  <link rel="stylesheet" href="../css/cp_add.css">
  <style>
									.multicast{
										width:200px;
									}
									.selectbox{
										position:relative;
									}
									.selectbox select{
										width:100%;
										font-weight:bold;
									}
									.overselect{
										position:absolute;
										left:0;right:0;top:0;bottom:0;
									}
									#checkboxes{
										display:none;
										    border: 1px #febd69 solid;
                                            width: inherit;
											
    background-color: white;
									}
										#checkboxes label{
											display:block;
										}
										#checkboxes label:hover{
											background-color:#febd69;
										}
									</style>
  <!--multi-->
 
			<!--try-->
	
								
					
					
				
<?php
/* var_dump($_POST);
var_dump($_FILES);
var_dump($id);
/* var_dump($_GET);
var_dump($_SESSION);
 ]
//
var_dump($_GET); */
if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST["add"]) and empty($_POST['id']) and empty($_GET['id']) )//
{
	//var_dump($_POST);
	//var_dump($_POST['prop']);
	//var_dump($_FILES);
	$name=$_POST['name'];//password_hash($_POST['pass'],PASSWORD_DEFAULT);
	$price=$_POST['price'];
	$cat_id=$_POST['cat_id'];
	$period=$_POST['period'];
	$description=$_POST['description'];
	$addDate=date("yy-m-d");//$_POST['addDate'];
	$newname[0]='no';
	$newname[1]='no';
	$newname[2]='no';
	$newname[3]='no';
	
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
	else if(!intval($price))
		{
			$error['price']="<span class='error-message'> الرجاء ادخال ارقام فقط</span>";
		}
	else if($price<50)
		{
			$error['price']="<span class='error-message'> الرجاء ادخال قيمة اكبر من او تساوي 50  </span>";
		}
	if(empty($period))
		{
			$error['period']=error_message("الفترة");
		}
	else if(!intval($period))
		{
			$error['period']="<span class='error-message'> الرجاء ادخال ارقام فقط</span>";
		}
	else if($period<1)
		{
			$error['period']="<span class='error-message'> الرجاء ادخال قيمة اكبر من او تساوي 1</span>";
		}
	if(empty($description))
		{
			$error['description']=error_message("وصف المنتج ");
			
		}
		
		
	else if(!preg_match('/^[a-zA-Zأ-يء\s]*$/u',$description))
		{
			$error['description']="<span class='error-message'> يجب ان يكون احرف فقط</span>";
		}
	
	for($i=0;$i<=3;$i++)
	{
		$namef=$_FILES["img$i"]['name'];
		$sizef=$_FILES["img$i"]['size'];
		$typef=$_FILES["img$i"]['type'];
		$tmp_namef=$_FILES["img$i"]['tmp_name'];
		$errorf=$_FILES["img$i"]['error'];
		
		//echo $namef;
		$mytypes=array("jpg","png","gif","jpeg","jfif");
		$ex=explode(".",$namef);
		$mytype=strtolower(end($ex));
		
		if(!empty($namef))
		{
			if(in_array($mytype,$mytypes))
			{
				if($sizef <=2000000)
				{
					$newname[$i] = md5($namef.date("Ymdhis",time())).".".$mytype;
					$na=$newname[$i];
				move_uploaded_file($tmp_namef,"../upload/$na");
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
	if(!empty($_POST["prop"]))
		{
			$checkedProp=[];
			foreach($_POST["prop"] as $pro_id)
			{
				$checkedProp[]=$pro_id;
			}
//var_dump($checkedProp);			
		}//var_dump($error);
	if(empty($error))
	{
		try
		{
			//var_dump($newname);
			
			  echo  "<div style='background-color: #FFC107;
					text-align: center;
					height: 4%;
					padding: 1%;'>".$h->products($users_id,$cat_id,$name,$description,"0",$price,date("Y-m-d"),$period,$newname[0],$newname[1],$newname[2],$newname[3])."</div>";
			 if(!empty($_POST["prop"]))
			{
				$checkedProp=[];
				foreach($_POST["prop"] as $pro_id)
				{
					$checkedProp[]=$pro_id;
					$h->used_properties( $pro_id,0,$_SESSION['id']);
					//var_dump($h->used_properties( $pro_id,0,$_SESSION['id']));
					//echo "used_properties(".$pro_id.",0,".$_SESSION['id'].")";
				} 
			}
			
					
		}
		catch(PDOException $e)
		{
			$done= $sql . "<br>" . $e->getMessage();
		} 
	}
	
	
}
 
if(isset($_GET['action'],$_GET['id']) and intval($_GET['id'])!=0)
{
	$products_id=intval($_GET['id']);
	//var_dump();
	switch($_GET['action'])
	{
		case "delete":
			
			$sql="Select orders.id from orders join products  where products.users_id=:id and products.id =orders.products_id and (role=1 or role=2) ";
			$q=$con->prepare($sql);
			$q->execute(array("id"=>$users_id));
			$rows=$q->fetchall();
			if($q->rowcount()>0)
			{
				 echo '<script>alert("سيتم الغاء تنشيط المنتج ويجب عليك اكمال طلباتك السابقة")</script>';
											
				$h->no_activation("products",$products_id);
			}
			else
			{
				$sql="select * from images where products_id=:id";
				$q=$con->prepare($sql);
				$q->execute(array("id"=>$products_id));
				$rows=$q->fetchall();
				if( $h->delete_("products",$products_id))
				{
					if($q->rowcount()>0)
					{
						foreach($rows as $row)
						{
							$img=$row['image_name'];
							unlink("../upload/$img");
						}
					}
				}
			}
			//unlink("");
			//echo "delete_('products',$products_id)";
			echo "<meta http-equiv='refresh' content='0;url=\"cp_products.php\"'/>";
			break;
		case "edit":
		{
			$sql="select products.id,name,price,period,categories_id,description,add_date
					from products 
					where products.id= :id
					group by products.id";
			$q=$con->prepare($sql);
			$q->execute(array("id"=>$products_id));
			$rows=$q->fetchall();
			if($q->rowcount()>0)
			{
				$images_id=[0,0,0,0];
				foreach($rows as $row)
				{
					$name=$row['name'];
					$description=$row['description'];
					$price=$row['price'];
					$addDate=$row['add_date'];
					$period=$row['period'];
					$cat_id=$row['categories_id'];
					$images=['no','no','no','no'];
					$c=0;
					$sql="Select id,image_name from images where products_id=:id ";
					$a=$con->prepare($sql);
					$a->execute(array("id"=>$products_id));
					$values=$a->fetchall();
					if($a->rowcount()>0)
						{
							foreach($values as $value){
							//echo $row['image_name'];
							$images_id[$c]=$value['id'];
							$update_images[$value['id']]=$value['image_name'];//enter to datebase
							$image_name[$c]=$value['image_name'];//shwo in form
							$images[$c]=$value['image_name'];
							$c++;
						}
					}
					//var_dump($images);
				}
				if($_SERVER['REQUEST_METHOD']=='POST' &&   isset($_POST['add']))
				{
					//$name=$_POST['name'];
					//$price=$_POST['price'];
					$cat_id=$_POST['cat_id'];
					$period=$_POST['period'];
					$description=$_POST['description'];
					$addDate=date("yy-m-d");//$_POST['addDate'];
					/* $newname[0]='no';
					$newname[1]='no';
					$newname[2]='no';
					$newname[3]='no'; */
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
					else if(!intval($price))
						{
							$error['price']="<span class='error-message'> الرجاء ادخال ارقام فقط</span>";
						}
					else if($price<50)
						{
							$error['price']="<span class='error-message'> الرجاء ادخال قيمة اكبر من او تساوي 50  </span>";
						}
					if(empty($period))
						{
							$error['period']=error_message("الفترة");
						}
					else if(!intval($period))
						{
							$error['period']="<span class='error-message'> الرجاء ادخال ارقام فقط</span>";
						}
					else if($period<1)
						{
							$error['period']="<span class='error-message'> الرجاء ادخال قيمة اكبر من او تساوي 1</span>";
						}
					if(empty($description))
						{
							$error['description']=error_message("وصف المنتج ");
							
						}
						
					else if(!preg_match('/^[a-zA-Zأ-ي\s]*$/u',$description))
						{
							$error['description']="<span class='error-message'> يجب ان يكون احرف فقط</span>";
						}
				
					for($i=0;$i<=3;$i++)
					{
						//var_dump($images);
						$namef=$_FILES["img$i"]['name'];
						$sizef=$_FILES["img$i"]['size'];
						$typef=$_FILES["img$i"]['type'];
						$tmp_namef=$_FILES["img$i"]['tmp_name'];
						$errorf=$_FILES["img$i"]['error'];
						
						
						//echo $namef;
						$mytypes=array("jpg","png","gif","jpeg","jfif");
						$ex=explode(".",$namef);
						$mytype=strtolower(end($ex));
						
						if(!empty($namef))
						{
							if(in_array($mytype,$mytypes))
							{
								if($sizef <=2000000)
								{
									if($images[$i]!='no')
										{
											//$images[$i]=$namef;
										}
										
									else
									$images[$i] = md5($namef.date("Ymdhis",time())).".".$mytype;
									move_uploaded_file($tmp_namef,"../upload/$images[$i]");
									
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
					 // return properties of products
					 $oldProperties=$h->getPropertiesOfProduct($products_id);
					//var_dump($error);
						//var_dump($images);
						//var_dump($images_id);
					if(empty($error))
					{
						try
						{
							
							if(!empty($_POST["prop"]) or !empty($oldProperties))
								{
									//$newProperties=[];
									//var_dump($oldProperties);
									//var_dump($_POST["prop"]);
									
									foreach($_POST["prop"] as $pro_id)
									{
										//$newProperties[]=$pro_id;
										if(in_array($pro_id,$oldProperties))
										{
											foreach($oldProperties as $k=>$p)
											{
												//var_dump($p[$k]);
												if($p==$pro_id)
												{
													unset($oldProperties[$k]);
												}
												
											}
											
										}
										else
										{
											var_dump($h->used_properties( $pro_id,0,$_SESSION['id']));
											//echo "( $pro_id,0,".$_SESSION['id']."))";
										}
									}
									if(empty($_POST["prop"]))
									{
										
									}										//var_dump($oldProperties);
									if(!empty($oldProperties))
									{
										foreach($oldProperties as $k=>$p)
										{
											$h->delete_('used_properties',$p,$products_id);
										}
									}
								}
							else if(empty($_POST["prop"]) or !empty($_oldProperties))
							{
								foreach($oldProperties as $k=>$p)
								{
									$h->delete_('used_properties',$p,$products_id);
								}
							}
							if($h->products($users_id,$cat_id,$name,$description,'1',$price,date("Y-m-d"),$period,$images[0],$images[1],$images[2],$images[3],$products_id,$images_id[0],$images_id[1],$images_id[2],$images_id[3]))
							{
								
								 echo  "<div style='background-color: #FFC107;
									text-align: center;
									height: 4%;
									padding: 1%;'>تم تعديل المنتج</div>";
							}
							
							//var_dump($_POST);
							/*  echo  "<div style='background-color: #FFC107;
									text-align: center;
									height: 4%;
									padding: 1%;'>".."</div>"; */
								 	//$h->products($users_id,$cat_id,$name,$description,"0",$price,date("Y-m-d"),$period,$newname[1],$newname[2],$newname[3],$newname[4])
									//echo"products($users_id,$cat_id,$name,$description,'0',$price,".date('Y-m-d').",$period,$images[1],$images[0],$images[2],$images[3],$id,$images_id[0],$images_id[1],$images_id[2],$images_id[3])";
						}
						catch(PDOException $e)
						{
							$done= $sql . "<br>" . $e->getMessage();
						}
					}
				}
			}
		}break;
	}
}	

						
?>


  						
					
						<section class="cat_product_area section_gap">
		<div class="container-fluid">
					
						<form action="cp_adding.php<?php if(isset($_GET['id'])) echo "?action=edit&id=".$_GET['id']?>" method="post" class="dirofform" enctype='multipart/form-data'>
						<input type="text" class="form-control" name="id" hidden  value="<?php if(isset($id)) echo $id;?>">
												<h3 class="mb-30"> <!-- لاضافة منتج --> </h3>
							<div class="latest_product_inner row">
							
						<div class="col-lg-8 col-md-8 col-sm-8 mx-auto">
							<div class="mt-10 mmb-10">
										<input type="text" name="name" placeholder="اسم المنتج" placeholder = "اسم المنتج" value="<?php if(isset($name)) echo $name;?>" <?php if(isset($_GET['id'])) echo "disabled";?>  required class="single-input">
									<?php if (isset($error['name']))echo ($error['name']);?>
									</div>
									
									<div class="mt-10 mmb-10">
										<input type="text" name="price"  placeholder = "سعر المنتج" value="<?php if(isset($price)) echo $price;?>" <?php if(isset($_GET['id'])) echo "disabled";?>  required class="single-input">
									<?php if (isset($error['price']))echo ($error['price']);?>
									</div>
									<select class="selecting mrs mt-10 mmb-10" name='cat_id' style="margin-right:2%;">
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
										<input type="text" name="period"  placeholder = " مدة تجهيز المنتج بالايام(ارقام)" value="<?php if(isset($period)) echo $period;?>" required class="single-input">
									<?php if (isset($error['period']))echo ($error['period']);?>
									</div>
									
									<?php
									$properties =$s->getProperties();
									if(isset($_GET['id']))
									{
										$checkedProp=$h->getPropertiesOfProduct($_GET['id']);
										
									}
									
										if(count($properties)>0)
										{
											
											for($index=0;$index<count($properties);$index++)
											{
												
												if(is_array($properties[$index]))
												{
													echo "<div id='checkboxes[$index]' class=' mt-10' style='color: black; padding: 1%;'> ";
													foreach($properties[$index] as $key=>$val)
													
													
														if(!empty($checkedProp)) 
														{//var_dump($checkedProp);
															if( in_array($key,$checkedProp) )
															echo "<label for='$key' style='padding-left: 8px;'><input type='checkbox' id='$key' value='$key' name='prop[]' checked/>$val</label>";
															else
															echo "<label for='$key'  style=' padding-left: 8px;'><input type='checkbox' id='$key' value='$key' name='prop[]'/>$val</label>";
														}
														else
															echo "<label for='$key'  style='padding-left: 8px;'><input type='checkbox' id='$key' value='$key' name='prop[]'/>$val</label>";
														
													
											
													echo "</div>";
													echo "</div>";
													//echo "</form>";
												}
												else
												{
													 echo " <div class='mrs mt-10 mmb-10'><div class='selectbox' onclick='showcheckboxes($index)'>
													
													<select class='selecting mrs mt-10 mmb-10'>
													<option>اختر $properties[$index]  </option>
													<div class='overselect'>  </div>
													</select></div>";
													
												}
											}
										}
									
									
										
									/* echo "
									<select id='multiselectwithsearch' multiple='multiple' name='color[]'>
										<option value='India'>India</option>
										<option value='Australia'>Australia</option>
										<option value='United State'>United State</option>
										<option value='Canada'>Canada</option>
										<option value='Taiwan'>Taiwan</option>
										<option value='Romania'>Romania</option>
									</select>"; */
									
									?>
									
									
									
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
												<input type="file" class="form-check-input" name="img0" hidden > <img style="width:30%;margin-right: 42.25%;" class="avatar border-gray " src="../upload/<?php if(isset($images[0])and$images[0]!='no') echo $images[0];  else if (isset($image_name[0]))echo $image_name[0]; else echo 'front.png'?>"> <?php if(isset($_FILES['img1']['name'])) echo  $_FILES['img1']['name']; else echo '<div style="color:black;text-align:center;padding-right:20px;"><p>اختر صوره</p></div>'?> <!--alt="..."-->
										 </input>
												</label><br>
												<?php if (isset($error['img0']))echo ($error['img0']);?>
										</div>
										
                                        
                                    </a>
									</div>
									
									
									
										<div class="col-lg-6 col-md-6 col-sm-6">
									
											 <a href="#">
												<div>
													  <label class="form-check-label">
														<input type="file" class="form-check-input" name="img1" hidden > <img style="width:30%;margin-right: 42.25%;" class="avatar border-gray " src="../upload/<?php if(isset($images[1])and$images[1]!='no') echo $images[1]; else if (isset($image_name[1]))echo $image_name[1];else echo 'left.png'?>"><?php if(isset($_FILES['img2']['name'])) echo  $_FILES['img2']['name']; else echo '<div style="color:black;text-align:center;padding-right:20px;"><p>اختر صوره</p></div>'?>  <!--alt="..."-->
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
													<input type="file" class="form-check-input" name="img2" hidden > <img style="width:30%;margin-right: 42.25%;" class="avatar border-gray " src="../upload/<?php if(isset($images[2])and $images[2]!='no') echo $images[2]; else if (isset($image_name[2]))echo $image_name[2]; else echo 'back.png'?>"><?php if(isset($_FILES['img3']['name'])) echo $_FILES['img3']['name']; else echo '<div style="color:black;text-align:center;padding-right:20px;"><p>اختر صوره</p></div>'?>  <!--alt="..."-->
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
														<input type="file" class="form-check-input" name="img3" hidden > <img style="width:30%;margin-right: 42.25%;" class="avatar border-gray " src="../upload/<?php if(isset($images[3])and$images[3]!='no') echo $images[3]; else if (isset($image_name[3]))echo $image_name[3]; else echo 'right.png'?>"><?php if(isset($_FILES['img4']['name'])) echo  $_FILES['img4']['name']; else echo '<div style="color:black;text-align:center;padding-right:20px;"><p>اختر صوره</p></div>'?>  <!--alt="..."-->
												 </input>
														</label><br>
														<?php if (isset($error['img3']))echo ($error['img3']);?>
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
	<script>
	var expanded=false;
	function showcheckboxes(i){
		var ch=checkboxes.i.toString();
		var checkboxes= document.getElementById(ch);
		if(!expanded){
			checkboxes.style.display="block";
			expanded=true;
		}else{
			checkboxes.style.display="none";
			expanded=false;
		}
	}
	</script>