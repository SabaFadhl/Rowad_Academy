
<?php include_once("../design/header.php"); 

include_once('../functions/functions.php');
$h = new herf("mysql:host=localhost;dbname=task_db","root","");
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
				
				
				
  
  <link rel="stylesheet" href="../css/product1.css">
			<!--try-->
	<style>
	
.dirocont{
	padding-top: 50px;
	direction:rtl;

}
hr{
	width: 300px;
	border: 3px solid #434444;
}

/* Product Grid */
.product-grid{
	padding-bottom: 20px;
	padding-top: 20px;
}
.product-grid:hover{
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.image{
	position: relative;
}
.overlay{
	position: absolute;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	height: 100%;
	width: 100%;
	opacity: 0;
	transition: .5s ease;
	background-color: rgba(238, 178, 53, 0.65);
}
.image:hover .overlay{
	opacity: 1;
}
.detail{
	color: #fff;
	font-size: 20px;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	-ms-transform: translate(-50%, -50%);
}

.buy{
	background-color: transparent;
	color: #434444;
	border-radius: 0;
	border: 1px solid #434444;
	width: 100%;
	margin-top: 20px;
}
.buy:hover{background-color: #febd69;
    border-color: #febd69;
	color: #fff;
}

	</style>	
					<div class="container dirocont">
					
<div><h2 class="pro"> </div>
	
	
		<div class="row crow">
			<?php $h->getProducts();?>
</div>

	</div>

    <?php include("../design/footer.php");?>