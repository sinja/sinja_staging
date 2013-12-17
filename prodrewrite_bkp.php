<? include("connect.php"); 
$page_name = "Product";
$collectionCode=trim(mysql_real_escape_string($_REQUEST['coll']));
$skuCode=trim(mysql_real_escape_string($_REQUEST['sku']));
//if($entity_id!="" && $id!="")
if($skuCode!="" && $collectionCode != "")
{
	//$productsQry="SELECT id,entity_id,sku,colors_shown,colors_avail,image_small,relateditems FROM products WHERE id='$id' and entity_id='$entity_id' order by entity_id asc";
	
	$productsQry="SELECT products.*
	FROM products
	inner join products_collections on products_collections.id = products.collection
	where products.sku='$skuCode' AND products.status!='deleted' AND products_collections.Acronym = '$collectionCode'
	order by products.entity_id asc";

	$productsQryRs=mysql_query($productsQry);
	$Totproducts=mysql_affected_rows();
	if($Totproducts<=0)
	{
		header("location:/collectionlist.php");
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
				$colorName = stripslashes($colors_availQryRow['name']);
				if(!empty($colorName))
					$colors_avail[]= strt($colorName);
			}
		}
		$colors_availText = implode(', ',$colors_avail);
		$colors_shown="";
		$Expcolors_shown="";
		if($productsQryRow['colors_shown']!="")
		{
			$Expcolors_shown=explode(",",$productsQryRow['colors_shown']);
			for($AS=0;$AS<count($Expcolors_shown);$AS++)
			{
				$colors_shownQryRs=mysql_query("SELECT * from products_colors where id='".$Expcolors_shown[$AS]."'");
				$colors_shownQryRow=mysql_fetch_array($colors_shownQryRs);
				$colors_shown.=strt(stripslashes($colors_shownQryRow['name']))."";
			}
		}
	}
}
else
{
	header("location:index.php");
	exit;
}	
?>
<? $page = "pro";
$page_title = ' | '.get_page_style_title($collectionCode).' '.$skuCode;
include("header.php");?>
<?
$page_level = 2;
$page_name = $skuCode;
$prodId = $productsQryRow['id'];
$selsql = " select * from productimages where pid=$prodId order by displayorder asc limit 0,6" ;
$productImgs = $sindb->get_results($selsql);
foreach($productImgs as $image){
	if($image['type']!='video'){
		$imgRow = $image;
		break;
	}
}
$imgThumbSize ="width=117&cropratio=1.17:1.499";
//$selres = mysql_query($selsql);
//$imgRow=mysql_fetch_array($selres);
?>
<body>
    
<script src="<?php echo GetSiteUrl();?>/js/cloud-zoom.1.0.2.js" type="text/javascript"></script>
   <link href="<?php echo GetSiteUrl();?>/css/cloud-zoom.css" rel="stylesheet" type="text/css" media="screen">
 <script> 
 var debugRight = true;
 if(debugRight){
 var message="Function Disabled!"; function clickIE4(){ if (event.button==2){ alert(message); return false; } } function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ alert(message); return false; } } } if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; } document.oncontextmenu=new Function("return false")
 }</script>
 <script>
 function show_video(id){
	 jQuery(".videoHolder").hide();
	jQuery('.mainImages').hide(); 
	jQuery("#"+id).show();
 }
 
 function resetMainImages(){
	 jQuery('.mainImages').show(); 
	jQuery(".videoHolder").hide();
 }

 </script>
 <style>
 .vertical{
    width:100%;
    height:50%;
    margin-top:-220px;   /* half vertical height*/    


}

 </style>
 
   
<div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
            <div id="content">
            <div id="productTop">
            <?php breadcrumbs(); ?>
        
            <div class="clr"></div>
            </div>
                <div id="detailPage">
                <input type="hidden" name="HidMaidsfdsnImage" id="HidfdsdMainImage" />
                <input type="hidden" name="proid" id="proid" value="<?=$productsQryRow['id'];?>" />
                <input type="hidden" name="entity_id" id="entity_id" value="<?=$productsQryRow['entity_id'];?>" />                
                 <div class="mainImages">



                <? if($imgRow['pimage']!=""){?>                
                     <a href="<?=$IMAGE_URL?>?<?=PROBIGZOOM?><?=$imgRow['pimage'];?>" id="zoom1" class='cloud-zoom' rel="position: 'inside',smoothMove:2">
                     <img class="imageBig" src="<?=$IMAGE_URL?>?<?=PROBIG?><?=$imgRow['pimage'];?>"/>
                     </a>
				<? }else{?>
                	 <img class="imageBig" src="<?=$IMAGE_URL?>?width=418&cropratio=4.18:5.32&image=<?=$SITE_URL?>/images/<?php echo $MISSING_IMG6_FILE;?>"/>
				<? } ?>


                        <?php
                        if ($_SESSION['SESSION_COLLECTIONLISTQRY'] != "") {
                            $idArray = array();
                            $query11 = $_SESSION['SESSION_COLLECTIONLISTQRY'] . "  order by collectionyear desc,season asc,sku asc";
                            $result11 = mysql_query($query11);
                            for ($h = 0; $row11 = mysql_fetch_row($result11); $h++) {
                                $idArray[$h] = $row11[2]; //sku
                                if ($row11[2] == $skuCode) {
                                    $tack = $h;
                                }
                            }
                            $prevID = $idArray[$tack - 1];
                            $nextID = $idArray[$tack + 1];
                            ?>		  

                        <? } ?>	

                        <? if ($prevID != "") { ?><a id="goLeftAlter" href="<?= $prevID; ?>" title="<?= $prevID; ?>"></a><?php } ?>
                        <? if ($nextID != "") { ?><a id="goRightAlter" href="<?= $nextID; ?>" title="<?= $nextID; ?>"></a><?php } ?>
                 </div>
                 <?php for($i=0;$i<6;$i++){?>
					<? $row=$productImgs[$i]; ?>
					<? if(!empty($row)){ ?>
                 <?php if($row["pimage"]!="" && $row['type'] == 'video'){ 				 
				 ?>                 
                 <div class="videoHolder" id="video<?=$i?>">
                 <div class="vertical"></div>
                 <?php echo $row["pimage"];?>
                 </div>
                 <?php } ?>
                 <? } ?><?php } ?> 
                 <ul id="thumblist">                 
              		<?php for($i=0;$i<6;$i++){?>
					<? $row=$productImgs[$i]; ?>
					<? if(!empty($row)){ ?>
                        <li>
                       <?php
					   if($row["pimage"]!="" && $row['type'] == 'image')
						{
					   ?>
                        <a id="img<?=$i?>" class='cloud-zoom-gallery' href="<?=$IMAGE_URL?>?<?=PROBIGZOOM?><?=$row['pimage'];?>" onClick="resetMainImages();" rel="useZoom: 'zoom1', smallImage: '<?=$IMAGE_URL?>?<?=PROBIG?><?=$row['pimage'];?>'">
                       <img src="<?=$IMAGE_URL?>?<?=PROTHUMB?><?=$row['pimage'];?>" alt="<?=stripslashes($productsQryRow['sku']);?>" title="<?=stripslashes($productsQryRow['sku']);?>"/>
                        </a>
                        <?php
						} 
						elseif($row["pimage"]!="" && $row['type'] == 'video')
						{							
						?>
                         <a id="img<?=$i?>" href="javascript:void(0);" class="proVideo" onClick="show_video('video<?=$i?>')">
                       <img src="<?=$IMAGE_URL?>?<?=$imgThumbSize?>&image=<?=$SITE_URL?>/images/<?php echo $VIDEO_IMG_FILE;?>" alt="<?=stripslashes($productsQryRow['sku']);?>" title="<?=stripslashes($productsQryRow['sku']);?>"/>
                        </a>
                        <?php
						}
						else
						{
						?>
                         <img src="<?=$IMAGE_URL?>?<?=$imgThumbSize?>&image=<?=$SITE_URL?>/images/<?php echo $MISSING_IMG6_FILE;?>"/>
                        <?php } ?>
                        </li><? } ?><?php } ?>                                          
                    </ul>                        
                    <div class="detailInfo">
                        <h3><?=stripslashes($productsQryRow['sku']);?></h3>                       
                        <div class="productIcons">
                        <a id="locatorInside" href="<?php echo GetSiteUrl();?>/find-a-store.php"><?php e_upstrt("STORE LOCATOR");?>  </a> 
                        <div class="clr"></div>                 
                       <?php 
					   $userFav = userFavorite($productsQryRow['entity_id']);
					   if($userFav) $class = "addFavOk";
					   ?>
                       <a class="addFav<?=' '.$class?>" href="javascript:void(0);" title="add to favs"></a>
                       <!--<a class="sendItem" href="javascript:void(0);" title="share this"></a>-->
                        <div class="tooltipBig">
                            <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                            <a class="addthis_button_preferred_1"></a>
                            <a class="addthis_button_preferred_2"></a>
                            <a class="addthis_button_preferred_3"></a>
                            <a class="addthis_button_preferred_4"></a>
                            <a class="addthis_button_compact"></a>
                            <a class="addthis_counter addthis_bubble_style"></a>
                            </div>
                            <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4b5d485814507317"></script>
                        </div>
                        <a class="printItem" title="print preview" href="<?php echo GetSiteUrl();?>/prodprint.php?id=<?=stripslashes($productsQryRow['id']);?>&entity_id=<?=stripslashes($productsQryRow['entity_id']);?>" target="_prnt"></a>
                        </div>
                        <p><?php e_strt("Shown in ");?> <?=$colors_shown;?><br /></p>
                        <div class="clr"><?php
                            $chars = 210;
                            $text = stripslashes($productsQryRow['description']);	
							$text = strip_tags($text);
							$text = trim($text);
							$text = str_replace('&nbsp;','',$text);
                            if(strlen($text) > $chars){								
                                 $text_short = substr($text,0,$chars) . "...";						
                                 ?>
                                 <div id="ShortDesc" style="float: left; font-size: 13px;line-height: 17px;"><p><?php echo $text_short;?></p>
                                 <div id="readMoreDesc" style="cursor:pointer; font-weight:bold; padding:7px; float:right;"><?php e_strt('Read More');?></div></div><div id="hiddenDescription" style="display:none;"><p><?php echo $text;?></p></div><?
                            }else{
                               ?><p><?php echo $text;?></p><?php
                            }
                            ?>	
                            <div class="clr"></div>					
                        </div>  
                        <div class="detailInfoBottom">
                        <p class="specs">
							<? if($colors_availText!=""){?>
                            <?php e_strt("Available colors");?>  :<br />
                            <?=$colors_availText;?>
                            <?php } ?>
                        </p>
                        <!--<div class="likeButton">
<!--                        <div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
	                        <script type="text/javascript">	_ga.trackFacebook(); </script><fb:like send="false" layout="button_count" width="100" show_faces="false"></fb:like>
	                        <div class="clr"></div>	
	                        </div>
	                        <div class="clr"></div>	
                        </div>  
                                           --> 


                        <div class="clr"></div>	                        
                        <div class="likeButton">
							

                            <div style="">
								<a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo $actUrl; ?>&media=<?php echo $srcimg; ?>&description=<?php echo $prodTitle; ?> <?php echo $prodText; ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
                            </div>
                            <div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div> 
                            <div>
                                <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $shortUrl; ?>" data-text="<?php echo $prodTitle; ?>" data-via="ja_bridal" data-count="none">Tweet</a>
								<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                            </div>
							<div>
                                <!-- Place this tag where you want the +1 button to render. -->
                                <div class="g-plusone" data-size="medium" data-annotation="none"></div>

                                <!-- Place this tag after the last +1 button tag. -->
                                <script type="text/javascript">
                                    (function() {
                                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                        po.src = 'https://apis.google.com/js/plusone.js';
                                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                                    })();
                                </script>
                            </div>
                            <div class="sharethisbg">
								<span class="st_sharethis_custom"></span>

								<script type="text/javascript" src="http://www.sharethis.com/button/buttons.js"></script>
								<script type="text/javascript">
									stLight.options({
										publisher:'f2585e59-0b64-4cb2-a256-12babea6f65e',
									});
								</script>               
                            </div>

                        </div>

                        
                    </div>
                </div>
                <?
				if($_SESSION['SESSION_COLLECTIONLISTQRY']!="")
				{					
					$idArray = array();
					$query11=$_SESSION['SESSION_COLLECTIONLISTQRY']."  order by collectionyear desc,season asc,sku asc";
					$result11 = mysql_query( $query11 );
					for ($h=0 ; $row11 = mysql_fetch_row($result11); $h++){
						$idArray[$h] = $row11[2];//sku
						if ($row11[2] == $skuCode){
							$tack = $h;
						}
					}
					$prevID = $idArray[$tack-1];
					$nextID = $idArray[$tack+1];					
					?>		  
               
                <? } ?>	
                <?php /*
                 <div id="detailPageNav">
                    <? if($prevID!=""){?><a id="goLeftAlter" href="<?=$prevID;?>" title="<?=$prevID;?>"></a><?php } ?>
                    <a id="viewAll" href="<?php echo GetSiteUrl();?>/wedding_dress"><?php e_upstrt("VIEW ALL STYLES");?>  </a>
                    <? if($nextID!=""){?><a id="goRightAlter" href="<?=$nextID;?>" title="<?=$nextID;?>"></a><?php } ?>
                </div>	
                */?>
                <? if($productsQryRow['relateditems']!=""){
					 if($productsQryRow['relateditems']!="") 
					  { 
							$totrelated=$productsQryRow['relateditems'];
					  }
					  else
					  {
							$totrelated=0;
					  }
					  $search_qry="select products.id,products.image_thumb1,products.sku, products_collections.Acronym from products 
					  inner join products_collections on products_collections.id = products.collection
					  where status='Able' AND products.id in (".$totrelated.") order by sku asc";					
					  $search_res=mysql_query($search_qry);
					  $tot_search=mysql_affected_rows();
					  if($tot_search>0)  
						{					
						?>
			</div> 
				<div class="clr">&nbsp;</div>
                     	<div id="similars">
                       		<span><?php e_upstrt("YOU MIGHT ALSO LIKE");?>:</span>
                       		<ul class="similarProducts">
                			<?php for($SS=0;$SS<$tot_search;$SS++){
								$search_row=mysql_fetch_array($search_res); 
								$similarProdId = $search_row['id'];
								$sql = " select * from productimages where pid=$similarProdId AND type='image' order by displayorder asc LIMIT 0,1" ;
								$pics = mysql_query($sql);
								$imgRow=mysql_fetch_array($pics);
								
								if($SS==7) break;
								?>
								<li>
								<a href="<?php echo GetSiteUrl();?>/<?php echo rewrite_acronym($search_row['Acronym']);?>/<?=$search_row['sku'];?>" title="<?=$search_row['sku'];?>">  
                                <? if($imgRow['pimage']!="") 
								{
									?><img src="<?=$IMAGE_URL?>?width=75&cropratio=7.5:9.8&image=<?=$SINCERITY?>/Products/images/<?=$imgRow['pimage'];?>" border="0"/>
								<? }else{?>
									<img src="<?=$SITE_URL?>/images/<?php echo $MISSING_IMG24_FILE;?>" border="0" />
								<? } ?>              
																
								</a>
								</li>
							
               				<?php } ?>
                       	   </ul>                
                    	</div>
               		 <?php }
				} ?>
              
        </div>
        
    </div>
  
    <? include("footer.php");?>
<? include("googleanalytic.php");?>
</body>
</html>
