<?php
/**
 * Template Name: Tag
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
                    ?>
                    <div class="heading">
                        <h1>Тег: <?php single_tag_title (); ?></h1>
                    </div>
                    <div class="category-description">
                        <?php
                        //if (is_category() && !is_paged()) {
                        echo category_description();
                        //}
                        ?>
                    </div>
				<?php
				$counter_post = 1;
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						if($counter_post == 2){
							get_template_part( 'inc/post-banner', 'none' );
						}
						?>
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
						<?php
						$counter_post ++;
					};
				};
				?>
				<?php get_template_part( 'inc/pagination', 'none' ); ?>
			</div>
			<?php get_template_part( 'inc/aside-left', 'none' ); ?>
			<?php get_template_part( 'inc/aside-right', 'none' ); ?>
		</div>
		<div class="holder">
			<div class="last-item-wrapper">
				<?php get_template_part( 'inc/form-box', 'none' ); ?>
				<?php get_template_part( 'inc/new-items', 'none' ); ?>
			</div>
		</div>
	</main>
    </div>
    </div>
<?php get_footer();  ?>