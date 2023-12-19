<?php
/**
 * Template Name: Фото
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
                <div class="heading-filter">
                    <h1>Фото</h1>
                    <a href="/videos/vse-video/" title="Видео">Видео</a>
                </div>
                <p>Альбомы</p>
                <div class="category-description">
                    <?php
                    if (is_category() && !is_paged()) {
                        echo category_description();
                    }
                    ?>
                </div>
                <div class="posts-material">
                    <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                        $category = get_the_category();
                        $cat_id = $category[0]->cat_id;


                        $term = (get_query_var('term')) ? get_query_var('term') : 'vse-foto';

                        //echo $term;

                        $args = array(
                            'post_type' => 'photo',
                            'posts_per_page' => 6,
                            'paged' => $paged,
                            'term'   => $term,
                            'taxonomy' => 'photos'
                        );
                        $q = new WP_Query($args);
                        if ($q->have_posts()): while($q->have_posts()): $q->the_post();
                            ?>

                            <div class="post">
                                <a class="post-link-content" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <time class="date" datetime="<?php the_time('Y-m-d H:i'); ?>"><?php the_time('j.m.Y');?></time>
                                    <?php
                                    if ( has_post_thumbnail() ) {
                                        the_post_thumbnail('thumbnail');
                                    }
                                    else {
                                        echo '<img src="' . get_bloginfo( 'stylesheet_directory' )
                                            . '/images/no-photo.jpg" />';
                                    }
                                    ?>
                                    <strong class="title"><?php the_title()?></strong>
                                </a>
                            </div>


                            <?php
                        endwhile; else:
                        endif;
                            ?>
                </div>

                <?php  inspiry_pagination( $q ); ?>
                <?php //  get_template_part( 'inc/pagination', 'none' ); ?>

                <nav class="filter add-filter">
                    <ul>
                        <?php
                        $variable = wp_list_categories('echo=0&show_count=1&depth=-1&title_li=0&taxonomy=photos');
                        $variable = str_replace(array('('), '<span>', $variable);
                        $variable = str_replace(array(')'), '</span>', $variable);
                        echo $variable;
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </main>
    </div>
    </div>
<?php get_footer();?>