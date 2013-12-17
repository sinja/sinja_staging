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


<?php
/*
  echo '<pre>';
  $lwpdb = new wpdb('root', '', , $host);

  global $wpdb;
  $sql = "select * from $mi_table_name";
  $results = $wpdb->get_results($sql, ARRAY_A);
  echo '</pre>';
*/
?>

<div id="breadcrumb"><ul><li><a href="<?php echo GetSiteUrl(); ?>/index.php" title="Home">Home</a></li> <li> &gt; Blog</li> </ul></div>

<div class="pageTitle"><h2>BLOG</h2></div>

<?php while (have_posts()) : the_post() ?>
    <div class="contentPage">
        <div class="spacer"></div>

        <h3 class="pageHeader"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
        <span class="headerInfo" style="text-transform: capitalize;"><?php echo get_the_date('F j, Y'); ?></span>

        <?php the_content(); ?>

        <div class="clr"></div>
        <div class="clr"></div>

        <div class="actionButtons">                                
            <a class="viewArticle" href="<?php the_permalink() ?>"><?php e_strt('Read More'); ?></a>                    	 
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