<? include("connect.php"); 
$WishlistSelQry3="DELETE FROM wishlist_item  WHERE wishlist_item_id='".trim($_REQUEST['id'])."'";
$WishlistSelQryRs3=mysql_query($WishlistSelQry3);
header("location:favorites.php");
exit;
?>
