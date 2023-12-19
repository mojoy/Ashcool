<?php
/**
 * Template Name: описания курса
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
                    <div class="heading">
                        <strong class="ttl">Программа обучения</strong>
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
                    <div class="add-content-holder">
                        <?php
                        $add_content = get_field('add_content');
                        echo $add_content;
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<div class="content content-languages">
    <div class="holder">
        <h1><?php the_title()?></h1>
        <?php the_content(); ?>
    </div>
</div>

<?php get_footer();  ?>
