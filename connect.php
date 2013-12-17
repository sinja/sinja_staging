<?php
session_start();
include ("include/config.inc.php");
include ("include/site_details.php");
include ("include/sindb.php");
include ("include/functions.php");
//include ("include/functions2.php");
include ("include/prs_function.php");
include ("include/gtg_functions.php");
include ("include/translations.php");
include_once("include/class.phpmailer.php");
include_once("include/class.smtp.php");
include_once("include/sendmail.php");
/*
$db=mysql_connect($DBSERVER, $USERNAME, $PASSWORD) or die(mysql_error());
mysql_select_db($DATABASENAME,$db);
*/
//$linkpath="http://".$_SERVER['HTTP_HOST']."/".$folder."/index.php";
?>
