<? include("connect.php"); 
function getMonthName($id="")
{	
	$id=intval($id);
	$mon=array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	return $mon[$id];
}
?>
<?php 
$page_title = ' | '.ucwords(strtolower(strt("Trunk Shows")));
?>
<? include("header.php"); $page_name = strt("Trunk Shows");?>
<body>
    <div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
            <div id="content" >
             <?php breadcrumbs(); ?>
            <div class="pageTitle">
                <h2>
               <?php e_upstrt("Trunk Shows");?>
                </h2>
            </div>
           
        <table width="600" border="0" align="left" cellpadding="10" cellspacing="0" style="margin-top:20px;">
            <tr>
              <td align="left" valign="top">
              <form name="FrmSrchDgnr" id="FrmSrchDgnr" enctype="multipart/form-data" method="get">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <?  if(trim($_REQUEST['zipcode'])!="" && trim($_REQUEST['zipcode'])!="Zip" ){$ZIP=trim($_REQUEST['zipcode']);}else{$ZIP="Zip";} ?>
                  <tr>
                    <td width="250" align="left" valign="middle">
                    <table width="90%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="90" align="left" valign="middle" class="font-11-blk">
                          <?php e_strt("Search by");?>:</td>
                          <td width="180" align="left" valign="middle">
                          <select name="country" class="text_field3"  id="country" style="width:180px;">
                          <option value=""><?php e_strt('Country');?></option>
                          <?=GetDropdown(country_id,name,directory_country,' where country_id!=\'\' and name!=\'\' order by name asc',$_REQUEST['country']);?></select></td>
                        </tr>
                      </table></td>
                    <td width="300" align="left" valign="middle">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <?php /*?><td width="20" align="left" valign="middle" class="font-11-blk">Or</td><?php */?>
                          <td width="70" align="left" valign="middle">
                          <select name="month" class="text_field3" id="month" style="width:70px;">
                          <option value=""><?php e_strt('Month');?></option><? echo getMonth_new($_REQUEST['month']);?>
                          </select></td>
                          <td width="80" align="left" valign="middle">
                          <select name="year" class="text_field3" id="year" style="width:70px;">
                          <option value=""><?php e_strt('Year');?></option><? echo expYear($_REQUEST['year']);?>
                          </select></td>
                          <td width="80" align="left" valign="middle">
                          <input type="submit" value="<?php e_upstrt('SEARCH');?>" class="searchLocation"/></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
              </form>
              </td>
            </tr>
            <tr >
              <td align="left" valign="top" style="padding-top:20px;">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="33%" valign="top">
                    <? 
                        if($_REQUEST['zipcode']!="" && $_REQUEST['zipcode']!="Zip"){$AndQry=" and zipcode='".trim($_REQUEST['zipcode'])."'";}
                        if($_REQUEST['country']!=""){$AndQry.=" and country='".trim($_REQUEST['country'])."'";}
                        $AndQry.=" and concat(',',concat(websiteid,','))  like '%,".SITE_ID.",%'";
                        if($_REQUEST['month']!=""){$CURRENTMONTH=$_REQUEST['month']-1;if($CURRENTMONTH==0){$CURRENTMONTH=12;}}else{$CURRENTMONTH=date('m');}
                        if($_REQUEST['year']!=""){$CURRENTYEAR=$_REQUEST['year'];}else{$CURRENTYEAR=date('Y');}
                        
                        //$curdate1111=gmdate("Y-m-d");
                        $curdate1111=$CURRENTYEAR."-".$CURRENTMONTH."-01";
                        $SelectExpiredDate1="SELECT DATE_ADD(\"$curdate1111\", INTERVAL \"1\" MONTH) as uppdate1";
                        $SelectExpiredDate1Rs1=mysql_query($SelectExpiredDate1);
                        $srow1=mysql_fetch_object($SelectExpiredDate1Rs1);
                        $Nextdate1=explode("-",$srow1->uppdate1);
                        $Nextmonth1=$Nextdate1[1];
                        $Nextyear1=$Nextdate1[0];
                        
                        $SelectExpiredDate2="SELECT DATE_ADD(\"$curdate1111\", INTERVAL \"2\" MONTH) as uppdate2";
                        $SelectExpiredDate1Rs2=mysql_query($SelectExpiredDate2);
                        $srow2=mysql_fetch_object($SelectExpiredDate1Rs2);
                        $Nextdate2=explode("-",$srow2->uppdate2);
                        $Nextmonth2=$Nextdate2[1];
                        $Nextyear2=$Nextdate2[0];
                        if($_REQUEST['year']!="")
                        {
                            $Nextyear1=$_REQUEST['year'];$Nextyear2=$_REQUEST['year'];
                        }
                        else
                        {
                            $CURRENTYEAR=date('Y');$Nextyear1=$Nextyear1;$Nextyear2=$Nextyear2;
                        }
                    ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                                <td height="35" align="left" valign="top" class="font-18-gra"><em><? echo getMonthName($CURRENTMONTH);?></em></td>
                          </tr>	
                          <?
                          $SelQry1="SELECT * FROM designerdays WHERE date_format(fromdate,'%Y-%m')='$CURRENTYEAR-$CURRENTMONTH' $AndQry order by date_format(fromdate,'%Y-%m-%d') asc";
                          $SelQryRs1=mysql_query($SelQry1);
                          $TotSel1=mysql_affected_rows();
                          if($TotSel1>0)
                          {
                                for($T1=0;$T1<$TotSel1;$T1++)
                                {
                                $SelQryRow1=mysql_fetch_array($SelQryRs1);
                          ?>
                                  <tr>
                                      <td align="left" valign="top" class="font-12-gra" >
                                        <? if($SelQryRow1['fromdate']!=""){?><? echo date("M jS",strtotime(stripslashes($SelQryRow1['fromdate'])));?><? }?> - <? if($SelQryRow1['enddate']!=""){?><? echo date("M jS",strtotime(stripslashes($SelQryRow1['enddate'])));?><? }?><br />
                                        <? if($SelQryRow1['name']!=""){?><? echo stripslashes($SelQryRow1['name']);?><br /><? } ?>
                                        <? if($SelQryRow1['address']!=""){?><? echo stripslashes($SelQryRow1['address']);?><br /><? } ?>
                                        <? if($SelQryRow1['city']!=""){?><? echo stripslashes($SelQryRow1['city']);?><? } ?><? if($SelQryRow1['state']!=""){?>, <? echo stripslashes($SelQryRow1['state']);?><? } ?><br />
                                        <? if($SelQryRow1['country']!=""){?><? echo stripslashes($SelQryRow1['country']);?><? } ?><? if($SelQryRow1['zipcode']!=""){?>, <? echo stripslashes($SelQryRow1['zipcode']);?><? } ?><br />
                                        <? if($SelQryRow1['phone']!=""){?>TEL. <? echo stripslashes($SelQryRow1['phone']);?><br /><? } ?>
                                        <? if($SelQryRow1['collection']!=""){?>
                                            <?php e_upstrt("COLLECTIONS");?>:<br />
                                            <?
                                                $collection="";
                                                $Expcollection="";
                                                if($SelQryRow1['collection']!="")
                                                {
                                                    $Expcollection=explode(",",$SelQryRow1['collection']);
                                                    for($AS=0;$AS<count($Expcollection);$AS++)
                                                    {
                                                        $collectionQryRs=mysql_query("SELECT * from products_collections where id='".$Expcollection[$AS]."'");
                                                        $collectionQryRow=mysql_fetch_array($collectionQryRs);
                                                        $collection.=stripslashes($collectionQryRow['name'])."<br />";
                                                    }
                                                }
                                                echo $collection;
                                            ?>
                                        <? } ?>
                                        </td>
                                 </tr>
                                 <tr>
                                     <td align="left" valign="top" class="font-12-gra">&nbsp;</td>
                                 </tr>
                            <? } ?>
                        <? }else{ ?>
                            <tr>
                                 <td align="left" valign="top" class="font-12-gra">
                                  <?php e_strt('Currently no events');?>.<br />
                                 <?php e_strt('Please check back');?>.</td>
                             </tr>
                        <? }?>
                       </table>
                    </td>
                    <td width="33%" valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                                <td height="35" align="left" valign="top" class="font-18-gra"><em><? echo getMonthName($Nextmonth1);?></em></td>
                          </tr>	
                          <?
                          $SelQry1="SELECT * FROM designerdays WHERE date_format(fromdate,'%Y-%m')='$Nextyear1-$Nextmonth1' $AndQry order by date_format(fromdate,'%Y-%m-%d') asc";
                          $SelQryRs1=mysql_query($SelQry1);
                          $TotSel1=mysql_affected_rows();
                          if($TotSel1>0)
                          {
                                for($T1=0;$T1<$TotSel1;$T1++)
                                {
                                $SelQryRow1=mysql_fetch_array($SelQryRs1);
                          ?>
                                  <tr>
                                      <td align="left" valign="top" class="font-12-gra" >
                                        <? if($SelQryRow1['fromdate']!=""){?><? echo date("M jS",strtotime(stripslashes($SelQryRow1['fromdate'])));?><? }?> - <? if($SelQryRow1['enddate']!=""){?><? echo date("M jS",strtotime(stripslashes($SelQryRow1['enddate'])));?><? }?><br />
                                        <? if($SelQryRow1['name']!=""){?><? echo stripslashes($SelQryRow1['name']);?><br /><? } ?>
                                        <? if($SelQryRow1['address']!=""){?><? echo stripslashes($SelQryRow1['address']);?><br /><? } ?>
                                        <? if($SelQryRow1['city']!=""){?><? echo stripslashes($SelQryRow1['city']);?><? } ?><? if($SelQryRow1['state']!=""){?>, <? echo stripslashes($SelQryRow1['state']);?><? } ?><br />
                                        <? if($SelQryRow1['country']!=""){?><? echo stripslashes($SelQryRow1['country']);?><? } ?><? if($SelQryRow1['zipcode']!=""){?>, <? echo stripslashes($SelQryRow1['zipcode']);?><? } ?><br />
                                        <? if($SelQryRow1['phone']!=""){?>TEL. <? echo stripslashes($SelQryRow1['phone']);?><br /><? } ?>
                                        <? if($SelQryRow1['collection']!=""){?>
                                            <?php e_upstrt("COLLECTIONS");?>:<br />
                                            <?
                                                $collection="";
                                                $Expcollection="";
                                                if($SelQryRow1['collection']!="")
                                                {
                                                    $Expcollection=explode(",",$SelQryRow1['collection']);
                                                    for($AS=0;$AS<count($Expcollection);$AS++)
                                                    {
                                                        $collectionQryRs=mysql_query("SELECT * from products_collections where id='".$Expcollection[$AS]."'");
                                                        $collectionQryRow=mysql_fetch_array($collectionQryRs);
                                                        $collection.=stripslashes($collectionQryRow['name'])."<br />";
                                                    }
                                                }
                                                echo $collection;
                                            ?>
                                        <? } ?>
                                        </td>
                                 </tr>
                                 <tr>
                                     <td align="left" valign="top" class="font-12-gra">&nbsp;</td>
                                 </tr>
                            <? } ?>
                        <? }else{ ?>
                            <tr>
                                 <td align="left" valign="top" class="font-12-gra">
                                  <?php e_strt('Currently no events');?>.<br />
                                 <?php e_strt('Please check back');?>.</td>
                             </tr>
                        <? }?>
                       
                        </table>
                    </td>
                    <td width="33%" valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                                <td height="35" align="left" valign="top" class="font-18-gra">
                                <em><? echo getMonthName($Nextmonth2);?></em></td>
                          </tr>	
                         <?
                          $SelQry1="SELECT * FROM designerdays WHERE date_format(fromdate,'%Y-%m')='$Nextyear2-$Nextmonth2'  $AndQry order by date_format(fromdate,'%Y-%m-%d') asc";
                          $SelQryRs1=mysql_query($SelQry1);
                          $TotSel1=mysql_affected_rows();
                          if($TotSel1>0)
                          {
                                for($T1=0;$T1<$TotSel1;$T1++)
                                {
                                $SelQryRow1=mysql_fetch_array($SelQryRs1);
                          ?>
                                  <tr>
                                      <td align="left" valign="top" class="font-12-gra" >
                                        <? if($SelQryRow1['fromdate']!=""){?><? echo date("M jS",strtotime(stripslashes($SelQryRow1['fromdate'])));?><? }?> - <? if($SelQryRow1['enddate']!=""){?><? echo date("M jS",strtotime(stripslashes($SelQryRow1['enddate'])));?><? }?><br />
                                        <? if($SelQryRow1['name']!=""){?><? echo stripslashes($SelQryRow1['name']);?><br /><? } ?>
                                        <? if($SelQryRow1['address']!=""){?><? echo stripslashes($SelQryRow1['address']);?><br /><? } ?>
                                        <? if($SelQryRow1['city']!=""){?><? echo stripslashes($SelQryRow1['city']);?><? } ?><? if($SelQryRow1['state']!=""){?>, <? echo stripslashes($SelQryRow1['state']);?><? } ?><br />
                                        <? if($SelQryRow1['country']!=""){?><? echo stripslashes($SelQryRow1['country']);?><? } ?><? if($SelQryRow1['zipcode']!=""){?>, <? echo stripslashes($SelQryRow1['zipcode']);?><? } ?><br />
                                        <? if($SelQryRow1['phone']!=""){?>TEL. <? echo stripslashes($SelQryRow1['phone']);?><br /><? } ?>
                                        <? if($SelQryRow1['collection']!=""){?>
                                        <?php e_upstrt("COLLECTIONS");?>:<br />
                                            <?
                                                $collection="";
                                                $Expcollection="";
                                                if($SelQryRow1['collection']!="")
                                                {
                                                    $Expcollection=explode(",",$SelQryRow1['collection']);
                                                    for($AS=0;$AS<count($Expcollection);$AS++)
                                                    {
                                                        $collectionQryRs=mysql_query("SELECT * from products_collections where id='".$Expcollection[$AS]."'");
                                                        $collectionQryRow=mysql_fetch_array($collectionQryRs);
                                                        $collection.=stripslashes($collectionQryRow['name'])."<br />";
                                                    }
                                                }
                                                echo $collection;
                                            ?>
                                        <? } ?>
                                        </td>
                                 </tr>
                                 <tr>
                                     <td align="left" valign="top" class="font-12-gra">&nbsp;</td>
                                 </tr>
                            <? } ?>
                        <? }else{ ?>
                            <tr>
                                 <td align="left" valign="top" class="font-12-gra">
                                 <?php e_strt('Currently no events');?>.<br />
                                 <?php e_strt('Please check back');?>.</td>
                             </tr>
                        <? }?>
                        </table>
                    </td>
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