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
$GLOBALS['FOOTER_P1'] = $FOOTER_P1;
$GLOBALS['FOOTER_P2'] = $FOOTER_P2;

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

include '../header.php';
wp_deregister_script('jquery');
wp_head();

include 'css.php';
?>

<body>
    <link href="<?php echo GetSiteUrl(); ?>/css/carousel.css" rel="stylesheet" type="text/css" media="screen" />
    <script src="<?php echo GetSiteUrl(); ?>/js/jquery.easing.js" type="text/javascript"></script>
    <script src="http://www.jacklmoore.com/colorbox/colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function()
        {
            $(window).bind('load', function()
            {
                $('.bloglikeButton').delay('2000').show('fast');
            });
        });
    </script>
    <script type="text/javascript">
        $('title').html('<?php
wp_title('|', true, 'right');
echo wp_specialchars(get_bloginfo('name'), 1);
?>');
    </script>


    <!-- 1. load the webfonts -->
    <link rel="stylesheet" type="text/css" href="<?php echo GetSiteUrl(); ?>/fonts/MyFontsWebfontsOrderM4062332.css">

    <!-- 2. set up some css styles using the webfonts -->
    <style type="text/css">
        .AlmibarPro { font-family: AlmibarPro; }
    </style>


    <!-- not relevant to webfonts. just example code highlighting. -->
    <script type="text/javascript" src="<?php echo GetSiteUrl(); ?>/fonts/Startherefiles/highlight.js"></script>
    <script type="text/javascript">
        hljs.initHighlightingOnLoad();
    </script>

    <div id="all">
            <?php include("../top.php"); ?>
        <div id="section">
<?php include("../left.php"); ?>
            <div id="content">
