<?php
include_once('design/sidebar.php');

ob_start();
require_once('../db/db.php');
require_once('../db/callTaskClass.php');
// سيشن
	$sql="select * from users where id=1";
	$q=$con->prepare($sql);
	$q->execute();
	$rows=$q->fetchall();
	if($q->rowcount()>0){
					foreach($rows as $row)
				{
					//$name=$row['username'];
					
					
				}
	}




if(isset($_GET['action'],$_GET['id']) and intval($_GET['id'])!=0 )
{
	$id=intval($_GET['id']);
	switch($_GET['action'])
	{
		case "delete":
				$h->delete_( "addresses",$id);
				echo "<meta http-equiv='refresh' content='0;url=\"addresses.php\"'/>";
				break;
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
				//echo "<button type='button'  class='btn btn-info btn-lg ' id='ins'><a href='categories_pro.php?action=insert' style ='color:white;'>اضافة </a></button>";
							# -- Building table
								$sql="Select * from addresses order by id desc";
								$q=$con->prepare($sql);
								$q->execute();
								$rows=$q->fetchall();
								// echo $q->rowcount();
								if($q->rowcount()>0){
								//var_dump($rows);
										echo " <div class='content'><div class='row'><div class='col-md-12'><div class='card'><div class='card-header'><h4 class='card-title'>العناوين</h4></div><div class='card-body'><div class='table-responsive'><table class='table'>";
										echo " <thead class=' text-primary top_table2'>";
										echo "<th class='text-right'>المعرف</th>";
										echo "<th class='text-right'>الاسم الاول</th>";
										echo "<th class='text-right'>اللقب</th>";
										echo "<th class='text-right'> الهاتف</th>";
										echo "<th class='text-right'>نوع العنوان</th>";
										//echo "<th class='text-right'>  الخريطة</th>";
										echo "<th class='text-right'>الموقع</th>";
										echo "<th class='text-right'>المستخدم</th>";
										//echo "<th class='text-right'>رقم الطلب</th>";
										echo "<th class='text-right'>الوصف</th>";
										echo "<th colspan=2 class='text-right'>التحكم</th>";
										echo "</thead>";
										foreach($rows as $row){
											$id=$row['id'];//[0]
											$fname=$row['first_name'];//[1]
											$lname=$row['last_name'];//[1]
											$phone=$row['phone'];
											$type=$row['type'];
											//$location_map=$row['location_map'];
											$location_id=$row['locations_id'];
											$user_id=$row['users_id'];
											//$order_id=$row['orders_id'];
											$description=$row['description'];
											
											echo "<tbody>";
											echo "<tr>";
											echo "<td>$id</td>";
											echo "<td>$fname</td>";
											echo "<td>$lname</td>";
											echo "<td>$phone</td>";
											echo "<td>".locationType($type)."</td>";
											//echo "<td>$location_map</td>";
											$sql="Select name
												from locations
												where id=:id";
											$q=$con->prepare($sql);
											$q->execute(array("id"=>$location_id));
											$rows=$q->fetchall();
											if($q->rowcount()>0)
											{
												echo "<td>".$rows[0]['name']."</td>";
											}
											
											echo "<td>$user_id</td>";
											//echo "<td>$order_id</td>";
											echo "<td>$description</td>";
											
											
											
											//echo "<td><a href='categories_pro.php?action=edit&id=$id'><i class='fa fa-edit' style='font-size:2em; color:#b37700;'></i></a></td>";
											echo "<td><a href='?action=delete&id=$id' title='حذف' onclick='return confirm(\" هل انت متأكد من حذف العنوان  $fname ؟\")'><i class='fa fa-trash' style='font-size:2em;color:#dc3545 !important;'></i></a></td>";
											echo "</tr>";
											echo "</tbody>";
										}
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
