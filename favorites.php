<? include("connect.php"); 
if($_SESSION['UsErId']==""){header("location:index.php");}

if(trim($_POST['Hidsubmit'])=="1")
{
	$count1 = $_REQUEST['count'];
	for($i = 0;$i < $count1;$i++)
	{
		$description = "description_".$i;
		$pid = "pid".$i;
		$desc=$_REQUEST[$description];
		if($desc!="Comments")
		{
			$desc=$_REQUEST[$description];
		}
		else
		{
			$desc="";
		}
		$query = "update wishlist_item  set description='".addslashes($desc)."' where wishlist_item_id=".$_REQUEST[$pid];
		mysql_query($query);
	}
	header("location:favorites.php");
	exit;
}

$entity_id=$_SESSION['UsErId'];
$SelQry="SELECT  email FROM customer_entity WHERE entity_id='$entity_id'";
$SelQryRs=mysql_query($SelQry);
$SelQryRow=mysql_fetch_array($SelQryRs);
$Email=ucfirst(stripslashes($SelQryRow['email']));

$SelQry1="SELECT  value FROM customer_entity_varchar WHERE customer_entity_varchar.attribute_id=7 and customer_entity_varchar.entity_id='$entity_id'";
$SelQryRs1=mysql_query($SelQry1);
$SelQryRow1=mysql_fetch_array($SelQryRs1);
$Lastname=ucfirst(stripslashes($SelQryRow1['value']));

$SelQry2="SELECT  value FROM customer_entity_varchar WHERE customer_entity_varchar.attribute_id=5 and customer_entity_varchar.entity_id='$entity_id'";
$SelQryRs2=mysql_query($SelQry2);
$SelQryRow2=mysql_fetch_array($SelQryRs2);
$Firstname=ucfirst(stripslashes($SelQryRow2['value']));

$CustomerZip="";
$GetCustomerNameQryRs4=mysql_query("SELECT value FROM customer_address_entity_varchar WHERE entity_id='$entity_id' and attribute_id=28");
$GetCustomerNameQryRow4=mysql_fetch_array($GetCustomerNameQryRs4);
$CustomerZip=stripslashes($GetCustomerNameQryRow4['value']);

$Customercountry="";
$GetCustomerNameQryRs5=mysql_query("SELECT value FROM customer_address_entity_varchar WHERE entity_id='$entity_id' and attribute_id=25");
$GetCustomerNameQryRow5=mysql_fetch_array($GetCustomerNameQryRs5);
$Customercountry=stripslashes($GetCustomerNameQryRow5['value']);
$page_title = ' | '.ucwords(strtolower(strt("My Account & Favorites")));
?>
<? include("header.php");?>
<body>
<script language="javascript" type="text/javascript"> function deleteconfirm(str,strurl) { if (confirm(str)) {	this.location=strurl;} } </script>
    <div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
            <div id="content"> 
            <?php breadcrumbs(); ?>           
            <div class="pageTitle">
                <h2><?php e_upstrt('Favorites');?></h2>
                <a href="<?php echo GetSiteUrl();?>/my_account.php"><?php e_upstrt('Edit Account');?></a>
                <div class="clr"></div>
            </div>
            <div id="favorites">
							<form name="FrmWishlist" id="FrmWishlist" enctype="multipart/form-data" method="post">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td align="left" valign="top" >&nbsp;</td>
                                </tr>
                                
								<?
								$WishlistSelQry2="SELECT  wishlist_id FROM wishlist  WHERE customer_id='$entity_id'";
								$WishlistSelQryRs2=mysql_query($WishlistSelQry2);
								$WishlistTotSel2=mysql_affected_rows();
								if($WishlistTotSel2>0)
								{
									$WishlistSelQryRow2=mysql_fetch_array($WishlistSelQryRs2);
									$wishlist_id=$WishlistSelQryRow2['wishlist_id'];
									
									$WishlistSelQry3="SELECT * FROM wishlist_item  WHERE wishlist_id='$wishlist_id'";
									$WishlistSelQryRs3=mysql_query($WishlistSelQry3);
									$WishlistTotSel3=mysql_affected_rows();
									if($WishlistTotSel3>0)
									{
										for($WL=0;$WL<$WishlistTotSel3;$WL++)
										{
											$WishlistSelQryRow3=mysql_fetch_array($WishlistSelQryRs3);
											$product_id=$WishlistSelQryRow3['product_id'];
											$description=stripslashes($WishlistSelQryRow3['description']);
											if($description=="")
											{
												$description="Comments";
											}
											
											$ProductsSelQry3="SELECT products.id,products.entity_id, sku,sizes,colors_shown,colors_avail, image_thumb1,collection,websiteid, core_website.websiteurl, core_website.websiteurlstaging, products_collections.Acronym
FROM products
inner join products_collections on products_collections.id = products.collection
INNER JOIN core_website ON core_website.website_id = products.websiteid  WHERE entity_id='$product_id' AND products.status!='deleted'";
											$ProductsSelQryRs3=mysql_query($ProductsSelQry3);
											$TotProducts=mysql_affected_rows();
											$ProductsSelQryRow3=mysql_fetch_array($ProductsSelQryRs3);
											if(empty($ProductsSelQryRow3)) continue;
											$colors_avail="";
											$Expcolors_avail="";
											if($ProductsSelQryRow3['colors_avail']!="")
											{
												$Expcolors_avail=explode(",",$ProductsSelQryRow3['colors_avail']);
												for($AC=0;$AC<count($Expcolors_avail);$AC++)
												{
													$colors_availQryRs=mysql_query("SELECT * from products_colors where id='".$Expcolors_avail[$AC]."'");
													$colors_availQryRow=mysql_fetch_array($colors_availQryRs);
													$colors_avail.=stripslashes($colors_availQryRow['name'])."<br>";
												}
											}
											$colors_shown="";
											$Expcolors_shown="";
											if($ProductsSelQryRow3['colors_shown']!="")
											{
												$Expcolors_shown=explode(",",$ProductsSelQryRow3['colors_shown']);
												for($AS=0;$AS<count($Expcolors_shown);$AS++)
												{
													$colors_shownQryRs=mysql_query("SELECT * from products_colors where id='".$Expcolors_shown[$AS]."'");
													$colors_shownQryRow=mysql_fetch_array($colors_shownQryRs);
													$colors_shown.=stripslashes($colors_shownQryRow['name'])."<br>";
												}
											}
								?>
												<tr>
												  <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
													  <tr>
														<td width="160" align="left" valign="top">
								<?
                                if(10>20)//(stripos($_SERVER["SERVER_NAME"], 'staging', 0) == 0)
                                    $absURL = $ProductsSelQryRow3['websiteurlstaging']."/";
                                else
                                    $absURL = $ProductsSelQryRow3['websiteurl']."/";
									
								$collection = $ProductsSelQryRow3['collection'];		
								if($collection=="3"){$collTxt="Justin Alexander Signature";}
								else if($collection=="1"){$collTxt="Justin Alexander";}
								else if($collection=="2"){$collTxt="Pure by Justin Alexander";}
								else if($collection=="4"){$collTxt="Sincerity";}
								else if($collection=="5"){$collTxt="Sincerity+";}
								else if($collection=="7"){$collTxt="Justin Alexander Signature";}
								else if($collection=="6"){$collTxt="Sweetheart";}
								?>
														<?
										  $prodId = $ProductsSelQryRow3['id'];
										  	  $selsql = " select * from productimages where pid=$prodId AND type='image' order by displayorder asc LIMIT 0,1" ;
											  $selres = mysql_query($selsql);
											  		$imgRow=mysql_fetch_array($selres);
										  ?>
												<a href="<?=$absURL?><?php echo rewrite_acronym($ProductsSelQryRow3['Acronym']);?>/<?=$ProductsSelQryRow3['sku'];?>" target="_proddet"><? if($imgRow['pimage'] != "") {?>
                                              <img src="<?=$IMAGE_URL?>?width=144&cropratio=1.44:1.95&image=<?=$SINCERITY?>/Products/images/<?=$imgRow['pimage'];?>" border="0" width="144" /><? }else{?>
                                              <img src="images/<?php echo $MISSING_IMG24_FILE;?>" width="144" border="0" /><? } ?></a>
														<?php /*?><img src="images/noimage-154-153.jpg" width="153" height="154" /><?php */?></td>
														<td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="5">
															<tr>
															  <td width="100%" align="left" valign="top" class="detailsFav font-12-wht">
															 <span class="title"> <?php e_upstrt('Collection');?>:</span>
															 <br />
                                                              # <?=stripslashes($collTxt);?><br /><br /></td>
															</tr>
                                                            <tr>
															  <td width="100%" align="left" valign="top" class="detailsFav font-12-wht">
															  <span class="title"><?php e_upstrt('Style');?>:</span><br />
															 
                                                              # <?=stripslashes($ProductsSelQryRow3['sku']);?><br /></td>
															</tr>																												
															<tr>
															  <td colspan="2" align="left" valign="top" class="font-12-gra-dr shareFav">
                                                               <div>
                                                               <a href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4b5d485814507317" class="addthis_button_compact sendPress" addthis:url="<?=$absURL?>product-detail.php?id=<?=stripslashes($ProductsSelQryRow3['id']);?>" addthis:title="<? echo("Check out style ".stripslashes($ProductsSelQryRow3['sku'])." by ".$collTxt."!"); ?>"></a>
                                                               <a class="printItem" title="print preview" href="<?php echo GetSiteUrl();?>/prodprint.php?id=<?=stripslashes($prodId);?>&entity_id=<?=stripslashes($ProductsSelQryRow3['entity_id']);?>" target="_prnt"></a>                                                              
                                                              </div>
											 				   <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4b5d485814507317"></script>
                                                               </td>
															</tr>
														  </table></td>
														<td width="243" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="5">
															<tr>
															  <td align="left"><textarea name="description_<?=$WL; ?>" rows="5" class="text_field6" id="description_<?=$WL; ?>" onFocus="if(this.value=='<?php e_strt('Comments');?>'){this.value='';}" onBlur="if(this.value==''){this.value='<?php e_strt('Comments');?>';}"><?=$description;?></textarea>
															    <input type="hidden" name="pid<?=$WL; ?>" value="<?=$WishlistSelQryRow3['wishlist_item_id'];?>" >
                              									<input type="hidden" name="count" value="<?=$WL+1; ?>" >
															  </td>
															</tr>
															<tr>
															  <td align="right" valign="middle">
                                                              <a href="#" onClick="deleteconfirm('<?php e_strt('Are you sure you want to remove this product from your wishlist?. \n');?>','removewishlist.php?id=<?php echo($WishlistSelQryRow3['wishlist_item_id']); ?>');return false;" class="removeFav">
                                                              <input type="button" value="<?php e_upstrt('REMOVE ITEM');?>" class="JAbutton"/></a></td>
															</tr>
														  </table>
                                                          </td>
                                                          <td width="107"></td>
													  </tr>
													</table></td>
												</tr>
												<tr>
												  <td align="left" valign="top">&nbsp;
                                                  <div class="spacer"></div>
                                                  </td>
												</tr>
									 <? } ?>	
												<tr>
												  <td align="right" valign="top" style="padding-bottom:15px; padding-right:5px;">
                                                  <table border="0" cellspacing="0" cellpadding="45">
													  <tr>
														<td height="30" align="left" valign="bottom">
                                                        <a href="share-wishlist.php">
                                                        <input type="button" value="<?php e_upstrt('SHARE LIST');?>" class="JAbutton"/>
                                                        </a>
                                                        </td>
														<td height="30" align="left" valign="bottom" style="padding-left:40px;">
														<input type="hidden" name="Hidsubmit" id="Hidsubmit" value="1" />
														<a href="#" onClick="document.FrmWishlist.Hidsubmit.value=1;document.FrmWishlist.submit();return false;"> 
                                                        <input type="button" value="<?php e_upstrt('UPDATE LIST');?>" class="JAbutton"/>
                                                        </a>
                                                        </td>
													  </tr>
													</table></td>
												</tr>
								  <? } else {?>	
								  	<tr>
									  <td align="left" valign="top"><?php e_upstrt('You have no items in your wishlist');?>.</td>
									</tr>
								  <? } ?>
								<? }else{ ?>
									<tr>
									  <td align="left" valign="top"><?php e_upstrt('You have no items in your wishlist');?>.</td>
									</tr>
								<? } ?>
                              </table>
							</form>
							</div>
                  </div>  
        </div>
        
    </div>
    <? include("footer.php");?>
<? include("googleanalytic.php");?>
</body>
</html>