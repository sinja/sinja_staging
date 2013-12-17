<?php

/**
 * Twenty Eleven functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyeleven_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
function add_smiley($content) {
    global $META_DESC;
    $followus = '
        <div class="followus">
            <a data-type="fb" class="afb selected" href="javascript:;"><span class="fb"></span><span class="arrow"></span></a>
            <a data-type="pt" class="apt" href="javascript:;"><span class="pt"></span><span class="arrow"></span></a>
            <a data-type="tw" class="atw" href="javascript:;"><span class="tw"></span><span class="arrow"></span></a>
            <a data-type="gp" class="agp" href="javascript:;"><span class="gp"></span><span class="arrow"></span></a>
        </div>
		<div class="content-likesend">
			<div class="likesend boxfb" style="display: block;">
				<div id="fb-root"></div>
				
				<div class="fb-like" data-href="https://www.facebook.com/justinalexanderbride" data-send="true" data-layout="button_count" data-width="450" data-show-faces="false" data-font="arial"></div>
			</div>
			<div class="likesend boxpt">
				<a href="http://pinterest.com/jabridal/"><img src="http://passets-lt.pinterest.com/images/about/buttons/follow-me-on-pinterest-button.png" width="169" height="28" alt="Follow Me on Pinterest" /></a>
			</div>
			<div class="likesend boxtw">
				<a href="https://twitter.com/ja_bridal" class="twitter-follow-button" data-show-count="false">Follow @ja_bridal</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>
			<div class="likesend boxgp">
				<div class="g-plusone" data-size="medium" data-annotation="none" data-href="' . GetSiteUrl() . '"></div>
				<script type="text/javascript">
					(function() {
						var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
						po.src = \'https://apis.google.com/js/plusone.js\';
						var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
					})();
				</script>
			</div>
		</div>
        ';

    $content = str_replace('[followus]', $followus, $content);

    $newsletter = '<p><input type="text" name="your-name" id="snlname" value="" size="40" title="Name" placeholder="Name" /></p>
    <p><input type="text" name="your-email" id="snlemail" value="" size="40" title="Email" placeholder="Email" /></p>
    <p><input type="text" name="wedding-date" value="" id="snlwdate" size="40" title="Wedding Date (optional)" placeholder="Wedding Date (optional)" /></p>
    <p><a href="' . GetSiteUrl() . '/register_popup.php" class="wpcf7-form-control  wpcf7-submit" id="subscribenewsletter" >SUBSCRIBE</a></p>
	<p>&nbsp;</p>';

    $content = str_replace('[newsletter]', $newsletter, $content);

    return $content;
}

add_filter('widget_text', 'add_smiley');

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width))
    $content_width = 584;

/**
 * Tell WordPress to run twentyeleven_setup() when the 'after_setup_theme' hook is run.
 */
add_action('after_setup_theme', 'twentyeleven_setup');

if (!function_exists('twentyeleven_setup')):

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which runs
     * before the init hook. The init hook is too late for some features, such as indicating
     * support post thumbnails.
     *
     * To override twentyeleven_setup() in a child theme, add your own twentyeleven_setup to your child theme's
     * functions.php file.
     *
     * @uses load_theme_textdomain() For translation/localization support.
     * @uses add_editor_style() To style the visual editor.
     * @uses add_theme_support() To add support for post thumbnails, automatic feed links, custom headers
     * 	and backgrounds, and post formats.
     * @uses register_nav_menus() To add support for navigation menus.
     * @uses register_default_headers() To register the default custom header images provided with the theme.
     * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
     *
     * @since Twenty Eleven 1.0
     */
    function twentyeleven_setup() {

        /* Make Twenty Eleven available for translation.
         * Translations can be added to the /languages/ directory.
         * If you're building a theme based on Twenty Eleven, use a find and replace
         * to change 'twentyeleven' to the name of your theme in all the template files.
         */
        load_theme_textdomain('twentyeleven', get_template_directory() . '/languages');

        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style();

        // Grab Twenty Eleven's Ephemera widget.
        require( get_template_directory() . '/inc/widgets.php' );

        // Add default posts and comments RSS feed links to <head>.
        add_theme_support('automatic-feed-links');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menu('primary', __('Primary Menu', 'twentyeleven'));

        // Add support for a variety of post formats
        add_theme_support('post-formats', array('aside', 'link', 'gallery', 'status', 'quote', 'image'));

        // This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
        add_theme_support('post-thumbnails');

        // We'll be using post thumbnails for custom header images on posts and pages.
        // We want them to be the size of the header image that we just defined
        // Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
        set_post_thumbnail_size($custom_header_support['width'], $custom_header_support['height'], true);

        // Add Twenty Eleven's custom image sizes.
        // Used for large feature (header) images.
        add_image_size('large-feature', $custom_header_support['width'], $custom_header_support['height'], true);
        // Used for featured posts if a large-feature doesn't exist.
        add_image_size('small-feature', 500, 300);

        // Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
        register_default_headers(array(
            'wheel' => array(
                'url' => '%s/images/headers/wheel.jpg',
                'thumbnail_url' => '%s/images/headers/wheel-thumbnail.jpg',
                /* translators: header image description */
                'description' => __('Wheel', 'twentyeleven')
            ),
            'shore' => array(
                'url' => '%s/images/headers/shore.jpg',
                'thumbnail_url' => '%s/images/headers/shore-thumbnail.jpg',
                /* translators: header image description */
                'description' => __('Shore', 'twentyeleven')
            ),
            'trolley' => array(
                'url' => '%s/images/headers/trolley.jpg',
                'thumbnail_url' => '%s/images/headers/trolley-thumbnail.jpg',
                /* translators: header image description */
                'description' => __('Trolley', 'twentyeleven')
            ),
            'pine-cone' => array(
                'url' => '%s/images/headers/pine-cone.jpg',
                'thumbnail_url' => '%s/images/headers/pine-cone-thumbnail.jpg',
                /* translators: header image description */
                'description' => __('Pine Cone', 'twentyeleven')
            ),
            'chessboard' => array(
                'url' => '%s/images/headers/chessboard.jpg',
                'thumbnail_url' => '%s/images/headers/chessboard-thumbnail.jpg',
                /* translators: header image description */
                'description' => __('Chessboard', 'twentyeleven')
            ),
            'lanterns' => array(
                'url' => '%s/images/headers/lanterns.jpg',
                'thumbnail_url' => '%s/images/headers/lanterns-thumbnail.jpg',
                /* translators: header image description */
                'description' => __('Lanterns', 'twentyeleven')
            ),
            'willow' => array(
                'url' => '%s/images/headers/willow.jpg',
                'thumbnail_url' => '%s/images/headers/willow-thumbnail.jpg',
                /* translators: header image description */
                'description' => __('Willow', 'twentyeleven')
            ),
            'hanoi' => array(
                'url' => '%s/images/headers/hanoi.jpg',
                'thumbnail_url' => '%s/images/headers/hanoi-thumbnail.jpg',
                /* translators: header image description */
                'description' => __('Hanoi Plant', 'twentyeleven')
            )
        ));
    }

endif; // twentyeleven_setup

if (!function_exists('twentyeleven_header_style')) :

    /**
     * Styles the header image and text displayed on the blog
     *
     * @since Twenty Eleven 1.0
     */
    function twentyeleven_header_style() {
        $text_color = get_header_textcolor();

        // If no custom options for text are set, let's bail.
        if ($text_color == HEADER_TEXTCOLOR)
            return;

        // If we get this far, we have custom styles. Let's do this.
        ?>
        <style type="text/css">
        <?php
// Has the text been hidden?
        if ('blank' == $text_color) :
            ?>
                #site-title,
                #site-description {
                    position: absolute !important;
                    clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
                    clip: rect(1px, 1px, 1px, 1px);
                }
            <?php
// If the user has set a custom color for the text use that
        else :
            ?>
                #site-title a,
                #site-description {
                    color: #<?php echo $text_color; ?> !important;
                }
        <?php endif; ?>
        </style>
        <?php
    }

endif; // twentyeleven_header_style

if (!function_exists('twentyeleven_admin_header_style')) :

    /**
     * Styles the header image displayed on the Appearance > Header admin panel.
     *
     * Referenced via add_theme_support('custom-header') in twentyeleven_setup().
     *
     * @since Twenty Eleven 1.0
     */
    function twentyeleven_admin_header_style() {
        ?>
        <style type="text/css">
            .appearance_page_custom-header #headimg {
                border: none;
            }
            #headimg h1,
            #desc {
                font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
            }
            #headimg h1 {
                margin: 0;
            }
            #headimg h1 a {
                font-size: 32px;
                line-height: 36px;
                text-decoration: none;
            }
            #desc {
                font-size: 14px;
                line-height: 23px;
                padding: 0 0 3em;
            }
            <?php
            // If the user has set a custom color for the text use that
            if (get_header_textcolor() != HEADER_TEXTCOLOR) :
                ?>
                #site-title a,
                #site-description {
                    color: #<?php echo get_header_textcolor(); ?>;
                }
            <?php endif; ?>
            #headimg img {
                max-width: 1000px;
                height: auto;
                width: 100%;
            }
        </style>
        <?php
    }

endif; // twentyeleven_admin_header_style

if (!function_exists('twentyeleven_admin_header_image')) :

    /**
     * Custom header image markup displayed on the Appearance > Header admin panel.
     *
     * Referenced via add_theme_support('custom-header') in twentyeleven_setup().
     *
     * @since Twenty Eleven 1.0
     */
    function twentyeleven_admin_header_image() {
        ?>
        <div id="headimg">
            <?php
            $color = get_header_textcolor();
            $image = get_header_image();
            if ($color && $color != 'blank')
                $style = ' style="color:#' . $color . '"';
            else
                $style = ' style="display:none"';
            ?>
            <h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
            <div id="desc"<?php echo $style; ?>><?php bloginfo('description'); ?></div>
            <?php if ($image) : ?>
                <img src="<?php echo esc_url($image); ?>" alt="" />
            <?php endif; ?>
        </div>
        <?php
    }

endif; // twentyeleven_admin_header_image

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function twentyeleven_excerpt_length($length) {
    return 40;
}

add_filter('excerpt_length', 'twentyeleven_excerpt_length');

/**
 * Returns a "Continue Reading" link for excerpts
 */
function twentyeleven_continue_reading_link() {
    return '';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyeleven_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function twentyeleven_auto_excerpt_more($more) {
    return '' . twentyeleven_continue_reading_link();
}

add_filter('excerpt_more', 'twentyeleven_auto_excerpt_more');

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function twentyeleven_custom_excerpt_more($output) {
    if (has_excerpt() && !is_attachment()) {
        $output .= twentyeleven_continue_reading_link();
    }
    return $output;
}

add_filter('get_the_excerpt', 'twentyeleven_custom_excerpt_more');

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function twentyeleven_page_menu_args($args) {
    $args['show_home'] = true;
    return $args;
}

add_filter('wp_page_menu_args', 'twentyeleven_page_menu_args');

/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_widgets_init() {

    register_widget('Twenty_Eleven_Ephemera_Widget');

    register_sidebar(array(
        'name' => __('Main Sidebar', 'twentyeleven'),
        'id' => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

add_action('widgets_init', 'twentyeleven_widgets_init');

if (!function_exists('twentyeleven_content_nav')) :

    /**
     * Display navigation to next/previous pages when applicable
     */
    function twentyeleven_content_nav($nav_id) {
        global $wp_query;

        if ($wp_query->max_num_pages > 1) :
            ?>
            <nav id="<?php echo $nav_id; ?>">
                <h3 class="assistive-text"><?php _e('Post navigation', 'twentyeleven'); ?></h3>
                <div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', 'twentyeleven')); ?></div>
                <div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>', 'twentyeleven')); ?></div>
            </nav><!-- #nav-above -->
            <?php
        endif;
    }

endif; // twentyeleven_content_nav

/**
 * Return the URL for the first link found in the post content.
 *
 * @since Twenty Eleven 1.0
 * @return string|bool URL or false when no link is present.
 */
function twentyeleven_url_grabber() {
    if (!preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches))
        return false;

    return esc_url_raw($matches[1]);
}

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function twentyeleven_footer_sidebar_class() {
    $count = 0;

    if (is_active_sidebar('sidebar-3'))
        $count++;

    if (is_active_sidebar('sidebar-4'))
        $count++;

    if (is_active_sidebar('sidebar-5'))
        $count++;

    $class = '';

    switch ($count) {
        case '1':
            $class = 'one';
            break;
        case '2':
            $class = 'two';
            break;
        case '3':
            $class = 'three';
            break;
    }

    if ($class)
        echo 'class="' . $class . '"';
}

if (!function_exists('twentyeleven_comment')) :

    /**
     * Template for comments and pingbacks.
     *
     * To override this walker in a child theme without modifying the comments template
     * simply create your own twentyeleven_comment(), and that function will be used instead.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     *
     * @since Twenty Eleven 1.0
     */
    function twentyeleven_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' :
                ?>
                <li class="post pingback">
                    <p><?php _e('Pingback:', 'twentyeleven'); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('Edit', 'twentyeleven'), '<span class="edit-link">', '</span>'); ?></p>
                    <?php
                    break;
                default :
                    ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                    <article id="comment-<?php comment_ID(); ?>" class="comment">
                        <footer class="comment-meta">
                            <div class="comment-author vcard">
                                <span class="fn"><?php echo get_comment_author(); ?></span>
                                <time pubdate="" datetime=""><?php echo get_comment_date("D, n/j/y - h:ia"); ?></time>
                            </div><!-- .comment-author .vcard -->

                            <?php if ($comment->comment_approved == '0') : ?>
                                <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'twentyeleven'); ?></em>
                                <br />
                            <?php endif; ?>

                        </footer>

                        <div class="comment-content"><span class="arrow-comment"></span><?php comment_text(); ?></div>

                        <div class="reply">
                            <?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'twentyeleven'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                        </div><!-- .reply -->
                        <div class="clr" style="height: 5px;">&nbsp;</div>
                    </article><!-- #comment-## -->

                    <?php
                    break;
            endswitch;
        }

    endif; // ends check for twentyeleven_comment()

    if (!function_exists('twentyeleven_posted_on')) :

        /**
         * Prints HTML with meta information for the current post-date/time and author.
         * Create your own twentyeleven_posted_on to override in a child theme
         *
         * @since Twenty Eleven 1.0
         */
        function twentyeleven_posted_on() {
            printf(__('<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven'), esc_url(get_permalink()), esc_attr(get_the_time()), esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_url(get_author_posts_url(get_the_author_meta('ID'))), esc_attr(sprintf(__('View all posts by %s', 'twentyeleven'), get_the_author())), get_the_author()
            );
        }

    endif;

    /**
     * Adds two classes to the array of body classes.
     * The first is if the site has only had one author with published posts.
     * The second is if a singular post being displayed
     *
     * @since Twenty Eleven 1.0
     */
    function twentyeleven_body_classes($classes) {

        if (function_exists('is_multi_author') && !is_multi_author())
            $classes[] = 'single-author';

        if (is_singular() && !is_home() && !is_page_template('showcase.php') && !is_page_template('sidebar-page.php'))
            $classes[] = 'singular';

        return $classes;
    }

    add_filter('body_class', 'twentyeleven_body_classes');

    function cut_excerpt($excerpt) {
        $content = explode(' ', $excerpt);
        $ret = '';
        for ($i = 0; $i < 20; $i++) {
            $ret .= $content[$i] . ' ';
        }

        return $ret;
    }

    function filter_handler($data, $postarr) {

        // se fija si es update.
        if ($postarr['ID'] != 0) {
            global $wpdb;

            $sql = "SELECT * 
                    FROM  ttt_relation_ja_jatr
                    WHERE  ja_id = {$postarr['ID']}";

            $relation = $wpdb->get_results($sql);

            // se fija si existe en la otra base de datos
            if (empty($relation)) {
                // incerta el nuevo post

                $post_title = qtrans_split($postarr['post_title']);
                $post_content = qtrans_split($postarr['post_content']);
                $post_excerpt = qtrans_split($postarr['post_excerpt']);

                if ($post_title['tr'] != '') {
                    $post_content = $post_content['tr'];
                    $post_title = $post_title['tr'];
                    $post_excerpt = $post_excerpt['tr'];
                } else {
                    $post_content = $post_content['en'];
                    $post_title = $post_title['en'];
                    $post_excerpt = $post_excerpt['en'];
                }

                $table = 'ttt_posts';
                $insert = array(
                    'post_author' => $postarr['post_author'],
                    'post_date' => $postarr['post_date'],
                    'post_date_gmt' => $postarr['post_date_gmt'],
                    'post_content' => $post_content,
                    'post_title' => $post_title,
                    'post_excerpt' => $post_excerpt,
                    'post_status' => $postarr['post_status'],
                    'comment_status' => $postarr['comment_status'],
                    'ping_status' => $postarr['ping_status'],
                    'post_password' => $postarr['post_password'],
                    'post_name' => $postarr['post_name'],
                    'to_ping' => $postarr['to_ping'],
                    'pinged' => $postarr['pinged'],
                    'post_modified' => $postarr['post_modified'],
                    'post_modified_gmt' => $postarr['post_modified_gmt'],
                    'post_content_filtered' => $postarr['post_content_filtered'],
                    'post_parent' => $postarr['post_parent'],
                    'guid' => str_replace('justinalexanderbridal.com', 'justinalexander.com.tr', $image->guid),
                    'menu_order' => $postarr['menu_order'],
                    'post_type' => $postarr['post_type'],
                    'post_mime_type' => $postarr['post_mime_type'],
                    'comment_count' => 0,
                );
                $format = array(
                    '%d',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%d',
                    '%s',
                    '%d',
                    '%s',
                    '%s',
                    '%d',
                );
                $wpdb->insert($table, $insert, $format);
                $post_insert_id = $wpdb->insert_id;

                $table = 'ttt_term_relationships';
                $insert = array(
                    'object_id' => $post_insert_id,
                    'term_taxonomy_id' => 1,
                    'term_order' => 0,
                );
                $format = array(
                    '%d',
                    '%d',
                    '%d',
                );
                $wpdb->insert($table, $insert, $format);

                $table = 'ttt_relation_ja_jatr';
                $insert = array(
                    'ja_id' => $postarr['ID'],
                    'jatr_id' => $post_insert_id,
                );
                $format = array(
                    '%d',
                    '%d',
                );
                $wpdb->insert($table, $insert, $format);

                $copy_post_id = $post_insert_id;
            } else {
                // actualiza el post

                $post_title = qtrans_split($postarr['post_title']);
                $post_content = qtrans_split($postarr['post_content']);
                $post_excerpt = qtrans_split($postarr['post_excerpt']);

                if ($post_title['tr'] != '') {
                    $post_content = $post_content['tr'];
                    $post_title = $post_title['tr'];
                    $post_excerpt = $post_excerpt['tr'];
                } else {
                    $post_content = $post_content['en'];
                    $post_title = $post_title['en'];
                    $post_excerpt = $post_excerpt['en'];
                }

                $table = 'ttt_posts';
                $update = array(
                    'post_author' => $postarr['post_author'],
                    'post_date' => $postarr['post_date'],
                    'post_date_gmt' => $postarr['post_date_gmt'],
                    'post_content' => $post_content,
                    'post_title' => $post_title,
                    'post_excerpt' => $post_excerpt,
                    'post_status' => $postarr['post_status'],
                    'comment_status' => $postarr['comment_status'],
                    'ping_status' => $postarr['ping_status'],
                    'post_password' => $postarr['post_password'],
                    'post_name' => $postarr['post_name'],
                    'to_ping' => $postarr['to_ping'],
                    'pinged' => $postarr['pinged'],
                    'post_modified' => $postarr['post_modified'],
                    'post_modified_gmt' => $postarr['post_modified_gmt'],
                    'post_content_filtered' => $postarr['post_content_filtered'],
                    'post_parent' => $postarr['post_parent'],
                    'guid' => str_replace('justinalexanderbridal.com', 'justinalexander.com.tr', $image->guid),
                    'menu_order' => $postarr['menu_order'],
                    'post_type' => $postarr['post_type'],
                    'post_mime_type' => $postarr['post_mime_type'],
                    'comment_count' => 0,
                );
                $where = array('ID' => $relation[0]->jatr_id);
                $format = array(
                    '%d',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%d',
                    '%s',
                    '%d',
                    '%s',
                    '%s',
                    '%d',
                );
                $where_format = array('%d');

                $wpdb->update($table, $update, $where, $format, $where_format);

                $copy_post_id = $relation[0]->jatr_id;
            }

            // obtiene todas las imagenes del post copia
            $sql = "SELECT r.ja_id, r.jatr_id
                    FROM  ttt_posts p, ttt_relation_ja_jatr r
                    WHERE p.ID = r.jatr_id
                    AND p.post_type = 'attachment'
                    AND p.post_parent = {$copy_post_id}";

            $images_post_copy = $wpdb->get_results($sql);

            foreach ($images_post_copy as $image_copy) {
                $images_copy[$image_copy->ja_id] = $image_copy->jatr_id;
            }

            // obtiene todas las imagenes del post
            $args = array(
                'post_parent' => $postarr['ID'],
                'post_type' => 'attachment',
                'numberposts' => -1,
                'post_mime_type' => 'image',
                'order' => 'ASC',
                'orderby' => 'menu_order',
            );

            $images = get_posts($args);

            foreach ($images as $image) {
                $sql = "SELECT * 
                            FROM  ttt_relation_ja_jatr
                            WHERE  ja_id = {$image->ID}";

                $relationImg = $wpdb->get_results($sql);

                if (isset($images_copy[$image->ID])) {
                    unset($images_copy[$image->ID]);
                }

                // guarda las imagenes si no existen el la otras base de datos
                if (empty($relationImg)) {

                    $table = 'ttt_posts';
                    $insert = array(
                        'post_author' => $image->post_author,
                        'post_date' => $image->post_date,
                        'post_date_gmt' => $image->post_date_gmt,
                        'post_content' => $image->post_content,
                        'post_title' => $image->post_title,
                        'post_excerpt' => $image->post_excerpt,
                        'post_status' => $image->post_status,
                        'comment_status' => $image->comment_status,
                        'ping_status' => $image->ping_status,
                        'post_password' => $image->post_password,
                        'post_name' => $image->post_name,
                        'to_ping' => $image->to_ping,
                        'pinged' => $image->pinged,
                        'post_modified' => $image->post_modified,
                        'post_modified_gmt' => $image->post_modified_gmt,
                        'post_content_filtered' => $image->post_content_filtered,
                        'post_parent' => $copy_post_id,
                        'guid' => str_replace('justinalexanderbridal.com', 'justinalexander.com.tr', $image->guid),
                        'menu_order' => $image->menu_order,
                        'post_type' => $image->post_type,
                        'post_mime_type' => $image->post_mime_type,
                        'comment_count' => 0,
                    );
                    $format = array(
                        '%d',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%d',
                        '%s',
                        '%d',
                        '%s',
                        '%s',
                        '%d',
                    );
                    $wpdb->insert($table, $insert, $format);
                    $post_insert_id = $wpdb->insert_id;


                    $sql = "SELECT *
                      FROM  wp_ja_postmeta
                      WHERE  post_id = {$image->ID}";

                    $postmetaImg = $wpdb->get_results($sql);

                    foreach ($postmetaImg as $value) {
                        $table = 'ttt_postmeta';
                        $insert = array(
                            'post_id' => $post_insert_id,
                            'meta_key' => $value->meta_key,
                            'meta_value' => $value->meta_value,
                        );
                        $format = array(
                            '%d',
                            '%s',
                            '%s',
                        );
                        $wpdb->insert($table, $insert, $format);
                    }

                    $table = 'ttt_relation_ja_jatr';
                    $insert = array(
                        'ja_id' => $image->ID,
                        'jatr_id' => $post_insert_id,
                    );
                    $format = array(
                        '%d',
                        '%d',
                    );
                    $wpdb->insert($table, $insert, $format);

                    $path = explode('/', $image->guid);
                    $key = array_search('wp-content', $path);
                    $top = count($path);
                    $url = '';
                    for ($i = $key; $i < $top - 1; $i++) {
                        $url .= $path[$i];
                        if ($i < $top - 1) {
                            $url .= '/';
                        }
                    }

                    if (!is_dir('../../../JustinAlexanderBridalTurkish.com/blog/')) {
                        if (!mkdir('../../../JustinAlexanderBridalTurkish.com/blog/' . $url, 0, true)) {
                            die('Fallo al crear carpetas...');
                        }
                    }

                    $thumbnail = wp_get_attachment_image_src($image->ID, 'thumbnail');
                    $paht = explode('/', $thumbnail[0]);
                    $top = count($path);
                    copy('../' . $url . $paht[$top - 1], '../../../JustinAlexanderBridalTurkish.com/blog/' . $url . $paht[$top - 1]);

                    $medium = wp_get_attachment_image_src($image->ID, 'medium');
                    $paht = explode('/', $medium[0]);
                    $top = count($path);
                    copy('../' . $url . $paht[$top - 1], '../../../JustinAlexanderBridalTurkish.com/blog/' . $url . $paht[$top - 1]);

                    $large = wp_get_attachment_image_src($image->ID, 'large');
                    $paht = explode('/', $large[0]);
                    $top = count($path);
                    copy('../' . $url . $paht[$top - 1], '../../../JustinAlexanderBridalTurkish.com/blog/' . $url . $paht[$top - 1]);
                }
            }

            if (!empty($images_copy)) {
                foreach ($images_copy as $image_copy) {
                    $table = 'ttt_posts';
                    $update = array(
                        'post_parent' => 0,
                    );
                    $where = array('ID' => $image_copy);
                    $format = array(
                        '%d',
                    );
                    $where_format = array('%d');
                    $wpdb->update($table, $update, $where, $format, $where_format);
                }
            }

            // guarda o actualiza el post thumbnail
            if (has_post_thumbnail($postarr['ID'])) {
                $thumbnailId = get_post_thumbnail_id($postarr['ID']);

                $sql = "SELECT * 
                            FROM  ttt_relation_ja_jatr
                            WHERE  ja_id = {$thumbnailId}";

                $thumbnailImg = $wpdb->get_results($sql);

                $sql = "SELECT * 
                    FROM  ttt_postmeta
                    WHERE  post_id = {$copy_post_id}
                    AND    meta_key = '_thumbnail_id'";

                $thumbnail = $wpdb->get_results($sql);
                if (empty($thumbnail)) {
                    $table = 'ttt_postmeta';
                    $insert = array(
                        'post_id' => $copy_post_id,
                        'meta_key' => '_thumbnail_id',
                        'meta_value' => $thumbnailImg[0]->jatr_id,
                    );
                    $format = array(
                        '%d',
                        '%s',
                        '%d',
                    );
                    $wpdb->insert($table, $insert, $format);
                } else {
                    $table = 'ttt_postmeta';
                    $update = array(
                        'meta_value' => $thumbnailImg[0]->jatr_id,
                    );
                    $where = array('meta_id' => $thumbnail[0]->meta_id);
                    $format = array(
                        '%d',
                    );
                    $where_format = array('%d');
                    $wpdb->update($table, $update, $where, $format, $where_format);
                }
            }

            // aca hay que guardar las relaciones entre post
            echo '<pre>';
            print_r($postarr['MRP_related_posts']['MRP_post_type-1']);
            echo '</pre>';
            die;
        }

        return $data;
    }

    add_filter('wp_insert_post_data', 'filter_handler', '99', 2);

    function attachment_save($post, $attachment) {
        // para actualizar las imagenes
        global $wpdb;

        $sql = "SELECT * 
                    FROM  ttt_relation_ja_jatr
                    WHERE  ja_id = {$post['ID']}";
        $relationImg = $wpdb->get_results($sql);

        $table = 'ttt_posts';
        $update = array(
            'post_author' => $post['post_author'],
            'post_date' => $post['post_date'],
            'post_date_gmt' => $post['post_date_gmt'],
            'post_content' => $post['post_title'],
            'post_title' => $post['post_content'],
            'post_excerpt' => $post['post_excerpt'],
            'post_status' => $post['post_status'],
            'comment_status' => $post['comment_status'],
            'ping_status' => $post['ping_status'],
            'post_password' => $post['post_password'],
            'post_name' => $post['post_name'],
            'to_ping' => $post['to_ping'],
            'pinged' => $post['pinged'],
            'post_modified' => $post['post_modified'],
            'post_modified_gmt' => $post['post_modified_gmt'],
            'post_content_filtered' => $post['post_content_filtered'],
            'post_parent' => $post['post_parent'],
            'menu_order' => $post['menu_order'],
            'post_type' => $post['post_type'],
            'post_mime_type' => $post['post_mime_type'],
            'comment_count' => 0,
        );
        $where = array('ID' => $relationImg[0]->jatr_id);
        $format = array(
            '%d',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%d',
            '%s',
            '%d',
            '%s',
            '%s',
            '%d',
        );
        $where_format = array('%d');

        $wpdb->update($table, $update, $where, $format, $where_format);

        return $post;
    }

    add_filter('attachment_fields_to_save', 'attachment_save', 10, 2);