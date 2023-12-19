<?php
/**
 * Template Name: статья
 *
 * @package WordPress
 * @subpackage
 */
get_header();  ?>
        <main>
            <div class="holder main-holder">
                <div class="content">
                    <div class="breadcrumbs">
                        <?php
                        get_template_part( 'inc/breadcrumb', 'none' );
                        ?>
                    </div>
                    <div class="post">
                        <div class="post-content">
                            <h1><?php the_title()?></h1>
                            <time class="date" datetime="<?php the_time('Y-m-d H:i'); ?>"><?php the_time('j.m.Y');?></time>
                            <?php
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail('small', array( 'class' => 'img-thumbnail' ));
                                }
                                else {
                                    echo '<img src="' . get_bloginfo( 'stylesheet_directory' )
                                        . '/images/thumbnail-nophoto.jpg" />';
                                }
                            ?>
                            <?php the_content(); ?>





                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php get_footer();  ?>
