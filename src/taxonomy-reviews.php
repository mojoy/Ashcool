<?php
/**
 * Template Name: отзывы
 *
 * @package WordPress
 * @subpackage
 */
get_header();  ?>
    <main>
        <div class="holder main-holder">
            <div class="content">
                <?php
                    get_template_part( 'inc/breadcrumb', 'none' );
                ?>
                <div class="heading">
                    <h1><?php echo $cat_title ?></h1>
                </div>
                <div class="category-description">
                    <?php
                    if (is_category() && !is_paged()) {
                        echo category_description();
                    }
                    ?>
                </div>
                <div class="posts-review">
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array(
                        'post_type' => 'review',
                        'posts_per_page' => 6,
                        'paged' => $paged,
                        'taxonomy' => 'reviews'
                    );
                    $q = new WP_Query($args);
                    if ($q->have_posts()): while($q->have_posts()): $q->the_post();
                        ?>
                        <div class="post">
                            <span class="post-link-content">
                               <span class="post-content">
                                   <time class="date" datetime="<?php the_time('Y-m-d H:i'); ?>"><?php the_time('j.m.Y');?></time>
                                   <span class="post-content-text"><?php the_content(); ?></span>
                                   <span class="avtor"><?php the_title()?></span>
                               </span>
                            </span>
                        </div>

                        <?php
                    endwhile; else:
                    endif;
                    ?>
                </div>

                <?php
                inspiry_pagination( $q );
                ?>

            </div>



        </div>
    </main>
    </div>
    </div>
<?php get_footer();  ?>