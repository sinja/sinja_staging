<? 
include("admin.config.inc.php");
include("connect.php");
$name=$_POST['name'];
$password=$_POST['password'];
$query=mysql_query("select * from admin WHERE username='$name' AND password='$password'");  
$row=mysql_fetch_assoc($query);
$total_rows=mysql_num_rows($query);
$ADMIN_USERNAME=$row["username"];
$ADMIN_PASSWORD=$row["password"];
$UID=$row["id"];

if(isset($UsErId))
{
	setcookie("UsErId","");
	$UsErId="";
}
if(($name==$ADMIN_USERNAME) && ($password==$ADMIN_PASSWORD) && ($total_rows>0))
{
	setcookie("UsErId",1);
	setcookie("UsErOfAdMiN",$ADMIN_USERNAME);
	$_SESSION["AdMiNUsErId"]=$UID;
	setcookie('ReSoUrCe','');
	header("Location:inner.php");
}
else
{		   
	header("Location:index.php?Err=1");
}
?>