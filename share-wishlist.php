<? include("connect.php"); 
if($_SESSION['UsErId']==""){header("location:index.php");}
$entity_id=$_SESSION['UsErId'];
if($_POST['hidchk']=="1")
{
	$SelQry1="SELECT  value FROM customer_entity_varchar WHERE customer_entity_varchar.attribute_id=7 and customer_entity_varchar.entity_id='$entity_id'";
	$SelQryRs1=mysql_query($SelQry1);
	$SelQryRow1=mysql_fetch_array($SelQryRs1);
	$Lastname=ucfirst(stripslashes($SelQryRow1['value']));
	
	$SelQry2="SELECT  value FROM customer_entity_varchar WHERE customer_entity_varchar.attribute_id=5 and customer_entity_varchar.entity_id='$entity_id'";
	$SelQryRs2=mysql_query($SelQry2);
	$SelQryRow2=mysql_fetch_array($SelQryRs2);
	$Firstname=ucfirst(stripslashes($SelQryRow2['value']));
	$username=$Firstname." ".$Lastname;
	
	$SelQry3="SELECT  email	 FROM customer_entity WHERE entity_id='$entity_id'";
	$SelQryRs3=mysql_query($SelQry3);
	$SelQryRow3=mysql_fetch_array($SelQryRs3);
	$emailfrom=stripslashes($SelQryRow3['email']);
	
	$emailsto=trim($_POST['emailsto']);
	if($emailsto!="")
	{	
		$expemailsto=explode(",",$emailsto);
		$Totexpemailsto=count($expemailsto);
		if($Totexpemailsto>0)
		{
			for($RR=0;$RR<$Totexpemailsto;$RR++)
			{
					/////////////////THANKYOU MAIL
					$toemail=$expemailsto[$RR];
					$PROD="";
					
					$WishlistSelQry2="SELECT  wishlist_id FROM wishlist  WHERE customer_id='$entity_id'";
					$WishlistSelQryRs2=mysql_query($WishlistSelQry2);
					$WishlistTotSel2=mysql_affected_rows();
					if($WishlistTotSel2>0)
					{
						$WishlistSelQryRow2=mysql_fetch_array($WishlistSelQryRs2);
						$wishlist_id=$WishlistSelQryRow2['wishlist_id'];
						
						if($_REQUEST['sid']!=""){$ANDDD=" and wishlist_item_id='".trim($_REQUEST['sid'])."'";}
						
						$WishlistSelQry3="SELECT * FROM wishlist_item  WHERE wishlist_id='$wishlist_id' $ANDDD";
						$WishlistSelQryRs3=mysql_query($WishlistSelQry3);
						$WishlistTotSel3=mysql_affected_rows();
						if($WishlistTotSel3>0)
						{
							for($WL=0;$WL<$WishlistTotSel3;$WL++)
							{
								$WishlistSelQryRow3=mysql_fetch_array($WishlistSelQryRs3);
								$product_id=$WishlistSelQryRow3['product_id'];
								
								$ProductsSelQry3="SELECT products.*, core_website.websiteurl, core_website.websiteurlstaging, products_collections.Acronym
													FROM products
													inner join products_collections on products_collections.id = products.collection
													INNER JOIN core_website ON core_website.website_id = products.websiteid  WHERE entity_id='$product_id'";
								$ProductsSelQryRs3=mysql_query($ProductsSelQry3);
								$TotProducts=mysql_affected_rows();
								$ProductsSelQryRow3=mysql_fetch_array($ProductsSelQryRs3);
								
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
								$description=stripslashes($WishlistSelQryRow3['description']);
								
								$collection="";
								$collectionimg="";
								$collection=$ProductsSelQryRow3['collection'];
								if($collection=="3"){$collectionimg='<img src="'.$SITE_URL.'/images/emaillogos/jasig.png" border="0"/>';}
								if($collection=="1"){$collectionimg='<img src="'.$SITE_URL.'/images/emaillogos/ja.png" border="0"/>';}
								if($collection=="2"){$collectionimg='<img src="'.$SITE_URL.'/images/emaillogos/ja.png" border="0"/>';}
								if($collection=="4"){$collectionimg='<img src="'.$SITE_URL.'/images/emaillogos/sin.png" border="0"/>';}
								if($collection=="5"){$collectionimg='<img src="'.$SITE_URL.'/images/emaillogos/sin.png" border="0"/>';}
								if($collection=="7"){$collectionimg='<img src="'.$SITE_URL.'/images/emaillogos/sd.png" border="0"/>';}
								if($collection=="6"){$collectionimg='<img src="'.$SITE_URL.'/images/emaillogos/sweet.png" border="0"/>';}
								
								if(10 > 20)//if(stripos($_SERVER["SERVER_NAME"], 'staging', 0) == 0)
                                    $absURL = $ProductsSelQryRow3['websiteurlstaging']."/";
                                else
                                    $absURL = $ProductsSelQryRow3['websiteurl']."/";
									
								$PROD.="<tr>";
								?>
									<?
										  $prodId = $ProductsSelQryRow3['id'];
										  	  $selsql = " select * from productimages where pid=$prodId AND type='image' order by displayorder asc LIMIT 0,1" ;
											  $selres = mysql_query($selsql);
											  		$imgRow=mysql_fetch_array($selres);
										  ?>
									<? if($imgRow['pimage']!=""){ ?>
										<? $PROD.="<td style='color: #000000;padding-right:35px;' align='center' width=150><a href='$absURL/".$ProductsSelQryRow3['Acronym']."/".$ProductsSelQryRow3['sku']."'><img src='".$IMAGE_URL.'?width=144&cropratio=1.44:1.95&image='.$SINCERITY.'/Products/images/'.$imgRow['pimage']."' border='0'/></a></td>"; ?>
									<? }else{ ?>
										<? $PROD.="<td align='center' width=150><a href='$absURL/".$ProductsSelQryRow3['Acronym']."/".$ProductsSelQryRow3['sku']."'><img src='$SITE_URL/images/".$MISSING_IMG24_FILE."' width='153' height='154' border='0'/></a></td>"; ?>
									<? } ?>									
										<? $PROD.='<td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="5">
											<tr>
											  <td width="28%" align="left" valign="top" class="font-14-wht" style="color: #000000;">'.strt('Style').':</td>
											  <td width="72%" align="left" valign="top" class="font-14-wht" style="color: #000000;"><a href="'.$absURL."/".$ProductsSelQryRow3['Acronym']."/".$ProductsSelQryRow3['sku'].'"> # '.stripslashes($ProductsSelQryRow3['sku']).'</a><br /></td>
											</tr>';

											if($colors_shown!=""){ ?>
										<? 	$PROD.='<tr>
											  <td align="left" valign="top" class="font-14-wht" style="color: #000000;">'.strt('Pictured').':</td>
											  <td align="left" valign="top" class="font-14-wht" style="color: #000000;">'.$colors_shown.'</td>
											</tr>';
											 } 
										?>
										<? if($colors_avail!=""){?>
										<? 	$PROD.='<tr>
											  <td align="left" valign="top" class="font-14-wht" style="color: #000000;">'.strt('Available').'<br />Colors:</td>
											  <td align="left" valign="top" class="font-14-wht" style="color: #000000;">'.$colors_avail.'</td>
											</tr>';
										} ?>
										<?	$PROD.='</table></td>
										 <td width="238" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="5">
											<tr>
											  <td align="left">'.$description.'</td>
											</tr>
											
										  </table></td><td style="text-align:right;"><a href="'.$absURL.'">'.$collectionimg.'</a></td>';?>
								<?
								$PROD.="</tr><tr><td colspan='5'> <div style='height:3px;'></div><div style='border-top:#9A9A9A solid 1px;height:6px;'></div></td></tr>";
								
							}
						}
					}			
				
					
					$subject1="Take a look at $username's wishlist";			
					$from1=$emailfrom;	
					$mailcontent1="<html><head><title>$SITE_TITLE</title><style>body {
										margin: 0px;
										padding: 0px;
										font-family: Arial, Helvetica, sans-serif;
										font-size: 12px;
										color: #000000;
									}
									</style></head><body>
									<table bgcolor=\"#F1F3F5\" cellpadding='0' cellspacing='0' style='width:795;color:#000; border:solid 1px #000;font-family: Arial, Helvetica, sans-serif;font-size: 12px; border-collapse:collapse;'>
  <tr>
    <td style='padding-top:34px; padding-left:20px;'><a href='$SITE_URL'><img src='$SITE_URL/images/email/hdr.png' alt='".$SITE_NAME."' style='display:block;' /></a></td>
  </tr>
  <tr>
    <td style='padding:0px 30px 20px 30px;color:#000;'><br /><p>Hey,<br>Take a look at my wishlist from $SITE_NAME.</p><br />
    ".nl2br(stripslashes(trim($_POST['message'])))."<br /><br /><br /><div style='border-top:#9A9A9A solid 1px;height:7px;'></div>
    <table bgcolor=\"#F1F3F5\" style='width:100%;'>
										".$PROD."
										</table>
    <br /><br />Thank you,<br />".$username."
    </td>
  </tr>
</table>
									</body>
									</html>";
					//echo $emailfrom; echo $toemail;echo $subject1;echo $mailcontent1;echo $from1;
						HtmlMailSend($toemail,$subject1,$mailcontent1,$from1);	
					/////////////////END OF MAIL
			}	
		}	
		echo "<script>window.location.href='share-wishlist.php?msg=Wishlist has been sent successfully.'</script>";
	}
	else
	{
		echo "<script>window.location.href='share-wishlist.php?msg=Please enter email address.'</script>";
	}		
}
?>
<? include("header.php");?>
<body>
 <div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
            <div id="content"> 
            <?php breadcrumbs(); ?>
            <style>
            table td{
				padding:10px 1px;
			}
            </style> 
          				<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="32" align="left" valign="top" class="font-20-gra"><?php e_upstrt('Share Your Wishlist');?></td>
                    </tr>
                    <tr>
                      <td align="center" valign="top"><table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="610" align="left" valign="top">
							<form name="FrmSignup" id="FrmSignup" enctype="multipart/form-data" method="post">
							<table width="600" border="0" cellspacing="0" cellpadding="0">
                               <? if(!empty($_REQUEST['msg'])){ ?>
                                <tr>
                                  <td align="left" valign="middle" style="color:#FF0000;"><? echo $_REQUEST['msg']; ?>&nbsp;</td>
                                </tr>
                                <? } ?>
                                <tr>
                                  <td align="left" valign="middle">
								  	<table width="100%" border="0" cellspacing="2"  cellpadding="0">
										<tr>
											<td align="left" valign="top" class="font-13-gra" height="35"><strong><?php e_strt('Sharing Information');?></strong></td>
										</tr>
										<tr>
											<td align="left" valign="top" class="font-13-gra"><?php e_strt('Email addresses, separated by commas');?></td>
										</tr>
										<tr>
											<td align="left" valign="top" class="font-13-gra"><textarea name="emailsto" style="padding: 2px;float: left;height: 100px;width: 300px;border: 1px solid #bfbfbf;font-size: 12px;" id="emailsto"></textarea></td>
										</tr>
										<tr>
											<td align="left" valign="top" class="font-13-gra"><?php e_strt('Message');?></td>
										</tr>
										<tr>
											<td align="left" valign="top" class="font-13-gra"><textarea name="message" style="padding: 2px;float: left;height: 100px;width: 300px;border: 1px solid #bfbfbf;font-size: 12px;" id="message"></textarea></td>
										</tr>
										<tr>
											<td align="left" valign="middle" height="40" class="font-13-gra">
											<input type="hidden" name="hidchk" id="hidchk" value="" />
						<input type="button" id="Sharewishlist" value="<?php e_upstrt('Share wishlist');?>" onClick="return frmcheck();" class="JAbutton"/>
                        <input type="button" value="<?php e_upstrt('BACK');?>" onClick="window.location.href='favorites.php'" class="JAbutton" style="padding-left:55px;"/>                          
											
											</td>
										</tr>				 
									</table>
								  </td>
                                </tr>
                               
                              </table>
							</form>
							</td>
                            <td width="253" align="left" style="padding-left:51px;" valign="top"><? //include("right_facebook.php");?></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                  </div>  
        </div>
        
    </div>
    <? include("footer.php");?>
<script language="javascript1.1" type="text/javascript">
function frmcheck()
{
	var frm=document.FrmSignup;
	/*if(frm.emailsto.value=="");
	{
		alert("Please enter Email addresses, separated by commas.");
		frm.emailsto.focus();
		return false;
	}
	if(frm.message.value=="");
	{
		alert("Please enter your message.");
		frm.message.focus();
		return false;
	}*/
	
	frm.hidchk.value=1;
	frm.submit();
	return true;
}
</script>
<? include("googleanalytic.php");?>
</body>
</html>