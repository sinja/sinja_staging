<?php
	ini_set('session.use_trans_sid', true);
	session_start();
  	setcookie("UsErOfAdMiN","");
  	$UsErOfAdMiN="";
  	setcookie("UsErTyPe","");
  	$UsErTyPe="";
	setcookie("UsErId","");
  	$UsErId="";
  
  
	//session_unregister("CartId");
	unset($_SESSION['CartId']);
	$CartId="";
	//session_unregister("MCartId");
	unset($_SESSION['McartId']);
	$MCartId="";
	//session_unregister("UsErOfAdMiN");
	unset($_SESSION['UsErOfAdMiN']);
	//session_unregister("UsErTyPe");
	unset($_SESSION['UsErTyPe']);
	//session_unregister("UsErId");
	unset($_SESSION['UsErId']);
	//session_unregister("AdMiNUsErId");
	unset($_SESSION['AdMiNUsErId']);
	
 
  header("Location: index.php");
?>



