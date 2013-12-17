<? 
include("connect.php");
$page_title = ' | '.ucwords(strtolower(strt("Homepage")));
?>
<? include("header.php");?>
<?php
$page_level = 0;
$page_name = strt("Home");
$w = 254;
$hr = 3.17;
$wr = 2.54;
$wbig = 718;
$hbigr = 4.04;
$wbigr = 7.18;
?>
<body>
<link href="<?php echo GetSiteUrl();?>/css/carousel.css" rel="stylesheet" type="text/css" media="screen" />
<script src="<?php echo GetSiteUrl();?>/js/jquery.easing.js" type="text/javascript"></script>
    <div id="all">
       <? include("top.php");?>
       <div id="section">
       <? include("left.php");?>
            <div id="content">
            <?php breadcrumbs(); ?>
           <!--  <div id="sliderContainer" class="theme-default">
                    <div id="images" class="nivoSlider">-->
                    <div class="carousel3">
                        <a class="prev">Prev</a>
                        <div class="carousel3-holder">
                        <ul>
            <?php 
				$aid = 4; 
				$AndQry =" and concat(',',concat(websiteid,','))  like '%,".SITE_ID.",%'";
				$AlbumQry="SELECT id FROM gallery WHERE category='".mysql_real_escape_string($aid)."' $AndQry order by addeddate desc";
				$AlbumQryRs=mysql_query($AlbumQry);
				$TotAlbum=mysql_affected_rows();
				$AlbumQryRow=mysql_fetch_array($AlbumQryRs);
				global $ALBUM_URL;
				$sql = "SELECT * from galleryimages where pid='".$AlbumQryRow['id']."'  order by type,displayorder ASC limit 0,4";
				$hueres = $sindb->get_results($sql);
				$temptot = count($hueres);				
				//$target = "_blank";				
			  if($temptot>0)
			  { 
					for($n=0;$n<$temptot;$n++)
					{ 
						$huerow = $hueres[$n];
						if($huerow["pimage"]!="" && $huerow['type'] == 'image')
						{
							$Data .= '<li js="resetCarousel();" >';
							if(!empty($huerow['title'])){
								/*
								  btenaglia was here
								  11/11/13
								*/
								$target=($huerow['open']==1)?'_blank':'';
								$Data .= '<a href="'.$huerow['title'].'" target="'.$target.'">';
							}
							$Data.='<img class="roll" src="'.$IMAGE_URL.'?width='.$wbig.'&cropratio='.$wbigr.':'.$hbigr.'&image='.$ALBUM_URL.'/'.stripslashes($huerow['pimage']).'">';
							if(!empty($huerow['title'])){
								$Data .= '</a>';	
							}
							$Data .= '</li>';
						} 
						if($huerow["pimage"]!="" && $huerow['type'] == 'video')
						{
							$Data .= '<li js="startvideo('."'".'video'. $n."'".');" >';
							$Data .= '<div class="vertical"></div>';
							$Data.='<div id="v'.$n.'" class="roll">'.'</div>';
							$Data .= '</li>';
						} 
						
					}
					echo $Data;
			  }
				
				?>      </ul>
                		</div>
                         <?php 
					 for($n=0;$n<$temptot;$n++)
					{ 
						$huerow = $hueres[$n];
						if($huerow["pimage"]!="" && $huerow['type'] == 'video')
						{
							?>
                            <div id="video<?=$n?>" class="homeVideoHolder"><?php echo $huerow['pimage'];?></div>
                            <?php
						}
					}
					 ?>   
						<a class="next">Next</a>
						<a href="#" class="pus">stopauto</a>
					</div>
                        
                	<!--</div>
                </div>-->
                <?php 
				$AndQry =" and concat(',',concat(websiteid,','))  like '%,".SITE_ID.",%'";
				$strQueryPerPage="select * from homepage_boxes  where 1=1 $AndQry $SearchAndQry order by sortorder LIMIT 3";
				$strResultPerPage=mysql_query($strQueryPerPage);
				while($row =mysql_fetch_object($strResultPerPage))
				{
				?>
				
				
                <a class="boxLink" href="<?php echo $row->url;?>" <?php if ($row->open == 1) echo 'target="_blank"'; ?> >
                    <span><?php e_strt(stripslashes($row->title));?></span>
                    <img class="feature" src="<?= getImageThumb('/Gallery/'.stripslashes($row->picture), $w, '317')?>" alt="<?php e_strt(stripslashes($row->title));?>" />
                    
                </a>
                <?php } ?>              
            </div>  
        </div>
        
    </div>
    <? include("footer.php");?>
    <? include("googleanalytic.php");?>
</body>
</html>
