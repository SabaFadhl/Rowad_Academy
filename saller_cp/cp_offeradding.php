
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

 if(isset($_GET['action'],$_GET['id']) and intval($_GET['id'])!=0 ){
	$id=intval($_GET['id']);
	$today = date("Y-m-d");
	switch($_GET['action'])
	{
		case "delete":
			echo $h->delete_("offers",$id) ;
			//echo "delete_('offers',$id)";
			echo "<meta http-equiv='refresh' content='0;url=\"cp_offers.php\"'/>";
			break;
		case "edit":
			//var_dump($_GET);
				$sql="select start_date,end_date,new_price,products_id 
						from offers 
						 where id=:id";
				$q=$con->prepare($sql);
				$q->execute(array("id"=>$id));
				$rows=$q->fetchall();
				if($q->rowcount()>0)
				{
					//var_dump($rows);
					
					foreach($rows as $row)
					{
						$p_id=$row['products_id'];
						$start=$row['start_date'];
						$end=$row['end_date'];
						$price=$row['new_price'];
						
					if($_SERVER['REQUEST_METHOD']=='POST' &&   isset($_POST['save'])&&   isset($_POST['id']) )
					{
						
						
						$id=$_POST['id'];//password_hash($_POST['pass'],PASSWORD_DEFAULT);
						$start=$_POST['start'];//password_hash($_POST['pass'],PASSWORD_DEFAULT);
						$end=$_POST['end'];
						$new_price=$_POST['price'];
						if(empty($new_price))
							{
								$error['price']=error_message("السعر الجديد");
							}
						
								else if(!intval($new_price))
								{
									$error['price']="<span class='error-message'> الرجاء ادخال ارقام فقط</span>";
								}
							else if($new_price<50)
								{
									$error['price']="<span class='error-message'> الرجاء ادخال قيمة اكبر من او تساوي 50  </span>";
								}
						if($start <$today)
							{
								//$error['date']="<span class='error-message'>يجب ان يكون تاريخ بداية العرض اليوم او بعد اليوم</span>";
							}
						if($end <=$today)
							{
								$error['date']="<span class='error-message'>يجب ان يكون تاريخ   نهايةالعرض   بعد اليوم</span>";
							}
						if($start>$end)
							{
								$error['date']="<span class='error-message'>يجب ان يكون تاريخ بداية العرض قبل تاريخ نهاية العرض</span>";
							}
		
						if(empty($error))
						{
							try
							{
								
								echo  "<div style='background-color: #FFC107;
										text-align: center;
										height: 4%;
										padding: 1%;'>".$h->offers( $p_id,$start,$end,$new_price,$id) ."</div>";
							}
							catch(PDOException $e)
							{
								$done= $sql . "<br>" . $e->getMessage();
							}
						}
					}
				}
			
		}
		break;
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


  						
					
						<section class="cat_product_area section_gap">
		<div class="container-fluid mx-auto">
		<div class="col-lg-8 col-md-8 col-sm-8 mx-auto">
					
						<form action="#" method="post" class="dirofform" enctype='multipart/form-data'>
							<input type="text" class="form-control" name="id" hidden  value="<?php if(isset($id)) echo $id;?>">
							<h3 class="mb-30"> لاضافة عرض  </h3>
							<div class="latest_product_inner row">
							<div class="col-lg-8 col-md-8 col-sm-8 mx-auto">
							<div class="mt-10 mmb-10">
								<input type="date" name="start"  value="<?php if(isset($start)) echo $start; else echo date("Y-m-d");?>" required class="single-input">
									
							</div>
							<div class="mt-10 mmb-10">
								<input type="date" name="end" value="<?php if(isset($end)) echo $end; else echo date("Y-m-d", strtotime("+1 week"));?>" required class="single-input">
									<?php if (isset($error['date']))echo ($error['date']);?>
							</div>
							<div class="mt-10 mmb-10">
								<h5>ادخل السعر الجديد:</h5><input type="text" name="price"  placeholder = "السعر" value="<?php if(isset($price)) echo $price;?>" required class="single-input">
							<?php if (isset($error['price']))echo ($error['price']);?>
							</div>
						</div>
						
						<div class="col-lg-4 col-md-4 col-sm-4">
						</div>
						</div>
									
				<br>
				<br>
				<br>
					<button class="btn btn-default btn-osx btn-lg add"  type="submit" name="save">
				<span> اضافة</span>

				</button>
		
							</form>
				</div>
						</div>
						</section>
						
						
					
					
	
	
 


    <?php include("../design/footer.php");?>