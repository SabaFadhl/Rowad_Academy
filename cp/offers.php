<?php
include_once('design/sidebar.php');

	
if(isset($_GET['action'],$_GET['id']) and intval($_GET['id'])!=0 )
	{
		$id=intval($_GET['id']);
		switch($_GET['action']){
			case "delete":
					$h->delete_( "offers",$id) ;
					break;
			default:echo "Error";break;
		}
	}

?>


        <div class="main-panel">
            <?php
				include_once('design/navbar.php');
		    ?>
			<div class="panel-header panel-header-sm">
            </div>
           <div class="content">
                <div class="row">
				 <div class="col-md-8">
				 
				 
				 
			<?php 
				echo "<button type='button'  class='btn btn-info btn-lg ' id='ins'><a href='offers_pro.php' style ='color:white;'>اضافة عرض جديد</a></button>";
							# -- Building table
								$sql="Select * from offers ";
								$q=$con->prepare($sql);
								$q->execute();
								$rows=$q->fetchall();
								// echo $q->rowcount();
								if($q->rowcount()>0){
								//var_dump($rows);
									echo " <div class='content'><div class='row'><div class='col-md-12'><div class='card'><div class='card-header'><h4 class='card-title'>العروض</h4></div><div class='card-body'><div class='table-responsive'><table class='table'>";
										echo " <thead class=' text-primary top_table2'>";
										echo "<th class='text-right'>المعرف</th>";
										echo "<th class='text-right'>رقم المنتج</th>";
										echo "<th class='text-right'>البداية</th>";
										echo "<th class='text-right'>النهاية</th>";
										echo "<th class='text-right'>السعر لجديد</th>";
										echo "<th colspan=2 class='text-right'>التحكم</th>";
										echo "</tr>";
										foreach($rows as $row){
											$id=$row['id'];
											$products_id=$row['products_id'];
											$start_date=$row['start_date'];
											$end_date=$row['end_date'];
											$new_price=$row['new_price'];
											
											echo "<tbody>";
											echo "<td>$id</td>";
											echo "<td>$products_id</td>";
											echo "<td>$start_date</td>";
											echo "<td>$end_date</td>";
											echo "<td>$new_price</td>";
											
											
											echo "<td><a href='?action=delete&id=$id' onclick='return confirm(\" هل انت متأكد من حذف العرض رقم   $id ؟\")' title='حذف'><i class='fa fa-trash' style='font-size:2em;color:#dc3545 !important;'></i></a></td>";
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