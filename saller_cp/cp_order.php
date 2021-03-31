
<?php include_once("../design/header.php"); 
if(!isset($_SESSION['id']) and !isset($_SESSION['role']))
	{
		header("location:index.php");
		exit();
	}	
if(isset($_GET['id']) and !isset($_GET['action']) )
{
	//var_dump($_SESSION);
	$id=$_GET['id'];
	           $h->order_tracking($id);
			  echo '<script>alert("الطلب قيد التجهيز")</script>';
			  
	//echo "<meta http-equiv='refresh' content='0;url='cp_orders.php'/>";
}
if(isset($_GET['nid']) and isset($_GET['action']) )
{
	$id=$_GET['nid'];
	if($_GET['action']=='seen')
	{
		//var_dump($id);
		$sql="update notifications set seen =1 where id =:id";
		$q=$con->prepare($sql);
		$q->execute(array("id"=>$id));
		echo "<meta http-equiv='refresh' content='0;url=\"../saller_cp/cp_order.php\"'/>";
	}
}
?>

								 <h2 class="ccc"></h2>
								 
        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row csc">
				 
				   <div class=" col-lg-3 text-center">
				   </div>
					
                    <div class=" col-lg-6 text-center">
                       
                           
							

                        <div class="cart-table clearfix">
					
                      
                            <table class="table table-responsive">
								
                                <thead >
								<tr class="heca"> 
                                   
                                        <th>اسم المنتج</th>
                                        <th>صورة المنتج</th>
                                       <th>السعر</th>
                                        <th>الكمية</th>
										<th>تخصيص المنتج</th>
											<th>تاريخ الطلب</th>
										<th></th>
								
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php  $s->sellerSales($_SESSION['id'],1);?>
                                     
                                </tbody>
                            </table>
                        </div>
							 
                    </div>
						
                   	   <div class=" col-lg-2 text-center">
				   </div>
				   
                </div>
				
            </div>
        </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->



    <?php include("../design/footer.php");?>