<?php
include("connect.php");

$page_name = $_GET['page_name'];

$per_page = 6;
if(isset($_POST['per_page']))
    $per_page = $_POST['per_page'];

$_GET['start'] = 0;
if(isset($_POST['start']))
    $_GET['start'] = $_POST['start'];

$qry = "select * from landing_pages where page_name= '$page_name' AND website_id = " . SITE_ID;
$rs = mysql_query($qry);
$landing_page = mysql_fetch_array($rs);

if (mysql_affected_rows() == 0) {
    header("location: " . GetSiteUrl());
}

$current_language = ($current_language == '') ? 'en_US' : $current_language;

$page_title = ' | ' . ucwords(str_replace('-', ' ', strtolower(strt($page_name))));

$page_level = 1;
$page_name = ucwords(str_replace('.php', '', basename($_SERVER['SCRIPT_NAME'])));
$page_name = str_replace('_', ' ', $page_name);
?>


<?php if($landing_page['styles'] == '0'):?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <title><?php the_sin_title(); ?></title>
                <meta name="description" content="<?php e_strt($META_DESC); ?>" />
                <meta name="keywords" content="<?php e_strt($META_KEYWORD); ?>" />
                <meta name="robots" content="INDEX,FOLLOW" />

                <link rel="stylesheet" type="text/css" media="screen" href='http://fonts.googleapis.com/css?family=Oswald' />
                <link rel="stylesheet" type="text/css" media="screen" href="<?php echo GetSiteUrl(); ?>/css/reset.css" />
                <link rel="stylesheet" type="text/css" media="screen" href="<?php echo GetSiteUrl(); ?>/css/default.css" />
                <link rel="stylesheet" type="text/css" media="screen" href="<?php echo GetSiteUrl(); ?>/css/<?php echo $CSS_FILE; ?>" />
                <link rel="stylesheet" type="text/css" media="screen" href="<?php echo GetSiteUrl(); ?>/css/style.css" />
                <link rel="stylesheet" type="text/css" media="screen" href="<?php echo GetSiteUrl(); ?>/css/black/style.css" />
                <link rel="stylesheet" type="text/css" media="screen" href="<?php echo GetSiteUrl(); ?>/css/css_page.css" />
                <link rel="stylesheet" type="text/css" media="screen" href="<?php echo GetSiteUrl(); ?>/css/carousel.css" />
                <link href="<?php echo GetSiteUrl(); ?>/css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />

                <script type="text/javascript" src="<?php echo GetSiteUrl(); ?>/js/jquery.js"></script>

                <script type="text/javascript">
                    var _gaq = _gaq || [];
                    _gaq.push(['_setAccount', '<?php echo $GOOGLE_ANALYTICS_ACCOUNT; ?>']);
                    _gaq.push(['_trackPageview']);

                    (function() {
                        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                    })();
                </script>
                <!-- Google Analytics Social Button Tracking -->
                <script type="text/javascript" src="http://www.tabpress.com/_js/ga_social_tracking.js"></script>    

                <!-- 1. load the webfonts -->
                <link rel="stylesheet" type="text/css" href="<?php echo GetSiteUrl(); ?>/fonts/MyFontsWebfontsOrderM4062332.css" />

                <!-- 2. set up some css styles using the webfonts -->
                <style type="text/css">
                    .clearfix:after {
                        content: ".";
                        display: block;
                        height: 0;
                        clear: both;
                        visibility: hidden;
                    }

                    .clearfix {display: inline-block;}

                    /* Hides from IE-mac \*/
                    * html .clearfix {height: 1%;}
                    .clearfix {display: block;}
                    /* End hide from IE-mac */

                    .landingpage { background: #fff; clear: left; color: #000000; padding: 8px 8px 15px 25px; margin-left: 11px; }
                    .landingpage h2 { font-family: AlmibarPro; color: #c00021; font-size: 43px; line-height: 50px; margin-bottom: 20px; margin-top: 40px !important; padding-top: 20px; }
                    .landingpage p { font-family: Georgia, serif; color: #000000; font-size: 14px; line-height: 19px; margin-bottom: 15px; text-align: justify; }
                    .landingpage p a { color: #C00021; }
                    .landingpage img { max-width: 514px; margin-top: 10px; }
                    .landingpage > .text { float: left; width: 514px; }
                    .landingpage .sidebar { width: 215px; float: right; margin-left: 25px; }
                    .landingpage .sidebar .product { margin-bottom: 10px; }
                    .landingpage .sidebar .product div.text { width: 215px; }
                    .landingpage .sidebar .product div.text h3 { font-family: Arial, Helvetica, sans-serif; color: #ffffff; font-size: 13px; line-height: 23px; padding: 0px 5px; margin: 0px; background: #850017; }
                    .landingpage .sidebar .product div.text h3 a { color: #ffffff; }
                    .landingpage .sidebar .product div.text img { width: 215px; height: auto; margin: 0px; }
                    .landingpage .sidebar .product div.text p { font-family: Arial, Helvetica, sans-serif; color: #000000; font-size: 10px; line-height: 14px; margin-bottom: 10px; padding: 5px 0px; margin: 0px; text-align: left; }
                    .landingpage .sidebar .product div.text p a { color: #000000; }

                    .reatured-image { margin-left: 10px; }

                    .widget {
                        background: #6D6D70;
                    }


                    .widget h3 {
                        font-size: 14px;
                        text-transform: uppercase;
                        height: 28px;
                        line-height: 28px;
                        padding-left: 5px;
                        margin: 0px;
                        margin-bottom: 15px;
                        background: #850017;
                        color: #fff;
                    }

                    .followus {
                        height: 40px;
                        border-bottom: 2px solid #3A3A3A;
                        margin-bottom: 20px;
                        margin-left: 5px;
                        margin-right: 5px;
                    }

                    .content-likesend {
                        overflow: hidden;
                        height: 40px;
                    }

                    .likesend {
                        margin-bottom: 20px;
                        display: block;
                        height: 25px;
                    }

                    .likesend img {
                        padding: 0px;
                        margin: 0px;
                    }

                    .likesend.boxfb{
                        padding-left: 44px;
                    }

                    .likesend.boxpt{
                        padding-left: 24px;
                    }

                    .likesend.boxtw{
                        padding-left: 47px;
                    }

                    .likesend.boxgp{
                        padding-left: 86px;
                    }

                    .followus a {
                        position: relative;
                        float: left;
                        margin: 0px 14px;
                    }

                    .followus a span.arrow{
                        width: 13px;
                        height: 12px;
                        background: url("/img/icon/followus_arrow.png") no-repeat;
                        position: absolute;
                        bottom: -20px;
                        display: none;
                    }

                    .followus a.afb:hover span.arrow, .followus a.afb.selected span.arrow {
                        left: 0px;
                        display: block;
                    }

                    .followus a.apt:hover span.arrow, .followus a.apt.selected  span.arrow {
                        left: 7px;
                        display: block;
                    }

                    .followus a.atw:hover span.arrow, .followus a.atw.selected  span.arrow {
                        left: 9px;
                        display: block;
                    }

                    .followus a.agp:hover span.arrow, .followus a.agp.selected  span.arrow {
                        left: 2px;
                        display: block;
                    }

                    .followus span.fb {
                        background: url("/img/icon/facebook.png") no-repeat; width: 13px; height: 25px; display: block; 
                    }

                    .followus span.fb:hover, .followus a.selected  span.fb {
                        background: url("/img/icon/facebook_selected.png") no-repeat;
                    }

                    .followus span.pt {
                        background: url("/img/icon/pinterest.png") no-repeat; width: 25px; height: 25px; display: block;
                    }

                    .followus span.pt:hover, .followus a.selected  span.pt {
                        background: url("/img/icon/pinterest_selected.png") no-repeat;
                    }

                    .followus span.tw {
                        background: url("/img/icon/twitter.png") no-repeat bottom center; width: 27px; height: 25px; display: block;
                    }

                    .followus span.tw:hover, .followus a.selected  span.tw {
                        background: url("/img/icon/twitter_selected.png") no-repeat bottom center;
                    }

                    .followus span.gp {
                        background: url("/img/icon/google-plus.png") no-repeat; width: 25px; height: 25px; display: block;
                    }

                    .followus span.gp:hover, .followus a.selected  span.gp {
                        background: url("/img/icon/google-plus_selected.png") no-repeat;
                    }

                    .widget input[type="text"] {
                        width: 190px;
                        margin: 0px 5px 5px 5px;
                        background: #3A3A3A;
                        color: white;
                        height: 30px;
                        line-height: 30px;
                        border: none;
                        font-size: 11px;
                        padding: 0px 6px;
                        font-family: Arial, Helvetica, sans-serif;
                    }

                    .wpcf7-submit {
                        border: none;
                        background: transparent;
                        padding: 0;
                        margin-left: 10px;
                        color: #FEFEFE;
                        font-size: 14px;
                        cursor: pointer;
                        font-family: Arial, Helvetica, sans-serif;
                        padding-bottom: 15px;
                        display: block;
                    }
                </style>
        </head>
        <?php
        $page_level = 0;
        $page_name = strt("Home");
        $wbig = 718;
        $hbigr = 4.04;
        $wbigr = 7.18;
        ?>
        <body>
            <div id="all">
                <?php include("top.php"); ?>
                <div id="section">
                    <?php include("left.php"); ?>
                    <div id="content">
                        <?php breadcrumbs(); ?>
                        <?php
                        $qry = "select * from landing_pages_slider where landing_page_id= " . $landing_page['id'] . " ORDER BY ord ASC";
                        $rs = mysql_query($qry);

                        $header = false;
                        if ($landing_page['slider'] == 0) {
                            $header = true;
                            ?>
                            <div class="carousel3">
                                <a class="prev">Prev</a>
                                <div class="carousel3-holder">
                                    <ul>
                                        <?php
                                        $aid = 4;
                                        $AndQry = " and concat(',',concat(websiteid,','))  like '%," . SITE_ID . ",%'";
                                        $AlbumQry = "SELECT id FROM gallery WHERE category='" . mysql_real_escape_string($aid) . "' $AndQry order by addeddate desc";
                                        $AlbumQryRs = mysql_query($AlbumQry);
                                        $TotAlbum = mysql_affected_rows();
                                        $AlbumQryRow = mysql_fetch_array($AlbumQryRs);
                                        global $ALBUM_URL;
                                        $sql = "SELECT * from galleryimages where pid='" . $AlbumQryRow['id'] . "'  order by type,displayorder ASC limit 0,4";
                                        $hueres = $sindb->get_results($sql);
                                        $temptot = count($hueres);
										
										$data = '';
                                        if ($temptot > 0) {
                                            for ($n = 0; $n < $temptot; $n++) {
                                                $huerow = $hueres[$n];
                                                if ($huerow["pimage"] != "" && $huerow['type'] == 'image') {
                                                    $data .= '<li js="resetCarousel();" >';
                                                    if (!empty($huerow['title'])) {
                                                        if ($huerow['open'] == 1) {
                                                            $open = 'target="_blank"';
                                                        } else {
                                                            $open = '';
                                                        }
                                                        $data .= '<a ' . $open . ' href="' . $huerow['title'] . '">';
                                                    }
                                                    $data.='<img class="roll" src="' . $IMAGE_URL . '?width=' . $wbig . '&cropratio=' . $wbigr . ':' . $hbigr . '&image=' . $ALBUM_URL . '/' . stripslashes($huerow['pimage']) . '">';
                                                    if (!empty($huerow['title'])) {
                                                        $data .= '</a>';
                                                    }
                                                    $data .= '</li>';
                                                }
                                                if ($huerow["pimage"] != "" && $huerow['type'] == 'video') {
                                                    $data .= '<li js="startvideo(' . "'" . 'video' . $n . "'" . ');" >';
                                                    $data .= '<div class="vertical"></div>';
                                                    $data .= '<div id="v' . $n . '" class="roll">' . '</div>';
                                                    $data .= '</li>';
                                                }
                                            }
                                            echo $data;
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <?php
                                for ($n = 0; $n < $temptot; $n++) {
                                    $huerow = $hueres[$n];
                                    if ($huerow["pimage"] != "" && $huerow['type'] == 'video') {
                                        ?>
                                        <div id="video<?= $n ?>" class="homeVideoHolder"><?php echo $huerow['pimage']; ?></div>
                                        <?php
                                    }
                                }
                                ?>
                                <a class="next">Next</a>
                                <a href="#" class="pus">stopauto</a>
                            </div>
                            <?php
                        } else {
                            if (mysql_affected_rows() > 0) {
                                $header = true;
                                if (mysql_affected_rows() == 1) {
                                    $slide = mysql_fetch_array($rs)
                                    ?>
                                    <a target="<?php echo stripslashes($slide['target']); ?>" href="<?php echo stripslashes($slide['link']); ?>"><img title="<?php echo stripslashes($slide['title']); ?>"  class="reatured-image" alt="<?php echo stripslashes($slide['image']); ?>" class="roll" src="http://sinceritybridal.com/image.php?width=789&amp;cropratio=7.18:4.04&amp;image=<?php echo "http://sinceritybridal.com/Gallery/" . stripslashes($slide['image']); ?>" /></a>
                                    <?php
                                } else {
                                    ?>   
                                    <div class="carousel3">
                                        <a class="prev">Prev</a>
                                        <div class="carousel3-holder">
                                            <ul>
                                                <?php
                                                while ($slide = mysql_fetch_array($rs)) {
                                                    ?>
                                                    <li js="resetCarousel();"><a target="<?php echo stripslashes($slide['target']); ?>" href="<?php echo stripslashes($slide['link']); ?>"><img title="<?php echo stripslashes($slide['title']); ?>" alt="<?php echo stripslashes($slide['image']); ?>" class="roll" src="http://sinceritybridal.com/image.php?width=718&amp;cropratio=7.18:4.04&amp;image=<?php echo "http://sinceritybridal.com/Gallery/" . stripslashes($slide['image']); ?>" /></a></li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <a class="next">Next</a>
                                        <a href="#" class="pus">stopauto</a>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        
                        $qry = "select * from landing_pages_content where landing_pages_id= " . $landing_page['id'] . " AND lang='" . $current_language . "'";
                        $rs = mysql_query($qry);

                        $content = mysql_fetch_array($rs);
                        
                        if($content['title'] == '') {
                            $current_language = 'en_US';
                            $qry = "select * from landing_pages_content where landing_pages_id= " . $landing_page['id'] . " AND lang='" . $current_language . "'";
                            $rs = mysql_query($qry);

                            $content = mysql_fetch_array($rs);
                        }
                        
                        $qry = "SELECT * from landing_pages_sidebar_product as p, landing_pages_sidebar_product_content as c 
                                WHERE p.id = c.landing_pages_sidebar_product_id 
                                AND landing_page_id= " . $landing_page['id'] . " 
                                AND c.lang = '" . $current_language . "' 
                                ORDER BY ord ASC";
                        $rs = mysql_query($qry);
                                
                        $title = stripslashes($content['title']);
                        
                        $style = '';
                        ?>
                        <div class="landingpage clearfix" >
                        
                            <?php
                            if(!$header){
                                ?>
                                <h2><?php echo $title; ?></h2>
                                <?php
                            }
                            ?>
                            <div class="sidebar">
                                <?php
                                
                                while ($product = mysql_fetch_array($rs)) {
                                    ?>
                                    <div class="product clearfix">
                                        <div class="text">
                                            <h3><a href="<?php echo stripslashes($product['link']); ?>"><?php echo stripslashes($product['title']); ?></a></h3>

                                            <a href="<?php echo stripslashes($product['link']); ?>"><img src="http://sinceritybridal.com/Products/images/<?php echo stripslashes($product['image']); ?>" alt="<?php echo stripslashes($product['title']); ?>" title="<?php echo stripslashes($product['title']); ?>" /></a>

                                            <p><?php echo stripslashes($product['content']); ?></p>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                                <div id="text-2" class="widget widget_text">
                                    <h3 class="widget-title">FOLLOW US</h3>         
                                    <div class="textwidget">
                                        <div class="followus">
                                            <a data-type="fb" class="afb selected" href="javascript:;" style="opacity: 1;"><span class="fb"></span><span class="arrow"></span></a>
                                            <a data-type="pt" class="apt" href="javascript:;"><span class="pt"></span><span class="arrow"></span></a>
                                            <a data-type="tw" class="atw" href="javascript:;"><span class="tw"></span><span class="arrow"></span></a>
                                            <a data-type="gp" class="agp" href="javascript:;"><span class="gp"></span><span class="arrow"></span></a>
                                        </div>
                                        <div class="content-likesend">
                                            <div class="likesend boxfb" style="display: block;">
                                                <div id="fb-root"></div>
                                                <script>(function(d, s, id) {
                                                    var js, fjs = d.getElementsByTagName(s)[0];
                                                    if (d.getElementById(id)) return;
                                                    js = d.createElement(s); js.id = id;
                                                    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=238694836256291";
                                                    fjs.parentNode.insertBefore(js, fjs);
                                                }(document, 'script', 'facebook-jssdk'));</script>
                                                <div class="fb-like" data-href="https://www.facebook.com/sinceritybridal" data-send="true" data-layout="button_count" data-width="450" data-show-faces="false" data-font="arial"></div>
                                            </div>
                                            <div class="likesend boxpt">
                                                <a href="http://www.pinterest.com/sinceritybridal"><img src="http://passets-lt.pinterest.com/images/about/buttons/follow-me-on-pinterest-button.png" width="169" height="28" alt="Follow Me on Pinterest"></a>
                                            </div>
                                            <div class="likesend boxtw">
                                                <iframe allowtransparency="true" frameborder="0" scrolling="no" src="http://platform.twitter.com/widgets/follow_button.1355514129.html#_=1356008874437&amp;id=twitter-widget-1&amp;lang=en&amp;screen_name=ja_bridal&amp;show_count=false&amp;show_screen_name=true&amp;size=m" class="twitter-follow-button" style="width: 120px; height: 20px;" title="Twitter Follow Button" data-twttr-rendered="true"></iframe>
                                                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                                            </div>
                                            <div class="likesend boxgp">
                                                <div style="height: 20px; width: 32px; display: inline-block; text-indent: 0px; margin: 0px; padding: 0px; background-color: transparent; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; background-position: initial initial; background-repeat: initial initial;" id="___plusone_0"><iframe frameborder="0" hspace="0" marginheight="0" marginwidth="0" scrolling="no" style="position: static; top: 0px; width: 32px; margin: 0px; border-style: none; left: 0px; visibility: visible; height: 20px;" tabindex="0" vspace="0" width="100%" id="I0_1356008874951" name="I0_1356008874951" src="https://plusone.google.com/_/+1/fastbutton?bsv&amp;size=medium&amp;annotation=none&amp;hl=en-US&amp;origin=http%3A%2F%2Fwww.justinalexanderbridal.com&amp;url=http%3A%2F%2Fwww.justinalexanderbridal.com%2F&amp;jsh=m%3B%2F_%2Fscs%2Fapps-static%2F_%2Fjs%2Fk%3Doz.gapi.es_419.q1SqJVvmLII.O%2Fm%3D__features__%2Fam%3DiQ%2Frt%3Dj%2Fd%3D1%2Frs%
3DAItRSTNy7tvr-KCNcJ6n7RZ17ZUsnbvFCw#_methods=onPlusOne%2C_ready%2C_close%2C_open%2C_resizeMe%2C_renderstart%2Concircled%2Conload&amp;id=I0_1356008874951&amp;parent=http%3A%2F%2Fwww.justinalexanderbridal.com" allowtransparency="true" title="+1"></iframe></div>
                                                <script type="text/javascript">
                                                (function() {
                                                    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                                    po.src = 'https://apis.google.com/js/plusone.js';
                                                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                                                })();
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div style="height: 8px;">&nbsp;</div>

                                <div id="text-3" class="widget widget_text">
                                    <h3 class="widget-title">NEWSLETTER</h3>            
                                    <div class="textwidget">
                                        <input type="text" name="your-name" id="snlname" value="" size="40" title="Name" placeholder="Name"/>
                                        <input type="text" name="your-email" id="snlemail" value="" size="40" title="Email" placeholder="Email"/>
                                        <input type="text" name="wedding-date" value="" id="snlwdate" size="40" title="Wedding Date (optional)" placeholder="Wedding Date (optional)"/>
                                        <a href="http://www.justinalexanderbridal.com/register_popup.php" class="wpcf7-form-control  wpcf7-submit cboxElement" id="subscribenewsletter">SUBSCRIBE</a>
                                    </div>
                                </div>
                            </div>

                            <div class="text">
                                <?php
                                if($header){
                                    ?>
                                    <h2><?php echo $title; ?></h2>
                                    <?php
                                }
                                ?>

                                <?php echo stripslashes($content['content']); ?>
                            </div>
                        </div>
                    </div>  
                </div>

            </div>
            <?php include("footer.php"); ?>
            <?php include("googleanalytic.php"); ?>
            <script type="text/javascript" src="<?php echo GetSiteUrl(); ?>/js/tools.js"></script>
            <script type="text/javascript" src="<?php echo GetSiteUrl(); ?>/js/php.js"></script>
            <script type="text/javascript" src="<?php echo GetSiteUrl(); ?>/js/script.js"></script>
            <script type="text/javascript" src="<?php echo GetSiteUrl(); ?>/js/iepngfix_tilebg.js"></script>
            <script type="text/javascript" src="<?php echo GetSiteUrl(); ?>/js/jquery.easing.js"></script>
            <script src="<?php echo GetSiteUrl(); ?>/js/jquery.colorbox.js" type="text/javascript"></script>

            <script type="text/javascript">
            $(function()
            {
                $(window).bind('load', function()
                {
                    $('.afb').click();
                    $('.content-likesend').css('overflow','inherit');
                });
            
                $('.followus a').click(function(){
                    $('.followus a.selected').css({ opacity: 1 });
                    $('.followus a.selected').removeClass('selected');
                    $(this).addClass('selected');
                    $('.likesend').css('display', 'none');
                    $('.likesend.box' + $(this).attr('data-type')).css('display', 'block');
                });
            
                $(".followus a").hover(
                function () {
                    if(!$(this).hasClass('selected')){
                        $('.followus a.selected').css({ opacity: 0.5 });
                    }
                },
                function () {
                    if(!$(this).hasClass('selected')){
                        $('.followus a.selected').css({ opacity: 1 });
                    }
                });

                $("#newsletterLink").colorbox({iframe:true, width:600, innerWidth:600, innerHeight:500,bottom:0,scrolling:false,bottom:"10%",fixed:true,onComplete:function(){ $('#cboxWrapper').css('width', '595'); $('.cboxShare').remove(); }}); 

                $('#subscribenewsletter').click(function(){
                    var snlname =  $('#snlname').val();
                    var snlemail = $('#snlemail').val();
                    var snlwdate = $('#snlwdate').val();
                
                    if(snlname == ''){
                        alert('Please enter your Name.');
                        return false;
                    }
                
                    if(snlemail == ''){
                        alert('Please enter your Email.');
                        return false;
                    }
                
                    href = '<?php echo GetSiteUrl(); ?>/register_popup.php?snlname=' + snlname + '&snlemail='+ snlemail + '&snlwdate=' + snlwdate;
                    $(this).attr('href', href);
                
                });
            
                $("#subscribenewsletter").colorbox({iframe:true, width:600, innerWidth:600, innerHeight:500,bottom:0,scrolling:false,bottom:"10%",fixed:true,onComplete:function(){ $('#cboxWrapper').css('width', '595'); $('.cboxShare').remove(); $('.cboxVia').remove(); }}); 
            });
            </script>

            <script type="text/javascript">
            setTimeout(function(){var a=document.createElement("script");
                var b=document.getElementsByTagName("script")[0];
                a.src=document.location.protocol+"//dnn506yrbagrg.cloudfront.net/pages/scripts/0013/2161.js?"+Math.floor(new Date().getTime()/3600000);
                a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
            </script>
        </body>

<?php else:?>
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
    
    <?php echo $og; ?>
    
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'/>
    <link href="<?php echo GetSiteUrl();?>/css/reset.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo GetSiteUrl();?>/css/nivo.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo GetSiteUrl();?>/css/default.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo GetSiteUrl();?>/css/<?php echo $CSS_FILE;?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo GetSiteUrl();?>/css/style.css" media="screen" rel="stylesheet" type="text/css" />
    <!--[if IE 6]><link rel="stylesheet" href="ie.css" type="text/css" /><![endif]-->
    <link href="<?php echo GetSiteUrl();?>/css/black/style.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo GetSiteUrl();?>/css/css_page.css" media="screen" rel="stylesheet" type="text/css" />
   
    <link href="<?php echo GetSiteUrl();?>/css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />
    
    <script src="<?php echo GetSiteUrl();?>/js/jquery.js" type="text/javascript"></script>
    <script src="<?php echo GetSiteUrl();?>/js/tools.js" type="text/javascript"></script>
    <script src="<?php echo GetSiteUrl();?>/js/nivo.js" type="text/javascript"></script>
    <script src="<?php echo GetSiteUrl();?>/js/php.js" type="text/javascript"></script>
    <script src="<?php echo GetSiteUrl();?>/js/script.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo GetSiteUrl();?>/js/iepngfix_tilebg.js"></script>
   
    <script src="<?php echo GetSiteUrl();?>/js/jquery.colorbox.js" type="text/javascript"></script>

    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.0/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo GetSiteUrl();?>/js/jquery.slimscroll.min.js"></script>
   
     <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <?php error_reporting(E_ALL);
			ini_set('display_errors', '1');?>
    <?php if(view_blacklist()) { ?>
        <style>
            #bl-msg h1,
            #bl-msg h2,
            #bl-msg h3,
            #bl-msg h4,
            #bl-msg h5,
            #bl-msg h6 { color: #fff; background: #3A3A3A; margin-right: 43px; margin-bottom: 0px; padding: 11px 24px; height: 28px; font-size: 12px; }
            #bl-msg p  { color: #393939; margin: 22px 22px 0px 22px; font-size: 11px; text-align: justify; }
            
            #bl-msg {
                max-width: 430px;
            }
            
            #cboxLoadedContent {
                border: none;
            }
            
            #cboxClose {
                background: url(../img/icon/close-bl.png) no-repeat top center;
                top: 0px;
                right: 0px;
                width: 50px;
                height: 50px;
            }
        </style>
        <script type="text/javascript">
            
            $(window).load(function () {
                $.colorbox({
                    html:'<div id="bl-msg"><h2><?php e_strt('BUYER BEWARE: YOU HAVE BEEN REFERRED TO OUR WEBSITE BY AN UNAUTHORIZED SOURCE.'); ?></h2><p><?php e_strt('Please be informed that we do not permit the sale of our wedding dresses online. The best and only way to know you are purchasing an authentic Justin Alexander gown is through one of our authorized retailers. Please use our store locator to find a store near you.'); ?></p></div>'
                });
            });
            
        </script>
    <?php } ?>
     
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
            <link rel="stylesheet" href="dhtmlgoodies_calendar.css?random=20051112" media="screen"></link>
            <script type="text/javascript" src="dhtmlgoodies_calendar.js?random=20060118"></script>
            <?php
            }
        }
        ?>
        <? if(isset($page)){
        //  echo $page;
            if($page == 'pro'){ ?>
        <script src="<?php echo GetSiteUrl();?>/js/jqzoom.js" type="text/javascript"></script>
        <link rel="stylesheet" href="<?php echo GetSiteUrl();?>/css/jqzoom.css" type="text/css"/>
      <script type="text/javascript">
        $(document).ready(function () {
            $('.jqzoom').jqzoom({
                zoomType: 'innerzoom',
                preloadImages: false,
                alwaysOn: false
            });     
            
            
            $("#goRightAlter").tooltip({ position: 'center left' });
            $("#goLeftAlter").tooltip({ position: 'center right' });

            $("ul.similarProducts li a").tooltip({ position: 'bottom center' });
            $(".printItem").tooltip({ position: 'top center' });
            $(".sendItem").tooltip({ position: 'top center' });
            $(".addFav").tooltip({ position: 'top center' });
            
        });
        
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
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <title><?php the_sin_title(); ?></title>
                <meta name="description" content="<?php e_strt($META_DESC); ?>" />
                <meta name="keywords" content="<?php e_strt($META_KEYWORD); ?>" />
                <meta name="robots" content="INDEX,FOLLOW" />

                <link rel="stylesheet" type="text/css" media="screen" href='http://fonts.googleapis.com/css?family=Oswald' />
                <link rel="stylesheet" type="text/css" media="screen" href="<?php echo GetSiteUrl(); ?>/css/reset.css" />
                <link rel="stylesheet" type="text/css" media="screen" href="<?php echo GetSiteUrl(); ?>/css/default.css" />
                <link rel="stylesheet" type="text/css" media="screen" href="<?php echo GetSiteUrl(); ?>/css/<?php echo $CSS_FILE; ?>" />
                <link rel="stylesheet" type="text/css" media="screen" href="<?php echo GetSiteUrl(); ?>/css/style.css" />
                <link rel="stylesheet" type="text/css" media="screen" href="<?php echo GetSiteUrl(); ?>/css/black/style.css" />
                <link rel="stylesheet" type="text/css" media="screen" href="<?php echo GetSiteUrl(); ?>/css/css_page.css" />
                <link rel="stylesheet" type="text/css" media="screen" href="<?php echo GetSiteUrl(); ?>/css/carousel.css" />
                <link href="<?php echo GetSiteUrl(); ?>/css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />

                <script type="text/javascript" src="<?php echo GetSiteUrl(); ?>/js/jquery.js"></script>



                <script type="text/javascript">
                    var _gaq = _gaq || [];
                    _gaq.push(['_setAccount', '<?php echo $GOOGLE_ANALYTICS_ACCOUNT; ?>']);
                    _gaq.push(['_trackPageview']);

                    (function() {
                        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                    })();
                </script>
                <!-- Google Analytics Social Button Tracking -->
                <script type="text/javascript" src="http://www.tabpress.com/_js/ga_social_tracking.js"></script>    

                <!-- 1. load the webfonts -->
                <link rel="stylesheet" type="text/css" href="<?php echo GetSiteUrl(); ?>/fonts/MyFontsWebfontsOrderM4062332.css" />

                <!-- 2. set up some css styles using the webfonts -->
                <style type="text/css">
                    .clearfix:after {
                        content: ".";
                        display: block;
                        height: 0;
                        clear: both;
                        visibility: hidden;
                    }

                    .text2{

                        width: 95%;
                    }
                    .clearfix {display: inline-block;}

                    /* Hides from IE-mac \*/
                    * html .clearfix {height: 1%;}
                    .clearfix {display: block;}
                    /* End hide from IE-mac */

                    .landingpage { background: #fff; clear: left; color: #000000; padding: 8px 8px 15px 25px; /*margin-left: 11px;*/ }
                    .landingpage h2 { font-family: AlmibarPro; color: #c00021; font-size: 43px; line-height: 50px; margin-bottom: 20px; margin-top: 20px; }
                    .landingpage p { font-family: Georgia, serif; color: #000000; font-size: 14px; line-height: 19px; margin-bottom: 15px; text-align: justify; }
                    .landingpage p a { color: #C00021; }
                    .landingpage img { max-width: 514px; margin-top: 10px; }
                    .landingpage > .text { float: left; width: 514px; }
                    .landingpage .sidebar { width: 215px; float: right; margin-left: 25px; }
                    .landingpage .sidebar .product { margin-bottom: 10px; }
                    .landingpage .sidebar .product div.text { width: 215px; }
                    .landingpage .sidebar .product div.text h3 { font-family: Arial, Helvetica, sans-serif; color: #ffffff; font-size: 13px; line-height: 23px; padding: 0px 5px; margin: 0px; background: #850017; }
                    .landingpage .sidebar .product div.text h3 a { color: #ffffff; }
                    .landingpage .sidebar .product div.text img { width: 215px; height: auto; margin: 0px; }
                    .landingpage .sidebar .product div.text p { font-family: Arial, Helvetica, sans-serif; color: #000000; font-size: 10px; line-height: 14px; margin-bottom: 10px; padding: 5px 0px; margin: 0px; text-align: left; }
                    .landingpage .sidebar .product div.text p a { color: #000000; }

                    .reatured-image { margin-left: 10px; }

                    .widget {
                        background: #6D6D70;
                    }

                    .widget h3 {
                        font-size: 14px;
                        text-transform: uppercase;
                        height: 28px;
                        line-height: 28px;
                        padding-left: 5px;
                        margin: 0px;
                        margin-bottom: 15px;
                        background: #850017;
                        color: #fff;
                    }

                    .followus {
                        height: 40px;
                        border-bottom: 2px solid #3A3A3A;
                        margin-bottom: 20px;
                        margin-left: 5px;
                        margin-right: 5px;
                    }

                    .content-likesend {
                        overflow: hidden;
                        height: 40px;
                    }

                    .likesend {
                        margin-bottom: 20px;
                        display: block;
                        height: 25px;
                    }

                    .likesend img {
                        padding: 0px;
                        margin: 0px;
                    }

                    .likesend.boxfb{
                        padding-left: 44px;
                    }

                    .likesend.boxpt{
                        padding-left: 24px;
                    }

                    .likesend.boxtw{
                        padding-left: 47px;
                    }

                    .likesend.boxgp{
                        padding-left: 86px;
                    }

                    .followus a {
                        position: relative;
                        float: left;
                        margin: 0px 14px;
                    }

                    .followus a span.arrow{
                        width: 13px;
                        height: 12px;
                        background: url("/img/icon/followus_arrow.png") no-repeat;
                        position: absolute;
                        bottom: -20px;
                        display: none;
                    }

                    .followus a.afb:hover span.arrow, .followus a.afb.selected span.arrow {
                        left: 0px;
                        display: block;
                    }

                    .followus a.apt:hover span.arrow, .followus a.apt.selected  span.arrow {
                        left: 7px;
                        display: block;
                    }

                    .followus a.atw:hover span.arrow, .followus a.atw.selected  span.arrow {
                        left: 9px;
                        display: block;
                    }

                    .followus a.agp:hover span.arrow, .followus a.agp.selected  span.arrow {
                        left: 2px;
                        display: block;
                    }

                    .followus span.fb {
                        background: url("/img/icon/facebook.png") no-repeat; width: 13px; height: 25px; display: block; 
                    }

                    .followus span.fb:hover, .followus a.selected  span.fb {
                        background: url("/img/icon/facebook_selected.png") no-repeat;
                    }

                    .followus span.pt {
                        background: url("/img/icon/pinterest.png") no-repeat; width: 25px; height: 25px; display: block;
                    }

                    .followus span.pt:hover, .followus a.selected  span.pt {
                        background: url("/img/icon/pinterest_selected.png") no-repeat;
                    }

                    .followus span.tw {
                        background: url("/img/icon/twitter.png") no-repeat bottom center; width: 27px; height: 25px; display: block;
                    }

                    .followus span.tw:hover, .followus a.selected  span.tw {
                        background: url("/img/icon/twitter_selected.png") no-repeat bottom center;
                    }

                    .followus span.gp {
                        background: url("/img/icon/google-plus.png") no-repeat; width: 25px; height: 25px; display: block;
                    }

                    .followus span.gp:hover, .followus a.selected  span.gp {
                        background: url("/img/icon/google-plus_selected.png") no-repeat;
                    }

                    .widget input[type="text"] {
                        width: 190px;
                        margin: 0px 5px 5px 5px;
                        background: #3A3A3A;
                        color: white;
                        height: 30px;
                        line-height: 30px;
                        border: none;
                        font-size: 11px;
                        padding: 0px 6px;
                        font-family: Arial, Helvetica, sans-serif;
                    }

                    .wpcf7-submit {
                        border: none;
                        background: transparent;
                        padding: 0;
                        margin-left: 10px;
                        color: #FEFEFE;
                        font-size: 14px;
                        cursor: pointer;
                        font-family: Arial, Helvetica, sans-serif;
                        padding-bottom: 15px;
                        display: block;
                    }
                </style>
        </head>
        <?php
        $page_level = 0;

        $wbig = 718;
        $hbigr = 4.04;
        $wbigr = 7.18;
        ?>
        <body>
            <div id="all">
                <?php include("top.php"); ?>
                <div id="section">
                    <?php include("left.php"); ?>
                    <div id="content">
                        <?php breadcrumbs(); ?>
                        <?php
                        $qry = "select * from landing_pages_slider where landing_page_id= " . $landing_page['id'] . " ORDER BY ord ASC";
                        $rs = mysql_query($qry);

                        $header = false;
                        if ($landing_page['slider'] == 0) {
                            $header = true;
                            ?>
                            <div class="carousel3">
                                <a class="prev">Prev</a>
                                <div class="carousel3-holder">
                                    <ul>
                                        <?php
                                        $aid = 4;
                                        $AndQry = " and concat(',',concat(websiteid,','))  like '%," . SITE_ID . ",%'";
                                        $AlbumQry = "SELECT id FROM gallery WHERE category='" . mysql_real_escape_string($aid) . "' $AndQry order by addeddate desc";
                                        $AlbumQryRs = mysql_query($AlbumQry);
                                        $TotAlbum = mysql_affected_rows();
                                        $AlbumQryRow = mysql_fetch_array($AlbumQryRs);
                                        global $ALBUM_URL;
                                        $sql = "SELECT * from galleryimages where pid='" . $AlbumQryRow['id'] . "'  order by type,displayorder ASC limit 0,4";
                                        $hueres = $sindb->get_results($sql);
                                        $temptot = count($hueres);

										$data = '';
                                        if ($temptot > 0) {
                                            for ($n = 0; $n < $temptot; $n++) {
                                                $huerow = $hueres[$n];
                                                if ($huerow["pimage"] != "" && $huerow['type'] == 'image') {
                                                    $data .= '<li js="resetCarousel();" >';
                                                    if (!empty($huerow['title'])) {
                                                        if ($huerow['open'] == 1) {
                                                            $open = 'target="_blank"';
                                                        } else {
                                                            $open = '';
                                                        }
                                                        $data .= '<a ' . $open . ' href="' . $huerow['title'] . '">';
                                                    }
                                                    $data.='<img class="roll" src="' . $IMAGE_URL . '?width=' . $wbig . '&cropratio=' . $wbigr . ':' . $hbigr . '&image=' . $ALBUM_URL . '/' . stripslashes($huerow['pimage']) . '">';
                                                    if (!empty($huerow['title'])) {
                                                        $data .= '</a>';
                                                    }
                                                    $data .= '</li>';
                                                }
                                                if ($huerow["pimage"] != "" && $huerow['type'] == 'video') {
                                                    $data .= '<li js="startvideo(' . "'" . 'video' . $n . "'" . ');" >';
                                                    $data .= '<div class="vertical"></div>';
                                                    $data .= '<div id="v' . $n . '" class="roll">' . '</div>';
                                                    $data .= '</li>';
                                                }
                                            }
                                            echo $data;
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <?php
                                for ($n = 0; $n < $temptot; $n++) {
                                    $huerow = $hueres[$n];
                                    if ($huerow["pimage"] != "" && $huerow['type'] == 'video') {
                                        ?>
                                        <div id="video<?= $n ?>" class="homeVideoHolder"><?php echo $huerow['pimage']; ?></div>
                                        <?php
                                    }
                                }
                                ?>
                                <a class="next">Next</a>
                                <a href="#" class="pus">stopauto</a>
                            </div>
                            <?php
                        } else {
                            if (mysql_affected_rows() > 0) {
                                $header = true;
                                if (mysql_affected_rows() == 1) {
                                    $slide = mysql_fetch_array($rs)
                                    ?>
                                    <a target="<?php echo stripslashes($slide['target']); ?>" href="<?php echo stripslashes($slide['link']); ?>">
                                        <img title="<?php echo stripslashes($slide['title']); ?>"  class="reatured-image" alt="<?php echo stripslashes($slide['image']); ?>" class="roll" src="http://sinceritybridal.com/image.php?width=789&amp;cropratio=7.18:4.04&amp;image=<?php echo "http://sinceritybridal.com/Gallery/" . stripslashes($slide['image']); ?>" /></a>
                                    <?php
                                } else {
                                    ?>   
                                    <div class="carousel3">
                                        <a class="prev">Prev</a>
                                        <div class="carousel3-holder">
                                            <ul>
                                                <?php
                                                while ($slide = mysql_fetch_array($rs)) {
                                                    ?>
                                                    <li js="resetCarousel();"><a target="<?php echo stripslashes($slide['target']); ?>" href="<?php echo stripslashes($slide['link']); ?>"><img title="<?php echo stripslashes($slide['title']); ?>" alt="<?php echo stripslashes($slide['image']); ?>" class="roll" src="http://sinceritybridal.com/image.php?width=718&amp;cropratio=7.18:4.04&amp;image=<?php echo "http://sinceritybridal.com/Gallery/" . stripslashes($slide['image']); ?>" /></a></li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <a class="next">Next</a>
                                        <a href="#" class="pus">stopauto</a>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        
                        $qry = "select * from landing_pages_content where landing_pages_id= " . $landing_page['id'] . " AND lang='" . $current_language . "'";
                        $rs = mysql_query($qry);

                        $content = mysql_fetch_array($rs);
                        
                        if($content['title'] == '') {
                            $current_language = 'en_US';
                            $qry = "select * from landing_pages_content where landing_pages_id= " . $landing_page['id'] . " AND lang='" . $current_language . "'";
                            $rs = mysql_query($qry);

                            $content = mysql_fetch_array($rs);
                        }
                        
                        $qry = "SELECT * from landing_pages_sidebar_product as p, landing_pages_sidebar_product_content as c 
                                WHERE p.id = c.landing_pages_sidebar_product_id 
                                AND landing_page_id= " . $landing_page['id'] . " 
                                AND c.lang = '" . $current_language . "' 
                                ORDER BY ord ASC";
                        $rs = mysql_query($qry);
                                
                        $title = stripslashes($content['title']);
                        
                        $style = '';
                        ?>
                        <div class="landingpage clearfix" style="width: 94.2%; margin-left: 10px;">
                        
                            <?php
                            if(!$header){
                                ?>
                                <h2><?php echo $title; ?></h2>
                                <?php
                            }
                            ?>

                            <div class="text2">
                                <?php
                                if($header){
                                    ?>
                                    <h2><?php echo $title; ?></h2>
                                    <?php
                                }
                                ?>

                                <?php echo stripslashes($content['content']); ?>
                            </div>

<!-- --------------------------------- BEGIN GALLERY ---------------------------------------------------- -->

<?php 
/*
    OLD PRODUCTS TAGS QUERY
    *********************** 
    $productsQry = "
        SELECT p.id, p.sku, pc.Acronym, p.entity_id
        FROM landing_pages_tags lpt
        INNER JOIN products_tags pt ON pt.tags_id = lpt.tag_id
        INNER JOIN products p ON p.id = pt.products_id
        LEFT JOIN products_collections pc ON pc.id = p.collection
        WHERE lpt.landing_page_id = ".$landing_page['id']."
        AND websiteid LIKE '%".SITE_ID."%'
        GROUP BY p.id
    ";
    */

    $productsQry = "
        SELECT p.id, p.sku, pc.Acronym, p.entity_id
        FROM products p
        INNER JOIN landings_products lp ON lp.products_id = p.id
        LEFT JOIN products_collections pc ON pc.id = p.collection
        WHERE lp.landing_pages_id = ".$landing_page['id']."
        AND websiteid LIKE '%".SITE_ID."%' 
        AND lp.active = 1 
        ORDER BY lp.orden
    ";

        $myResult = mysql_query($productsQry); 
        $newLinks['totalRows'] = mysql_num_rows($myResult);                                 //  array newLinks for all the new pagination stuff
        $newLinks['totalPages'] = (int) ceil(($newLinks['totalRows'] + 1) / 6);
        $newLinks['currentPage'] = (int) ceil($_GET['start'] / 6);

        //$_GET['start'] = 6;
        $result = $prs_pageing->sin_new_paging($productsQry,$per_page,8,"N","Y");

        $Totproducts = mysql_affected_rows(); 
                      
        if($Totproducts > 0){

            ?>

                <div style="margin-left: -28px;" id="pageSlider" <?php if($per_page == 24) { ?>class="alter"<?php } ?>>

                                <?php if($per_page == 24){                                  
                                        $class_numbers = 'loters'; 
                                        $class_per_page = 'pagewLot'; 
                                    }else{
                                        $class_numbers = 'sixers'; 
                                        $class_per_page = 'pagewSix'; 
                                    }
                                    ?>
                                <div class="<?php echo $class_numbers;?>">
                                    <?php if($_GET['start'] > 0):?>
                                    <form method="POST" name="back">
                                        <input type="hidden" name="start" value="<?php echo $_GET['start'] - 6;?>"/>
                                        <a style="margin-top: 10px; height: 652px;" class="backward" id="pageSlideLeft" href="javascript:void(0)" onclick="document.forms['back'].submit();return false;"></a>
                                    </form> 
                                    <?php endif;?>

                                    <?php if($_GET['start'] + 6 < $newLinks['totalRows']):             //  if there is more results show the arrow ?>
                                    <form method="POST" name="next">
                                        <input type="hidden" name="start" value="<?php echo $_GET['start'] + 6;?>"/>
                                        <a style="margin-top: 10px; height: 652px;" class="forward" id="pageSlideRight" href="javascript:void(0)" onclick="document.forms['next'].submit();return false;"></a>
                                    </form> 
                                    <?php endif;?>
                                <ul class="<?php echo $class_per_page;?>">
                                <?php
                                $count = 0;

                                while($row = mysql_fetch_object($result[0]))
                              {   

                                    //if($count%$per_page==0 && $count!=0){echo '</ul> <ul class="'.$class_per_page.'">';}                           
                                    if($per_page == 24){                                        

                                        $selsql = "
                                            select * from productimages 
                                            where pid = ".$row->id." 
                                            AND type='image' 
                                            order by landing_order, displayorder asc 
                                            LIMIT 0,1" ;
                                        $selres = mysql_query($selsql);
                                        $imgRow=mysql_fetch_array($selres);
                                      ?>
                                       <li>
                                        <a class="roll" href="#">
                                        <? if($imgRow['pimage']!="") 
                                        {
                                            ?><img src="<?=$IMAGE_URL?>?<?=GALLOT?>th_<?=$imgRow['pimage'];?>" border="0"/>
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
                                        $selsql = "
                                            SELECT * 
                                            FROM productimages pi
                                            INNER JOIN landings_images li ON li.productimages_id = pi.id  
                                            WHERE pid = ".$row->id." 
                                            AND type='image' 
                                            AND li.landing_pages_id = ".$landing_page['id']." 
                                            AND li.active = 1
                                            ORDER BY li.orden 
                                            LIMIT 0,5" ;
                                        $selres = mysql_query($selsql);
                                        $total = 1;
                                        $i=2;
                                        ?>
                                        <li>
                                           <a class="roll" href="/<?php 
                                                $tmpUrl = explode('/',rewrite_acronym($row->Acronym));

                                                echo end($tmpUrl);

                                                ?>/<?=$row->sku;?>">
                                           <?php

                                            while($imgRow=mysql_fetch_array($selres)){ 
                                            ?>
                                            <? if($imgRow['pimage']!="") 
                                                {
                                                ?><img src="<?=$IMAGE_URL?>?<?=GALSIX?><?=$imgRow['pimage'];?>" border="0"/>
                                            <?

                                             }else{?>
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
                                                <span><?=stripslashes($row->sku);

                                                ?></span>                                                
                                            </div>
                                            <div class="littleStar">
                                                <!--<a class="addFavLittle" href="<?php echo GetSiteUrl();?>/addtofav.php?id=<?=$row->id;?>&entity_id=<?=$row->entity_id;?>"></a>-->
                                              <a class="addFavLittle" href="#" onClick="initIds('<?=$row->id;?>','<?=$row->entity_id;?>');"></a>  
                                            </div>
                                        </li>
                                        <?php
                                
                                    }
                                    $count++; 
                                    
                                }
                                ?> 
                                 </ul> 
                                  </div>
                                  
                            <? }else{ ?>  
                                <br /><br /><br /><br /><?php //e_strt("No Products Found.");?>
                            <? } ?>
                          
                        <? if($Totproducts>0) { ?>
<!--
                            <div style="overflow: visible; height: 36px; background: #7e6c7f; padding: 10px; display: inline-block; width: 766px; margin-left: 4px;" id="pageSliderBottom" <?php if($per_page == 24){?>class="alter"<?php } ?>>
                                               
                                <div class="" style="text-align: center;">

                                    <ul class="pageSliderNav" style="display: inline-block; float: none;">

                                    <?php if(((int)$_GET['start']) >= 6):?>
                                    <li style="height: 23px; overflow: hidden;">
                                    <form method="POST" name="bk">
                                        <input type="hidden" name="start" value="<?php echo ($_GET['start'] - 6)?>" />
                                        <a class="backward" id="pageSlideLeftBottom" href="javascript:void()" onclick="document.forms['bk'].submit();return false;"></a> 
                                    </form>
                                    </li>
                                    <?php endif;?>
                                        <?php 
                                            $inicio = 0;
                                            if($newLinks['currentPage'] > 4 && $newLinks['totalPages'] > 8)
                                                $inicio = $newLinks['currentPage'] -4;

                                            for( $i = $inicio; $i < $newLinks['totalPages'] -1; $i++):
                                                $class = '';
                                                if($newLinks['currentPage'] == $i)
                                                    $class = 'current';
                                                ?>
                                            <li>
                                                <form method="POST" name="page<?php echo $i?>">
                                                    <input type="hidden" name="start" value="<?php echo ($i * 6);?>" />
                                                    <a class="<?php echo $class;?>" href="javascript:void(0)" onclick="document.forms['page<?php echo $i?>'].submit();return false;"><?php echo $i+1;?></a>
                                                </form>
                                            </li>
                                            <?php endfor;?>
                                     <?php if($_GET['start'] + 6 < $newLinks['totalRows']): ?>
                                     <li style="height: 23px; overflow: hidden;">
                                    <form method="POST" name="nt">
                                        <input type="hidden" name="start" value="<?php echo ($_GET['start'] + 6)?>" />
                                        <a class="forward" id="pageSlideRightBottom" href="javascript:void()" onclick="document.forms['nt'].submit();return false;"></a> 
                                    </form>
                                    </li>
                                    <?php endif;?>
                                    </ul>
                                </div>
                            </div>
                        <? } ?> 
                    </div>

                    <!-- --------------------------------- END GALLERY -------------------------------------------------------- -->


                        </div>
                    </div>  
                </div>

            </div>
            <?php include("footer.php"); ?>
            <?php include("googleanalytic.php"); ?>
            <script type="text/javascript" src="<?php echo GetSiteUrl(); ?>/js/tools.js"></script>
            <script type="text/javascript" src="<?php echo GetSiteUrl(); ?>/js/php.js"></script>
            <script type="text/javascript" src="<?php echo GetSiteUrl(); ?>/js/script.js"></script>
            <script type="text/javascript" src="<?php echo GetSiteUrl(); ?>/js/iepngfix_tilebg.js"></script>
            <script type="text/javascript" src="<?php echo GetSiteUrl(); ?>/js/jquery.easing.js"></script>
            <script src="<?php echo GetSiteUrl(); ?>/js/jquery.colorbox.js" type="text/javascript"></script>

            <script type="text/javascript">
            $(function()
            {
                $(window).bind('load', function()
                {
                    $('.afb').click();
                    $('.content-likesend').css('overflow','inherit');
                });
            
                $('.followus a').click(function(){
                    $('.followus a.selected').css({ opacity: 1 });
                    $('.followus a.selected').removeClass('selected');
                    $(this).addClass('selected');
                    $('.likesend').css('display', 'none');
                    $('.likesend.box' + $(this).attr('data-type')).css('display', 'block');
                });
            
                $(".followus a").hover(
                function () {
                    if(!$(this).hasClass('selected')){
                        $('.followus a.selected').css({ opacity: 0.5 });
                    }
                },
                function () {
                    if(!$(this).hasClass('selected')){
                        $('.followus a.selected').css({ opacity: 1 });
                    }
                });

                $("#newsletterLink").colorbox({iframe:true, width:600, innerWidth:600, innerHeight:500,bottom:0,scrolling:false,bottom:"10%",fixed:true,onComplete:function(){ $('#cboxWrapper').css('width', '595'); $('.cboxShare').remove(); }}); 

                $('#subscribenewsletter').click(function(){
                    var snlname =  $('#snlname').val();
                    var snlemail = $('#snlemail').val();
                    var snlwdate = $('#snlwdate').val();
                
                    if(snlname == ''){
                        alert('Please enter your Name.');
                        return false;
                    }
                
                    if(snlemail == ''){
                        alert('Please enter your Email.');
                        return false;
                    }
                
                    href = '<?php echo GetSiteUrl(); ?>/register_popup.php?snlname=' + snlname + '&snlemail='+ snlemail + '&snlwdate=' + snlwdate;
                    $(this).attr('href', href);
                
                });
            
                $("#subscribenewsletter").colorbox({iframe:true, width:600, innerWidth:600, innerHeight:500,bottom:0,scrolling:false,bottom:"10%",fixed:true,onComplete:function(){ $('#cboxWrapper').css('width', '595'); $('.cboxShare').remove(); $('.cboxVia').remove(); }}); 
            });
            </script>

            <script type="text/javascript">
            setTimeout(function(){var a=document.createElement("script");
                var b=document.getElementsByTagName("script")[0];
                a.src=document.location.protocol+"//dnn506yrbagrg.cloudfront.net/pages/scripts/0013/2161.js?"+Math.floor(new Date().getTime()/3600000);
                a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
            </script>
             <script type="text/javascript">
                    $(document).ready(function () {
                        <?php if($per_page == 24 && $Totproducts>24 ){?>
                       // $(".pageSliderNav").tabs(".loters > .pagewLot", { effect: 'fade', fadeOutSpeed: "slow", rotate: false }).slideshow({ clickable: true });
                        <?php }elseif($per_page == 6 && $Totproducts>6){ ?>
                         //   $(".pageSliderNav").tabs(".sixers > .pagewSix", { effect: 'fade', fadeOutSpeed: "slow", rotate: false }).slideshow({ clickable: true });

                        //$(".littleNav").tabs("> a.roll img", { effect: 'fade' });
                        <?php } ?>          
                        if( $(".pagewLot"))
                            $(".pagewLot").show();
                        if( $(".pagewSix")){
                            $(".pagewSix").show();
                            $(".littleNav").tabs("> a.roll img", { effect: 'fade' });
                        }
                        
                        //            $(".littleInfo ul").tabs("a.roll > img", { effect: 'fader' });
                    });
            </script>
        </body>
    </html>

<?php endif;?>