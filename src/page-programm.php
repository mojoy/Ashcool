<?php
/**
 * Template Name: программа обучения
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
                    <h1><?php the_title()?></h1>
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
                    <?php the_content(); ?>
                </div>
            </div>
        </main>
    </div>
</div>
<?php get_footer();  ?>
