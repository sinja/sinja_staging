<?
include("connect.php");

if($_GET['footer_lang'] == 'de'){

	header("location: http://www.sincerity.de");
	exit;
}

if(trim($_REQUEST['footer_lang'])!=""){$_SESSION['SESSION_LANGUAGE']=trim($_REQUEST['footer_lang']);}else{$_SESSION['SESSION_LANGUAGE']="EN";}
//$url=$_SERVER['HTTP_REFERER'];

if(!empty($url)){
	header("location:$url");
}else{
	header("location:".GetSiteUrl());
}
exit;
?>