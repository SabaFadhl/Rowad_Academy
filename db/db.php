<?php
	define("DSN","mysql:host=localhost;dbname=task_db");
	define("USER","root");
    define("PASS","");
	$opts=array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8");
	try
	{
		$con=new PDO(DSN,USER,PASS,$opts);
		//echo "<span style='color:red;'>connect</span>";
	}
	catch(PDOEXCEPTION $ex)
	{
		exit($ex->getmessage());
		
	} 
?>
