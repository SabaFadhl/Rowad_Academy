<?php
include_once('design/sidebar.php');

if(isset($_GET['action'],$_GET['id']) and intval($_GET['id'])!=0 )
	{
		$id=intval($_GET['id']);
		switch($_GET['action']){
			case "delete":
					$h->delete_( "messages",$id) ;
					//echo "<meta http-equiv='refresh' content='0;url=\"categories.php\"'/>";
					break;
			break;
			default:echo "Error";break;
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
				//echo "<button type='button'  class='btn btn-info btn-lg ' id='ins'><a href='?action=insert' style ='color:white;'>اضافة صنف جديد</a></button>";
							# -- Building table
								$sql="Select * from messages ";
								$q=$con->prepare($sql);
								$q->execute();
								$rows=$q->fetchall();
								// echo $q->rowcount();
								if($q->rowcount()>0){
								//var_dump($rows);
									echo " <div class='content'><div class='row'><div class='col-md-12'><div class='card'><div class='card-header'><h4 class='card-title'>الرسائل</h4></div><div class='card-body'><div class='table-responsive'><table class='table'>";
										echo " <thead class=' text-primary top_table2'>";
										echo "<th class='text-right'>المعرف</th>";
										echo "<th class='text-right'>الرسالة</th>";
										echo "<th class='text-right'>المستخدم</th>";
										echo "<th colspan=2 class='text-right'>التحكم</th>";
										echo "</tr>";
										foreach($rows as $row){
											$id=$row['id'];//[0]
											$message=$row['message'];//[1]
											$users_id=$row['users_id'];
											
											echo "<tbody>";
											echo "<td>$id</td>";
											echo "<td>$message</td>";
											echo "<td>$users_id</td>";
											
											
											echo "<td><a href='?action=delete&id=$id' onclick='return confirm(\" هل انت متأكد من حذف الرسالة رقم   $id ؟\")' title='حذف'><i class='fa fa-trash' style='font-size:2em;color:#dc3545 !important;'></i></a></td>";
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