<?php
include_once('design/sidebar.php');

if(isset($_GET['action'],$_GET['id']) and intval($_GET['id'])!=0 )
	{
		$id=intval($_GET['id']);
		switch($_GET['action']){
			case "active":
				$h->activation( "products",$id) ;
				echo "<meta http-equiv='refresh' content='0;url=\"products.php\"'/>";
				break;
		case "unactive":
				$h->no_activation( "products",$id);
				echo "<meta http-equiv='refresh' content='0;url=\"products.php\"'/>";
				break;
		 
				default:echo "Error";break;
			
		}
	}
	$sql="SELECT * FROM `roles` WHERE not id=4 order by id ASC";
	$q=$con->prepare($sql);
	$q->execute();
	$row=$q->fetchall();
	//var_dump($row);
	if($q->rowcount()>0){
		$acounts_1=$row[0]['acounts'];
		$acounts_2=$row[1]['acounts'];
		$acounts_3=$row[2]['acounts'];
		$orders_1=$row[0]['orders'];
		$orders_2=$row[1]['orders'];
		$orders_3=$row[2]['orders'];
		$slides_1=$row[0]['slides'];
		$slides_2=$row[1]['slides'];
		$slides_3=$row[2]['slides'];
		$users_1=$row[0]['users'];
		$users_2=$row[1]['users'];
		$users_3=$row[2]['users'];
		$products_1=$row[0]['products'];
		$products_2=$row[1]['products'];
		$products_3=$row[2]['products'];
		$offers_1=$row[0]['offers'];
		$offers_2=$row[1]['offers'];
		$offers_3=$row[2]['offers'];
		$addresses_1=$row[0]['addresses'];
		$addresses_2=$row[1]['addresses'];
		$addresses_3=$row[2]['addresses'];
		$locations_1=$row[0]['locations'];
		$locations_2=$row[1]['locations'];
		$locations_3=$row[2]['locations'];
		$messages_1=$row[0]['messages'];
		$messages_2=$row[1]['messages'];
		$messages_3=$row[2]['messages'];
		$granted_roles_1=$row[0]['granted_roles'];
	}

	if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST["save"]))
	{
		if(isset($_POST['acounts_1'])) $acounts_1=1;
		else $acounts_1=0;
		if(isset($_POST['acounts_2'])) $acounts_2=1;
		else $acounts_2=0;
		if(isset($_POST['acounts_3'])) $acounts_3=1;
		else $acounts_3=0;
		if(isset($_POST['orders_1'])) $orders_1=1;
		else $orders_1=0;
		if(isset($_POST['orders_2'])) $orders_2=1;
		else $orders_2=0;
		if(isset($_POST['orders_3'])) $orders_3=1;
		else $orders_3=0;
		if(isset($_POST['slides_1'])) $slides_1=1;
		else $slides_1=0;
		if(isset($_POST['slides_2'])) $slides_2=1;
		else $slides_2=0;
		if(isset($_POST['slides_3'])) $slides_3=1;
		else $slides_3=0;
		if(isset($_POST['users_1'])) $users_1=1;
		else $users_1=0;
		if(isset($_POST['users_2'])) $users_2=1;
		else $users_2=0;
		if(isset($_POST['users_3'])) $users_3=1;
		else $users_3=0;
		if(isset($_POST['products_1'])) $products_1=1;
		else $products_1=0;
		if(isset($_POST['products_2'])) $products_2=1;
		else $products_2=0;
		if(isset($_POST['products_3'])) $products_3=1;
		else $products_3=0;
		if(isset($_POST['offers_1'])) $offers_1=1;
		else $offers_1=0;
		if(isset($_POST['offers'])) $offers=1;
		else $offers=0;
		if(isset($_POST['offers_3'])) $offers_3=1;
		else $offers_3=0;
		if(isset($_POST['addresses_1'])) $addresses_1=1;
		else $addresses_1=0;
		if(isset($_POST['addresses_2'])) $addresses_2=1;
		else $addresses_2=0;
		if(isset($_POST['addresses_3'])) $addresses_3=1;
		else $addresses_3=0;
		if(isset($_POST['locations_1'])) $locations_1=1;
		else $locations_1=0;
		if(isset($_POST['locations_2'])) $locations_2=1;
		else $locations_2=0;
		if(isset($_POST['locations_3'])) $locations_3=1;
		else $locations_3=0;
		if(isset($_POST['messages_2'])) $messages_2=1;
		else $messages_2=0;
		if(isset($_POST['messages_3'])) $messages_3=1;
		else $messages_3=0;
		if(isset($_POST['messages_1'])) $messages_1=1;
		else $messages_1=0;
		if(isset($_POST['granted_roles_1'])) $granted_roles_1=1;
		else $granted_roles_1=0;
		$h->roles($acounts_1,$acounts_2,$acounts_3,$orders_1,$orders_2,$orders_3,$slides_1,$slides_2,$slides_3,$users_1,$users_2,$users_3,$products_1,$products_2,$products_3,$offers_1,$offers_2,$offers_3,$addresses_1,$addresses_2,$addresses_3,$locations_1,$locations_2,$locations_3,$messages_1,$messages_2,$messages_3,$granted_roles_1);
	}
?>
 <div class="main-panel">
     <?php include_once('design/navbar.php'); ?>
    <div class="content"><br><br><br><br><br>
        
				<form action="#" method='post'>
				<div class="row">
					<div class="col-md-4">
					<h2>الادمن</h2>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >الطلبات</lable>
						<input class="form-check-input" type="checkbox" name="orders_1" <?php if(isset($orders_1) and $orders_1==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >اضافة حسابات</lable>
						<input class="form-check-input" type="checkbox" name="acounts_1" <?php if(isset($acounts_1) and $acounts_1 ==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >السلايدات</lable>
						<input class="form-check-input" type="checkbox" name="slides_1" <?php if(isset($slides_1) and $slides_1==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >المستخدمين</lable>
						<input class="form-check-input" type="checkbox" name="users_1"<?php if(isset($users_1) and $users_1==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >المنتجات</lable>
						<input class="form-check-input" type="checkbox" name="products_1" <?php if(isset($products_1) and $products_1==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >العروض</lable>
						<input class="form-check-input" type="checkbox" name="offers_1" <?php if(isset($offers_1) and $offers_1==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >العناوين</lable>
						<input class="form-check-input" type="checkbox" name="addresses_1" <?php if(isset($addresses_1) and $addresses_1==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >المواقع</lable>
						<input class="form-check-input" type="checkbox" name="locations_1" <?php if(isset($locations_1)and $locations_1==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >الرسائل</lable>
						<input class="form-check-input" type="checkbox" name="messages_1"<?php if(isset($messages_1) and $messages_1 ==1 ) echo "checked"?>>
						</label>
						</div></div>
						<div class="col-md-4">
					<h2>المشرف</h2>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >الطلبات</lable>
						<input class="form-check-input" type="checkbox" name="orders_2" <?php if(isset($orders_2) and $orders_2 ==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >اضافة حسابات</lable>
						<input class="form-check-input" type="checkbox" name="acounts_2" <?php if(isset($acounts_2) and $acounts_2==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >السلايدات</lable>
						<input class="form-check-input" type="checkbox" name="slides_2" <?php if(isset($slides_2) and $slides_2 ==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >المستخدمين</lable>
						<input class="form-check-input" type="checkbox" name="users_2"<?php if(isset($users_2) and $users_2 ==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >المنتجات</lable>
						<input class="form-check-input" type="checkbox" name="products_2" <?php if(isset($products_2) and $products_2 ==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >العروض</lable>
						<input class="form-check-input" type="checkbox" name="offers_2" <?php if(isset($offers_2) and $offers_2 ==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >العناوين</lable>
						<input class="form-check-input" type="checkbox" name="addresses_2" <?php if(isset($addresses_2) and $addresses_2 ==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >المواقع</lable>
						<input class="form-check-input" type="checkbox" name="locations_2" <?php if(isset($locations_2) and $locations_2 ==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >الرسائل</lable>
						<input class="form-check-input" type="checkbox" name="messages_2"<?php if(isset($messages_2) and $messages_2 ==1) echo "checked"?>>
						</label>
					</div>
					</div><div class="col-md-4">
					<h3>المحرر</h3>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >الطلبات</lable>
						<input class="form-check-input" type="checkbox" name="orders_3" <?php if(isset($orders_3) and $orders_3==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >اضافة حسابات</lable>
						<input class="form-check-input" type="checkbox" name="acounts_3" <?php if(isset($acounts_3) and $acounts_3 ==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >السلايدات</lable>
						<input class="form-check-input" type="checkbox" name="slides_3" <?php if(isset($slides_3) and $slides_3 ==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >المستخدمين</lable>
						<input class="form-check-input" type="checkbox" name="users_3"<?php if(isset($users_3) and $users_3 ==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >المنتجات</lable>
						<input class="form-check-input" type="checkbox" name="products_3" <?php if(isset($products_3) and $products_3 ==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >العروض</lable>
						<input class="form-check-input" type="checkbox" name="offers_3" <?php if(isset($offers_3) and $offers_3 ==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >العناوين</lable>
						<input class="form-check-input" type="checkbox" name="addresses_3" <?php if(isset($addresses_3) and $addresses_3 ==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >المواقع</lable>
						<input class="form-check-input" type="checkbox" name="locations_3" <?php if(isset($locations_3) and $locations_3 ==1) echo "checked"?>>
						</label>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label"> <lable >الرسائل</lable>
						<input class="form-check-input" type="checkbox" name="messages_3"<?php if(isset($messages_3) and $messages_3 ==1) echo "checked"?>>
						</label>
					</div>
					<button type="submit" class="btn btn-primary" name='save'>Submit</button>
					</div>
				</form>	
			
    </div>
</div>
                       <?php
include_once('design/footer.php');
?>