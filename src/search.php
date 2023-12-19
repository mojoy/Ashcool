<?php
/**
 * Template Name: поиск
 * @package WordPress
 * @subpackage doors on the order
 */
get_header();
?>
<main>
            <div class="holder main-holder">
                <div class="content">
                    <div class="breadcrumbs">
                        <?php
                        if(function_exists('bcn_display'))
                        {
                            bcn_display();
                        }
                        ?>
                    </div>
                    <?php get_search_form(); ?>
                    <?php if (have_posts()) : ?>
                        <h1><?php _e('Результат поиска', 'kubrick'); ?></h1>
                        <div class="post-search-list">
                            <?php while (have_posts()) : the_post(); ?>
                                <div class="post">
                                    <?php get_template_part( 'inc/post-top', 'none' ); ?>
                                    <div class="post-content">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                            <?php get_template_part( 'inc/post-img', 'none' ); ?>
                                        </a>
                                        <?php echo kama_excerpt( array('maxchar'=>290) ); ?>
                                    </div>
                                    <?php get_template_part( 'inc/post-info', 'none' ); ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else : ?>
                        <h2 class="center"><?php _e('Ничего не найдено, вероятно вышла ошибочка', ''); ?></h2>
                        <?php // get_search_form(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
    </div>
<?php get_footer(); ?>