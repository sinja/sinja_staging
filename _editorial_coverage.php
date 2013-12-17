<? include("connect.php"); ?>
<? 
$page_title = ' | '.ucwords(strtolower(strt("Editorial Coverage")));
include("header.php");?>
<?php
$AndQry.=" and concat(',',concat(websiteid,','))  like '%,".SITE_ID.",%'";
$productsQry="select * from press  where 1=1 $AndQry  order by addeddate desc";
$results = $sindb->get_results($productsQry);
$Totproducts = count($results);
?>
<body>
 <div id="fb-root"></div>
    <script>    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) { return; }
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=179251552151990";
        fjs.parentNode.insertBefore(js, fjs);
    } (document, 'script', 'facebook-jssdk'));</script>
    
<div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
            <div id="content">
            <?php breadcrumbs(); ?>
             <div class="pageTitle">
                <h2>
               <?php e_upstrt("editorial coverage");?>
                </h2>
            </div>
            <?php 
			 if($Totproducts>0)
			 {
				 $count = 0;
				$result=$prs_pageing->sin_press_new_paging($productsQry,5,10,"Y","Y");
				while($row =mysql_fetch_array($result[0]))
				{					
					$count++;
					$selsql = " select * from press_images where pid='".$row['id']."' order by displayorder asc" ;
					$pressImgs = $sindb->get_results($selsql);
//					var_dump($pressImgs);
					?>
                <div class="pressPage">
                    <h4 class="pressHeader"><b><?=stripslashes($row['title']);?></b> <?=$row['issue'];?></h4>			
					<?php if(!empty($pressImgs[0])){?>
                     <a class="pressImg pressImg<?=$count?>" href="<?=$PRESS_URL;?>/<?=$pressImgs[0]['pimage'];?>" title="<?=stripslashes($row['title']);?>">
                    <img src="<?=$PRESS_URL;?>/<?=$pressImgs[0]['pimage'];?>"  title="<?=stripslashes($row['title']);?>" />
                    </a>                    
                    <? } ?>
                    <?php if(!empty($pressImgs[1])){ ?>
                     <a class="pressImg pressImg<?=$count?>" href="<?=$PRESS_URL;?>/<?=$pressImgs[1]['pimage'];?>" title="<?=stripslashes($row['title']);?>">
                    <img src="<?=$PRESS_URL;?>/<?=$pressImgs[1]['pimage'];?>"  title="<?=stripslashes($row['title']);?>" />
                    </a>
                    <? } ?>
                    <div style="display:none">
                    <? foreach($pressImgs as $img){?>                   
                    <a class="pressImg pressImg<?=$count?>" href="<?=$PRESS_URL;?>/<?=$img['pimage'];?>" title="<?=stripslashes($row['title']);?>">
                    <img src="<?=$PRESS_URL;?>/<?=$img['pimage'];?>"  title="<?=stripslashes($row['title']);?>" />
                    </a>
                    <? } ?>
                    </div>
                    <p>
                    <? 
					$text = stripslashes($row['long_desc']);
					if(strlen($text) > 255)
					     $text = substr($text,0,255) . "...";						
					?>
                    <?=$text?>
                        <?php //stripslashes($row['short_desc']);?>
                    </p>
                    
                    <? if($row['pdf']!="" | $row['url'] != "" ){?>									
                         <? if(stripos($row['url'], 'http') !== false) {//then link directly to the url ?>
				         	<a class="viewArticle" href="<?=$row['url'];?>" target="_blank"><?php e_strt('View Article');?></a>
                    	 <? }else{ ?>
							<a class="viewArticle" href="<?=$PRESS_URL;?>/pdf/<?=$row['pdf'];?>" target="_blank"><?php e_strt('View Article');?></a>
                         <? } ?>
                    <? } ?>                              
                   <div class="shareButton" style="float:left;">
                    <a class="sendPress" href="javascript:void(0);" title="share this"></a>
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
                      </div>
                    <div class="fb-like" data-send="false" data-width="350" data-show-faces="false" style="margin:2px 0px 0px 5px;"></div>
                </div>
                <? } ?> 
                <? } else{?>                
				No Press.                
                <? } ?>
                <? if($Totproducts>0) { ?>
                <div id="pagingPress">
					<?=$result[1];?>	
                 </div>								
				<? } ?> 
                <? //include("right_facebook.php");?>
               
                   </div>  
        </div>
        
    </div>    
    <? include("footer.php");?>
<? include("googleanalytic.php");?>
 <script type="text/javascript">
        $(document).ready(function () {
			<?php for($i=1;$i<($count+1);$i++){ ?>
            $("a.pressImg<?=$i?>").colorbox({ rel: 'pressImg<?=$i?>' });
			<?php } ?>
        });
    </script>
</body>
</html>