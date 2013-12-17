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

<div id="breadcrumb"><ul><li><a href="<?php echo GetSiteUrl(); ?>/index.php" title="Home">Home</a></li> <li> &gt; <?php printf(__('Search Results for: %s', 'twentyeleven'), '<span>' . get_search_query() . '</span>'); ?></li> </ul></div>

<div class="blog clearfix">

    <?php get_sidebar(); ?>

    <div id="primary">
        <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post() ?>
            <div class="post">
                <div class="date"><?php echo get_the_date('M'); ?><br/><strong><?php echo get_the_date('j'); ?></strong></div>
                <h3 class="AlmibarPro"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>

                <?php
                $image_url[0] = '';
                if (has_post_thumbnail(get_the_ID())) {
                    $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'medium');
                    ?>
                    <a href="<?php echo get_permalink(get_the_ID()); ?>"><img class="imgth" src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" /></a>
                    <?php
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
                    if (isset($image_url[0])) {
                        ?>
                        <img class="imgth" src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" />
                        <?php
                    } else {
                        $image_url[0] = GetSiteUrl() . "/img/logo/main.png";
                    }
                }
                ?>

                <?php the_excerpt(); ?>

                <div class="clr"></div>

                <a class="readmore" href="<?php the_permalink() ?>"><?php e_strt('Read More'); ?></a>  

                <div class="bloglikeButton">
                    <div style="width:60px;overflow:hidden">
                        <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $image_url[0]; ?>&description=<?php the_title(); ?> <?php echo get_the_excerpt(); ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
                        <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
                    </div>
                    <div>
                        <script type="text/javascript">	_ga.trackFacebook(); </script><fb:like href="<?php the_permalink(); ?>" send="false" layout="button_count" width="100" show_faces="false"></fb:like>
                    </div>
                    <div>
                        <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-via="ja_bridal">Tweet</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    </div>
                    <div>
                        <!-- Place this tag where you want the +1 button to render. -->
                        <div class="g-plusone" data-size="medium" href="<?php the_permalink(); ?>" data-annotation="none"></div>

                        <!-- Place this tag after the last +1 button tag. -->
                        <script type="text/javascript">
                            (function() {
                                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                po.src = 'https://apis.google.com/js/plusone.js';
                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                            })();
                        </script>
                    </div>
                    <div>
                        <span class="st_sharethis_custom"></span>

                        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
                        <script type="text/javascript">
                            stLight.options({
                                publisher:'f2585e59-0b64-4cb2-a256-12babea6f65e',
                            });
                        </script>
                    </div>
                </div>                 	 

                <div class="clr"></div>

            </div>
            <div class="post-spacer">&nbsp;</div>
        <?php endwhile; ?>
<?php else : ?>
    <p><?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyeleven'); ?></p>
<?php endif; ?>


        <div class="navigation clearfix">
            <ul>
                <?php
                $top = $wp_query->max_num_pages;
                if ($top > 1) {
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                    if ($paged > 1) {
                        $prevlink = esc_url(get_pagenum_link($paged - 1));
                        ?>
                        <li><a href="<?php echo $prevlink; ?>"><< prev</a></li>        
                        <li><a href="<?php echo esc_url(get_pagenum_link($i)); ?>">< first</a></li>        
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
                            <li><a href="<?php echo esc_url(get_pagenum_link($i)); ?>"><?php echo $i; ?></a></li>
                            <?php
                        }
                    }
                    ?>

                    <?php
                    if ($paged < $top) {
                        $nextlink = esc_url(get_pagenum_link($paged + 1));
                        ?>
                        <li><a href="<?php echo $nextlink; ?>">next ></a></li>
                        <li><a href="<?php echo esc_url(get_pagenum_link($top)); ?>">last >></a></li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <div class="clr"></div>	

    </div>
</div>


<?php get_footer(); ?>