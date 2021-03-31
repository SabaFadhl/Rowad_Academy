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
								$sql="Select * from products ";
								$q=$con->prepare($sql);
								$q->execute();
								$rows=$q->fetchall();
								// echo $q->rowcount();
								if($q->rowcount()>0){
								//var_dump($rows);
									echo " <div class='content'><div class='row'><div class='col-md-12'><div class='card'><div class='card-header'><h4 class='card-title'>المنتجات</h4></div><div class='card-body'><div class='table-responsive'><table class='table'>";
										echo " <thead class=' text-primary top_table2'>";
										echo "<th class='text-right'>المعرف</th>";
										echo "<th class='text-right'>رقم المستخدم</th>";
										echo "<th class='text-right'>الاسم</th>";
										echo "<th class='text-right'>السعر</th>";
										echo "<th class='text-right'>تاريخ الاضافة</th>";
										echo "<th class='text-right'>صورة المنتج</th>";
										//echo "<th class='text-right'>صورة2</th>";
										//echo "<th class='text-right'>صورة3</th>";
										//echo "<th class='text-right'>صورة4</th>";
										echo "<th colspan=3 class='text-right' >التحكم</th>";
										echo "</tr>";
										//var_dump($rows );
										foreach($rows as $row){
											$id=$row['id'];
											$act=$row['activation'];
											$users_id=$row['users_id'];
												
											
											$name=$row['name'];
											$description=$row['description'];
											$price=$row['price'];
											$add_date=$row['add_date'];
												
												$images=['no image','no image','no image','no image'];
												$c=0;
												$sql="Select id,image_name from images where products_id=:id ";
												$a=$con->prepare($sql);
												$a->execute(array("id"=>$id));
												$rows=$a->fetchall();
												if($a->rowcount()>0)
													{
														foreach($rows as $row){
														$images[$c]=$row['image_name'];
														$c++;
													}
												}
											echo "<tbody>";
											echo "<td>$id</td>";
											echo "<td>$users_id</td>";
											echo "<td>$name</td>";
											// echo "<td>$description</td>";
											echo "<td>$price</td>";
											echo "<td>$add_date</td>";
											echo "<td><img style='width: 60px; height: 40px; float:center;' src='../upload/$images[0]'></td>";
											//echo "<td><img style='width: 60px; height: 40px; float:center;' src='../upload/$images[1]'></td>";
											//echo "<td><img style='width: 60px; height: 40px; float:center;' src='../upload/$images[2]'></td>";
											//echo "<td><img style='width: 60px; height: 40px; float:center;' src='../upload/$images[3]'></td>";
											
											
											if($act==0)
												echo "<td><a href='?action=active&id=$id'><i class='fa fa-check' style='font-size:2em;color:#007bff !important;'title='عرض'></i></a></td>";
											else
												echo "<td><a href='?action=unactive&id=$id'><i class='fa fa-close' style='font-size:2em;color:red;' style='font-size:2em;color:#de3545 !important'title='عرض'></i></a></td>";
											echo "<td><a href='products_pro.php?action=display&id=$id&name=$name' onclick=''><i class='fa fa-eye' style='font-size:2em;color:#363636 !important'title='عرض'></i></a></td>";
											echo "<td><a href='offers_pro.php?action=offer&id=$id'  title='اضافة عرض'><i class='fa fa-plus' style='font-size:2em;color:#dc3545 !important;'></i></a></td>";
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