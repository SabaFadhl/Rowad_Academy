<?php

require_once('../db/db.php'); 
include_once ("../db/callHerfClass.php");

if (isset($_POST['country_id'])) {
var_dump($_POST);	
	//$query = "select * from locations where parent=".$_POST['country_id'];
	$query2 = "select id,name from locations where parent='2'";//.$_POST['country_id'] ;//."and level='3'";
	/*  $query2 = "Select l.name
					from locations l
					inner join locations o 
					where l.parent=o.parent and l.parent=:parent"; */ //.$_POST['country_id'] ;//."and level='3'";
	$result2 = $con->prepare($query2);
	
	$result2->execute();//array("parent")=>$_POST['country_id']
	$rowss=$result2->fetchall();
	if ($result2->rowcount()>0) {
	 foreach ($rowss as $row1) {
	echo '<option value='.$row1['id'].'>'.$row1['name'].'</option>';
		 }
	}
	
	
	
else{

		echo '<option>لايوجد اي منطقة</option>';
	}

}



?>
						