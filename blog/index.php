<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
 
session_start();

if(empty($_SESSION['SESSION_LANGUAGE'])) {
	$_SESSION['SESSION_LANGUAGE'] = 'en_US';
}
$_GET['lang'] = $_SESSION['SESSION_LANGUAGE'];
 
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require('./wp-blog-header.php');
