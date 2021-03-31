<?php include_once("../design/header.php"); ?>

<?php 
if(isset($_SESSION['id']))
$userid=$_SESSION['id'];

	

$P_id = ''; 
if( isset( $_GET['id'])) {
    $P_id = $_GET['id']; 
}		
if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST["add_to_cart"]) )
{
	
	//var_dump($_POST);
	//var_dump($_SESSION);
	
	if(isset($_SESSION['shopping_cart']))
	{
		$item_array_id=array_column($_SESSION['shopping_cart'],'item_id');
		if(!in_array($_POST['hidden_id'],$item_array_id))
		{
			$count=count($_SESSION['shopping_cart']);
			$item_array=array(
			'item_id'=>$_POST['hidden_id'],
			'item_name'=>$_POST['hidden_name'],
			'item_price'=>$_POST['hidden_price'],
			'item_image'=>$_POST['hidden_image'],
			'done'=>false
			);
			$_SESSION['shopping_cart'][$count]=$item_array;
		}
		else
		{
			$id=$_POST['hidden_id'];
			echo '<script>alert("المنتج موجود مسبقا")</script>';
			//echo "<script>window.location='handscraft.php?p=$id'</script>";
			
			
		}
	}
	else
	{
		$item_array=array(
			'item_id'=>$_POST['hidden_id'],
			'item_name'=>$_POST['hidden_name'],
			'item_price'=>$_POST['hidden_price'],
			'item_image'=>$_POST['hidden_image']
		);
		$_SESSION['shopping_cart'][0]=$item_array;
	}
	
}

?>



    <link href="../css/show_details.css" rel="stylesheet" />


	<!--================Single Product Area =================-->
	<div class="product_image_area">
		<div class="container">
			<?php echo $h->ShowDetails($P_id)?>
		</div>
	</div>
	<!--================End Single Product Area =================-->
<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/functions.js"></script>
	
    <?php include("../design/footer.php");?>