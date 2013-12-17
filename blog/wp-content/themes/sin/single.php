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

<?php while (have_posts()) : the_post() ?>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
<div id="breadcrumb"><ul><li><a href="<?php echo GetSiteUrl(); ?>/index.php" title="Home">Home</a></li> <li> &gt; <a href="<?php bloginfo('url'); ?>" title="Blog">Blog</a></li> <li> &gt; <?php the_title(); ?></li> </ul></div>

<div class="blog clearfix">
    <?php get_sidebar(); ?>
    <div id="primary"> 
        <div class="post" style="padding-bottom: 0px;">
            

                <div class="date"><?php echo get_the_date('M'); ?><br/><strong><?php echo get_the_date('j'); ?></strong></div>
                <h3 class="AlmibarPro"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                <?php
                $image_url[0] = '';
                if (has_post_thumbnail(get_the_ID())) {
                    $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                    ?>
                    <img width="100%" alt="<?php the_title(); ?>" src="<?php echo $image_url[0]; ?>" />
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
                    $image_url = wp_get_attachment_image_src($images[0]->ID, 'full');
					if(!empty($image_url[0])){
					?> 
						<img width="100%" src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" />
					<?php
					}
                }
                ?>

                <div class="clr">&nbsp;</div>
                <div class="bloglikeButton">
                    <div style="width:60px;overflow:hidden">
                        <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $image_url[0]; ?>&description=<?php the_title(); ?>- <?php echo    (get_the_excerpt()); ?>    " class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
                        <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
                    </div>
                    <div style="width: 72px;">
                        <iframe src="//www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;send=false&amp;locale=en_US&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=21&amp;appId=238694836256291" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>
                    </div>
                    <div>
                        <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-via="ja_bridal" data-count="none">Tweet</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    </div>
                    <div>
                        <!-- Place this tag where you want the +1 button to render. -->
                        <div class="g-plusone" data-size="medium" data-annotation="none" data-href="<?php the_permalink(); ?>"></div>

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
                <div class="clr">&nbsp;</div>
                <?php the_content(); ?>

                <?php
                $args = array(
                    'post_parent' => get_the_id(),
                    'post_type' => 'attachment',
                    'numberposts' => -1,
                    'post_mime_type' => 'image',
                    'order' => 'ASC',
                    'orderby' => 'menu_order',
                );

                $images = get_posts($args);

                if (!empty($images)) {
                    ?>
                    <div class="clr">&nbsp;</div>
                    <h4>GALLERY</h4>
                    <div class="boxgallery">
                        <?php
                        foreach ($images as $img) {
                            $imageSrcT = wp_get_attachment_image_src($img->ID, 'thumbnail');
                            $imageSrcF = wp_get_attachment_image_src($img->ID, 'full');
                            ?>
                            <a class="gallery" rel="gallery" data-external-url="<?php echo $img->post_excerpt; ?>" data-url="<?php the_permalink(); ?>" data-img="<?php echo $imageSrcF[0]; ?>" data-desc="<?php the_title(); ?> <?php echo    (get_the_excerpt()); ?>    " title="<?php echo $img->post_title; ?>" href="<?php echo $imageSrcF[0]; ?>"><img width="122" src="<?php echo $imageSrcT[0]; ?>" alt="<?php the_title(); ?> <?php echo    (get_the_excerpt()); ?>    " /></a>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>


                <?php 
                if (function_exists('MRP_get_related_posts')) {
                    $relatedPost = MRP_get_related_posts(get_the_ID(), true);

                    if (is_array($relatedPost)) {
                        ?>
                        <h4>RELATED POSTS</h4>
                        <div class="boxrelatedposts">
                            <?php
                            foreach ($relatedPost as $post) {
								$title = qtrans_split($post->post_title);
								$lang = qtrans_getLanguage();
								
								if($title[$lang] == '') {
									foreach($title as $key => $value) {
										if($value != ''){
											$lang = $key;
											break;
										}
									}
								}
								
                                $image_url[0] = '';
                                if (has_post_thumbnail(get_the_ID())) {
                                    $image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail');
                                    ?>
                                    <a href="<?php echo get_permalink($post->ID); ?>"><img width="75" src="<?php echo $image_url[0]; ?>" alt="<?php echo $title[$lang]; ?>" /></a>
                                    <?php
                                }
                                ?>
                                <h3><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $title[$lang]; ?></a></h3>
                                <div class="clr"></div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                } 
                ?>

                <div class="clr"></div>


            

            <?php comments_template('', true); ?>
        </div>
        <div class="clr">&nbsp;</div>
        <div class="clr">&nbsp;</div>
    </div>
</div>
<?php endwhile; ?>

<?php get_footer(); ?>