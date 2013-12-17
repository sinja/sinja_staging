<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
get_header();
?>


<div id="breadcrumb"><ul><li><a href="<?php echo GetSiteUrl(); ?>/index.php" title="Home">Home</a></li> <li> &gt; <a href="<?php echo GetSiteUrl(); ?>/blog/" title="Blog">Blog</a></li> <li> &gt; <?php the_title(); ?></li> </ul></div>

<?php while (have_posts()) : the_post() ?>
    <div class="contentPage">
        <div class="spacer"></div>

        <h3 class="pageHeader"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
        <span class="headerInfo" style="text-transform: capitalize;"><?php echo get_the_date('F j, Y'); ?></span>

        <?php the_content(); ?>

        <div class="clr"></div>
        <div class="clr"></div>

        <div class="actionButtons">
            <div class="shareButton" style="float:left;">
                <a class="sendPress" href="javascript:void(0);" title="share this"></a>
                <div class="tooltipBig">
                    <div class="addthis_toolbox addthis_default_style addthis_32x32_style" addthis:url="<?php the_permalink(); ?>" addthis:title="<?php the_title(); ?>">
                        <a class="addthis_button_preferred_1"></a>
                        <a class="addthis_button_preferred_2"></a>
                        <a class="addthis_button_preferred_3"></a>
                        <a class="addthis_button_preferred_4"></a>
                        <a class="addthis_button_compact"></a>
                        <a class="addthis_counter addthis_bubble_style"></a>
                    </div>
                    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4b5d485814507317"></script>
                </div>
            </div>
            <div class="fb-like" data-send="false" data-width="350" data-show-faces="false" style="margin:2px 0px 0px 5px;"></div>

        </div>
        <div class="clr"></div>

    </div>

<?php endwhile; ?>

<?php //comments_template('', true); ?>

<?php get_footer(); ?>