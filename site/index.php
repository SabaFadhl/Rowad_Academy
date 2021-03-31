
    <?php include("../design/header.php");
	
	ob_start();
	//session_start();
	//require_once('../db/db.php'); 
	//include_once ("../db/callHerfClass.php");
	//echo "<h1>".$_COOKIE['email']."</h1>";
	//var_dump($_SESSION);


	?>
	
	 <section id="carousel">
    	<div id="carousel-home" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-home" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-home" data-slide-to="1"></li>
                <li data-target="#carousel-home" data-slide-to="2"></li>
                <li data-target="#carousel-home" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <?php

                   $h->displaySlides( );

                ?>
               
            </div>
            <a class="carousel-control-prev" href="#carousel-home" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-home" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>

	<div class="container dirocont">
	<div><h2 class="pro"> العروض</h2></div>
	
	
		<div class="row crow ">
		
	<?php $h->displayOffers("home");?>
			<!-- show-->		
			<div class="col-md-3 product-grid pad" style="height:425px" title="عرض المزيد من العروض ">
				<div class="image">
					<a href="showAll.php?pro=offers">
						
						<style>
						.mmore{
	 text-align: center;
    font-size: 16em;
	color: #008aef !important;
						}
						.mmoretxt{
							text-align: center;
    color: black;
    font-size: 1.5em;
    padding-top: 5%;
						}
						</style>
							<div class=""><i class="fa  fa-arrow-circle-left w-100 mmore"></i></div>
					
						<div class="mmoretxt">عرض الكل</div>
					</a>
				</div>
				<h5 class="text-center"></h5>
					<h5 class="text-center">
				 <!-- <span class="fa fa-star checked" id="star"></span>
					<span class="fa fa-star checked" id="star"></span>
					<span class="fa fa-star checked" id="star"></span>
					<span class="fa fa-star" id="star"></span>
					<span class="fa fa-star" id="star"></span>-->
					</span></h5>
				<h5 class="text-center"></h5>
				
			</div>
			 
<!-- end show-->
		
		</div>

	</div>
 <?php include("../design/footer.php");?>