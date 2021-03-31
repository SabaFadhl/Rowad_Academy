<?php
include_once('functions.php');
include_once('seller_functions.php');
$h = new herf("mysql:host=localhost;dbname=herf_db","root","");
$s = new seller("mysql:host=localhost;dbname=herf_db","root","");


$properties =$s->getProperties();

if(count($properties)>0)
	{
		
		for($index=0;$index<count($properties);$index++)
		{
			//echo count($properties);
			if(is_array($properties[$index]))
			{
				foreach($properties[$index] as $key=>$val)
				{
					echo "<option value='$key'>$val</option>";
				}
				echo "</select>";
			}
			else
			{
				echo "$properties[$index]";
				echo "<select id='multiselectwithsearch' multiple='multiple' name='prop[]'>";
			}
		}
	}
var_dump($h->used_properties(36,0,1)) ;

?>