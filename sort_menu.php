<?php
include("connect.php");
$tblnm = $_REQUEST['tblnm'];
$menu = $_POST['menu'];
for ($i = 0; $i < count($menu); $i++) 
{
	mysql_query("UPDATE `".$tblnm."` SET `sortorder`=" . $i . " WHERE `id`='" . $menu[$i] . "'");
}
?>
