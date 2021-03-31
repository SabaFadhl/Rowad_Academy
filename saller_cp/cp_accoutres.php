
<?php include_once("../design/header.php"); 
if(!isset($_SESSION['id']) and !isset($_SESSION['role']))
	{
		header("location:index.php");
		exit();
	}	
if(isset($_GET['id']) )
{
	var_dump($_SESSION);
	$id=$_GET['id'];
	echo $h->order_tracking($id);
	//echo "<meta http-equiv='refresh' content='0;url='cp_orders.php'/>";
}

?>

								 <h2 class="ccc"></h2>
								 
        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row csc">
				 
				   <div class=" col-lg-2 text-center">
				   </div>
					
                    <div class=" col-lg-8 text-center">
                       
                           
							

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
										<th>هل اكتمل</th>
								
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php  $s->sellerSales($_SESSION['id'],2);?>
                                     
                                </tbody>
                            </table>
                        </div>
							 
                    </div>
						
                   
                </div>
				
            </div>
        </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->



    <?php include("../design/footer.php");?>