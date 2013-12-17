<? include("connect.php"); 
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
		header("location:collectionlist.php");
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
$prodId = $productsQryRow['id'];
$selsql = " select * from productimages where pid=$prodId AND type='image' order by displayorder asc limit 0,6" ;
$productImgs = $sindb->get_results($selsql);
$imgRow = $productImgs[0];
$thumwidth=117;
$thumheight=150;
$bigimgwidth=418;
$bigimgheight=532;	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="description" content="<?php echo $SITE_NAME;?>" />
    <meta name="keywords" content="<?php echo $SITE_NAME;?>" />
    <meta name="copyright" content="all content copyright 2011 <?php echo $SITE_NAME;?>" />

    <title><?php echo $SITE_NAME;?></title>
    
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/print.css" rel="stylesheet" type="text/css" media="screen" />

    <link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />

    <link rel="stylesheet" href="css/jqzoom.css" type="text/css">

<!--<link href="favicon.ico" rel="shortcut icon" />
    <link href="preview.jpg" rel="image_src" />-->


    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/tools.js" type="text/javascript"></script>
    <script src="js/nivo.js" type="text/javascript"></script>
</head>
<body onload="window.print();">
    <div id="all" style="width:100%; position:relative; float:left;">
        <div id="header" style="width:100%; height:128px; padding:0px 10px; margin:0 auto;">
            <h1 style="width:100%; height:60px; float:left; margin:25px 0px 23px 0px;font-size:68px; color:#000; text-align:center;">
            <img src="img/bg/<?php echo $LOGO_PRINT_FILE;?>" /></h1>
            
        </div>
        <div id="section" style="width:960px;margin:0 auto;padding:0px 10px; padding-top:25px;">
            
            <div id="content" style="width:798px; float:left; position:relative;">
                <div id="detailPage" style="width:781px; height:auto; float:left; margin-left:17px;">
                    <div class="mainImages" style="width:418px; height:532px; float:left;display: block;zoom: 1;">
                        <? if($imgRow['pimage']!=""){?>                
                     <a href="<?=$IMAGE_URL?>?<?=PROBIG?><?=$imgRow['pimage'];?>" class="jqzoom" rel='gal1'>
                     <img width="<?=$bigimgwidth?>" height="<?=$bigimgheight?>" class="imageBig" src="<?=$IMAGE_URL?>?<?=PROBIG?><?=$imgRow['pimage'];?>"/>
                     </a>
						<? }else{?>
                	 <img width="<?=$bigimgwidth?>" height="<?=$bigimgheight?>" class="imageBig" src="<?=$IMAGE_URL?>?<?=PROBIG?>noimage-312-447.jpg"  border="0" />
						<? } ?>
                        
                    </div>
                    <ul id="thumblist" style="width:363px; height:308px; float:left;">
                        <?php for($i=0;$i<6;$i++){?>
					<? $row=$productImgs[$i]; ?>
					<? if(!empty($row)){ ?>
                        <li style="width:<?=$thumwidth?>px; height:<?=$thumheight?>px; float:left; margin:0px 0px 5px 4px;">
                       <a style="width:<?=$thumwidth?>px; height:<?=$thumheight?>px; float:left;" id="img<?=$i?>" href="javascript:void(0);" rel="{gallery: 'gal1', smallimage: '<?=$IMAGE_URL?>?<?=PROBIG?><?=$row['pimage'];?>',largeimage: '<?=$IMAGE_URL?>?<?=PROBIG?><?=$row['pimage'];?>'}">
                       <img width="<?=$thumwidth?>" height="<?=$thumheight?>" src="<?=$IMAGE_URL?>?<?=PROTHUMB?><?=$row['pimage'];?>" alt="<?=stripslashes($productsQryRow['sku']);?>" title="<?=stripslashes($productsQryRow['sku']);?>"/>
                        </a>
                        </li><? } ?><?php } ?> 
		               
                    </ul>
                    <div class="detailInfo" style="width:359px; min-height:225px; float:left; margin-left:4px; 
                    background-color:#fff; color:#000; position:relative;">
                         <h3 style="width:192px; float:left; font-size:44px; 
                        padding-left:8px; line-height:46px; padding-top:4px;
                        font-family:'Helvetica', Arial, Sans-Serif;"><?=stripslashes($productsQryRow['sku']);?></h3> 
                       
                       <p style="width:343px; float:left; font-size:15px; 
                      margin:10px 8px 0px 8px; line-height:17px;"><?php e_strt("Shown in Ivory");?><br /><br />
                       <?php
                            $text = stripslashes(strip_tags($productsQryRow['description']));
                             echo $text;
                            ?>
                        </p>
                        <p class="specs" style="width:343px; float:left; font-size:12px; font-style:italic; 
                            margin:10px 8px 0px 8px;">                        
                        <? if($colors_avail!=""){?>
                            <?php e_strt("Available colors");?>  :<br />
                            <?=$colors_avail;?>
                            <?php } ?>
                        </p>
                       
                    </div>
                </div>
                
               
            </div>  
        </div>
        
    </div>
</body>
</html>