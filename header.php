<?php
$page_level = 1;
$page_name = ucwords(str_replace('.php','',basename($_SERVER['SCRIPT_NAME'])));
$page_name = str_replace('_',' ',$page_name);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php the_sin_title();?></title>
    <meta name="description" content="<?=$META_DESC;?>" />
    <meta name="keywords" content="<?=$META_KEYWORD;?>" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'/>

    <link href="<?php echo GetSiteUrl();?>/css/site-min.css" rel="stylesheet" type="text/css" />
<!--
    <link href="<?php echo GetSiteUrl();?>/css/reset.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo GetSiteUrl();?>/css/nivo.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo GetSiteUrl();?>/css/default.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo GetSiteUrl();?>/css/<?php echo $CSS_FILE;?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo GetSiteUrl();?>/css/style.css" media="screen" rel="stylesheet" type="text/css" />
-->
    <!--[if IE 6]><link rel="stylesheet" href="ie.css" type="text/css" /><![endif]-->
<!--
	<link href="<?php echo GetSiteUrl();?>/css/black/style.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="<?php echo GetSiteUrl();?>/css/css_page.css" media="screen" rel="stylesheet" type="text/css" />
   
	<link href="<?php echo GetSiteUrl();?>/css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />
-->

<!--	
    <script src="<?php echo GetSiteUrl();?>/js/jquery.js" type="text/javascript"></script>
    <script src="<?php echo GetSiteUrl();?>/js/tools.js" type="text/javascript"></script>
    <script src="<?php echo GetSiteUrl();?>/js/nivo.js" type="text/javascript"></script>
    <script src="<?php echo GetSiteUrl();?>/js/php.js" type="text/javascript"></script>
    <script src="<?php echo GetSiteUrl();?>/js/script.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo GetSiteUrl();?>/js/iepngfix_tilebg.js"></script>
   
    <script src="<?php echo GetSiteUrl();?>/js/jquery.colorbox.js" type="text/javascript"></script>
-->
    <script src="<?php echo GetSiteUrl();?>/js/site-min.js" type="text/javascript"></script>
   
     <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
     
	 <script type="text/javascript">
            $(window).load(function () {
                $('#images').nivoSlider({
                effect:'fade',
                });
            });
        </script>
        
        <?php if(isset($page)){
			if($page=='cs'){ //Customer Service Map
				?>
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
                <?php
			}elseif($page=='rg'){ //Registration ?>
<!--			<link rel="stylesheet" href="dhtmlgoodies_calendar.css?random=20051112" media="screen"></link>-->
			<script type="text/javascript" src="dhtmlgoodies_calendar.js?random=20060118"></script>
			<?php
			}
		}
		?>
        <? if(isset($page)){
		//	echo $page;
			if($page == 'pro'){ ?>
			<script type="text/javascript" src="<?php echo GetSiteUrl();?>/js/jquery-ui-1.10.1.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo GetSiteUrl();?>/js/jquery.slimscroll.min.js"></script>
        <script src="<?php echo GetSiteUrl();?>/js/jqzoom.js" type="text/javascript"></script>
<!-- 		<link rel="stylesheet" href="<?php echo GetSiteUrl();?>/css/jqzoom.css" type="text/css"/>-->
      <script type="text/javascript">
        $(document).ready(function () {
            $('.jqzoom').jqzoom({
                zoomType: 'innerzoom',
                preloadImages: false,
                alwaysOn: false
            });		
			
			
            $("#goRightAlter").tooltip({ position: 'center left' });
            $("#goLeftAlter").tooltip({ position: 'center right' });

            /*$("ul.similarProducts li a").tooltip({ position: 'bottom center' });*/
            $(".printItem").tooltip({ position: 'top center' });
            $(".sendItem").tooltip({ position: 'top center' });
            $(".addFav").tooltip({ position: 'top center' });
			
			if($("#readMoreDesc")){
				$("#readMoreDesc").click(function(){
					$("#ShortDesc").hide();
					$("#hiddenDescription").show();
					$("#readMoreDesc").hide();
				});
			}
			
        });
    </script>
    		<script>
		$(function(){
			$('.detail').slimScroll({
				alwaysVisible: true,
				railVisible: true,
				height: '125px',
				distance: '10px',
				railColor: '#d0d2d1',
				size: '7px',
				railOpacity: 1
			});
		});
    </script>
    <? } 
		} ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $GOOGLE_ANALYTICS_ACCOUNT;?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- Google Analytics Social Button Tracking -->
<script type="text/javascript" src="http://www.tabpress.com/_js/ga_social_tracking.js"></script>		
</head>
