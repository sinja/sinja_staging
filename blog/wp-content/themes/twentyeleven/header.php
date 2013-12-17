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

include '../header.php';
wp_head();
?>
<body>
<link href="<?php echo GetSiteUrl();?>/css/carousel.css" rel="stylesheet" type="text/css" media="screen" />
<script src="<?php echo GetSiteUrl();?>/js/jquery.easing.js" type="text/javascript"></script>
    <div id="all">
       <?php include("../top.php");?>
       <div id="section">
       <?php include("../left.php");?>
            <div id="content">
