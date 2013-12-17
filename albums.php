<? include("connect.php");
//if(mysql_real_escape_string($_REQUEST['aid'])>0 && mysql_real_escape_string($_REQUEST['aid'])<=3){
	$AndQry.=" concat(',',concat(websiteid,','))  like '%,".SITE_ID.",%'";
	$AndQry.=" AND category != 4 ";
	//$AlbumQry="SELECT * FROM gallery WHERE category='".mysql_real_escape_string($_REQUEST['aid'])."' $AndQry order by addeddate desc";
	$AlbumQry="SELECT * FROM gallery WHERE $AndQry order by addeddate desc";
	//echo $AlbumQry;
	$AlbumQryRs=mysql_query($AlbumQry);
	$TotAlbum=mysql_affected_rows();

//}else{header("location:gallery.php");exit;}
?>
<?php
$per_page = 6;
/*if(isset($_REQUEST['per_page'])){
   $per_page = $_REQUEST['per_page'];
}*/
$page_title = ' | '.ucwords(strtolower(strt("Image Gallery")));
?>
<? include("header.php");?>
<?php
$page_name = strt("Gallery");
?>
<body>
    <div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
            <div id="content">
            <?php breadcrumbs(); ?>                     
            <?
			if($TotAlbum>0)
			{				
				?>
                <?php 
					$class_numbers = 'sixers'; 
					$class_per_page = 'pagewSix'; 
				?>
                <div id="pageSlider">
                <?php if($TotAlbum > 6){ ?>
                    <a class="backward" id="pageSlideLeft" href="javascript:void(0);" title="previous page"></a>
                 <? } ?>
                   <div class="<?php echo $class_numbers?>">
			       <ul class="<?php echo $class_per_page;?>">
                <?php
				for($AA=1;$AA<($TotAlbum+1);$AA++)
				{
					if($AA%$per_page==1 && $AA!=1){echo '</ul> <ul class="'.$class_per_page.'">';} 
					$AlbumQryRow=mysql_fetch_array($AlbumQryRs);
					//var_dump($AlbumQryRow);
					?>
                    
                        <li id="item_<?=$AlbumQryRow['id'];?>" onClick="Load_ALBUM_IMAGES('Load_ALBUM_IMAGES_ID',<?=$AA?>,<?=$AlbumQryRow['id'];?>);return false;" title="<?=ucfirst(stripslashes($AlbumQryRow['title']));?>">
                            <a class="mediaImg<?=$AA?> roll" href="<?=$ALBUM_URL;?>/<?=stripslashes($AlbumQryRow['picture']);?>" >
                               <? if($AlbumQryRow['picture']!=""){?>
                               <img src="<?=$ALBUM_URL;?>/<?=stripslashes($AlbumQryRow['picture']);?>"/>
							   <? } else{?>
                               <img src="images/noimage-154-153.jpg"/>
							   <? } ?>                               
                            </a>
                            
                            <div class="littleInfoBig" onClick="Load_ALBUM_IMAGES('Load_ALBUM_IMAGES_ID',0,<?=$AlbumQryRow['id'];?>);return false;">
                                <span><?=ucfirst(stripslashes($AlbumQryRow['title']));?><br /><?=date("m/d/Y",strtotime(stripslashes($AlbumQryRow['addeddate'])));?></span>
                            </div>
                        </li>
                    <?php
					
				}
				?>
                 </ul>
                </div>
                <?php if($TotAlbum > 6){ ?>
                <a class="forward" id="pageSlideRight" href="javascript:void(0);"></a>
                <div class="clr"></div>
                <div id="pageSliderBottom" class="albumsPaging">                        
                        <div class="pageSliderNavContainer">
                            <a class="backward" id="pageSlideLeftBottom" href="javascript:void(0);" title="previous page"></a>
                            <ul class="pageSliderNav">
                                <li><a class="current" href="0">1</a></li>
                                <?php for($i=1;$i<ceil($TotAlbum/6);$i++){ ?>
                                <li><a href="<?=$i?>"><?php echo ($i+1);?></a></li>
                                <?php } ?>
                            </ul>
                            <a class="forward" id="pageSlideRightBottom" href="javascript:void(0);" title="next page"></a>
                        </div>
                    </div>                   
                <? } ?>
                 </div>
					<? }else{ ?>  
                        <br /><br /><br /><br /><?php e_strt("No Albums Found.");?>
                    <? } ?>
                
             
			
                   </div>  
        </div>
        
    </div>
    <? include("footer.php");?>
<script language="javascript">
var http = false;
if(navigator.appName == "Microsoft Internet Explorer") { http = new ActiveXObject("Microsoft.XMLHTTP");} else {  http = new XMLHttpRequest();}
function Load_ALBUM_IMAGES(Load_ALBUM_IMAGES_ID,start,aid)
{
	var numItems = $('.mediaImg' + start).length;
	if(numItems == 1){
		
 var jqxhr = $.getJSON("albumimages.php?Type=Load_ALBUM_IMAGES&start="+start+"&aid="+aid, function(data) {
    var items = [];

	  $.each(data, function(key,jitem) {
		   
		items.push('<a class="mediaImg' + start + ' ninja" href="<?=$ALBUM_URL;?>/' + jitem.pimage + '" title="' + jitem.title + '">' +
		'<img src="<?=$ALBUM_URL;?>/' + jitem.pimage + '"/></a>');
	  });

	  $('#item_'+aid).append(	items.join('') );
	
  })  
  .complete(function() { $(".pagewSix li a.mediaImg"+start).colorbox({ rel: 'mediaImg'+start,open:true }); console.debug(1);	})
  .error(function() { alert("error"); });

	}
  
}
</script>
<? include("googleanalytic.php");?>
 <script type="text/javascript">
        $(document).ready(function () {        
			<?php if($per_page == 24 && $TotAlbum>24 ){?>
            $(".pageSliderNav").tabs(".loters > .pagewLot", { effect: 'fade', fadeOutSpeed: "slow", rotate: true }).slideshow({ clickable: false });
			<?php }elseif($per_page == 6 && $TotAlbum>6){ ?>
			    $(".pageSliderNav").tabs(".sixers > .pagewSix", { effect: 'fade', fadeOutSpeed: "slow", rotate: true }).slideshow({ clickable: false });

            $(".littleNav").tabs("> a.roll img", { effect: 'fade' });
			<?php }else{ ?>	
			if(	$(".pagewLot"))
				$(".pagewLot").show();
			if(	$(".pagewSix"))
				$(".pagewSix").show();
			<?php } ?>
            $("#pageSlideRight").tooltip({ position: 'center left' });
            $("#pageSlideLeft").tooltip({ position: 'center right' });
			 
        });
    </script>
</body>
</html>