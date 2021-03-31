<!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute bg-primary fixed-top">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <!--<form style="direction:  ltr;">
                            <div class="input-group no-border">
                                <input type="text" value="" class="form-control" placeholder="بحث...">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                                </span>
                            </div>
                        </form>-->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">
                                    <i class="fa fa-sign-out media-4_sound-wave"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">الحالة</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
							 <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="now-ui-icons fa fa-globe"></i>
									
									<?php 
										ini_set('display_errors', '0');
										if(isset($_SESSION['admin_id']))
										{
											$sql="Select seen from notifications where users_id=:id  order by id desc limit 6";
												$q=$con->prepare($sql);
												$q->execute(array("id"=>$_SESSION['admin_id']));
												$rows=$q->fetchall();
												if(!empty($rows))
												{
													$num=0;
													foreach($rows as $row)
													{
														if($row['seen']==0)
														$num++;
													}
													if($num>0)
													 echo "<span id='checkout_items' class='checkout_items notiitem' style='display: -webkit-box;
																															display: -moz-box;
																															display: -ms-flexbox;
																															display: -webkit-flex;
																															display: flex;
																															flex-direction: column;
																															justify-content: center;
																															align-items: center;
																															position: absolute;
																															top: 4px;
																															left: 7px;
																															width: 17px;
																															height: 17px;
																															border-radius: 53%;
																															background: #ff2849;
																															font-size: 12px;
																															color: #FFFFFF;' >$num</span>";
																																																						
																																										}
										}
										
									?>
									
                                    <p>
                                        <span class="d-lg-none d-md-block">بعض الأحداث</span>
                                    </p>
                                </a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
							<?php
								if(isset($_SESSION['admin_id']))
								{
									//var_dump($_SESSION);
									 $sqln="Select * from notifications where users_id=:id order by id desc limit 6";
										$qn=$con->prepare($sqln);
										$qn->execute(array("id"=>$_SESSION['admin_id']));
										$nots=$qn->fetchall();
										if($qn->rowcount()>0)
										{
											//var_dump($_SESSION);
											foreach($nots as $not)
											{
												
												$idv=$not['id'];
												$url=$not['url'];
												$content=$not['content'];
												$seen=$not['seen'];
												if($seen==0)
												{
													echo " <a class='dropdown-item' href='$url&action=seen&nid=$idv'>$content</a>";//?action=seen&id=$id
												}
												else
												{
													echo " <a style='color:brown' class='dropdown-item' href='$url'>$content</a>";
												}
												
											}
											echo "<div class='dropdown-divider '></div><a class='dropdown-item' href='#'>عرض الكل</a>
													";
											
										}
										else echo "<a class='dropdown-item'  href='#'>لايوجد اشعارات</a>
													";
								}
								?>
								</div>
								</li>
                            <!--<li class="nav-item">
                                <a class="nav-link" href="#pablo">
                                    <i class="now-ui-icons users_single-02"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">الحساب</span>
                                    </p>
                                </a>
                            </li>-->
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->