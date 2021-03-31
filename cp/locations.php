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
				 echo "<button type='button'  class='btn btn-info btn-lg ' id='ins'><a href='locations_pro.php?action=insert' style ='color:white;'>اضافة مكان جديد</a></button>";
							# -- Building table
								$sql="Select * from locations order by id desc ";
								$q=$con->prepare($sql);
								$q->execute();
								$rows=$q->fetchall();
								// echo $q->rowcount();
								if($q->rowcount()>0){
								//var_dump($rows);
									echo " <div class='content'><div class='row'><div class='col-md-12'><div class='card'><div class='card-header'><h4 class='card-title'>المدن</h4></div><div class='card-body'><div class='table-responsive'><table class='table'>";
										echo " <thead class=' text-primary top_table2'>";
										echo "<th class='text-right'>المعرف</th>";
										echo "<th class='text-right'>اسم المحافظة</th>";
										echo "<th class='text-right'>المستوى</th>";
										echo "<th class='text-right'>تتبع</th>";
										echo "<th colspan=2 class='text-right'>التحكم</th>";
										echo "</thead>";
										foreach($rows as $row){
											//var_dump($rows);
											$id=$row['id'];//[0]
											$name=$row['name'];//[1]
											$level=$row['level'];
											$parent=$row['parent'];
											
											echo "<tbody>";
											echo "<td>$id</td>";
											echo "<td>$name</td>";
											echo "<td>$level</td>";
											$sql="Select l.name
												from locations l
												inner join locations o 
												where :parent=l.id";
											$q=$con->prepare($sql);
											$q->execute(array("parent"=>$parent));
											$rows=$q->fetchall();
											if($q->rowcount()>0)
											{
												echo "<td>".$rows[0]['name']."</td>";
											}
											else echo "<td> No </td>";
										  
											
											
											echo "<td><a href='locations_pro.php?action=edit&id=$id' title='تعديل'><i class='fa fa-edit' style='font-size:2em; color:#28a745 !important;'></i></a></td>";
											echo "<td><a href='locations_pro.php?action=delete&id=$id' onclick='return confirm(\" هل انت متأكد من حذف   $name ؟\")' title='حذف'><i class='fa fa-trash' style='font-size:2em;color:#dc3545 !important;'></i></a></td>";
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