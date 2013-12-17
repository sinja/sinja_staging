<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
// pruebas

include '../connect.php';

$GLOBALS['sindb'] = $sindb;
$GLOBALS['current_language'] = $current_language;
$GLOBALS['SITE_URL'] = $SITE_URL;
$GLOBALS['FOOTER_ID'] = $FOOTER_ID;
$GLOBALS['FOOTER_TABLE'] = $FOOTER_TABLE;
$GLOBALS['ALBUM_URL'] = $ALBUM_URL;
$GLOBALS['META_DESC'] = $META_DESC;

$image_url[0] = '';
if (has_post_thumbnail($post->ID)) {
    $image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
} else {
    $args = array(
        'post_parent' => get_the_id(),
        'post_type' => 'attachment',
        'numberposts' => 1,
        'post_mime_type' => 'image',
        'order' => 'ASC',
        'orderby' => 'menu_order',
    );

    $images = get_posts($args);
    $image_url = wp_get_attachment_image_src($images[0]->ID, 'medium');
    if (!isset($image_url[0])) {
        $image_url[0] = GetSiteUrl() . "img/logo/main.png";
    }
}


if (is_single()) {
    $og = '
    <meta property="og:title" content="' . $post->post_title . '" />
    <meta property="og:description" content="' . str_replace('"', "'", $post->post_content) . ' ' . get_permalink($post->ID) . '" />
    <meta property="og:url" content="' . get_permalink($post->ID) . '" />
    <meta property="og:image" content="' . $image_url[0] . '" />
	';
} else {
    $og = '';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title><?php
wp_title('|', true, 'right');
echo wp_specialchars(get_bloginfo('name'), 1);
?></title>
            <meta name="description" content="<?php e_strt($META_DESC); ?>" />
            <meta name="keywords" content="<?php e_strt($META_KEYWORD); ?>" />
            <meta name="robots" content="INDEX,FOLLOW" />

            <?php echo $og; ?>

            <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'/>
            <link href="<?php echo GetSiteUrl(); ?>/css/reset.css" rel="stylesheet" type="text/css" />

            <link href="<?php echo GetSiteUrl(); ?>/css/default.css" rel="stylesheet" type="text/css" media="screen" />
            <link href="<?php echo GetSiteUrl(); ?>/css/<?php echo $CSS_FILE; ?>" rel="stylesheet" type="text/css" />
            <link href="<?php echo GetSiteUrl(); ?>/css/style.css" media="screen" rel="stylesheet" type="text/css" />
            <!--[if IE 6]><link rel="stylesheet" href="ie.css" type="text/css" /><![endif]-->
            <link href="<?php echo GetSiteUrl(); ?>/css/black/style.css" media="screen" rel="stylesheet" type="text/css" />
            <link href="<?php echo GetSiteUrl(); ?>/css/css_page.css" media="screen" rel="stylesheet" type="text/css" />

            <link href="<?php echo GetSiteUrl(); ?>/css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />

            <script src="<?php echo GetSiteUrl(); ?>/js/php.js" type="text/javascript"></script>

            <script type="text/javascript" src="<?php echo GetSiteUrl(); ?>/js/iepngfix_tilebg.js"></script>
            <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>

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

            <?php
            wp_head();
            ?>

            <!-- 1. load the webfonts -->
            <link rel="stylesheet" type="text/css" href="<?php echo GetSiteUrl(); ?>/fonts/MyFontsWebfontsOrderM4062332.css">

                <!-- 2. set up some css styles using the webfonts -->
                <style type="text/css">
                    .AlmibarPro { font-family: AlmibarPro; }
                </style>

                <!-- not relevant to webfonts. just example code highlighting. -->
                <script type="text/javascript" src="<?php echo GetSiteUrl(); ?>/fonts/Startherefiles/highlight.js"></script>
                <script src="<?php echo GetSiteUrl(); ?>/js/jquery.colorbox.js" type="text/javascript"></script>
                <script type="text/javascript">
                    hljs.initHighlightingOnLoad();
                </script>

                <link href="<?php bloginfo('template_url'); ?>/style.css" media="screen" rel="stylesheet" type="text/css" />
                <script src="<?php echo GetSiteUrl(); ?>/js/jquery.js" type="text/javascript"></script> 
                </head>
                <body>
                    <div id="all">
                        <?php include("../top.php"); ?>
                        <div id="section">
                            <?php include("../left.php"); ?>
                            <div id="content">
