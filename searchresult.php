<? include("connect.php"); 
if(trim($_REQUEST['type'])!="")
{
	if(trim($_REQUEST['type'])=="newarrival")
	{
		$PageTitle="New Arrivals";
	}	
	if(trim($_REQUEST['type'])=="designerpicks")
	{
		$PageTitle="Designer Picks";
	}	
}
else
{
	$q = stripslashes(stripslashes(trim($_REQUEST['srch'])));
	$PageTitle="Search results for '".$q."'";
}
?>
<?php
$per_page = 6;
if(isset($_REQUEST['per_page'])){
   $per_page = $_REQUEST['per_page'];
}
?>
<? 
$page_title = ' | '.ucwords(strtolower(strt($PageTitle)));
include("header.php");?>
<?php
$page_name = strt($PageTitle);
?>
<body>
 <div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
            <div id="content">
            <?php breadcrumbs(); ?> 
            <?php if(!empty($q)){ ?>
            <div class="pageTitle">
                <h2 style="padding-left:10px; font-weight:normal; font-size:26px;">                
               <?php 
			   e_strt("Search results for");
			   echo " '".$q."'";
			   ?>
                </h2>
            </div>
            <?php } ?>
            
             <input type="hidden" name="proid" id="proid" value="" />
                <input type="hidden" name="entity_id" id="entity_id" value="" />               
		   <?
           if(trim($_REQUEST['silhouette'])!=""){$AndQry.=" and concat(',',concat(silhouette,','))  like '%,".trim($_REQUEST['silhouette']).",%'";}
           if(trim($_REQUEST['neckline'])!=""){$AndQry.=" and concat(',',concat(neckline,','))  like '%,".trim($_REQUEST['neckline']).",%'";}
           if(trim($_REQUEST['weist'])!=""){$AndQry.=" and concat(',',concat(weist,','))  like '%,".trim($_REQUEST['weist']).",%'";}
           if(trim($_REQUEST['dresslength'])!=""){$AndQry.=" and concat(',',concat(dresslength,','))  like '%,".trim($_REQUEST['dresslength']).",%'";}
           //if(trim($_REQUEST['dresscolor'])!=""){$AndQry.=" and concat(',',concat(dresscolor,','))  like '%,".trim($_REQUEST['dresscolor']).",%'";}
           if(trim($_REQUEST['dresscolor'])!="")
           {
                $GetDressColorsQry="SELECT colors FROM products_dresscolor WHERE id='".$_REQUEST['dresscolor']."'";
                $GetDressColorsQryRs=mysql_query($GetDressColorsQry);
                $GetDressColorsQryRow=mysql_fetch_array($GetDressColorsQryRs);
                $colors=$GetDressColorsQryRow['colors'];
                if($colors!="")
                {
                    $expcolors=explode(",",$colors);
                    $AndQry2="";
                    $AndQry2.=" and (";
                    for($cc=0;$cc<count($expcolors);$cc++)
                    {
                        $currentcolor=$expcolors[$cc];
                        $AndQry2.=" concat(',',concat(colors_avail,','))  like '%,".trim($currentcolor).",%' or";
                    }
                    $AndQry2=substr($AndQry2,0,-2);
                    $AndQry2.=" ) ";
                    $AndQry.=$AndQry2;
                }
                else
                {
                    $AndQry.=" 1!=1";
                }
                
           }
           if(trim($_REQUEST['collection2'])!=""){$AndQry.="  and concat(',',concat(collection,','))  like '%,".trim($_REQUEST['collection2']).",%'";}
           if(trim($_REQUEST['type'])!=""){$AndQry.="  and ".trim($_REQUEST['type'])."='Y'";}
            if(mysql_real_escape_string(trim($_REQUEST['srch']))!="" && mysql_real_escape_string(trim($_REQUEST['srch']))!="SEARCH")
            {
                //$AndQry.=" and ( title like '".mysql_real_escape_string(trim($_REQUEST['srchkword']))."%' or itemSKU like '".mysql_real_escape_string(trim($_REQUEST['srchkword']))."%' or  itemDescription like '".mysql_real_escape_string(trim($_REQUEST['srchkword']))."%' )";
                
                $srch=mysql_real_escape_string(trim($_REQUEST['srch']));
                $MYPSRCH=str_replace("&","and",$srch);
                $MYPSRCH1=str_replace("and","&",$srch);
                $MYPSRCH2=str_replace("&","&amp;",$srch);
                $MYPSRCH3=str_replace("’","\'",$srch);
                $MYPSRCH4=addslashes(addslashes($srch));
                $explodedsearch=explode("'",$srch);
                $explodedsearch2=explode("’",$srch);
                $explodedsearch3=explode(" ",$srch);
            
                $AndQry.=" and ( products.sku like '%".$MYPSRCH."%' or products.name like '%".$MYPSRCH1."%' or products.sku like '%".$MYPSRCH2."%' or products.sku like '%".$MYPSRCH3."%'  or products.name like '%".$MYPSRCH4."%' or products.sku like '%".$srch."%' or products.name like '%".$MYPSRCH."%' or products.name like '%".$MYPSRCH1."%' or products.name like '%".$MYPSRCH2."%' or products.name like '%".$MYPSRCH3."%'  or products.name like '%".$MYPSRCH4."%' or products.name like '%".$srch."%'  or products.description like '%".$srch."%' or products.sku like '".$explodedsearch3[0]."%' or products.name like '".$explodedsearch3[0]."%')";
                $OrderbyQry="order by products.sku='$srch' desc,products.name like '$srch%' desc,collectionyear desc,season asc,sku asc";
                
                $CURRENT_CATDESC="Keyword: ".stripslashes(stripslashes(trim($_REQUEST['srchkword'])))."";
            }
            else
            {
                $OrderbyQry=" order by collectionyear desc,season asc,sku asc";
            }
           $AndQry.="  and concat(',',concat(websiteid,','))  like '%,".SITE_ID.",%'";
           $productsQry="SELECT products.id,products.entity_id,products.sku,products.image_thumb1, products_collections.Acronym
            FROM products
            inner join products_collections on products_collections.id = products.collection
           WHERE status='Able' $AndQry $OrderbyQry";
		  // echo $productsQry;
           $productsQryTEMP="SELECT id,entity_id,sku,image_thumb1 FROM products WHERE status='Able' $AndQry ";
           $_SESSION['SESSION_COLLECTIONLISTQRY']=$productsQryTEMP;
           $productsQryRs=mysql_query($productsQry);
           $Totproducts=mysql_affected_rows();
           if($Totproducts>0)
           {
			   $result=$prs_pageing->sin_new_paging($productsQry,$per_page,8,"N","Y");
			   ?>
                <div id="pageSlider" <?php if($per_page == 24){?>class="alter"<?php } ?>>
                 <?php echo $result[2]; ?>
                <?php if($per_page == 24){									
                        $class_numbers = 'loters'; 
                        $class_per_page = 'pagewLot'; 
                    }else{
                        $class_numbers = 'sixers'; 
                        $class_per_page = 'pagewSix'; 
                    }?>
                <div class="<?php echo $class_numbers?>">
                <ul class="<?php echo $class_per_page;?>">
               <?php                
                $count = 0;
                while($row =mysql_fetch_object($result[0]))
                {
					if($count%$per_page==0 && $count!=0){echo '</ul> <ul class="'.$class_per_page.'">';}                           
                   if($per_page == 24){										
					$prodId = $row->id;
					$selsql = " select * from productimages where pid=$prodId AND type='image' order by displayorder asc LIMIT 0,1" ;
					$selres = mysql_query($selsql);
					$imgRow=mysql_fetch_array($selres);
				  ?>
				   <li>
					<a class="roll" href="<?php echo rewrite_acronym($row->Acronym);?>/<?=$row->sku;?>">
					<? if($imgRow['pimage']!="") 
					{
						?><img src="<?=$IMAGE_URL?>?<?=GALLOT?><?=$imgRow['pimage'];?>" border="0"/>
					<? }else{?>
						<img src="images/<?php echo $MISSING_IMG24_FILE;?>" border="0" />
					<? } ?>
					</a>
					<div class="littleInfoAlter">
						<span><?=stripslashes($row->sku);?></span>
					</div>
					</li>
					<? 
				}else{
					$prodId = $row->id;
					$selsql = " select * from productimages where pid=$prodId AND type='image' order by displayorder asc LIMIT 0,3" ;
					$selres = mysql_query($selsql);
;
					$total = 1;
					$i=2;
					?>
					<li>
					   <a class="roll" href="<?php echo rewrite_acronym($row->Acronym);?>/<?=$row->sku;?>">
					   <?php while($imgRow=mysql_fetch_array($selres)){   ?>
						<? if($imgRow['pimage']!="") 
							{
							?><img src="<?=$IMAGE_URL?>?<?=GALSIX?><?=$imgRow['pimage'];?>" border="0"/>
						<? }else{?>
							<img src="images/<?php echo $MISSING_IMG6_FILE;?>" border="0" />
						<? } ?>
						<?php 
						$total++;
						} ?>
                        <? if($total==1) { ?>
                        <img src="images/<?php echo $MISSING_IMG6_FILE;?>" border="0" />
                        <? } ?>
						</a>
						<ul class="littleNav">                        	
							<li><a class="current" href="javascript:void(0);"></a></li>
							<?php while($i<$total){?>
                            <li><a href="javascript:void(0);"></a></li>
                            <? 
							$i++;
							}?>						
						</ul>
						<div class="littleInfo">
                        <span><?=stripslashes($row->sku);?></span>                                                
                    </div>
                    <div class="littleStar">
                        <!--<a class="addFavLittle" href="<?php echo GetSiteUrl();?>/addtofav.php?id=<?=$row->id;?>&entity_id=<?=$row->entity_id;?>"></a>-->
                      <a class="addFavLittle" href="#" onClick="initIds('<?=$row->id;?>','<?=$row->entity_id;?>');"></a>  
                    </div>
					</li>
					<?php
			
				}
				$count++; 				
			}?>  
            </ul> 
                                  </div>
                                  <?php echo $result[3]; ?>
                            <? }else{ ?>  
                                <br /><br /><br /><br /><?php e_strt("No Products Found.");?>
                            <? } ?>
							<? if($Totproducts>0) { ?>
                            <div id="pageSliderBottom" <?php if($per_page == 24){?>class="alter"<?php } ?>>
                            <?php $params24 = '?per_page=24';
							$params6 = '?per_page=6';
							if(!empty($_REQUEST['type'])) $params .= '&type='.$_REQUEST['type'];
							if(!empty($_REQUEST['srch'])) $params .= '&srch='.$_REQUEST['srch'];
							?>
           					 <a <?php if($per_page == 24){ ?> class="current"<?php } ?> href="<?php echo GetSiteUrl();?>/searchresult.php<?=$params24.$params?>" id="sortLot"><?php e_upstrt("24 PER PAGE");?></a>
				            <a <?php if($per_page == 6){ ?> class="current"<?php } ?> href="<?php echo GetSiteUrl();?>/searchresult.php<?=$params6.$params?>" id="sortSix"><?php e_upstrt("6 PER PAGE");?></a>
                           <?=$result[1];?>  
                        </div>
                        </div>
											<? } ?> 
						
                  </div>  
        </div>
        
    </div>
    <? include("footer.php");?>
<? include("googleanalytic.php");?>
 <script type="text/javascript">
        $(document).ready(function () {
			<?php if($per_page == 24 && $Totproducts>24 ){?>
            //$(".pageSliderNav").tabs(".loters > .pagewLot", { effect: 'fade', fadeOutSpeed: "slow", rotate: true }).slideshow({ clickable: false });
			<?php }elseif($per_page == 6 && $Totproducts>6){ ?>
			//    $(".pageSliderNav").tabs(".sixers > .pagewSix", { effect: 'fade', fadeOutSpeed: "slow", rotate: true }).slideshow({ clickable: false });

           // $(".littleNav").tabs("> a.roll img", { effect: 'fade' });
			<?php } ?>			
			if(	$(".pagewLot").length){
				$(".pagewLot").show();
			}
			if(	$(".pagewSix")){
				$(".pagewSix").show();
				$(".littleNav").tabs("> a.roll img", { effect: 'fade' });
			}
			
            //            $(".littleInfo ul").tabs("a.roll > img", { effect: 'fader' });
        });
    </script>
</body>
</html>