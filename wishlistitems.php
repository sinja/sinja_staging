<?php 
include("admin.config.inc.php"); 
include("connect.php");
include("admin.cookie.php");
$mlevel=6;
if($_GET["id"])
{	
	$cid=$_GET["id"];	
	$dqry="delete from wishlist_item where wishlist_item_id=$cid";
	mysql_query($dqry);	
	header("location:wishlistitems.php?msgs=15&wishlist_id=".trim($_REQUEST['wishlist_id'])."");
	exit;
}


/////////////////////END OF UPDATE DISPLAY ORDER//////////////////////////

$strQueryPerPage="select * from wishlist_item  where wishlist_id='".trim($_REQUEST['wishlist_id'])."'  order by wishlist_item_id desc";
$strResultPerPage=mysql_query($strQueryPerPage);
$strTotalPerPage=mysql_affected_rows(); 

if($strTotalPerPage<1)
$Error = 1;
	
if($_GET["msgs"]==1)
{
	$Message2 = "Favorites Added Successfully!!";
}
if($_GET["msgs"]==2)
{
	$Message2 = "Gift Shop Home Page Favorites has been setteled Successfully!!";
}
if($_GET["msgs"]==3)
{
	$Message2 = "Favorites Updated Successfully!!";
}
if($_GET["msgs"]==15)
{
	$Message2 = "Favorites Deleted Successfully!!";
}
if($_GET["msgs"]==5)
{
	$Message2 = "Featured Products have been changed Successfully!!";
}
if($_GET["msgs"]==333)
{
	$Message2 = "Favorites Setted Successfully!!";
}
if($_GET["msgs"]==3333)
{
	$Message2 = "Display Order has been updated successfully"; 
}	
if($_GET["msgs"]==4)
{
	$Message2 = "Favorites has been updated successfully"; 
}
?>
<html>
<head>
<title><?php echo $ADMIN_MAIN_SITE_NAME ?></title>
<script language="javascript" src="body.js"></script>
<meta http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<meta content="MSHTML 6.00.2600.0" name=GENERATOR>
<link rel="stylesheet" href="main.css" type="text/css">
</head>
<body>
<table align="left" width="100%" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td height=60 valign="top"  colspan="2"><? include("top.php") ?>
      </td>
    </tr>
    <tr>
      <td width="20%" valign="top" class="rightbdr" ><? include("inner_left_admin.php"); ?>
      </td>
      <td width="80%" valign="top"><table width="100%"  border=0 cellpadding="2" cellspacing="2">
          <tr>
            <td width="100%" height="35" class=form111>Manage Favorites </td>
          </tr>
          <tr>
            <td align="center"  class="formbg"><table width="100%"  border=0 cellPadding=0 cellSpacing=0 align="left">
                <tbody>
                  <tr>
                    <td align="center" width="100%" class="a-l" ><font color="#FF0000"><?php echo $Message2 ; ?></font></td>
                  </tr>
                  <tr>
                    <td background="images/vdots.gif"><IMG height=1  src="images/spacer.gif" width=1 border=0></td>
                  </tr>
                <td valign="top"><?php /*?><form  name="order" action="#" method="post">
                      <table cellSpacing=0 cellPadding=1 border=0  >
                        <tbody>
                          <tr>
                            <td colspan="25" height="20"><b>View By Name </b></td>
                          </tr>
                          <?=$prs_pageing->order();?>
                        </tbody>
                      </table>
                    </form><?php */?>
                    <?php if(!$strTotalPerPage) { ?>
                    <table width="70%" border="0"   cellspacing="1" cellpadding="1" align="center" >
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="t-a2">
                            <tr>
                              <td class=th-a><div align="center" ><strong>There are no Favoritess to display</strong></div></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table>
                    <?php } else { ?>
                    <form id="passionmanage" name="passionmanage"  method="post" enctype="multipart/form-data">
                      <table width="100%" border=0 cellspacing=0 cellpadding="0" class="t-b">
                        <tbody>
                          <!--DWLayoutTable-->
                          <tr>
                            <td align="right" height="30" colspan=12><? $result=$prs_pageing->number_pageing($strQueryPerPage,100,10,"Y","N");?></td>
                          </tr>
                          <tr class="form_back">
                            <?php /*?><td width="4%" height="26"  align="left" ><strong>ID</strong></td><?php */?>
                            <td width="7%" height="26"  align="left" ><strong>Name</strong></td>
                            <td width="37%" height="26"  align="left" ><strong>User Description</strong></td>
							<td width="37%" height="26"  align="left" ><strong>Added From</strong></td>
                            <td width="11%" height="26"  align="left" ><strong>Date</strong></td>
                            <td width="8%" align="center"><strong>Options</strong></td>
                          </tr>
                          <?
							$k=0;
							$count = 0;
						  while($row =mysql_fetch_object($result))
						  {
								$k=$k+1;
								$count++;
								$ProdcutSku="";
								$GetCustomerNameQryRs1=mysql_query("SELECT sku,name,id FROM products WHERE entity_id='".$row->product_id."' ");
								$GetCustomerNameQryRow1=mysql_fetch_array($GetCustomerNameQryRs1);
								$ProdcutSku=stripslashes($GetCustomerNameQryRow1['name']);
								$ProdcutID=stripslashes($GetCustomerNameQryRow1['id']);
								
								if($row->store_id>0)
								{
									$core_store=GetName1("core_store","name","store_id",stripslashes($row->store_id));
								}	
								else
								{
									$core_store=="";
								}
						  ?>
                          <tr>
                            <?php /*?><td align="left"><? echo stripslashes($row->entity_id); ?></td><?php */?>
                            <td align="left"><a href="add_product.php?id=<? echo stripslashes($ProdcutID); ?>"><? echo $ProdcutSku; ?></a>&nbsp;</td>
                            <td align="left"><? echo stripslashes($row->description); ?>&nbsp;</td>
							<td align="left"><? echo stripslashes($core_store); ?>&nbsp;</td>
							<td align="left"><? echo date("M d, Y",strtotime(stripslashes($row->added_at))); ?>&nbsp;</td>
                            <td  align="center" width="8%" ><input name="button2" type="button" onClick="deleteconfirm('Are you sure you want to delete this favourite item?. \n','wishlistitems.php?id=<?php echo($row->wishlist_item_id); ?>&wishlist_id=<? echo trim($_REQUEST['wishlist_id']);?>');" value="Delete" class="bttn-s">
                              <input type="hidden" name="pid<?=$count; ?>" value="<?=$row->cat_id;?>" >
                              <input type="hidden" name="count" value="<?=$count; ?>" >
                            </td>
                          </tr>
                          <? } ?>
                        </tbody>
                      </table>
                    </form>
                    <?php } ?>
                    <!--/content--></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>
