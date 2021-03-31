<?php
include_once('design/sidebar.php');

// سيشن
	$sql="select * from users where id=1";
	$q=$con->prepare($sql);
	$q->execute();
	$rows=$q->fetchall();
	if($q->rowcount()>0){
		foreach($rows as $row)
		{
			$name=$row['first_name'];
		}
	}

if(isset($_GET['role']) and intval($_GET['role'])!=0)
{
	$role=intval($_GET['role']);
	$title=$_GET['name'];
}
else
{
	$name=$_GET['name'];
}//var_dump($_GET);
if(isset($_GET['nid']) and isset($_GET['action']) )
{
	$id=$_GET['nid'];
	if($_GET['action']=='seen')
	{
		//var_dump($id);
		$sql="update notifications set seen =1 where id =:id";
		$q=$con->prepare($sql);
		$q->execute(array("id"=>$id));
		
		//echo "<meta http-equiv='refresh' content='0;url=\"../cp/users.php\"'/>";
	}
}
?>
 <div class="main-panel">
	<?php
		include_once('design/navbar.php');
	?>

	<div class="content">
		<div class="row">
			<div class="col-md-8">
	<?php 
		echo "<button type='button'  class='btn btn-info btn-lg ' id='ins'><a href='user_pro.php?action=insert&role=$role&name=$title' style ='color:white;'>اضافة </a></button>";
		# -- Building table
			$sql="Select * from users  order by id desc";
			$q=$con->prepare($sql);
			$q->execute();
			$rows=$q->fetchall();
			// echo $q->rowcount();
			if($q->rowcount()>0){
			//var_dump($rows);
				echo " <div class='content'><div class='row'><div class='col-md-12'><div class='card' style='width: fit-content;'><div class='card-header'><h4 class='card-title'>$title</h4></div><div class='card-body'><div class='table-responsive'><table class='table'>";
					echo " <thead class=' text-primary top_table2'>";
					echo "<th class='text-right'>المعرف</th>";
					//echo "<th class='text-right'>اسم المستخدم</th>";
					echo "<th class='text-right'>الاسم الاول </th>";
					echo "<th class='text-right'>اللقب</th>";
					echo "<th class='text-right'>الصلاحية</th>";
					echo "<th class='text-right'>الايميل</th>";
					echo "<th class='text-right'>البروفايل</th>";
					//echo "<th class='text-right'>كلمة السر</th>";
					echo "<th class='text-right'>الهاتف</th>";
					echo "<th class='text-right'>تاريخ الاضافة</th>";
					echo "<th colspan=3 class='text-center' >التحكم</th>";
					echo "</thead>";
					echo "<tbody>";
					foreach($rows as $row){
						$id=$row['id'];//[0]
						//$name=$row['username'];//[1]
						$fname=$row['first_name'];//[1]
						$lname=$row['last_name'];//[1]
						if($row['role']==1) $role1='مدير';
						else if($row['role']==2) $role1='مشرف';
						else if($row['role']==3) $role1='محرر';
						else if($row['role']==4) $role1='مستخدم';
						$email=$row['email'];//[1]
						$profile=$row['image_name'];
						$password=$row['password'];
						$phone=$row['phone'];
						$addDate=$row['add_date'];
						
						
						echo "<tr>";
						echo "<td>$id</td>";
						//echo "<td>$name</td>";
						echo "<td>$fname</td>";
						echo "<td>$lname</td>";
						echo "<td>$role1</td>";
						echo "<td>$email</td>";
						echo "<td><img style='width: 60px; height: 40px; float:center;' src='../upload/$profile'></td>";
						//echo "<td>$password</td>";
						echo "<td>$phone</td>";
						echo "<td>$addDate</td>";
						
						if($row['activation']==0)
							echo "<td><a href='user_pro.php?action=active&id=$id&role=$role&name=$title' title=''><i class='fa fa-check' style='font-size:2em;color:#007bff !important;'></i></a></td>";
						else
							echo "<td><a href='user_pro.php?action=unactive&id=$id&role=$role&name=$title' title=''><i class='fa fa-close' style='font-size:2em;'></i></a></td>";
						
						echo "<td><a href='user_pro.php?action=edit&id=$id&role=$role&name=$title' title='تعديل'><i class='fa fa-edit' style='font-size:2em; color:#28a745 !important;'></i></a></td>";
						echo "<td><a href='user_pro.php?action=delete&id=$id&role=$role&name=$title' onclick='return confirm(\" هل انت متأكد من حذف المستخدم $fname  ؟\")'><i class='fa fa-trash' style='font-size:2em;color:#dc3545 !important;'></i></a></td>";
						echo "</tr>";
						
					}
						echo "</tbody>";
						echo "</table>";
						echo "</div></div></div></div></div></div>";
						
						
							
					}
					else
					{
						echo "Empty";
					}
?>								
		
		

		
		</div>
		</div>
	</div>
</div>
                       <?php
include_once('design/footer.php');
?>