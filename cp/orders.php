<?php
include_once('design/sidebar.php');

// سيشن
if(isset($_GET['role']) and intval($_GET['role'])!=0)
{
	$role=intval($_GET['role']);
	$name=$_GET['name'];
}
else
{
	$role=0;
	$name=$_GET['name'];
}

?>
        <div class="main-panel">
            <?php
				include_once('design/navbar.php');
		    ?>
            <div class="content">
                <div class="row">
				 <div class="col-md-12">
				 
				 
				 
			<?php 
				//echo "<button type='button'  class='btn btn-info btn-lg ' id='ins'><a href='?action=insert' style ='color:white;'>اضافة صنف جديد</a></button>";
							# -- Building table
								if($role==0)
								{
									$sql="Select * from orders  ";
								}
								else 
								{
									$sql="Select * from orders where role=:role ";
								}
								$q=$con->prepare($sql);
								$q->execute(array("role"=>$role));
								$rows=$q->fetchall();
								// echo $q->rowcount();
								if($q->rowcount()>0){
								//var_dump($rows);
									echo " <div class='content'><div class='row'><div class='col-md-12'><div class='card'><div class='card-header'><h4 class='card-title'>$name</h4></div><div class='card-body'><div class='table-responsive'><table class='table'>";
										echo " <thead class=' text-primary top_table'>";
										echo "<th class='text-right'>المعرف</th>";
										echo "<th class='text-right'> المستخدم</th>";
										echo "<th class='text-right'> المنتج </th>";
										echo "<th class='text-right'>تاريخ الاضافة</th>";
										echo "<th class='text-right'>تاريخ التوصيل</th>";
										echo "<th class='text-right'>تاريخ البيع</th>";
										echo "<th colspan=2 class='text-right'>التحكم</th>";
										echo "</thead>";
										foreach($rows as $row){
											$id=$row['id'];//[0]
											$user=$row['users_id'];//[1]
											$product=$row['products_id'];//[1]
											$add_date=$row['add_date'];//[1]
											$date_deliver=$row['date_deliver'];//[1]
											$sale_date=$row['sale_date'];//[1]
											
											
											echo "<tbody>";
											echo "<tr>";
											echo "<td>$id</td>";
											echo "<td>$user</td>";
											echo "<td>$product</td>";
											echo "<td>$add_date</td>";
											echo "<td>$date_deliver</td>";
											echo "<td>$sale_date</td>";
											
											
											
											
											echo "<td><a href='orders_pro.php?action=display&id=$id&name=$name'  onclick='' title='عرض'><i class='fa fa-eye' style='font-size:2em;color:#363636 !important'></i></a></td>";
											echo "<td><a href='orders_pro.php?action=delete&id=$id&name=$name' onclick='return confirm(\" هل أنت متأكد من خذف الطلب $id ؟\")' title='حذف'><i class='fa fa-trash' style='font-size:2em;color:#de3545 !important'></i></a></td>";
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