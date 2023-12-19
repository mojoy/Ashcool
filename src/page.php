<?php
/**
 * Template Name: страница
 *
 * @package WordPress
 * @subpackage Smile-at-Once
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
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</div>
<?php get_footer();  ?>
