<? 
header("location:index.php");
exit;
include("connect.php"); 
$id=trim(mysql_real_escape_string($_REQUEST['id']));
$entity_id=trim(mysql_real_escape_string($_REQUEST['entity_id']));
//if($entity_id!="" && $id!="")
if($id!="")
{
	//$productsQry="SELECT id,entity_id,sku,colors_shown,colors_avail,image_small,relateditems FROM products WHERE id='$id' and entity_id='$entity_id' order by entity_id asc";
	$productsQry="SELECT * FROM products WHERE id='$id' order by entity_id asc";
	$productsQryRs=mysql_query($productsQry);
	$Totproducts=mysql_affected_rows();
	if($Totproducts<=0)
	{
		header("location:index.php");
		exit;
	}
	else
	{
		$productsQryRow=mysql_fetch_array($productsQryRs);
		$colors_avail="";
		$Expcolors_avail="";
		if($productsQryRow['colors_avail']!="")
		{
			$Expcolors_avail=explode(",",$productsQryRow['colors_avail']);
			for($AC=0;$AC<count($Expcolors_avail);$AC++)
			{
				$colors_availQryRs=mysql_query("SELECT * from products_colors where id='".$Expcolors_avail[$AC]."'");
				$colors_availQryRow=mysql_fetch_array($colors_availQryRs);
				$colors_avail.=stripslashes($colors_availQryRow['name'])."<br>";
			}
		}
		$colors_shown="";
		$Expcolors_shown="";
		if($productsQryRow['colors_shown']!="")
		{
			$Expcolors_shown=explode(",",$productsQryRow['colors_shown']);
			for($AS=0;$AS<count($Expcolors_shown);$AS++)
			{
				$colors_shownQryRs=mysql_query("SELECT * from products_colors where id='".$Expcolors_shown[$AS]."'");
				$colors_shownQryRow=mysql_fetch_array($colors_shownQryRs);
				$colors_shown.=stripslashes($colors_shownQryRow['name'])."<br>";
			}
		}
	}
}
else
{
	header("location:collectionlist.php");
	exit;
}	
?>
<? include("header.php");?>
<body>
<script type="text/javascript" src="js/jquery.sudoSlider.js"></script>
<script type="text/javascript">
$(document).ready(function(){	
	$("#slider").sudoSlider();
});	
</script>
<script type="text/javascript" src="js/iepngfix_tilebg.js"></script>
<style type="text/css">
img, div, input ,td{ behavior: url("iepngfix.htc") }
</style>
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top"><? include("top.php");?></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="1164" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="215" align="left" valign="top"><? include("left.php");?></td>
                <td width="879" align="right" valign="top"><table width="720" border="0" align="center" cellpadding="5" cellspacing="0">
                    <tr>
                      <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="left" valign="top" class="font-20-gra"><?php echo strtoupper($SITE_NAME);?></td>
                            <td align="right" valign="top"><a href="collectionlist.php?collection=1"><img src="images/view-full-coll-btn.gif" width="195" height="23" border="0" /></a></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" class="gra_border1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <?
										  $prodId = $productsQryRow['id'];
										  	  $selsql = " select * from productimages where pid=$prodId AND type='image'  order by displayorder asc LIMIT 0,1" ;
											  $selres = mysql_query($selsql);
											  		$imgRow=mysql_fetch_array($selres);
										  ?>
                            <td width="320" align="left" valign="top"><? if($imgRow['pimage']!=""){?><img id="MainImage" src="<?=$PRODUCT_URL;?>/images/<?=$imgRow['pimage'];?>" width="312" <?php /*?>height="447"<?php */?> /><? }else{?><img src="images/noimage-312-447.jpg"  border="0" /><? } ?></td>
                            <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                                <tr>
                                  <td align="left" valign="top" class="font14-wht"><?=stripslashes($productsQryRow['sku']);?><br /><? if($colors_shown!=""){?>Pictured: <?=$colors_shown;?><? } ?></td>
                                </tr>
								<tr>
                                  <td align="left" valign="top" class="gra_border1"><div id="container" style="position:relative;">
                                      <div id="content">
                                        <div id="slider" class="slider">
                                          <ul style="text-align:center;"><input type="hidden" name="HidMainImage" id="HidMainImage" />
                                          <?
										  function is_odd( $int )
											{
											  return( $int & 1 );
											}
										  $prodId = $productsQryRow['id'];
										  	  $selsql = " select * from productimages where pid=$prodId AND type='image' order by displayorder asc" ;
											  $selres = mysql_query($selsql);
											  
											  $i = 1;
											  while($obj=mysql_fetch_object($selres))
											{
										  ?>
													 <?
													 //write the opening tag if this is an odd number
														if(is_odd($i))
														{
														?>
													<li>
                                                    <?
														}
														//end odd number check
													?>
														<img src="images/thumbseperator.gif" /><img style="cursor:pointer;" onClick="document.getElementById('HidMainImage').value=this.src;this.src=document.getElementById('MainImage').src;document.getElementById('MainImage').src=document.getElementById('HidMainImage').value;" id="subimage3" src="<?=$PRODUCT_URL;?>/images/<?=$obj->pimage;?>" alt="<?=stripslashes($productsQryRow['sku']);?>" title="<?=stripslashes($productsQryRow['sku']);?>"  height="154"/>
                                                        <?
														if(!is_odd($i))
														{
														?>
													</li>
                                                    <?
														}
														//end odd number check
													?>
                                          <?
										  $i++;
											}
											//end images while
											?>
											</ul>
                                        </div>
                                      </div>
                                    </div></td>
                                </tr>
                                <tr>
                                  <td align="left" valign="top" class="gra_border1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <? if($colors_avail!=""){?>
											<tr>
                                              <td width="39%" align="left" valign="top" class="font14-wht"><? if($colors_avail!=""){?>Available<br />Colors<? } ?></td>
                                              <td width="61%" align="left" valign="top" class="font14-wht"><?=$colors_avail;?></td>
                                            </tr>
											<? } ?>
                                            <tr>
                                              <td align="left" valign="top" class="font14-wht">&nbsp;</td>
                                              <td align="left" valign="top" class="font14-wht">&nbsp;</td>
                                            </tr>
											<? if( ($productsQryRow['silhouette']!="" && $productsQryRow['silhouette']!="NULL") || ($productsQryRow['neckline']!="" && $productsQryRow['neckline']!="NULL")  || ($productsQryRow['weist']!="" && $productsQryRow['weist']!="NULL")  || ($productsQryRow['dresslength']!="" && $productsQryRow['dresslength']!="NULL")  ){?>
                                            <tr>
                                              <td align="left" valign="top" class="font14-wht"><?php e_strt("Features");?></td>
                                              <td align="left" valign="top" class="font14-wht">
											  <? if( ($productsQryRow['silhouette']!="" && $productsQryRow['silhouette']!="NULL"))
											     {
												 		$silhouette="- ";
														$Expsilhouette="";
														$Expsilhouette=explode(",",$productsQryRow['silhouette']);
														for($AC5=0;$AC5<count($Expsilhouette);$AC5++)
														{
															$silhouetteQryRs=mysql_query("SELECT * from products_silhouette where id='".$Expsilhouette[$AC5]."'");
															$silhouetteQryRow=mysql_fetch_array($silhouetteQryRs);
															$silhouette.=stripslashes($silhouetteQryRow['name']).", ";
														}
														echo substr($silhouette,0,-2)."<br />";
												 } 
											   ?>
											   <? if( ($productsQryRow['neckline']!="" && $productsQryRow['neckline']!="NULL"))
											     {
												 		$neckline="- ";
														$Expneckline="";
														$Expneckline=explode(",",$productsQryRow['neckline']);
														for($AC6=0;$AC6<count($Expneckline);$AC6++)
														{
															$necklineQryRs=mysql_query("SELECT * from products_neckline where id='".$Expneckline[$AC6]."'");
															$necklineQryRow=mysql_fetch_array($necklineQryRs);
															$neckline.=stripslashes($necklineQryRow['name']).", ";
														}
														echo substr($neckline,0,-2)."<br />";
												 } 
											   ?>
											   <? if( ($productsQryRow['weist']!="" && $productsQryRow['weist']!="NULL"))
											     {
												 		$weist="- ";
														$Expweist="";
														$Expweist=explode(",",$productsQryRow['weist']);
														for($AC7=0;$AC7<count($Expweist);$AC7++)
														{
															$weistQryRs=mysql_query("SELECT * from products_weist where id='".$Expweist[$AC7]."'");
															$weistQryRow=mysql_fetch_array($weistQryRs);
															$weist.=stripslashes($weistQryRow['name']).", ";
														}
														echo substr($weist,0,-2)."<br />";
												 } 
											   ?>
											   <? if( ($productsQryRow['dresslength']!="" && $productsQryRow['dresslength']!="NULL"))
											     {
												 		$dresslength="- ";
														$Expdresslength="";
														$Expdresslength=explode(",",$productsQryRow['dresslength']);
														for($AC8=0;$AC8<count($Expdresslength);$AC8++)
														{
															$dresslengthQryRs=mysql_query("SELECT * from products_dresslength where id='".$Expdresslength[$AC8]."'");
															$dresslengthQryRow=mysql_fetch_array($dresslengthQryRs);
															$dresslength.=stripslashes($dresslengthQryRow['name']).", ";
														}
														echo substr($dresslength,0,-2)."<br />";
												 } 
											   ?>
                                                <? if( ($productsQryRow['Accessories']!="" && $productsQryRow['Accessories']!="NULL"))
											     {
												 		$accessory="- ";
														$Expdressaccessory="";
														$Expdressaccessory=explode(",",$productsQryRow['Accessories']);
														for($AC9=0;$AC9<count($Expdressaccessory);$AC9++)
														{
															$dressaccessoryQryRs=mysql_query("SELECT * from productaccessories where AccessoryId='".$Expdressaccessory[$AC9]."'");
															$dressaccessoryQryRow=mysql_fetch_array($dressaccessoryQryRs);
															$accessory.=stripslashes($dressaccessoryQryRow['AccessoryName']).", ";
														}
														echo substr($accessory,0,-2)."<br />";
												 } 
											   ?>
											  </td>
                                            </tr>
											<? } ?>
                                          </table></td>
                                        <td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                            <tr>
                                              <td align="left" valign="top"><a href="addtofav.php?id=<?=$productsQryRow['id'];?>&entity_id=<?=$productsQryRow['entity_id'];?>"><img src="images/add-to-favorites.gif" width="151" height="24" border="0" /></a></td>
                                            </tr>
                                            <tr>
                                              <td align="left" valign="top"><a href="prodprint.php?id=<?= $_REQUEST['id'] ?>&entity_id=<?= $_REQUEST['entity_id'] ?>" target="_prnt"><img src="images/print-btn.gif" width="151" height="24" border="0" /></a></td>
                                            </tr>
                                            <tr>
                                              <td align="left" valign="top"><a href="find-a-store.php"><img src="images/find-a-store.gif" width="151" height="24" border="0" /></a></td>
                                            </tr>
                                            <tr>
                                              <td align="left" valign="top">
                                               <div><a href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4b5d485814507317" class="addthis_button_compact"><img align="left" src="images/share_btn1.gif" width="151" height="24"  border="0" /></a></div>
											 				   <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4b5d485814507317"></script>
                                                               <script type="text/javascript">
																var addthis_share =
																{
																	title: "<? echo("Check out style ".$productsQryRow['sku']." by Justin Alexander!"); ?>",
																	description: ""
																}
																</script>
											  </td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                    </table></td>
                                </tr>
								<? if($productsQryRow['relateditems']!=""){?>
                                <tr>
                                  <td align="left" valign="top" class="gra_border1"><table border="0" cellspacing="0" cellpadding="2">
                                      <tr>
                                        <td align="left" valign="middle" class="font14-wht">Smiliar<br />Dresses</td>
                                        <td align="left" valign="top">
											   <table width="100%" border="0" cellspacing="1" cellpadding="4">
												   <?
													 if($productsQryRow['relateditems']!="") 
													  { 
															$totrelated=$productsQryRow['relateditems'];
													  }
													  else
													  {
															$totrelated=0;
													  }
													  $search_qry="select id,image_thumb1,sku from products where id in (".$totrelated.") order by sku asc";					
													  $search_res=mysql_query($search_qry);
													  $tot_search=mysql_affected_rows();
													  if($tot_search>0)  
													  {
													  		for($SS=0;$SS<$tot_search;$SS++)
															{
																$search_row=mysql_fetch_array($search_res); 
																if($SS%7==0)
																{
																	echo "</tr><tr>";
																}
												  			?><td align="left" valign="top"><a href="product-detail.php?id=<?=$search_row['id'];?>"><? if($search_row['image_thumb1']!=""){?>
																	<img src="onlinethumb.php?nm=<?=$PRODUCT_URL;?>/thumbnail/<?=$search_row['image_thumb1'];?>&mwidth=34&mheight=34" alt="<?=$search_row['sku'];?>" title="<?=$search_row['sku'];?>"   border="0"/>
																<? }else{?>
																	<img src="images/noimage-34-34.jpg" alt="<?=$search_row['sku'];?>" title="<?=$search_row['sku'];?>" width="34" height="34" border="0"/>
																<? } ?></a></td>
														 <? } ?>		
												  <? } ?>		  
												</table>

										</td>
                                      </tr>
									  
                                    </table></td>
                                </tr>
								<? } ?>
								<?
								if($_SESSION['SESSION_COLLECTIONLISTQRY']!="")
								{
									   /////////get next and previous rest/
										$idArray = array();
										$query11=$_SESSION['SESSION_COLLECTIONLISTQRY']."  order by collectionyear desc,season asc,sku asc";
										$result11 = mysql_query( $query11 );
										for ($h=0 ; $row11 = mysql_fetch_row($result11); $h++){
											$idArray[$h] = $row11[0];
											if ($row11[0] == $_REQUEST['id']){
												$tack = $h;
											}
										}
										$prevID = $idArray[$tack-1];
										$nextID = $idArray[$tack+1];
										
									  /* $productsQryTEMP=$_SESSION['SESSION_COLLECTIONLISTQRY']."  order by entity_id asc";
									   $productsQryRsTEMP=mysql_query($productsQryTEMP);
									   $TotproductsTEMP=mysql_affected_rows();
									   if($TotproductsTEMP>0)
									   {
											$resultTEMP=$prs_pageing->number_pageing_nodetail_ja($productsQryTEMP,8,5,"Y","Y");*/
										?>
										<tr>
										  <td align="left" valign="top" class="gra_border1"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
											  <tr>
												<td width="140" align="left" valign="bottom"><? if($prevID!=""){?><img src="images/prv-arrow.gif" width="8" height="9" />&nbsp;<a href="product-detail.php?id=<?=$prevID;?>" class="pre">Previous</a><? } ?></td>
												<td width="100" align="center" valign="bottom" class="link_one_select"><?php /*?>1&nbsp;&nbsp;<a href="#" class="link_footer1">2</a>&nbsp;&nbsp;<a href="#" class="link_footer1">3</a>&nbsp;&nbsp;<a href="#" class="link_footer1">4</a>&nbsp;&nbsp;<a href="#" class="link_footer1">5</a>&nbsp;&nbsp;<?php */?></td>
												<td width="130" align="right" valign="bottom"><? if($nextID!=""){?><a href="product-detail.php?id=<?=$nextID;?>" class="pre">Next</a>&nbsp;&nbsp;<img src="images/next-arrow.gif" width="8" height="9" /><? } ?></td>
											  </tr>
											</table></td>
										</tr>
									<?php /*?><? } ?>	<?php */?>
							  <? } ?>			
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="left" valign="top">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="35" align="center" valign="top">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="top"><? include("footer.php");?></td>
  </tr>
</table>
<? include("googleanalytic.php");?>
</body>
</html>