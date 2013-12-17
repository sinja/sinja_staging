<?php
global $page_name,$page_level;
/*foreach($_SESSION as $s){
	print_r($s);
	echo "<br>";
	}
		echo "<br>";
	echo "<br>";
	echo "<br>";
*/
include("breadcrumbs.class.php");
$trail = new Breadcrumb();
$URL_URI = $_SERVER['PHP_SELF'];
$queryString = $_SERVER['QUERY_STRING'];
$URL_URI .= "?".$queryString;


$trail->add($page_name, $URL_URI, $page_level);

//Sample CSS

//Now output the navigation.
if($page_level>=1){
if (basename($_SERVER['SCRIPT_NAME']) !== 'index.php'){ $trail->output();}
}
?>