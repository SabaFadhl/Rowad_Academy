
<?php include_once("../design/header.php"); 
if(!isset($_SESSION['id']) and !isset($_SESSION['role']))
	{
		header("location:../site/index.php");
		exit();
	}
	//var_dump($_SESSION['id']);
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
										<th> تاريخ البيع</th>
										<th> حالة الطلب</th>
										<th></th>
								
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  $s->sellerSales($_SESSION['id'],4);?>
                                    
                                    </tr>
                                </tbody>
                            </table>
                        </div>
							 
                    </div>
						
                    <div class=" col-lg-3 text-center">
				   </div> 
				   
                </div>
				
            </div>
        </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->



    <?php include("../design/footer.php");?>