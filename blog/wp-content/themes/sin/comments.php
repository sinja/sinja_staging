<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to twentyeleven_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<div id="comments">
    <?php if (post_password_required()) : ?>
        <p class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.', 'twentyeleven'); ?></p>
    </div><!-- #comments -->
    <?php
    /* Stop the rest of comments.php from being processed,
     * but don't kill the script entirely -- we still have
     * to fully load the template.
     */
    return;
endif;
?>

<?php // You can start editing here -- including this comment! ?>


<a id="view-comments-btn" href="javascript:;">close</a>
<h2 id="comments-title">COMMENTS (<?php echo get_comments_number(); ?>)</h2>
<div id="view-comments">
<?php comment_form(array('comment_notes_before' => '<div id="twconnect_commentslogin" class="twc_connect">&nbsp;</div> <img style="display: block; clear: left; margin-bottom: 8px;" src="'.get_bloginfo('template_url').'/images/or.png" />')); ?>
    <?php if (have_comments()) : ?>
		<div style="border-top: 1px solid #3A3A3A; height: 5px; margin-bottom: 5px;">&nbsp;</div>
		
		<div class="navigation clearfix">
            <ul>
                <?php
                $top = get_comment_pages_count();
				$wp_query->query_vars['cpage'];
                if ($top > 1) {
                    $paged = (isset($wp_query->query_vars['cpage'])) ? $wp_query->query_vars['cpage'] : 1;

                    if ($paged > 1) {
                        $prevlink = esc_url(get_comments_pagenum_link($paged - 1));
                        ?>
                        <li><a href="<?php echo $prevlink; ?>"><< prev</a></li>        
                        <li><a href="<?php echo esc_url(get_comments_pagenum_link(1)); ?>">< first</a></li>        
                        <?php
                    }
                    ?>


                    <?php
                    for ($i = 1; $i <= $top; $i++) {
                        if ($i == $paged) {
                            ?>
                            <li class="current"><?php echo $i; ?></li>
                            <?php
                        } else {
                            ?>
                            <li><a href="<?php echo esc_url(get_comments_pagenum_link($i)); ?>"><?php echo $i; ?></a></li>
                            <?php
                        }
                    }
                    ?>

                    <?php
                    if ($paged < $top) {
                        $nextlink = esc_url(get_comments_pagenum_link($paged + 1));
                        ?>
                        <li><a href="<?php echo $nextlink; ?>">next ></a></li>
                        <li><a href="<?php echo esc_url(get_comments_pagenum_link($top)); ?>">last >></a></li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <div class="clr"></div>	
		
        <ol class="commentlist">
            <?php
            /* Loop through and list the comments. Tell wp_list_comments()
             * to use twentyeleven_comment() to format the comments.
             * If you want to overload this in a child theme then you can
             * define twentyeleven_comment() and that will be used instead.
             * See twentyeleven_comment() in twentyeleven/functions.php for more.
             */
            wp_list_comments(array('callback' => 'twentyeleven_comment'));
            ?>
        </ol>
        <div class="clr">&nbsp;</div>
		
        <?php
    /* If there are no comments and comments are closed, let's leave a little note, shall we?
     * But we don't want the note on pages or post types that do not support comments.
     */
    elseif (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) :
        ?>
        <p class="nocomments"><?php _e('Comments are closed.', 'twentyeleven'); ?></p>
    <?php endif; ?>
</div>
</div><!-- #comments -->

