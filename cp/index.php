<link href="css/icon.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/ar.css" rel="stylesheet" class="lang_css arabic">
<?php
include_once('design/sidebar.php');
// unlink();
?>
<div class="main-panel">
    <?phpinclude_once('design/navbar.php');?>
    <div class="content">
        <div class="row">
           
              <!--Start Main content container-->
        <div class="main_content_container">
            <div class="main_container  main_menu_open">
                
                <div class="page_content">
                    <div class="page_content">
                        <div class="quick_links text-center">
                           
                            <a href="../site/index.php" style="background-color: #c0392b">
                                <h4>استعراض الموقع</h4>
                            </a>
                         
                        </div>
                        <div class="home_statics text-center">
                            <h1 class="heading_title">احصائيات عامة للموقع</h1>

                            <div style="background-color: #9b59b6">
                                <span class="bring_right glyphicon glyphicon-home"></span>

                                <h3>زيارات الموقع</h3>

                                <p class="h4">55</p>
                            </div>

                            <div style="background-color: #34495e">
                                <span class="bring_right glyphicon glyphicon-phone-alt"></span>

                                <h3>المتصلين الان</h3>

                                <p class="h4">55</p>
                            </div>
                            <div style="background-color: #00adbc">
                                <span class="bring_right glyphicon glyphicon-user"></span>

                                <h3>عدد الاعضاء</h3>

                                <p class="h4">55</p>
                            </div>
                            <div style="background-color: #f39c12">
                                <span class="bring_right glyphicon glyphicon-pencil"></span>

                                <h3>عدد المقالات</h3>

                                <p class="h4">55</p>
                            </div>
                            <div style="background-color: #2ecc71">
                                <span class="bring_right glyphicon glyphicon-calendar"></span>

                                <h3>عمر الموقع بالايام</h3>

                                <p class="h4">55</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/End Main content container-->   
            </div>
        
    </div>
 </div>          
<?php
include_once('design/footer.php');
?>