<?
include("connect.php");
session_unregister('SESSION_COUNTRY');
session_unregister('SESSION_LANGUAGE');
session_unregister('SESSION_ISUS'); // added temporarliy to identify US from Region
if(trim($_REQUEST['cid'])!=""){$_SESSION['SESSION_COUNTRY']=trim($_REQUEST['cid']);}
if(trim($_REQUEST['lan'])!=""){$_SESSION['SESSION_LANGUAGE']=trim($_REQUEST['lan']);}else{$_SESSION['SESSION_LANGUAGE']="EN";}
if(trim($_REQUEST['isus'])!=""){$_SESSION['SESSION_ISUS']=trim($_REQUEST['isus']);} // added temporarliy to identify US from Region
header("location:index.php");
exit;
?>