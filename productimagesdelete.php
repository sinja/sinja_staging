<?
	include_once("admin.config.inc.php");
    include("admin.cookie.php");
	include("connect.php");
	$imgid= $_GET["imgid"];
	$img = $_GET["img"];
	$pid=$_GET["pid"];
	$type=$_GET['type'];
	if(file_exists("../Products/images/$img") && $img != "")
	{
		@unlink("../Products/images/$img");
	}
	//now delete the thumbnail
	if(file_exists("../Products/images/th_$img") && $img != "")
	{
		@unlink("../Products/images/th$img");
	}
	
	$delsql = " delete from productimages where id=$imgid " ;
	$delres = mysql_query($delsql);
	header("location:imagesproducts.php?type=$type&pid=$pid");
?>