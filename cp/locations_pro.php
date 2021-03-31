
<?php
include_once('design/sidebar.php');




if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST["send"]) and empty($_GET['id']))
	{ 

	    //var_dump($_POST);
		$name=$_POST['name'];
		$level=$_POST['level'];
		$parent=$_POST['parent'];
		
		
		if(empty($name))
		{
			$error['name']=error_message("الاسم");
		}
		
		else if(!preg_match('/^[a-zA-Zأ-ي\s]*$/u',$name))
		{
			$error['name']="<span class='error-message'> يجب ان يكون احرف فقط</span>";
		} 
		
			# send to data base
			
			if(empty($error))
		   {
			   try{
				   $done=$h->locations($name,$level,$parent);
				} 
				catch(PDOException $e){
					$done= $sql . "<br>" . $e->getMessage();
				}
			}
	   
	}

if(isset($_GET['action'],$_GET['id']) and intval($_GET['id'])!=0 )
{
	$id=intval($_GET['id']);
	switch($_GET['action'])
	{
		case "delete":
				$h->delete_( "locations",$id);
				echo "<meta http-equiv='refresh' content='0;url=\"locations.php\"'/>";
				break;
		 case "edit":
				$sql="Select * from locations where  id=:id";
				$q=$con->prepare($sql);
				$q->execute(array("id"=>$id));
				$rows=$q->fetchall();
				if($q->rowcount()>0)
				{
					foreach($rows as $row)
					{
						$name=$row['name'];
						$level=$row['level'];
						$parent=$row['parent'];
					}	
					
					if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['send']) )
					{
						$name=$_POST['name'];
						$level=$_POST['level'];
						$parent=$_POST['parent'];
						
						if(empty($name))
						{
							$error['name']=error_message("الاسم");
						}
						
						else if(!preg_match('/^[a-zA-Zأ-ي\s]*$/u',$name))
						{
							$error['name']="<span class='error-message'> يجب ان يكون احرف فقط</span>";
						} 
						
						if(empty($error))
						   {
							   //var_dump($_POST);
							   try
								{
									$done=$h->locations($name,$level,$parent,$id);
								} 
								catch(PDOException $e)
								{
									$done= $sql . "<br>" . $e->getMessage();
								}
										
							}
						
					}
				}	
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
                        <div class="card">
                            <div class="card-header">
                                <h5 class="title"></h5>
                            </div>
                            <div class="card-body">
															
									<form action=' ' method='post' enctype='multipart/form-data'>
										<input type="text" class="form-control" name="id" hidden  value="<?php if(isset($id)) echo $id;?>">
										<div class="col-md-8">
										<?php if (isset($done))echo "<div class='return_message'>". $done ."</div>";?>
										<br></div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label>المكان</label>
												<input type="text" class="form-control" placeholder="إسم المكان" name='name' value="<?php if(isset($name)) echo $name;?>">
												<span class="error-message"><?php if (isset($error['name']))echo ($error['name']);?></span>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label>المستوى</label>
												<input type="number" class="form-control" name='level' value="<?php if(isset($level)) echo $level;?>" min="0">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label>يتبع</label>
											<?php 
											 if(isset($parent)){
												 $sql="select id ,name from locations ";
												 $c=$con->prepare($sql);
												 $c->execute();
												 $rows=$c->fetchall();
												if($c->rowcount()>0)
													{
														echo"<select name='parent' class='form-control' >";
														 echo"<option value='0' selected>0</option>";
														foreach($rows as $row)
														{
															$parentf = $row['id'];
															$name=$row['name'];
															
																
															if($parentf==$parent)
																echo"<option value='$parentf' selected>$parentf  $name</option>";
															else
																echo"<option value='$parentf'>$parentf  $name</option>";
														}
														echo"</select><br>";
													}
											 }
											 
											 else 
											 {
													 $sql="select id,name from locations ";
													 $c=$con->prepare($sql);
													 $c->execute();
													 $rows=$c->fetchall();
													if($c->rowcount()>0)
														{
															
															echo"<select name='parent' class='form-control' >";
															echo"<option value='0' selected>0</option>";
															
															foreach($rows as $row)
															{
																$parentf = $row['id'];
																$name=$row['name'];
																echo"<option value='$parentf' selected>$parentf  $name</option>";
															}
															echo"</select><br>";
														}
												 }
												?>
											</div>
										</div>
										<input type="submit"  value="ارسال" name="send"  class="btn-info btn"/>
									</div>
									
															
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div></form>
                       
<?php include_once('design/footer.php');?>
