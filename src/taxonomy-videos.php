<?php
/**
 * Template Name: видео материал
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
                    <a href="/photos/vse-foto/" title="Фото">Фото</a>
                    <h1>Видео</h1>

                </div>
                <div class="category-description">
                    <?php
                    if (is_category() && !is_paged()) {
                        echo category_description();
                    }
                    ?>
                </div>
                <div class="posts-material">
                    <?php

                        $args = array(
                            'post_type' => 'video',
                            'posts_per_page' => -1
                        );
                        $q = new WP_Query($args);
                        if ($q->have_posts()): while($q->have_posts()): $q->the_post();
                            ?>

                            <div class="post">
                                <?php edit_post_link('редактировать', '<p>', '</p>'); ?>
                                <div class="box-content">
                                    <div class="video-holder">
                                        <a href="<?php echo get_field('link-video'); ?>" class="fancybox-video " title="<?php the_title(); ?>"  data-fancybox="video">
                                            <span class="btn-play">
                                                <img src="<?php
                                                $str = get_field('link-video');
                                                # $re = '/^(?<url>.*youtube\.com\/watch?v=)(?<video_id>\S+)\?.*$/';
                                                # preg_match($re,$str,$matches);
                                                $video_id_arr = explode('watch?v=',$str);
                                                echo('http://img.youtube.com/vi/'.$video_id_arr[1].'/hqdefault.jpg'); ?>" alt="<?php the_title(); ?>">
                                            </span>
                                            <span><?php the_title(); ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>



                            <?php
                        endwhile; else:
                        endif;
                            ?>
                </div>

                <?php // get_template_part( 'inc/pagination', 'none' ); ?>

                <nav class="filter add-filter">
                    <ul>
                        <?php
                        $variable = wp_list_categories('echo=0&show_count=1&depth=-1&title_li=0&taxonomy=videos');
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