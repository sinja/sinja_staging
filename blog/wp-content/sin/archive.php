<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */
get_header();
?>

<div id="breadcrumb"><ul><li><a href="<?php echo GetSiteUrl(); ?>/index.php" title="Home">Home</a></li> <li> 
            &gt; 
            <?php if (is_day()) : ?>
                <?php printf(__('Daily Archives: %s', 'twentyeleven'), '<span>' . get_the_date() . '</span>'); ?>
            <?php elseif (is_month()) : ?>
                <?php printf(__('Monthly Archives: %s', 'twentyeleven'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'twentyeleven')) . '</span>'); ?>
            <?php elseif (is_year()) : ?>
                <?php printf(__('Yearly Archives: %s', 'twentyeleven'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'twentyeleven')) . '</span>'); ?>
            <?php else : ?>
                <?php _e('Blog Archives', 'twentyeleven'); ?>
            <?php endif; ?>
        </li> </ul></div>

<?php get_sidebar(); ?>

<?php while (have_posts()) : the_post() ?>
    <div class="contentPage excerpt">
        <div class="spacer"></div>

        <h3 class="pageHeader"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
        <span class="headerInfo" style="text-transform: capitalize;"><?php echo get_the_date('F j, Y'); ?></span>

        <?php
        $args = array(
            'post_parent' => get_the_id(),
            'post_type' => 'attachment',
            'numberposts' => 1,
            'post_mime_type' => 'image',
            'order' => 'ASC',
            'orderby' => 'menu_order',
        );

        $image = get_posts($args);

        $imageSrcT = wp_get_attachment_image_src($image[0]->ID, 'thumbnail');
        $imageSrcF = wp_get_attachment_image_src($image[0]->ID, 'full');
        ?>

        <a title="<?php echo $image[0]->post_title; ?>" href="<?php echo $imageSrcF[0]; ?>"><img class="imgth" src="<?php echo $imageSrcT[0]; ?>" alt="<?php echo $image[0]->post_title; ?>" /></a>

        <?php the_excerpt(); ?>

        <a class="viewArticle" href="<?php the_permalink() ?>"><?php e_strt('Read More'); ?></a>                    	 

        <div class="clr"></div>

    </div>

<?php endwhile; ?>

<div id="pagingPress" class="clr" style="padding-top:20px;">
    <div class="pageSliderNavContainer">

        <?php
        $top = $wp_query->max_num_pages;
        if ($top > 1) {
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            if ($paged > 1) {
                $prevlink = esc_url(get_pagenum_link($paged - 1));
                ?>
                <a class="backward" id="pageSlideLeftBottom" href="<?php echo $prevlink; ?>"></a>
                <?php
            }
            ?>
            <ul class="pageSliderNav">

                <?php
                for ($i = 1; $i <= $top; $i++) {
                    if ($i == $paged) {
                        ?>
                        <li><a class="current" href="javascript:;"><?php echo $i; ?></a></li>
                        <?php
                    } else {
                        ?>
                        <li><a href="<?php echo esc_url(get_pagenum_link($i)); ?>"><?php echo $i; ?></a></li>
                        <?php
                    }
                }
                ?>
            </ul>
            <?php
            if ($paged < $top) {
                $nextlink = esc_url(get_pagenum_link($paged + 1));
                ?>
                <a class="forward" id="pageSlideRightBottom" href="<?php echo $nextlink; ?>"></a>
                <?php
            }
        }
        ?>
    </div>
    <div class="clr"></div>	
</div>

<?php get_footer(); ?>