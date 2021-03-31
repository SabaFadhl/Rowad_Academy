
<?php include_once("../design/header.php"); 
	if(!isset($_SESSION['id']) and !isset($_SESSION['role']))
	{
		header("location:cart.php");
		exit();
	}
	else
	{
		$users_id=$_SESSION['id'];
	}
?>
				
  <link rel="stylesheet" href="../css/cp_add.css">
			<!--try-->
	
								
					
	
				
<?php  
	
if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST["choose"]))
{
	//var_dump($_POST);
	$item_array=array(
				'id'=>$_POST["id"],
				'name'=>$_POST["name"],
				'phone'=>$_POST["phone"],
				'description'=>$_POST["description"]
				);
	$_SESSION['address']=$item_array;
	echo "<meta http-equiv='refresh' content='0;url=\"../site/cart.php\"'/>";
							
	//var_dump($_SESSION);
} 

$rows=$h->getAdressess($users_id);						
?>

  						
					
					<section>
					            <div class="row" style="margin-top:2%;">
									 <div class=" col-lg-5">
									 </div>
									  <div class=" col-lg-2">
										<p><a href="addAdress.php" class="btn btn-primary ">اضافة عنوان </a></p>
									</div>
									 <div class=" col-lg-5">
									 </div>
								</div>
									
									
										<div class="row csc" style="margin-top:2%;">
			
			
			                      
							
							<?php foreach($rows as $row)				
									{			
							?>
												
				<div class="col-lg-2">
				</div>
						
					<div class="col-lg-8">
						
						<div class="row" style="    background-color: #eaecef;
    margin-right: 1%;
    border-radius: 7px;
    padding: 1%;
    text-align: right;
    font-size: 1em !important;
    font-family: inherit;
    color: black;">
										
							<div class="col-lg-6">
									<div class="col-lg-6">
							
								<span><?php echo $row['first_name']." ".$row['last_name']; ?></span><br>
								<span><?php echo $row['phone']?></span><br>
								<span><?php echo $row['description']?></span>
									
									
									</div>
									<div class="col-lg-6">
								           <a href="addAdress.php?action=edit&id=<?php echo $row['id']?>" class="btn btn-primary " style="width:40%;">تعديل</a>
											<a href="addAdress.php?action=delete&id=<?php echo $row['id']?>" class="btn btn-primary " onclick='return confirm("هل انت متأكد من الحذف ؟")' style="width:40%;">حذف</a>
								
									
									</div>
							
							
							
							</div>
							
							<div class="col-lg-4">
							</div>
							<div class="col-lg-2">
							
							
							
								<form action="" method="post"  enctype='multipart/form-data' name='chose' style='border:none;' class="" >
									<input name='id' value='<?php echo $row['id']; ?>' hidden>
									<input name='name' value='<?php echo $row['first_name']." ".$row['last_name']; ?>' hidden>
									<input name='phone' value='<?php echo $row['phone']?>' hidden>
									<input name='description' value='<?php echo $row['description']?>' hidden>
									<div class="">
									<button type='submit' name='choose' class="btn btn-primary " for='chose'>اختيار</button>
									</div></form>
							</div>
							</div>
				
					
						<br>
						<br>
								
								</div>
							
													<div class="col-lg-2">
				</div>
									
			
								
							<?php }?>
							<br>
			<br>
			<br>
					
		
									
									
							</div>
								
									
								
							
							<section>	
						
					
	
	
 


    <?php include("../design/footer.php");?>