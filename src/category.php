<?php
/**
 * Template Name: Категории
 *
 * @package WordPress
 * @subpackage Smile-at-Once
 */
get_header();  ?>
	<main>
		<div class="holder main-holder">
			<div class="content">
                <?php
                    get_template_part( 'inc/breadcrumb', 'none' );
                    if ( is_single() ) {
                        $cats =  get_the_category();
                        $cat = $cats[0];
                    } else {
                        $cat = get_category( get_query_var('cat') );
                    }
                    $cat_slug = $cat->slug; // ярлык рубрики
                    $cat_title = $cat->cat_name;
                ?>
                <div class="heading">
                    <h1><?php echo $cat_title ?></h1>
                </div>
                <div class="category-description">
                    <?php
                        if (is_category() && !is_paged()) {
                            echo category_description();
                        }
                    ?>
                </div>
                <div class="posts-holder">
                    <?php
                    if ( have_posts() ) {
                        while ( have_posts() ) {
                            the_post();
                            ?>

                            <div class="post">
                                <a class="post-link-content" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php
                                    if ( has_post_thumbnail() ) {
                                        the_post_thumbnail('small', array( 'class' => 'img-thumbnail' ));
                                    }
                                    else {
                                        echo '<img src="' . get_bloginfo( 'stylesheet_directory' )
                                            . '/images/no-photo.jpg" />';
                                    }
                                    ?>
                                    <span class="post-content">
                                        <time class="date" datetime="<?php the_time('Y-m-d H:i'); ?>"><?php the_time('j.m.Y');?></time>
                                        <strong class="title"><?php the_title()?></strong>
                                        <?php echo kama_excerpt( array('maxchar'=>450) ); ?>
                                    </span>
                                </a>
                            </div>


                            <?php
                        }
                    };
                    ?>
                </div>
				<?php get_template_part( 'inc/pagination', 'none' ); ?>


			</div>


			<?php // get_template_part( 'inc/aside-right', 'none' ); ?>
		</div>
	</main>
    </div>
    </div>
<?php get_footer();  ?>