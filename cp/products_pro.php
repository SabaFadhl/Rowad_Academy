
<?php
include_once('design/sidebar.php');

if(isset($_GET['action'],$_GET['id']) and intval($_GET['id'])!=0 )
{
	
	$id=intval($_GET['id']);
	//$name=$_GET['name'];
	
	switch($_GET['action'])
	{
		case "display":

				$sql="select  * from products
						where products.id= :id ";	
				$q=$con->prepare($sql);
				$q->execute(array("id"=>$id));
				$rows=$q->fetchall();
				if($q->rowcount()>0)
				//var_dump($rows);
				$user="";
				foreach($rows as $row)
				{
					$name=$row['name'];
					$add=$row['add_date'];
					$desc=$row['description'];
					$price=$row['price'];
					$activation=$row['activation'];
					//$sell=$row['sale_date'];
					if($row['activation']==0)
					{
						$activation='نشط';
					}
					else
					{
						$activation='غير نشط';
					}
					//$del=$row['date_deliver'];
					//$role=orderType($row['role']);
					//var_dump($activation);
					//var_dump($category);
					$images=[];
					$c=0;
					$sql="Select id,image_name from images where products_id=:id ";
					$a=$con->prepare($sql);
					$a->execute(array("id"=>$id));
					$rows=$a->fetchall();
					if($a->rowcount()>0)
						{
							foreach($rows as $row){
							//echo $row['image_name'];
							$images[$c]=$row['image_name'];
							$c++;
						}
					}
				}
		break;
		default:echo "Error";break;
	}
								
}											?>
														
															
	<link rel="stylesheet" href="assets/css/cardoforders.css" type="text/css" media="all" />
            <div class="main-panel">
            <?php
				include_once('design/navbar.php');
		    ?>
            
            <div class="content">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="title"></h5>
                            </div>
                            <div class="card-body mktop">
															
									<form action=' ' method='post' enctype='multipart/form-data'>
										<div class="col-md-8">
										<?php if (isset($done))echo $done;?>
										<br></div>
										<div class="row">
										<div class="col-md-4">
											
										</div>
									  <div class="col-md-4">
									<div class="form-group">
											<img src="assets/img/logo.png" class="imgwh">
											</div>
											</div>
											<div class="col-md-4">
											
										</div>
											<div class="col-md-4">
										<div class="form-group">
												<label for="exampleInputEmail1" class="coftit">رقم المنتج : <?php if(isset($id)) echo "<span class='cofans'>".$id ."</span>"; else echo '__';?></label>
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1" class="coftit">اسم المنتج : <?php if(isset($name)) echo "<span class='cofans'>".$name."</span>" ; else echo '__';?></label>
											</div>
											
										</div>
										<div class="col-md-4">
											
										</div>
								
									<div class="col-md-4">
									   
											<div class="col-md-10">
											<div class="form-group">
												<label for="exampleInputEmail1" class="coftit pp">حالة المنتج : <?php  if(isset($activation)) echo "<span class='cofans'>".$activation."</span>"; else echo '__'; ?></label>
											</div>
											</div>
										</div>
										
										
									
										<div class="col-md-12" style="border-bottom: 2px dashed #eeeeee;margin:5px;"></div>
										
								
										<div class="col-md-8">
											
											<div class="form-group">
												<label for="exampleInputEmail1" class="coftit">تاريخ الاضافة  : <?php if(isset($add)) echo "<span class='cofans'>".$add."</span>"; else echo '__'; ?></label>
											</div>
											<div class="form-group">
												<p for="exampleInputEmail1" class="coftit">مواصفات المنتج  : <?php if(isset($desc)) echo "<p class='cofans'>".$desc."</p>"; else echo '__'; ?></p>
											</div>
										</div>
										<div class="col-md-12" style="border-bottom: 2px dashed #eeeeee;margin:5px;"></div>
										
										<div class="col-md-4">
											
										</div><div class="col-md-4">
											
										</div><div class="col-md-4">
											
										</div><div class="col-md-3">
											
										</div>
									
										<div class="col-md-12">
											<section class="cat_product_area section_gap">
							<div class="container-fluid">
					
					
							<div class="latest_product_inner row">
							<div class="col-lg-3 col-md-3 col-sm-3">
								<a href="#">
									

		
                                       <div>
											  <label class="form-check-label">
												<img style="width:40%;margin-right: 42.25%;" class="avatar border-gray " src="../upload/<?php if(isset($images[0])and$images[0]!='no') echo $images[0];  else if (isset($image_name[0]))echo $image_name[0]; else echo 'front.png'?>"> <?php if(isset($_FILES['img1']['name'])) echo  $_FILES['img1']['name']; else echo '<div style="color:black;text-align:center;padding-right:20px;"><p>امام</p></div>'?> <!--alt="..."-->
										 </input>
												</label><br>
												
										</div>
										
                                        
                                    </a>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-3">
									
											 <a href="#">
												<div>
													  <label class="form-check-label">
														<img style="width:40%;margin-right: 42.25%;" class="avatar border-gray " src="../upload/<?php if(isset($images[1])and$images[1]!='no') echo $images[1]; else if (isset($image_name[1]))echo $image_name[1];else echo 'left.png'?>"><?php if(isset($_FILES['img2']['name'])) echo  $_FILES['img2']['name']; else echo '<div style="color:black;text-align:center;padding-right:20px;"><p>يسار</p></div>'?>  <!--alt="..."-->
												 </input>
														</label><br>
														
												</div>
											</a>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-3">
										 <a href="#">
											
										   <div>
												  <label class="form-check-label">
													<img style="width:40%;margin-right: 42.25%;" class="avatar border-gray " src="../upload/<?php if(isset($images[2])and $images[2]!='no') echo $images[2]; else if (isset($image_name[2]))echo $image_name[2]; else echo 'back.png'?>"><?php if(isset($_FILES['img3']['name'])) echo $_FILES['img3']['name']; else echo '<div style="color:black;text-align:center;padding-right:20px;"><p>خلف</p></div>'?>  <!--alt="..."-->
											 </input>
													</label><br>
													
											</div>
											
										</a>
									
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3">
											 <a href="#">
												<div>
													  <label class="form-check-label">
													<img style="width:40%;margin-right: 42.25%;" class="avatar border-gray " src="../upload/<?php if(isset($images[3])and$images[3]!='no') echo $images[3]; else if (isset($image_name[3]))echo $image_name[3]; else echo 'right.png'?>"><?php if(isset($_FILES['img4']['name'])) echo  $_FILES['img4']['name']; else echo '<div style="color:black;text-align:center;padding-right:20px;"><p>يمين</p></div>'?>  <!--alt="..."-->
												 </input>
														</label><br>
														
												</div>
											</a>
									</div>
									
									</div>
									
									</div>
									
									</section>
										</div>
										<div class="col-md-4">
										
										</div>
										
										
									</div>
									 </div>
                        </div>
                    </div>
                    
                </div>
            </div></form>
                       <?php
include_once('design/footer.php');
?>
															
							

?>
