<?php
/**
 * Template Name: contact
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
                        <?php the_content(); ?>
                        <div class="box-contact-form">
                            <?php echo do_shortcode('[contact-form-7 id="37" title="Контактная форма 1"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</div>
<?php get_footer();  ?>
