<?php
include_once('design/sidebar.php');
$sql="select * from slides";
		$q=$con->prepare($sql);
		$q->execute(array());
		$rows=$q->fetchall();
		$i=0;
		if($q->rowcount()>0)
		{
			$name1=$rows[0]['name'];
			$name2=$rows[1]['name'];
			$name3=$rows[2]['name'];
			$name4=$rows[3]['name'];
		}

if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST["send"]))
	{
		$newname[0]=$name1;
		$newname[1]=$name2;
		$newname[2]=$name3;
		$newname[3]=$name4;
		for($i=0;$i<=3;$i++)
	{
		$namef=$_FILES["img$i"]['name'];
		$sizef=$_FILES["img$i"]['size'];
		$typef=$_FILES["img$i"]['type'];
		$tmp_namef=$_FILES["img$i"]['tmp_name'];
		$errorf=$_FILES["img$i"]['error'];
		
		//echo $namef;
		$mytypes=array("jpg","png","gif","jpeg","jfif");
		$ex=explode(".",$namef);
		$mytype=strtolower(end($ex));
		
		if(!empty($namef))
		{
			if(in_array($mytype,$mytypes))
			{
				if($sizef <=2000000)
				{
					//$newname[$i] = md5($namef.date("Ymdhis",time())).".".$mytype;
					$na=$newname[$i];
				move_uploaded_file($tmp_namef,"../upload/$na");
				}	
				else
				{
				  $error["img$i"]="<span class='error-message'>$i حجم الملف اكبر من اللازم -_-  </span>";
				}
			}
			else
			{
				  $error["img$i"]="<span class='error-message'>$i يجب ان يكون نوع الملف صورة -_-  </span>";
			}
		}

		
	}
	if(empty( $error))
		{
			echo "donnee";
			$h->editSlides($newname[0],$newname[1],$newname[2],$newname[3]);
			//echo "editSlides($newname[0],$newname[1],$newname[2],$newname[3]);";
		}
	}
	




	


?>


 <div class="main-panel">
    <?php include_once('design/navbar.php');?>
        <div class="content"><br><br><br><br>
           <form action='#' method='POST' enctype='multipart/form-data'> 
				<div class="row">
					<div class="col-md-3">
						<div class="card" >
							<img class="card-img-top" src="../upload/<?php if(isset($name1)) echo $name1;?>" alt="Card image">
							<div class="card-body">
							<input type="file" class="form-check-input " name="img0"   ></input>
							<br><br><?php if (isset($error['img0']))echo ($error['img0']);?>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card" >
							<img class="card-img-top" src="../upload/<?php if(isset($name2)) echo $name2;?>" alt="Card image">
							<div class="card-body">
							<input type="file" class="form-check-input " name="img1"   ></input>
							<br><br><?php if (isset($error['img1']))echo ($error['img1']);?>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card">
							<img class="card-img-top" src="../upload/<?php if(isset($name3)) echo $name3;?>" alt="Card image">
							<div class="card-body">
							<input type="file" class="form-check-input " name="img2"   ></input>
							<br><br><?php if (isset($error['img2']))echo ($error['img2']);?>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card">
							<img class="card-img-top" src="../upload/<?php if(isset($name4)) echo $name4;?>" alt="Card image">
							<div class="card-body">
							<input type="file" class="form-check-input " name="img3"   ></input>
							<br><br><?php if (isset($error['img3']))echo ($error['img3']);?>
							</div>
						</div>
					</div>
				</div><br><br><br><br><br><br><br><br><br><br><br><br>
				<div class="row"><div class="col-md-12">
				<input type="submit"  value="ارسال" name="send" class="btn-info btn" />
				</div></div>
            </form>
        </div>
</div>
                       <?php
include_once('design/footer.php');
?>