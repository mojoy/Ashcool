<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 19.12.2017
 * Time: 17:22
 */
?>
<div class="pagination">
	<?php
		$args = array(
			'show_all'     => false, // показаны все страницы участвующие в пагинации
			'end_size'     => 2,     // количество страниц на концах
			'mid_size'     => 2,     // количество страниц вокруг текущей
			'prev_next'    => true,  // выводить ли боковые ссылки "предыдущая/следующая страница".
			'prev_text'    => __(''),
			'next_text'    => __(''),
			'add_args'     => false, // Массив аргументов (переменных запроса), которые нужно добавить к ссылкам.
			'add_fragment' => '',     // Текст который добавиться ко всем ссылкам.
			'screen_reader_text' => __( 'Страницы: ' ),
		);
		the_posts_pagination( $args );
	?>
</div>