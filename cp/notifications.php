<?php
include_once('design/sidebar.php');
?>
        <div class="main-panel">
            <?php
				include_once('design/navbar.php');
		    ?>
            <div class="panel-header">
                <div class="header text-center">
                    <h2 class="title">الإخطارات</h2>
                </div>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">تصميم الإخطارات</h4>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info">
                                    <span>هذا إخطار عادي.</span>
                                </div>
                                <div class="alert alert-info">
                                    <button type="button" aria-hidden="true" class="close">
                                        <i class="now-ui-icons ui-1_simple-remove"></i>
                                    </button>
                                    <span>هذا إخطار مع زر إغلاق.</span>
                                </div>
                                <div class="alert alert-info alert-with-icon" data-notify="container">
                                    <button type="button" aria-hidden="true" class="close">
                                        <i class="now-ui-icons ui-1_simple-remove"></i>
                                    </button>
                                    <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
                                    <span data-notify="message">هذا إخطار مع زر إغلاق وأيقونة.</span>
                                </div>
                                <div class="alert alert-info alert-with-icon" data-notify="container">
                                    <button type="button" aria-hidden="true" class="close">
                                        <i class="now-ui-icons ui-1_simple-remove"></i>
                                    </button>
                                    <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
                                    <span data-notify="message">
هذا إخطار مع زر الإغلاق والأيقونة والعديد من الخطوط. يمكنك ملاحظة أن الأيقونة وزر الإغلاق دائمًا محاذيًا رأسيًا. هذا هو إخطار جميل. لذلك لا داعي للقلق حول التصميم.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">حالات الإخطار</h4>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-primary">
                                    <button type="button" aria-hidden="true" class="close">
                                        <i class="now-ui-icons ui-1_simple-remove"></i>
                                    </button>
                                    <span>
                                        <b> رئيسي - </b> هذا هو إخطار منتظم مع ".alert-primary"</span>
                                </div>
                                <div class="alert alert-info">
                                    <button type="button" aria-hidden="true" class="close">
                                        <i class="now-ui-icons ui-1_simple-remove"></i>
                                    </button>
                                    <span>
                                        <b> معلومة - </b> هذا هو إخطار منتظم مع ".alert-info"</span>
                                </div>
                                <div class="alert alert-success">
                                    <button type="button" aria-hidden="true" class="close">
                                        <i class="now-ui-icons ui-1_simple-remove"></i>
                                    </button>
                                    <span>
                                        <b> نجاح - </b> هذا هو إخطار منتظم مع ".alert-success"</span>
                                </div>
                                <div class="alert alert-warning">
                                    <button type="button" aria-hidden="true" class="close">
                                        <i class="now-ui-icons ui-1_simple-remove"></i>
                                    </button>
                                    <span>
                                        <b> تحذير - </b> هذا هو إخطار منتظم مع ".alert-warning"</span>
                                </div>
                                <div class="alert alert-danger">
                                    <button type="button" aria-hidden="true" class="close">
                                        <i class="now-ui-icons ui-1_simple-remove"></i>
                                    </button>
                                    <span>
                                        <b> خطر - </b> هذا هو إخطار منتظم مع ".alert-danger"</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="places-buttons">
                                    <div class="row">
                                        <div class="col-md-6 ml-auto mr-auto text-center">
                                            <h4 class="card-title">
                                                أماكن الإخطارات
                                                <p class="category">إضغط على الأزرار لرؤية الإخطارات</p>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8 ml-auto mr-auto">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <button class="btn btn-primary btn-block" onclick="demo.showNotification('top','left')">أعلى اليسار</button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-primary btn-block" onclick="demo.showNotification('top','center')">أعلى الوسط</button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-primary btn-block" onclick="demo.showNotification('top','right')">أعلى اليمين</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8 ml-auto mr-auto">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <button class="btn btn-primary btn-block" onclick="demo.showNotification('bottom','left')">أسفل اليسار</button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-primary btn-block" onclick="demo.showNotification('bottom','center')">أسفل الوسط</button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-primary btn-block" onclick="demo.showNotification('bottom','right')">أسفل اليمين</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
include_once('design/footer.php');
?>