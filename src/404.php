<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package 404
 * @subpackage Smile-at-Once
 * @since Smile-at-Once 1.0
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
                    <h1>к сожалению страница не найдена</h1>
                </div>
            </div>
        </main>
    </div>
</div>
<?php get_footer();  ?>

