<?php
/**
 * Template Name: прайс
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
                            <h1><span><?php the_title()?></span></h1>
                            <div class="price">
                                <div class="price-inner">
                                    <div class="price-content">
                                        <div class="price-content-add">
                                            <?php the_content(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p>*группы по всем языкам, литературе, подготовке к школе и подготовке к ЕГЭ / ОГЭ от 2 до 6 человек</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php get_footer();  ?>
