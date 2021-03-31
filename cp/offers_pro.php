
<?php
include_once('design/sidebar.php');
if(isset($_GET['action'],$_GET['id']) and intval($_GET['id'])!=0 )
{
	$id=intval($_GET['id']);
	$today = date("Y-m-d");
	switch($_GET['action'])
	{
		case "offer":
				if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST["save"]))
				{
					//var_dump($_POST);
					$start=$_POST['start'];;
					$end=$_POST['end'];
					$price=$_POST['price'];
					
					if($start>$end)
						{
							$error['date']="<span class='error-message'>يجب ان يكون تاريخ بداية العرض قبل تاريخ نهاية العرض</span>";
						}
					if($start <$today)
						{
							$error['date']="<span class='error-message'>يجب ان يكون تاريخ بداية العرض اليوم او بعد اليوم</span>";
						}
					if($end <=$today)
						{
							$error['date']="<span class='error-message'>يجب ان يكون تاريخ   نهايةالعرض   بعد اليوم</span>";
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
					
					if(empty($error))
					{
						try
						{
							echo  "<div style='background-color: #FFC107;
									text-align: center;
									height: 4%;
									padding: 1%;'>".$h->offers( $id,$start,$end,$price)."</div>";
									
						}
						catch(PDOException $e)
						{
							$done= $sql . "<br>" . $e->getMessage();
						}
					}
					
					
				} 
			break;
	}
} 														
?>
														
															
            <div class="main-panel">
            <?php
				include_once('design/navbar.php');
		    ?>
            
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="title"> لاضافة عرض </h5>
                            </div>
                            <div class="card-body">
															
									<form action=' ' method='post' enctype='multipart/form-data'>
										<input type="text" class="form-control" name="id" hidden  value="<?php if(isset($id)) echo $id;?>">
										<div class="col-md-8">
										<?php if (isset($done))echo "<div class='return_message'>". $done ."</div>";?>
										<br></div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label>بداية العرض</label>
												<input type="date" name="start"  value="<?php if(isset($start)) echo $start; else echo date("Y-m-d");?>" required class="single-input">
												<span class="error-message"><?php if (isset($error['name']))echo ($error['name']);?></span>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label>نهاية العرض</label>
												<input type="date" name="end" value="<?php if(isset($end)) echo $end; else echo date("Y-m-d", strtotime("+1 week"));?>" required class="single-input">
												<?php if (isset($error['date']))echo ($error['date']);?></div>
										</div>
										
										<div class="col-md-6">
										<label> السعر الجديد:</label><input type="text" name="price"  placeholder = "السعر" value="<?php if(isset($price)) echo $price;?>" required class="single-input">
											<?php if (isset($error['price']))echo ($error['price']);?>
										</div>
										<input type="submit"  value="ارسال" name="save"  class="btn-info btn"/>
									</div>
									
															
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div></form>
                       
<?php include_once('design/footer.php');?>
