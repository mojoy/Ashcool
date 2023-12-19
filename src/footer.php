    <footer class="footer">
		<div class="holder row-col">
            <div class="col-3">
                <div class="box-copy">
                    Все права защищены.<br>
                    &copy; <?php echo date("Y"); ?> год
                </div>
            </div>
            <div class="col-3">
                <div class="logo"><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>" ><?php bloginfo('name'); ?></a></div>
            </div>
            <div class="col-3 col-address">
                <div class="box-address">
                    <?php dynamic_sidebar('address'); ?>
                </div>
            </div>
		</div>
	</footer>
    </div>
    <div style="display: none">
        <div class="box-contact-form" id="pop-up">
            <?php echo do_shortcode('[contact-form-7 id="37" title="Контактная форма 1"]'); ?>
        </div>
    </div>
	<?php wp_footer(); ?>
</body>
</html>