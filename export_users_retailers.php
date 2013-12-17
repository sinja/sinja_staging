<?php 
include("admin.config.inc.php"); 
include("connect1.php");
include("admin.cookie.php");

$InOrder=$_GET["InOrder"];if($InOrder!=""){$InOrder=$_GET["InOrder"];}else{$InOrder="asc";}
$Orderby=$_GET["Orderby"];
if($Orderby!=""){ $OrderbyQry=" order by $Orderby $InOrder";}else{$OrderbyQry=" order by username desc";}

$order=$_GET["order"];
if($order!=""){ $AndQry=" and ( jos_users.name like '$order%' )";}

if(trim($_REQUEST['cb_storecountry'])!=""){$AndQry.=" and cb_storecountry='".trim($_REQUEST['cb_storecountry'])."'";}
if(trim($_REQUEST['cb_ecomacct'])!=""){$AndQry.=" and cb_ecomacct='".trim($_REQUEST['cb_ecomacct'])."'";}
if(trim($_REQUEST['geocoded'])!=""){$AndQry.=" and GeocodeFailed='".trim($_REQUEST['geocoded'])."'";}
if(trim($_REQUEST['colCarried'])!=""){$AndQry.=" and ".trim($_REQUEST['colCarried'])."='Yes'";}
if(trim($_REQUEST['name'])!="")
{
	$AndQry.=" and (jos_users.name like '%".addslashes(addslashes(trim($_REQUEST['name'])))."%'";
	$AndQry.=" or jos_comprofiler.firstname	 like '%".addslashes(addslashes(trim($_REQUEST['name'])))."%'";
	$AndQry.=" or jos_comprofiler.middlename like '%".addslashes(addslashes(trim($_REQUEST['name'])))."%'";
	$AndQry.=" or jos_comprofiler.lastname like '%".addslashes(addslashes(trim($_REQUEST['name'])))."%'";
	$AndQry.=" or jos_comprofiler.cb_storename like '%".addslashes(addslashes(trim($_REQUEST['name'])))."%'";
	$AndQry.=" or jos_comprofiler.cb_storeaddress1 like '%".addslashes(addslashes(trim($_REQUEST['name'])))."%'";
	$AndQry.=" or jos_comprofiler.cb_storeaddress2 like '%".addslashes(addslashes(trim($_REQUEST['name'])))."%'";
	$AndQry.=" or jos_comprofiler.cb_storecity like '%".addslashes(addslashes(trim($_REQUEST['name'])))."%'";
	$AndQry.=" or jos_comprofiler.cb_storeprostate like '%".addslashes(addslashes(trim($_REQUEST['name'])))."%'";
	$AndQry.=" or jos_comprofiler.cb_storepost like '%".addslashes(addslashes(trim($_REQUEST['name'])))."%'";
	$AndQry.=" or jos_comprofiler.cb_aboutstore like '%".addslashes(addslashes(trim($_REQUEST['name'])))."%'";
	$AndQry.=" or jos_comprofiler.cb_sellinglines like '%".addslashes(addslashes(trim($_REQUEST['name'])))."%'";				
	$AndQry.=" or cb_ecomacct like '%".addslashes(addslashes(trim($_REQUEST['name'])))."%'";				
	$AndQry.=" or CountryName like '%".addslashes(addslashes(trim($_REQUEST['name'])))."%' )";				
}
$query="select jos_users.username as Username, jos_users.name as 'Store Name',CountryName as Country
, jos_comprofiler.cb_storecity as City, jos_comprofiler.cb_storeprostate as State
, jos_comprofiler.cb_storepost as 'Zip Code', jos_comprofiler.cb_storeaddress1 as 'Address', jos_comprofiler.cb_storewebsite as 'Website'
, jos_comprofiler.cb_storephone as 'Phone', jos_comprofiler.cb_storeemail as 'Email', jos_comprofiler.allow_popup as 'Allow Popup'
, jos_comprofiler.cb_contactname as 'Contact Name'
, jos_users.email as 'User Email', jos_comprofiler.cb_ecomacct as 'Ecomet account #'
,jos_comprofiler.cb_jab As JAR,jos_comprofiler.cb_jap AS JAP,jos_comprofiler.cb_jas as JAS,jos_comprofiler.cb_jal as JAL
,jos_comprofiler.cb_sin as SIN,jos_comprofiler.cb_sip as SIP,jos_comprofiler.cb_sde as SDE
,jos_comprofiler.cb_swh as SWH,jos_comprofiler.cb_sdd	as SDD 
,
CASE 
WHEN jos_comprofiler.RetailerStatusId = 2 THEN 'Yes' 
ELSE 'No'
END as 'Approved'
				  from jos_users,jos_comprofiler  
				  inner join Countries on Countries.CountryId = jos_comprofiler.CountryId
				  where 1=1 
				  and  jos_comprofiler.user_id=jos_users.id
				  $AndQry $SearchAndQry $OrderbyQry";

$result=mysql_query($query);

function cleanData(&$str) 
{ 
	$str = str_replace("&#351;", "?", $str); 
	$str = str_replace("&#350;", "?", $str); 
	$str = str_replace("&#262;", "?", $str); 
	$str = str_replace("&#8203;", "", $str); 
	$str = str_replace("&#347;", "?", $str); 
	$str = str_replace("&#304;", "?", $str); 
	$str = str_replace("&#305;", "?", $str); 
	$str = str_replace("&#322;", "?", $str); 
	$str = preg_replace("/\t/", "\\t", $str); 
	$str = preg_replace("/\r?\n/", "\\n", $str); 
	$str = str_replace("\'", "'", $str); 
	$str = str_replace('\"', '"', $str); 
	if(strstr($str, '"')) 
		$str = '"' . str_replace('"', '""', $str) . '"'; 
} 

// file name for download 
$filename = "retailers".date('Ymd').".xls"; 
header("Content-Disposition: attachment; filename=\"$filename\""); 
header("Content-Type: application/vnd.ms-excel; charset=utf-8"); 
$flag = false; 

while(false !== ($row = mysql_fetch_assoc($result))) 
{ 
	if(!$flag) 
	{ 
	// display field/column names as first row 
	echo utf8_decode(implode("\t", array_keys($row))) . "\n"; 
	$flag = true; 
	} 
	array_walk($row, 'cleanData'); 
	echo utf8_decode(implode("\t", array_values($row))) . "\n"; 
}

?>