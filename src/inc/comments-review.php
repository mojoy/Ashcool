<?php if ( post_password_required() )
{ return; }
?>
<?php if ( have_comments() ) : ?>
<div id="comments">
    <h2 class="comments-title">
        <?php printf( _nx ( 'Один отзыв к записи &ldquo;%2$s&rdquo;', '%1$s отзыва к записи &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'twentyfifteen' ), number_format_i18n( get_comments_number() ), get_the_title() ); ?>
    </h2>
	<div class="commentlist">
		<?php
		$args = array(
			'walker'            => null,
			'max_depth'         => '',
			'style'             => 'div',
			'callback'          => 'mytheme_comment',
			'end-callback'      => null,
			'type'              => 'all',
			'reply_text'        => 'Ответить',
			'login_tex'        => 'Что бы написать отзыв, нужно указать ваше имя и электронную почту',
			'page'              => '',
			'per_page'          => '',
			'avatar_size'       => 32,
			'reverse_top_level' => null,
			'reverse_children'  => '',
			'format'            => 'html5', // или xhtml, если HTML5 не поддерживается темой
			'short_ping'        => false,    // С версии 3.6,
			'echo'              => true,     // true или false
		);

		wp_list_comments( $args );
		?>
	</div>
	<?php endif; ?>


	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :	?>
		<p class="no-comments"><?php _e( 'Комментарии закрыты.' ); ?></p>
	<?php endif; ?>

	<?php

	$comments_args = array(
		// изменим название кнопки
		'label_submit' => 'Оставить отзыв',
		// заголовок секции ответа
		'title_reply'=>'Напишите свой отзыв',
		// удалим текст, который будет показано после того как коммент отправлен
		'comment_notes_after' => '',
		// переопределим textarea (тело формы)
		'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8"  aria-required="true" required="required"></textarea></p>',
	);

	comment_form( $comments_args );
	?>
</div>
