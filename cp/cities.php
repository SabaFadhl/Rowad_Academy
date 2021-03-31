<?php
include_once('design/sidebar.php');

function html_header(	){
echo ' <div class="panel-header panel-header-sm">
            </div>';
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
				//echo "<button type='button'  class='btn btn-info btn-lg ' id='ins'><a href='?action=insert' style ='color:white;'>اضافة صنف جديد</a></button>";
							# -- Building table
								$sql="Select * from locations ";
								$q=$con->prepare($sql);
								$q->execute();
								$rows=$q->fetchall();
								// echo $q->rowcount();
								if($q->rowcount()>0){
								//var_dump($rows);
									echo " <div class='content'><div class='row'><div class='col-md-12'><div class='card'><div class='card-header'><h4 class='card-title'>المدن</h4></div><div class='card-body'><div class='table-responsive'><table class='table'>";
										echo " <thead class=' text-primary'>";
										echo "<th class='text-right'>المعرف</th>";
										echo "<th class='text-right'>اسم المحافظة</th>";
										echo "<th class='text-right'>المستوى</th>";
										echo "<th class='text-right'>تتبع</th>";
										echo "<th colspan=2 class='text-right'>التحكم</th>";
										echo "</thead>";
										foreach($rows as $row){
											$id=$row['id'];//[0]
											$name=$row['name'];//[1]
											$level=$row['level'];
											$parent=$row['parent'];
											
											echo "<tbody>";
											echo "<td>$id</td>";
											echo "<td>$name</td>";
											echo "<td>$level</td>";
											echo "<td>$parent</td>";
											
											echo "<td><a href='?action=edit&id=$id' title='تعديل'><i class='fa fa-edit' style='font-size:2em; color:#b37700;'></i></a></td>";
											echo "<td><a href='?action=delete&id=$id' title='حذف' onclick='return confirm(\" هل انت متأكد من حذف الصنف  $name ؟\")'><i class='fa fa-trash' style='font-size:2em;color:black;'></i></a></td>";
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