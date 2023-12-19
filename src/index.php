<?php
/**
 * Template Name: Главная
 *
 * @package WordPress
 * @subpackage Smile-at-Once
 */
get_header();  ?>
<main>


    <div class="holder">
        <div class="main-menu-holder">
            <?php
                $nav_args = array(
                    'theme_location'  => 'menu',
                    'menu_class'      => 'menu',
                    'menu_id'         => 'menu',
                    'link_before'     => '<span>',
                    'link_after'      => '</span>',
                    'echo'            => true,
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 0,
                );
                wp_nav_menu($nav_args);
            ?>
        </div>

        <div class="container-reviews">
            <strong class="ttl">Отзывы</strong>
            <div class="reviews row-col">
                <?php
                    $args = array(
                        'post_type' => 'review',
                        'posts_per_page' => 3
                    );
                    $q = new WP_Query($args);
                    if ($q->have_posts()): while($q->have_posts()): $q->the_post();
                ?>
                    <div class="col-3">
                        <div class="box-review">
                            <blockquote>
                                <q><?php echo kama_excerpt( array('maxchar'=>300) ); ?></q>
                                <cite><?php the_title()?></cite>
                            </blockquote>
                        </div>
                    </div>
                <?php
                    endwhile; else:
                    endif;
                ?>
            </div>
            <div class="btn-row">
                <a href="/reviews/vse-otzyivyi/" class="btn">Все отзывы</a>
            </div>
        </div>
        </div>
    </div>
    </div>
    <section class="section-banner">
        <div class="section-banner1">
            <div class="section-banner2">
                <?php dynamic_sidebar('banner-main'); ?>
            </div>
        </div>
    </section>
    <section class="section-news">
        <div class="holder">
            <strong class="ttl">новости</strong>
            <div class="news row-col">
                <?php $pc = new WP_Query( array(
                        'posts_per_page' => 3,
                        'orderby'   => 'date',
                        'category_name' => 'news'
                    ));
                ?>
                <?php while ($pc->have_posts()) : $pc->the_post(); ?>
                    <div class="col-3">
                        <a href="<?php the_permalink()?>" title="<?php the_title()?>">
                            <?php
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail('small', array( 'itemprop' => 'image' ));
                            }
                            else {
                                echo '<img src="' . get_bloginfo( 'stylesheet_directory' ). '/images/no-photo.jpg" />';
                            }
                            ?>
                            <span class="box-new-content">
                                <time class="date" datetime="<?php the_time('Y-m-d H:i'); ?>"><?php the_time('j.m.Y');?></time>
                                <strong class="title"><?php the_title()?></strong>
                                <?php echo kama_excerpt( array('maxchar'=>160) ); ?>
                            </span>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <section class="contact-form">
        <div class="holder">
            <?php echo do_shortcode('[contact-form-7 id="37" title="Контактная форма 1"]'); ?>
        </div>
    </section>
</main>

<?php get_footer();  ?>
