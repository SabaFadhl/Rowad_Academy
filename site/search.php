
<?php include_once("../design/header.php"); 

$rows=$h->search($str);

if(!empty($str))
{

$rows=$h->search($str);

if(count($rows)>0)
{
?>
				
	<div class="container dirocont">
	
					<div class="row crow">
					<?php foreach($rows as $row)				
				{			
					?>
				<div class='col-md-6 col-lg-4 col-xl-3  product-grid' style='margin-bottom: 4%;'>
									<div class='image' >
										<a href='#' >
											<img src='../upload/<?php echo $row['image_name']; ?>' class='w-100' style='vertical-align: middle;
    width: 100%;
	    min-height: 300px;
   height: 212px;' >
											<div class='overlay'>
												<a href='showDetails.php?id=<?php echo $row['id']; ?>'><div class='detail'>مزيد من التفاصيل</div></a>
											</div>
										</a>
									</div>
									<h5 class='text-center'><?php echo $row['name']; ?></h5>
									<h5 class='text-center'>
									 <!-- <span class='text-center'>$evaluation</span>-->
									  
									  </span></h5>
									<h5 class='text-center'><?php echo $row['price']; ?> $</h5>
									<a href='showDetails.php?id=<?php echo $row['id']; ?>' class='btn buy'> <i class='fa fa-shopping-cart cooffa' > </i></a>
								</div>
								<?php }?>
								</div>	

								
								</div>		
								
				<?php  
	
}

else{
	echo "<div class=' dirocont' style='text-align: center; color: black;'>
	<span style='font-size:1.3em'>لايوجد ماتبحث عنه....</span>
	
	</div>";
}
				}
else{
	echo "<div style='text-align:center;color:black;'>الرجاء كتابة ماتبحث عنة</div>";
}

?>

    <?php include("../design/footer.php");?>