<? include("connect.php"); 
$getallstoreforQry="SELECT store_id FROM core_store WHERE website_id='".SITE_ID."'";
$getallstoreforQryRs=mysql_query($getallstoreforQry);
$Totgetallstorefor=mysql_affected_rows();
if($Totgetallstorefor>0)
{
	for($ST=0;$ST<$Totgetallstorefor;$ST++)
	{
		$getallstoreforQryRow=mysql_fetch_array($getallstoreforQryRs);		
		$Fianlstore_id.=$getallstoreforQryRow['store_id'].",";
	}
	$Fianlstore_id=substr($Fianlstore_id,0,-1);
}
$getallstorePostforQry="SELECT distinct post_id FROM aw_blog_store WHERE store_id in ($Fianlstore_id)";
$getallstorePostforQryRs=mysql_query($getallstorePostforQry);
$TotggetallstorePostfor=mysql_affected_rows();
if($TotggetallstorePostfor>0)
{
	for($ST2=0;$ST2<$TotggetallstorePostfor;$ST2++)
	{
		$getallstorePostforQryRow=mysql_fetch_array($getallstorePostforQryRs);		
		$Fianlpost_id.=$getallstorePostforQryRow['post_id'].",";
	}
	$Fianlpost_id=substr($Fianlpost_id,0,-1);
}
if($Fianlpost_id!="")
{
	$AndQry=" and post_id in ($Fianlpost_id)";	
}else{
$AndQry.="  and concat(',',concat(websiteid,','))  like '%,".SITE_ID.",%'";
}
$AndQry .=" and video='Y'";
$productsQry="select * from aw_blog  where 1=1 $AndQry and status=1 order by created_time desc";
$productsQryRs=$sindb->get_results($productsQry);
$Totproducts=count($productsQryRs);
$page_title = ' | '.ucwords(strtolower(strt("Videos")));
?>
<? include("header.php");?>
<body>
<link href="<?php echo GetSiteUrl();?>/css/carousel-video.css" rel="stylesheet" type="text/css" media="screen" />
<script src="<?php echo GetSiteUrl();?>/js/jquery.easing.js" type="text/javascript"></script>
<style>
#video0 {
	display:block;
}
</style>
    <div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
            <div id="content">
            <?php breadcrumbs(); ?>
            <div class="pageTitle">
                <h2>
               <?php e_upstrt("Videos");?>
                </h2>
            </div>			
           	         				
		  <?						   
           if($Totproducts>0)
           {
			   ?> <div id="videos"><?
               for($n=0;$n<$Totproducts;$n++)
                { 
                    $row = $productsQryRs[$n];									
                    ?>
                    <div id="video<?=$n?>" class="homeVideoHolder">
                    <?php 
                    $trimContent = trim($row['post_content']);
                    echo stripslashes($trimContent) ;
                    ?>
                    <h4 class="videoTitle"><?php echo stripslashes($row['title']);?></h4>                                    
                     <p class="videoDescription">
                      <?php
                      if(!empty($row['post_contentmore']))
                      {
                          echo stripslashes($row['post_contentmore']);
                      }
                      ?> 
                      </p>                                   
                    </div>
                    <?php									
                }	
                
                ?>
            </div>
                <div class="carouselvid">
                <a class="prev">Prev</a>
                <div class="carouselvid-holder">
                <ul>
               <?php
               for($n=0;$n<$Totproducts;$n++)
                { 
                    $counter = 1;
                   
               ?>
                    
                    <li js="">
                    <?php for($counter =1 ;($counter<4);$counter++,$n++){?>
                    <? $row = $productsQryRs[$n];
					if(!empty($row)){
					 $thumb = stripslashes($row['title']);
					$thumb = str_replace(' ','-',$thumb);
					?>
                    
                   <a class="videoBox" href="javascript:void(0);" onClick="show_video('video<?=$n?>');">
                        <span class="thumbShadow"></span>
                        <img src="<?=$ALBUM_URL;?>/<?=stripslashes($row['picture']);?>" />
                        <span class="title"><?=stripslashes($row['title']);?></span>
                        <? 
                          if(!empty($row['post_contentmore']))
                          {
                          ?> 
                        <p class="desc">
                           <?= stripslashes($row['post_contentmore']) ;?>
                        </p>
                        <? } ?>
                    </a>
                    <? }
					} ?>
                    </li>
           
            <? } ?>
              </ul>
            </div>
            <a class="next">Next</a>
            <a href="#" class="pus">stopauto</a>
        </div>		
                                
        <? } ?>                                               
			 </div>  
        </div>
        
    </div>
    <? include("footer.php");?>
<? include("googleanalytic.php");?>
</body>
</html>