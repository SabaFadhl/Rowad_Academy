<?php include_once("../design/header.php"); 
//var_dump($_SESSION['shopping_cart']);
//var_dump($_SESSION['shopping_cart']);
//var_dump($_SESSION);
if(empty($_SESSION['address']) and !isset($_SESSION['id']))
{
	echo '<script>alert("يجب تسجيل الدخول")</script>';
}
if(isset($_GET['action']))
{
	//var_dump($_GET);
	
	switch($_GET['action'])
	{
		case "delete":
			$id=intval($_GET['id']);
			if(isset($_SESSION['shopping_cart']))
				{
					foreach($_SESSION['shopping_cart'] as $keys => $values)
					{
						if($values['item_id']==$id)
						{
							unset($_SESSION['shopping_cart'][$keys]);
							echo "<meta http-equiv='refresh' content='0;url=\"../site/cart.php\"'/>";
							break;
						}
					}
				}
				else
				{
					echo '<script>alert("لم تطلب أي شيئ حتى الان ...")</script>';
				}
			break;
		case "buy":
			if(isset($_SESSION['id']))
			{
								
				if(!empty($_SESSION['shopping_cart']))
				{
					
					if(intval($_GET['total'])<1000)
					{
						//var_dump($_SESSION['shopping_cart']);
						echo '<script>alert("عذرا لايمكنك الشراء بمبلغ اقل من 1000 ريال")</script>';
					}
					else
					{
						foreach($_SESSION['shopping_cart'] as $keys => $values)
						{
							
							$date=date("Y-m-d");
							if(!empty($_SESSION['address']))
							{
								$user_id=$_SESSION['id'];
								$name=$values['item_name'];
								//$seller=$values['item_seller'];
								//$description=$values['item_description'];
								$product_id=$values['item_id'];
								$role=1;
								$address=$_SESSION['address']['id'];
								if($h->orders($_SESSION['id'],$product_id,$date,$date,$role,$date,$address))//add-delivet-sell
								{
									//echo "orders($_SESSION[id],$product_id,$date,$date,$role,$date,$address)";
									
									//var_dump($_SESSION['address']['id']);
									unset($_SESSION['shopping_cart'][$keys]);
									//echo "<meta http-equiv='refresh' content='0;url=\"../site/cart.php\"'/>";
									//echo '<script>alert("تم ارسال طلبك للبائع وهو ب انتظار الموافقة")</script>';
									//echo "<meta http-equiv='refresh' content='0;url=\"../site/cart.php\"'/>";
								} 	
								else
								{
									echo '<script>alert("السلة فارغة")</script>';
								}
							}
							else
							{
								echo '<script>alert("يرجى اختيار عنوان")</script>';
							}
							  
						}
					}
					
				}
				else
				{
					echo '<script>alert("لم تطلب أي شيئ حتى الان ...")</script>';
				}
			}
			else
			{
				//var_dump($_SESSION);
				echo '<script>alert("يجب تسجيل الدخول")</script>';
			}
			
			break;
	}
	
}

?>




								 
        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
             
							
							<div class="row csc" style="
    margin-top: 3% !important;">
				 
			
                    <div class=" col-lg-1 text-center">
					</div>
					
                    <div class=" col-lg-6">
                       

                        <div class="cart-table clearfix">
					
                      
                            <table class="table table-responsive table-hover">
								
                                <thead>
								<tr class="heca"> 
                                   
                                        <th></th>
                                        <th>اسم المنتج</th>
                                        <th>السعر</th>
                                        <th>الاجمالي</th>
										<th>حذف المنتج </th>
								
                                    </tr>
                                </thead>
                                <tbody>
								<?php 
								$total=0;
									if(!empty($_SESSION['shopping_cart']))
									{
										
										
										foreach($_SESSION['shopping_cart'] as $keys => $values)
										{
											//var_dump($_SESSION);
											$total_price=0;
											$product_id =$values['item_id'];
											$product_name =$values['item_name'];
											$product_price =$values['item_price'];
											$product_image =$values['item_image'];
											$total_price+=($product_price);
											$total+=$total_price;
											
											?>
										<tr>
                                        <td class="cart_product_img" style="text-align:center; vertical-align:middle">
                                            <a href="#"><img src="../upload/<?php echo $product_image;?>"  class="cart_img" alt="Product"   style="max-height:100%; min-width:100px"></a>
                                        </td>
                                        <td class="cart_product_desc">
                                            <h5><?php echo $product_name;?></h5>
                                        </td>
                                        <td class="price">
                                          <h5><?php echo $product_price;?> ريال </h5>
                                        </td>
                                       
										
										 <!--<td class="price">
                                             <h5>تفاصيل المنتج</h5>
                                        </td>-->
										 <td class="price">
                                             <h5><?php echo $total_price;?>RY</h5>
                                        </td>
										
										 <td>
										 <a href='?action=delete&id=<?php echo $product_id;?>' onclick='return confirm("هل انت متأكد من الحذف ؟")'><i class='fa fa-trash' id='mc'></i></a> 
										 </td>
                                    </tr>
									
											
											<?php
										}
									}
									else
									{
										
									}
								?>
                                     
                                </tbody>
                            </table>
                        </div>
							 
                    </div>
						<div class="col-lg-3 cart-wrap ftco-animate text-right" style="
    background-color: #f6f6f6;">
						
								 <h3 class="cccss" style='text-align:center'>عنوان التوصيل </h3>
								 
								 	<div class="col-lg-12" >
						
						<div class="row" style="  id='address'  background-color: #ffffff;
   
    border-radius: 7px;
    padding: 1%;
    text-align: right;
    font-size: 1em !important;
    font-family: inherit;
    color: black;">
	
	   <?php if(!empty($_SESSION['address']))
						{
							?>
							
								
								<div class="col-lg-12" >
							
								<span>الاسم : <?php echo $_SESSION['address']['name'] ?></span><br>
								<span>الرقم : </span><?php echo $_SESSION['address']['phone']?><br>
								<span>الوصف : <?php echo $_SESSION['address']['description']?></span>
									
									
									</div>
								</div><br>
							<br>
								
								</div>
									<div class="">
				 
										<p><a href="address.php" class="btn btn-primary">اختيار عنوان اخر</a></p>
									</div>
									<br>
							
							
								 		
						<?php
						}
						else
						{
							
							?>
							<style>
							#address{
								display:none;
							
							</style>
								</div><br>
							<br>
								
								</div>
									<div class="">
				 
										<p><a href="address.php" class="btn btn-primary" onclick='<?php  if(!isset($_SESSION["id"])) {$c="يرجى تسجيل الدخول"; echo "return confirm($c)";}?>'>اختيار عنوان </a> </p>
									</div>
									<br>
									
								 		
										<?php
						
						}		
				
				 ?>
					
								
    				<div class="cart-total mb-3 text-center" style="
    background-color:#ffffff !important;">
    					<h4>الفاتوره</h4>
    					
    				
    					<p class="d-flex total-price">
    						<span>الاجمالي</span>
    						<span><?php if(isset($total)) echo $total ; else echo 0?> $ </span>
    					</p>
    				</div>
    				<p><a href="?action=buy&total=<?php  echo $total ; ?>" class="btn btn-primary ">تاكيد</a></p>
    			</div>
				 <div class=" col-lg-1 text-center">
					</div>
					
                
                </div>
				
            </div>
        </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->



    <?php include("../design/footer.php");?>