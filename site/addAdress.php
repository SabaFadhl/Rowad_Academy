
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
				
  <link rel="stylesheet" href="../css/cp_add.css">
			<!--try-->
	
								
					
	
				
<?php  
if(isset($_GET['action'],$_GET['id']) and intval($_GET['id'])!=0)
{
	$address_id=intval($_GET['id']);
	//var_dump();
	switch($_GET['action'])
	{
		case "delete":
			$h->delete_('addresses',$address_id);
			echo "delete_('addresses',$address_id)";
			echo "<meta http-equiv='refresh' content='0;url=\"address.php\"'/>";
			break;
		case "edit":
		{
			$sql="select * from addresses where id =:address_id ";
			$q=$con->prepare($sql);
			$q->execute(array("address_id"=>$address_id));
			$rows=$q->fetchall();
			if($q->rowcount()>0)
			{
				$images_id=[0,0,0,0];
				foreach($rows as $row)
				{
					$fname=$row['first_name'];//password_hash($_POST['pass'],PASSWORD_DEFAULT);
					$lname=$row['last_name'];
					$location_id=$row['locations_id'];
					$users_id=$row['users_id'];
					$description=$row['description'];
					$phone=$row['phone'];
					$type=$row['type'];
				}
				if($_SERVER['REQUEST_METHOD']=='POST' &&   isset($_POST['sendadd']) && !empty($_POST['ida']) )
				{
					//var_dump($_POST);
					//var_dump($_FILES);
					$fname=$_POST['fname'];//password_hash($_POST['pass'],PASSWORD_DEFAULT);
					$lname=$_POST['lname'];
					$phone=$_POST['phone'];
					$description=$_POST['description'];
					$type=$_POST['type'];
					//$locationmap=$_POST['locationmap'];
					$city=$_POST['state'];
					$country=$_POST['country'];
					
					//$locationid=$_POST['locationid'];
					
					//var_dump($newname);
					if(empty($fname))
						{
							$error['fname']=error_message("الاسم الاول ");
						}
						
					else if(!preg_match('/^[a-zA-Zأ-ي\s]*$/u',$fname))
						{
							$error['fname']="<span class='error-message'> يجب ان يكون احرف فقط</span>";
						}
						
						
						if(empty($lname))
						{
							$error['lname']=error_message("الاسم الاخير ");
						}
						
					else if(!preg_match('/^[a-zA-Zأ-ي\s]*$/u',$lname))
						{
							$error['lname']="<span class='error-message'> يجب ان يكون احرف فقط</span>";
						}
						
					if(empty($phone))
						{
							$error['phone']=error_message("رقم الهاتف");
						}
					else if(!preg_match('~^[71/73/77/70]{2}[0-9]{7}$~D',$phone))
						{
							$error['phone']="<span class='error-message'>يجب ادخال صيغة صحيحة تبدأ ب 71 او 73 او  77 ومكون من 9 ارقام </span>";
						}
					if(empty($country))
						{
							$error['country']=error_message("محافظة");
						}
					
					if(empty($description))
						{
							$error['description']=error_message("وصف المنتج ");
							
						}
						
					/* else if(!preg_match('/^[a-zA-Zأ-ي\s]*$/u',$description))
						{
							$error['description']="<span class='error-message'> يجب ان يكون احرف فقط</span>";
						} */
					
					
					
					if(empty($error))
					{
						try
						{
							echo  "<div style='background-color: #FFC107;
									text-align: center;
									height: 4%;
									padding: 1%;'>".$h->addresses( $fname,$lname,$phone,$type,$description,'hh',$city,$users_id,$address_id)."</div>";
									//echo "<meta http-equiv='refresh' content='0;url=\"../site/address.php\"'/>";
											
						}
						catch(PDOException $e)
						{
							$done= $sql . "<br>" . $e->getMessage();
						}
					}
					
	
				}
		}break;
	}
}	
}			
if (isset($_POST['country_id']))
{
	//echo "<h1>".$_POST['country_id']."</h1>";	
	//$query = "select * from locations where parent=".$_POST['country_id'];
	//$query2 = "select id,name from locations where parent='6'";//.$_POST['country_id'] ;//."and level='3'";
	 $query2 = "Select l.name,l.id
					from locations l
					inner join locations o 
					where l.parent=o.id and o.id=:parent";  //.$_POST['country_id'] ;//."and level='3'";
	$result2 = $con->prepare($query2);
	
	$result2->execute(array("parent"=>$_POST['country_id']));//
	$rowss=$result2->fetchall();
	if ($result2->rowcount()>0) {
	 foreach ($rowss as $row1) {
		 if($row1['id']==$location_id)
	echo '<option value='.$row1['id'].'>'.$row1['name'].'</option>';

	else echo '<option value='.$row1['id'].' selected>'.$row1['name'].'</option>';
		 }
	}
	
	
	
else{

		echo '<option>لايوجد اي منطقة</option>';
	}
}	
if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST["sendadd"]) && empty($_POST['ida']))
{
	//var_dump($_POST);
	//var_dump($_FILES);
	$fname=$_POST['fname'];//password_hash($_POST['pass'],PASSWORD_DEFAULT);
	$lname=$_POST['lname'];
	$phone=$_POST['phone'];
	$description=$_POST['description'];
	$type=$_POST['type'];
	//$locationmap=$_POST['locationmap'];
	$city=$_POST['state'];
	$country=$_POST['country'];
	
	//$locationid=$_POST['locationid'];
	
	//var_dump($newname);
	if(empty($fname))
		{
			$error['fname']=error_message("الاسم الاول ");
		}
		
	else if(!preg_match('/^[a-zA-Zأ-ي\s]*$/u',$fname))
		{
			$error['fname']="<span class='error-message'> يجب ان يكون احرف فقط</span>";
		}
		
		
		if(empty($lname))
		{
			$error['lname']=error_message("الاسم الاخير ");
		}
		
	else if(!preg_match('/^[a-zA-Zأ-ي\s]*$/u',$lname))
		{
			$error['lname']="<span class='error-message'> يجب ان يكون احرف فقط</span>";
		}
		
	if(empty($phone))
		{
			$error['phone']=error_message("رقم الهاتف");
		}
	else if(!preg_match('~^[71/73/77/70]{2}[0-9]{7}$~D',$phone))
		{
			$error['phone']="<span class='error-message'>يجب ادخال صيغة صحيحة تبدأ ب 71 او 73 او  77 ومكون من 9 ارقام </span>";
		}
	if(empty($country))
		{
			$error['country']=error_message("محافظة");
		}
	
	if(empty($description))
		{
			$error['description']=error_message("وصف المنتج ");
			
		}
		
	/* else if(!preg_match('/^[a-zA-Zأ-ي\s]*$/u',$description))
		{
			$error['description']="<span class='error-message'> يجب ان يكون احرف فقط</span>";
		} */
	
	
	
	if(empty($error))
	{
		try
		{
			echo  "<div style='background-color: #FFC107;
					text-align: center;
					height: 4%;
					padding: 1%;'>".$h->addresses( $fname,$lname,$phone,$type,$description,'hh',$city,$users_id)."</div>";
					echo "<meta http-equiv='refresh' content='0;url=\"../site/address.php\"'/>";
							
		}
		catch(PDOException $e)
		{
			$done= $sql . "<br>" . $e->getMessage();
		}
	}
	
	
}
//else 			
?>

  						
					
						<section class="cat_product_area section_gap">
		<div class="container-fluid">
					
						<form action="" method="post" class="dirofform" enctype='multipart/form-data'>
						<input type="text" class="form-control" name="ida" hidden  value="<?php if(isset($address_id)) echo $address_id;?>">
						
												<h3 class="mb-30">  عنوان التوصيل  </h3>
							<div class="latest_product_inner row">
							
						<div class="col-lg-8 col-md-8 col-sm-8">
							<div class="mt-10 mmb-10">
										<input type="text" name="fname" placeholder="الاسم الاول"   required class="single-input" value="<?php if(isset($fname)) echo $fname;?>">
									<?php if (isset($error['fname']))echo ($error['fname']);?>
									</div>
									
										<div class="mt-10 mmb-10">
										<input type="text" name="lname" placeholder="الاسم الاخير"   required class="single-input" value="<?php if(isset($lname)) echo $lname;?>">
									<?php if (isset($error['lname']))echo ($error['lname']);?>
									</div>
									
									<div class="mt-10 mmb-10">
										<input type="text" name="phone"  placeholder = "رقم الهاتف"  required class="single-input" value="<?php if(isset($phone)) echo $phone;?>">
										<?php if (isset($error['phone']))echo ($error['phone']);?>
									</div>
									<!----------------------------------------------------------------->
									
			<div class="continput">

	
	<span class="t1">نوع السكن:</span>
			<input  type="radio" value='1'  name="type" <?php if(isset($type)and $type==1) echo "checked"; if(!isset($type)) echo "checked"?> >
			<label class="llableadd" >شقة</label>
			
			<input type="radio" value='2' name="type" <?php if(isset($type)and $type==2) echo "checked"?>>
			<label class="llableadd">منزل</label>
		
			<input type="radio" value='3' name="type" <?php if(isset($type)and $type==3) echo "checked"?>>
			<label class="llableadd">مكتب</label>
		<?php //if (isset($error['type']))echo ($error['type']);?>
		
		
</div>
									<!----------------------------------------------------------------->
							
									
								<span class="t1">المدينة:</span>
									<select class="selecting" name="country" id="country" class="form-control" onchange="FetchState(this.value)" >
									<option></option>
										 <?php
            //echo "<h1>".$_POST['country_id']."</h1>";	
			$result = $con->prepare("select * from locations where parent='1'");

			$result->execute();
					$rows=$result->fetchall();
					if($result->rowcount()>0)
						{
							foreach($rows as $row)
							{
								$idc=$row['id'];//the id of city
								$namee=$row['name'];
								if(isset($city) and $city=$idc)
								{
									echo "<option value='$idc'>$namee</option>";
								}
								else
								{
									echo "<option value='$idc'>$namee</option>";
								}
								
								
							}
						}
						else
							echo "erre";
          ?> 
									</select>
										<br>
										<?php if (isset($error['country']))echo ($error['country']);?>
										<br>
										
								<span class="t1">المنطقة:</span>
									<select class="selecting"  id="state" name="state" >
										
									</select>
									<br>
									<br>
										
<script type="text/javascript">
  function FetchState(id){
    $('#state').html('');
	
	 $.ajax({
      type:'post',
      url: 'addAdress.php',
      data : { country_id :id },
      success : function(data){
         $('#state').html(data);
      }

    })
  }
  </script>
  
										<!--<span class="t1">الرجاء نسخ رابط موقعك بعد تحديده في الخريطة</span>
										
									<a href="https://www.google.com/maps" class="gotomap">الخريطة</a>
									-->
										<div class="mt-10 mmb-10">
										<input type="text" name="description" placeholder="ادخل عنوانك ..."  value="<?php if(isset($description)) echo $description;?>" required class="single-input">
									<?php if (isset($error['description']))echo ($error['description']);?>
									</div>
								
						</div>
						
						
						
					
						</div>
									
				<br>
				<br>
				<br>
					<button class="btn btn-default btn-osx btn-lg add"  type="submit" name="sendadd">
				<span> ارسال</span>

				</button>
		
							</form>
				
						</div>
						</section>
						
					
					
					
	
	
 


    <?php include("../design/footer.php");?>