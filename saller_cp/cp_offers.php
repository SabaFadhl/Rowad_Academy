
<?php include_once("../design/header.php"); 
if(!isset($_SESSION['id']) and !isset($_SESSION['role']))
	{
		header("location:index.php");
		exit();
	}
else
{
	 $user_id=$_SESSION['id'];
}
	
$today = date("Y-m-d");
$rows=$s->cp_offers($user_id);



?>



		
  
  
			<!--try-->

					
					
		<section class="cat_product_area section_gap">
		<div class="container-fluid" style="direction:rtl">
					<div class="latest_product_inner row">
						
						<?php foreach($rows as $row)				
						{	
							if($row['start_date']<=$today and $row['end_date']>=$today)
								$state=true;
							else 
								$state=false;
							
					?>
					<div class="col-md-6 col-lg-4 col-xl-3">
							<div class="f_p_item">
							
								<div class="f_p_img">
									<img class="img-fluid" src="../upload/<?php echo $row['image_name']; ?>" alt="" style='vertical-align: middle;
    width: 100%;
	    min-height: 300px;
   height: 212px;' >
									<div class="p_icon">
										<a href="#">
											<i class="lnr lnr-heart"></i>
										</a>
										<a href="#">
											<i class="lnr lnr-cart"></i>
										</a>
									</div>
									</div>
									<a href="#">
										<h4> <?php echo $row['name']; ?></h4>
									</a>
									<h5> <del><?php echo $row['price']; ?> ريال</del></h5>
									<h5><?php echo $row['new_price']; ?> ريال</h5>
									<h5><span>الكمية المباعة: </span><?php echo $row['sales']; ?></h5>
									<h5><span>حالة العرض: </span><?php echo offerType($state); ?></h5>
									
									<a href='cp_offeradding.php?action=edit&id=<?php echo $row['id']; ?>'>
									<button class="btn btn-default btn-osx btn-lg check cp_but" title="تعديل العرض"  type="submit" name="submit">
									 <i class="fa fa-edit " aria-hidden="true"></i>
									</button></a>  
										
									
									<a href='cp_offeradding.php?action=delete&id=<?php echo $row['id']; ?>' onclick='return confirm(\" هل انت متأكد من حذف العرض\")'><button class="btn btn-default btn-osx btn-lg check cp_but" title="حذف العرض" type="submit" name="submit">
									<i class="fa fa-trash " aria-hidden="true" ></i> 
									</button></a> 
									
							
							</div>
							</div>
							
							<?php }?>
						
					</div>
					</section>
					
	
<div class="container">
 
  <ul class="pagination">
    <li class="active"><a href="#">1</a></li>
    <li ><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
  </ul>
</div>
	
 


    <?php include_once("../design/footer.php");?>