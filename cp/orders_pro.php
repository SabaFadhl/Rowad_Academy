
<?php
include_once('design/sidebar.php');

if(isset($_GET['action'],$_GET['id']) and intval($_GET['id'])!=0 )
{
	
	$id=intval($_GET['id']);
	$name=$_GET['name'];
	
	switch($_GET['action'])
	{
		case "display":

				$sql="select u.first_name,u.last_name,u.phone,p.name,o.add_date,o.sale_date,o.date_deliver,o.role 
						from orders o
						inner join users u
						inner join products p
						where u.id=o.users_id and p.id = o.products_id and o.id=:id";
				$q=$con->prepare($sql);
				$q->execute(array("id"=>$id));
				$rows=$q->fetchall();
				//var_dump($rows);
				$user="";
				foreach($rows as $row)
				{
					$name=$row['first_name']." ".$row['last_name'];
					$phone=$row['phone'];
					$product=$row['name'];
					$add=$row['add_date'];
					$sell=$row['sale_date'];
					$del=$row['date_deliver'];
					$role=orderType($row['role']);
				}
		break;
		case "delete":
				$done=$h->delete_("orders",$_GET['id']);
				echo "<meta http-equiv='refresh' content='0;url=\"orders.php?role=$role&name=$name\"'/>";
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
												<label for="exampleInputEmail1" class="coftit">رقم الطلب : <?php if(isset($id)) echo "<span class='cofans'>".$id ."</span>"; else echo '__';?></label>
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1" class="coftit">اسم الزبون : <?php if(isset($name)) echo "<span class='cofans'>".$name."</span>" ; else echo '__';?></label>
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1" class="coftit">رقم هاتفه : <?php if(isset($phone)) echo "<span class='cofans'>".$phone."</span>"; else echo '__'; ?> </label>
											</div>
										</div>
										<div class="col-md-4">
											
										</div>
								
									<div class="col-md-4">
									   
											<div class="col-md-10">
											<div class="form-group">
												<label for="exampleInputEmail1" class="coftit pp">حالة الطلب : <?php  if(isset($role)) echo "<span class='cofans'>".$role."</span>"; else echo '__'; ?></label>
											</div>
											</div>
										</div>
										
										
									
										<div class="col-md-12" style="border-bottom: 2px dashed #eeeeee;margin:5px;"></div>
										
								
										<div class="col-md-4">
											<div class="form-group">
												<label for="exampleInputEmail1" class="coftit">المنتج : <?php if(isset($product)) echo "<span class='cofans'>".$product."</span>"; else echo '__'; ?> </label>
											</div>
											
										</div>
										<div class="col-md-12" style="border-bottom: 2px dashed #eeeeee;margin:5px;"></div>
										
										<div class="col-md-4">
											
										</div>
										<div class="col-md-4">
											
										</div><div class="col-md-4">
											
										</div><div class="col-md-4">
											
										</div><div class="col-md-3">
											
										</div>
									
										<div class="col-md-5">
											<div class="form-group">
												<label for="exampleInputEmail1" class="coftit">تاريخ اضافة الطلب  : <?php if(isset($add)) echo "<span class='cofans'>".$add."</span>"; else echo '__'; ?></label>
											</div>
												<div class="form-group">
												<label for="exampleInputEmail1" class="coftit">تاريخ البيع  : <?php  if(isset($sell)) echo "<span class='cofans'>".$sell."</span>"; else echo '__'; ?></label>
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1" class="coftit" >تاريخ التوصيل : <?php if(isset($del)) echo "<span class='cofans'>".$del."</span>"; else echo '__';  ?></label>
											</div>
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
															
														<?php
											
								

?>
