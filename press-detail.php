<? include("connect.php"); 
$productsQry="select * from press  where 1=1 and id='".mysql_real_escape_string(trim($_REQUEST['id']))."' ";
$productsQryRs=mysql_query($productsQry);
$Totproducts=mysql_affected_rows();
if($Totproducts<=0)
{
	header("locaiton:press.php");
	exit;
}
else
{
	$rowpress=mysql_fetch_array($productsQryRs);
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
                <table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="30" align="left" valign="top" class="font-20-gra">
					  <?php e_strt('Press');?>
					 </td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" class="gra_border1"><table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="645" align="left" valign="top"><table width="600" border="0" align="left" cellpadding="10" cellspacing="0">
                               	<tr>
								  <td align="left" valign="top" class="gra_border1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
									  <tr>
										<? if($rowpress['picture']!=""){?><td width="115" align="left" valign="top"><a  class="font-16-gra-new" href="press-detail.php?id=<?=stripslashes($rowpress['id']);?>"><img src="<?=$PRESS_URL;?>/thumb/<?=$rowpress['picture'];?>"  border="0" /></a></td><? } ?>
										<td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
											<tr>
											  <td align="left" valign="top" class="font-16-gra"><a  class="font-16-gra-new" href="press-detail.php?id=<?=stripslashes($rowpress['id']);?>"><?=stripslashes($rowpress['title']);?></a></td>
											</tr>
											<tr>
											  <td height="20" align="left" valign="top" class="font-10-gra"><?=$rowpress['issue'];?></td>
											</tr>
											<tr>
											  <td align="left" valign="top" class="font-10-gra"><span class="font-12-gra"><?=stripslashes($rowpress['long_desc']);?></span></td>
											</tr>
											<? if($rowpress['pdf']!="" | $rowpress['url'] != "" ){?>
													<tr>
                                                    <? if(stripos($rowpress['url'], 'http') !== false) {//then link directly to the url ?>
                                              		  <td align="right" valign="top" class="font-10-gra"><a href="<?=$rowpress['url'];?>" target="_blank" class="link3">View Article</a></td>
                                                      <? }else{ ?>
													  <td align="right" valign="top" class="font-10-gra"><a href="<?=$PRESS_URL;?>/pdf/<?=$rowpress['pdf'];?>" target="_blank" class="link3">View Article</a></td>
                                                      <? } ?>
													</tr>
													 <? } ?>
										  </table></td>
									  </tr>
									</table></td>
								</tr>
						       <tr>
                                  <td align="right" valign="top" class="gra_border1"><a href="press.php" class="link3"><< Back</a></td>
                                </tr>
                              </table></td>
                            <td width="202" align="left" valign="top"><? //include("right_facebook.php");?></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                  </div>  
        </div>
        
    </div>
    <? include("footer.php");?>
<? include("googleanalytic.php");?>
</body>
</html>