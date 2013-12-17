<?
	include_once("admin.config.inc.php");
    include("admin.cookie.php");
	include("connect.php");
	$imgid= $_GET["imgid"];
	$img = $_GET["img"];
	$pid=$_GET["pid"];
	if(file_exists("../Gallery/$img") && $img != "")
	{
		@unlink("../Gallery/$img");
	}
	$delsql = " delete from galleryimages where id=$imgid " ;
	$delres = mysql_query($delsql);
	header("location:imagesgallery.php?pid=$pid");
?>