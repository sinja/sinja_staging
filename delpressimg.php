<?
	include_once("admin.config.inc.php");
    include("admin.cookie.php");
	include("connect.php");
	$imgid= $_GET["imgid"];
	$img = $_GET["img"];
	$pid=$_GET["pid"];
	if(file_exists("../Press/$img") && $img != "")
	{
		@unlink("../Press/$img");
	}
	$delsql = " delete from press_images where id=$imgid " ;
	$delres = mysql_query($delsql);
	header("location:imagespress.php?pid=$pid");
?>