
<?php include_once("../design/header.php"); 
if(!isset($_SESSION['id']) and !isset($_SESSION['role']))
	{
		header("location:index.php");
		exit();
	}
if(isset($_GET['action']))
{
	//var_dump($_GET);
	if(isset($_GET['id']))
	{
		$id=intval($_GET['id']);
	}
	if(isset($_GET['nid']))
	{
		$id=intval($_GET['nid']);
	}
	
	switch($_GET['action'])
	{
		case "delete":
			echo" <div style='background-color: #FFC107;
					text-align: center;
					height: 4%;
					padding: 1%;'>". $h->delete_('orders',$id)."</div>" ;
			echo "<meta http-equiv='refresh' content='0;url=\"myPurchases.php\"'/>";
			
			break;
		case 'seen':
			$sql="update notifications set seen =1 where id =:id";
			$q=$con->prepare($sql);
			$q->execute(array("id"=>$id));
			echo "<meta http-equiv='refresh' content='0;url=\"../site/myPurchases.php\"'/>";
		
	}
}
//var_dump($_SESSION);	
$rows=$s->myPurchases($_SESSION['id']);


?>

								 <h2 class="ccc"></h2>
								 
        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row csc">
				 
				   <div class=" col-lg-3 text-center">
				   </div>
					
                    <div class=" col-lg-6 text-center">
                       
                           
							

                        <div class="cart-table clearfix">
					
                      
                            <table class="table table-responsive  table-hover">
								
                                <thead >
								<tr class="heca"> 
                                   
                                        <th>اسم المنتج</th>
                                        <th>صورة المنتج</th>
                                       <th>السعر</th>
                                        <th>تاريخ الطلب</th>
										<th>تاريخ التوصيل</th>
										<th>تاريخ الدفع</th>
										<th>حالة الطلب</th>
									<th></th>
								
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php  
									// var_dump($rows);
									if(!empty($rows)){
									 foreach($rows as $row)
										{
											//var_dump($row);
											$id=$row['id'];
											$name=$row['name'];
											$img=$row['image_name'];
											$add=$row['add_date'];
											$deliver=$row['date_deliver'];
											$role=orderType($row['role']);
											$price=$row['price'];
											$sale=$row['sale_date'];
											?>
											<tr>
														<td class='cart_product_desc' >
															<h5><?php echo $name; ?></h5>
														</td>
														<td class='cart_product_img' style="width:200px;text-align:center; vertical-align:middle">
												<a href='#' ><img src='../upload/<?php echo $img;?>' alt='Product' class='d-block img-fluid' style="max-height:100%; min-width:100px" /></a>
														</td>
														
														<td class='price'>
														  <h5><?php echo $price;?></h5>
														</td>
														
														
														<td class='price'>
															 <h5><?php echo $add;?></h5>
														</td>
														<td class='price'>
															 <h5><?php echo $deliver;?></h5>
														</td>
														<td class='price'>
															 <h5><?php echo $sale;?></h5>
														</td>
													<td class='price'>
															 <h5><?php echo $role;?></h5>
														</td>
														 <td class='price'>
															<a class=''href='?action=delete&id=<?php echo $id;?>' onclick='return confirm("هل انت متأكد من الحذف ؟")'><i class='fa fa-trash' id='mc'></i></a>
														</td>
												</tr>
										<?php
											}
										}
										else 
											{
											//echo "<div class='dirocont' style='text-align:center; color: black;'><span style='font-size:1.3em'> لايوجد ماتبحث عنه....  </span></div>";
											}
										?>
                                     
                                </tbody>
                            </table>
                        </div>
							 
                    </div>
						
                       <div class=" col-lg-3 text-center">
				   </div> 
				   
                </div>
				
            </div>
        </div>
    
    <!-- ##### Main Content Wrapper End ##### -->



    <?php 
	
	include("../design/footer.php");?>