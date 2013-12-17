<?
include("connect.php");
$store_id = SITE_ID;
$id=trim(mysql_real_escape_string($_REQUEST['id']));
$entity_id=trim(mysql_real_escape_string($_REQUEST['entity_id']));
if($_SESSION['UsErId']!="")
{
	if($entity_id!="" && $id!="" && $_SESSION['UsErId']!="")
	{
		$productsQry="SELECT id,entity_id,sku,colors_shown,colors_avail,image_small FROM products WHERE id='$id' and entity_id='$entity_id' order by entity_id asc";
		$productsQryRs=mysql_query($productsQry);
		$Totproducts=mysql_affected_rows();
		if($Totproducts<=0)
		{
			header("location:collectionlist.php");
			exit;
		}
		else
		{
			//check in wishlist table either row added for the customer
			$wishlistQry="SELECT wishlist_id FROM wishlist WHERE customer_id='".trim($_SESSION['UsErId'])."'";
			$wishlistQryRs=mysql_query($wishlistQry);
			$Totwishlist=mysql_affected_rows();
			if($Totwishlist<=0)
			{
				//if in wishlist table row not added for the customer then insert row for the customer
				$wishlistQry="INSERT INTO wishlist SET customer_id='".trim($_SESSION['UsErId'])."',shared='0'";
				$wishlistQryRs=mysql_query($wishlistQry);
				$insertedwishlist=mysql_insert_id();
			}
			else
			{
				//if in wishlist table row added for the customer then get the wishlist_id
				$wishlistQryRow=mysql_fetch_array($wishlistQryRs);
				$insertedwishlist=$wishlistQryRow['wishlist_id'];
			}
			///check either same product in wishlist or not
			$wishlistdetailQry="SELECT * FROM wishlist_item WHERE product_id='".trim($entity_id)."' and wishlist_id='".trim($insertedwishlist)."'";
			$wishlistdetailQryRs=mysql_query($wishlistdetailQry);
			$Totwishlistdetail=mysql_affected_rows();
			if($Totwishlistdetail<=0)
			{
				///if no same product in wishlist then add it
				$wishlistInsertQry="INSERT INTO wishlist_item SET product_id='".trim($entity_id)."',wishlist_id='".trim($insertedwishlist)."',added_at=now(),store_id=$store_id";
				$wishlistInsertQryRs=mysql_query($wishlistInsertQry);
			}
			header("location:".GetSiteUrl()."/my_account.php");
			exit;
		}
	}	
}
else	
{
	header("location:".GetSiteUrl()."login.php");
	exit;
}
?>