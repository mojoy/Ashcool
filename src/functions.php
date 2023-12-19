<?php

function right_way_to_include_google_fonts() {
    if (!is_admin()) {
        wp_register_style('google', 'https://fonts.googleapis.com/css?family=Play:400,700&amp;subset=cyrillic,cyrillic-ext,latin-ext', array(), null, 'all');
        wp_enqueue_style('google');
    }
}
add_action('wp_enqueue_scripts', 'right_way_to_include_google_fonts');

wp_register_style($handle, $src, $deps, $ver, $media);


function my_scripts(){
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', null, null );

    wp_enqueue_script( 'script-one3', get_template_directory_uri() . '/js/jquery.min.js', array(), null, true );
    wp_enqueue_script( 'script-one3', get_template_directory_uri() . '/js/jquery.easing-1.3.pack.js', array(), null, true );
    wp_enqueue_script( 'script-one4', get_template_directory_uri() . '/js/jquery.mousewheel-3.0.4.pack.js', array(), null, true );
    wp_enqueue_script( 'script-one5', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array(), null, true );
    wp_enqueue_script( 'script-one6', get_template_directory_uri() . '/js/main.js', array(), null, true );


}
add_action('wp_enqueue_scripts', 'my_scripts');









if ( function_exists("add_theme_support") ) {
	add_theme_support( 'post-thumbnails');
	add_theme_support( 'custom-background');
	add_theme_support( 'automatic-feed-links' );
	//add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	add_theme_support( 'admin-bar', array( 'callback'=>'__return_false' ) );
	add_theme_support( 'post-formats', array( 'standard','aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'  ) );


	if ( function_exists( 'add_image_size' ) ) {
        add_image_size( 'small', 195,195, true);
	}

}



if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'name' => 'Баннер на главной',
        'id' => 'banner-main',
        'before_widget' => '<div id="%1$s" class="banner-main %1$s">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => '',
    ));
    register_sidebar(array(
        'name' => 'Адрес в футере',
        'id' => 'address',
        'before_widget' => '<div id="%1$s" class="address %1$s">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => '',
    ));
    register_sidebar(array(
        'name' => 'хедер блок слева',
        'id' => 'header-left',
        'before_widget' => '<div id="%1$s" class="address %1$s">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => '',
    ));
    register_sidebar(array(
        'name' => 'хедер блок справа',
        'id' => 'header-right',
        'before_widget' => '<div id="%1$s" class="address %1$s">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => '',
    ));

}








function my_editor_style() {
	global $current_screen;
	switch ($current_screen->post_type) {
		case 'post':
			add_editor_style('editor-style.css');
			break;

		case 'page':
			add_editor_style('editor-style.css');
			break;

		case 'overview':
			add_editor_style('editor-style.css');
			break;
	}
}
add_action( 'admin_head', 'my_editor_style' );




// сжатие контента

if( extension_loaded('zlib') && ini_get('output_handler') != 'ob_gzhandler' ){
	add_action('wp', function(){ @ ob_end_clean(); @ ini_set('zlib.output_compression', 'on'); } );
}


function register_my_menus(){
	register_nav_menus(
		array(
			'nav'=>'Главное меню',
            'menu'=>'Меню языков'
		));
}

add_action('init','register_my_menus');




## удаляет сообщение о новой версии WordPress у всех пользователей кроме администратора
if( is_admin() && ! current_user_can('manage_options') ){
	add_action('init', function(){  remove_action( 'init', 'wp_version_check' );  }, 2 );
	add_filter('pre_option_update_core', '__return_null');
}

## Удаление табов "Все рубрики" и "Часто используемые" из метабоксов рубрик (таксономий) на странице редактирования записи.
add_action('admin_print_footer_scripts', 'hide_tax_metabox_tabs_admin_styles', 99);
function hide_tax_metabox_tabs_admin_styles(){
	$cs = get_current_screen();
	if( $cs->base !== 'post' || empty($cs->post_type) ) return; // не страница редактирования записи
	?>
	<style>
		.postbox div.tabs-panel{ max-height:1200px; border:0; }
		.category-tabs{ display:none; }
	</style>
	<?php
}

##  отменим показ выбранного термина наверху в checkbox списке терминов
add_filter( 'wp_terms_checklist_args', 'set_checked_ontop_default', 10 );
function set_checked_ontop_default( $args ) {
	// изменим параметр по умолчанию на false
	if( ! isset($args['checked_ontop']) )
		$args['checked_ontop'] = false;
	return $args;
}

## Добавление класса `has_sidebar` к тегу `<body>`, если есть сайдбар
add_filter('body_class', 'has_sidebar_func');
function has_sidebar_func( $classes ){
	if( is_active_sidebar('sidebar') ){
		// добавляем класс
		$classes[] = 'has_sidebar';
	}
	return $classes;
}

## Полное Удаление версии WP
## Также нужно удалить файл readme.html в корне сайта
remove_action('wp_head', 'wp_generator'); // из заголовка
add_filter('the_generator', '__return_empty_string'); // из фидов и URL

## Изменение длины цитаты
add_filter( 'excerpt_length', 'custom_excerpt_length_func');
function custom_excerpt_length_func( $length ) {
	return 20; // кол-во слов
}

## Отменяем обертку картинок в тег `<p>` в контенте
add_filter('the_content', 'remove_img_ptags_func');
function remove_img_ptags_func( $content ){
	return preg_replace('/<p>\s*((?:<a[^>]+>)?\s*<img[^>]+>\s*(?:<\/a>)?)\s*<\/p>/i', '\1', $content );
}

## закроем возможность публикации через xmlrpc.php
add_filter('xmlrpc_enabled', '__return_false');

## качество картинок
function my_prefix_regenerate_thumbnail_quality() {
	return 65;
}
add_filter( 'jpeg_quality', 'my_prefix_regenerate_thumbnail_quality');


## заменим слово "записи" на "посты" для типа записей 'post'
add_filter('post_type_labels_post', 'rename_posts_labels');
function rename_posts_labels( $labels ){
	// заменять автоматически нельзя: Запись = Новости, а в тексте получим "Просмотреть Новости"
	$new = array(
		'name'                  => 'Новости',
		'singular_name'         => 'Новость',
		'add_new'               => 'Добавить новость',
		'add_new_item'          => 'Добавить новость',
		'edit_item'             => 'Редактировать новость',
		'new_item'              => 'Новая новость',
		'view_item'             => 'Просмотреть новость',
		'search_items'          => 'Поиск новость',
		'not_found'             => 'Новости не найдены.',
		'not_found_in_trash'    => 'Новости в корзине не найдены.',
		'parent_item_colon'     => '',
		'all_items'             => 'Все новости',
		'archives'              => '',
		'insert_into_item'      => 'Вставить в новости',
		'uploaded_to_this_item' => 'Загруженные для этой новости',
		'featured_image'        => 'Миниатюра новости',
		'filter_items_list'     => 'Фильтровать список статеи',
		'items_list_navigation' => 'Навигация по списку статеи',
		'items_list'            => 'Список статей',
		'menu_name'             => 'Новости',
		'name_admin_bar'        => 'Новости', // пункте "добавить"
	);

	return (object) array_merge( (array) $labels, $new );
}


## Добавляем типы записей в результат поиска
add_action('pre_get_posts', 'get_posts_search_filter');
function get_posts_search_filter( $query ){
	if ( ! is_admin() && $query->is_main_query() && $query->is_search ) {
		$query->set('post_type', array('post', 'overview', 'doctor') );
	}
}


## Удаление виджетов из Консоли WordPress
add_action('wp_dashboard_setup', 'clear_wp_dash' );
function clear_wp_dash(){
	$dash_side = &$GLOBALS['wp_meta_boxes']['dashboard']['side']['core'];
	$dash_normal = &$GLOBALS['wp_meta_boxes']['dashboard']['normal']['core'];

	unset($dash_side['dashboard_quick_press']);   //Быстрая публикация
	//unset($dash_side['dashboard_recent_drafts']); //Полседние черновики
	unset($dash_side['dashboard_primary']);       //Блог WordPress
	unset($dash_side['dashboard_secondary']);     //Другие Нновости WordPress

	unset($dash_normal['dashboard_incoming_links']);  //Входящие ссылки
	//unset($dash_normal['dashboard_right_now']);       //Прямо сейчас
	unset($dash_normal['dashboard_recent_comments']); //Последние комментарии
	unset($dash_normal['dashboard_plugins']);         //Последние Плагины

	unset($dash_normal['dashboard_activity']);        // Активность
}

## Отключим возможность редактировать файлы в админке для тем, плагинов
define('DISALLOW_FILE_EDIT', true);

## отключаем не нужные стандартные виджеты
add_action('widgets_init', 'unregister_basic_widgets' );
function unregister_basic_widgets() {
	//unregister_widget('WP_Widget_Pages');            // Виджет страниц
	unregister_widget('WP_Widget_Calendar');         // Календарь
	unregister_widget('WP_Widget_Archives');         // Архивы
	unregister_widget('WP_Widget_Links');            // Ссылки
	unregister_widget('WP_Widget_Meta');             // Мета виджет
	unregister_widget('WP_Widget_Search');           // Поиск
	//unregister_widget('WP_Widget_Text');             // Текст
	unregister_widget('WP_Widget_Categories');       // Категории
	unregister_widget('WP_Widget_Recent_Posts');     // Последние записи
	unregister_widget('WP_Widget_Recent_Comments');  // Последние комментарии
	unregister_widget('WP_Widget_RSS');              // RSS
	unregister_widget('WP_Widget_Tag_Cloud');        // Облако меток
	//unregister_widget('WP_Nav_Menu_Widget');         // Меню
}

## Добавляем все типы записей в виджет "Прямо сейчас" в консоли
add_action( 'dashboard_glance_items' , 'add_right_now_info' );
function add_right_now_info( $items ){

	if( ! current_user_can('edit_posts') ) return $items; // выходим

	// типы записей
	$args = array( 'public' => true, '_builtin' => false );

	$post_types = get_post_types( $args, 'object', 'and' );

	foreach( $post_types as $post_type ){
		$num_posts = wp_count_posts( $post_type->name );
		$num       = number_format_i18n( $num_posts->publish );
		$text      = _n( $post_type->labels->singular_name, $post_type->labels->name, intval( $num_posts->publish ) );

		$items[] = "<a href=\"edit.php?post_type=$post_type->name\">$num $text</a>";
	}

	// таксономии
	$taxonomies = get_taxonomies( $args, 'object', 'and' );

	foreach( $taxonomies as $taxonomy ){
		$num_terms = wp_count_terms( $taxonomy->name );
		$num       = number_format_i18n( $num_terms );
		$text      = _n( $taxonomy->labels->singular_name, $taxonomy->labels->name , intval( $num_terms ) );

		$items[] = "<a href='edit-tags.php?taxonomy=$taxonomy->name'>$num $text</a>";
	}

	// пользователи
	global $wpdb;

	$num  = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
	$text = _n( 'User', 'Users', $num );

	$items[] = "<a href='users.php'>$num $text</a>";

	return $items;
}



// начало добавление колонки с превью каринки
if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {
	// for post and page
	add_theme_support('post-thumbnails', array( 'post', 'page' ) );
	function fb_AddThumbColumn($cols) {
		$cols['thumbnail'] = __('Thumbnail');
		return $cols;
	}

	function fb_AddThumbValue($column_name, $post_id) {
		$width = (int) 60;
		$height = (int) 60;
		if ( 'thumbnail' == $column_name ) {
			// thumbnail of WP 2.9
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );

			// image from gallery
			$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );

			if ($thumbnail_id)
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			elseif ($attachments) {
				foreach ( $attachments as $attachment_id => $attachment ) {
					$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
				}
			}
			if ( isset($thumb) && $thumb ) { echo $thumb; }
			else { echo __('None'); }
		}
	}

	// for posts
	add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
	add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );

	// for pages
	add_filter( 'manage_pages_columns', 'fb_AddThumbColumn' );
	add_action( 'manage_pages_custom_column', 'fb_AddThumbValue', 10, 2 );
}
// конец добавление колонки с превью каринки
/**
 * Обрезка текста (excerpt). Шоткоды вырезаются. Минимальное значение maxchar может быть 22.
 *
 * @param (строка/массив) $args Параметры.
 *
 * @return HTML
 * ver 2.6.1
 */
function kama_excerpt( $args = '' ){
	global $post;
	$default = array(
		'maxchar'   => 350,   // количество символов.
		'text'      => '',    // какой текст обрезать (по умолчанию post_excerpt, если нет post_content.
		// Если есть тег <!--more-->, то maxchar игнорируется и берется все до <!--more--> вместе с HTML
		'autop'     => false,  // Заменить переносы строк на <p> и <br> или нет
		'save_tags' => '',    // Теги, которые нужно оставить в тексте, например '<strong><b><a>'
		'more_text' => 'Читать дальше...', // текст ссылки читать дальше
	);

	if( is_array($args) ) $_args = $args;
	else                  parse_str( $args, $_args );
	$rg = (object) array_merge( $default, $_args );
	if( ! $rg->text ) $rg->text = $post->post_excerpt ?: $post->post_content;
	$rg = apply_filters('kama_excerpt_args', $rg );
	$text = $rg->text;
	$text = preg_replace ('~\[/?.*?\](?!\()~', '', $text ); // убираем шоткоды, например:[singlepic id=3], markdown +
	$text = trim( $text );
	// <!--more-->
	if( strpos( $text, '<!--more-->') ){
		preg_match('/(.*)<!--more-->/s', $text, $mm );
		$text = trim($mm[1]);
		$text_append = ' <a href="'. get_permalink( $post->ID ) .'#more-'. $post->ID .'">'. $rg->more_text .'</a>';
	}
	// text, excerpt, content
	else {
		$text = trim( strip_tags($text, $rg->save_tags) );
		// Обрезаем
		if( mb_strlen($text) > $rg->maxchar ){
			$text = mb_substr( $text, 0, $rg->maxchar );
			$text = preg_replace('~(.*)\s[^\s]*$~s', '\\1 ...', $text ); // убираем последнее слово, оно 99% неполное
		}
	}
	// Сохраняем переносы строк. Упрощенный аналог wpautop()
	if( $rg->autop ){
		$text = preg_replace(
			array("~\r~", "~\n{2,}~", "~\n~",   '~</p><br ?/>~'),
			array('',     '</p><p>',  '<br />', '</p>'),
			$text
		);
	}
	$text = apply_filters('kama_excerpt', $text, $rg );
	if( isset($text_append) ) $text .= $text_append;
	return ($rg->autop && $text) ? "$text" : $text;
}




// шаблон вывода комментариев
function mytheme_comment($comment, $args, $depth){
	$GLOBALS['comment'] = $comment; ?>
	<div <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div class="comment-block reviews">
			<?php if ($comment->comment_approved == '0') : ?>
				<em><?php _e('Ваш комментарий ожидает модерации.') ?></em>
				<br/>
			<?php endif; ?>
			<div class="comment-content post">
				<div class="post-content post-content"><?php comment_text() ?></div>
				<div class="comment-autor post-info">
					<?php // echo get_avatar($comment,$size='75',$default='<path_to_url>' ); ?>
					<span class="autor"><?php printf(__('<cite class="fn">%s</cite> '), get_comment_author_link()) ?></span>
					<em class="date">(<?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()) ?>)</em>
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
				<div class="comment-meta commentmetadata">
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"></a>
					<?php edit_comment_link(__('(Edit)'),'  ','') ?>
				</div>
			</div>
		</div>
	</div>
<?php }










/**
 * Установка HTTP заголовка Last-Modified
 * При активации плагина, у всех незапароленных постов в HTTP-заголовках появится Last-Modified
 * https://sheensay.ru/?p=247
 */

add_action( 'template_redirect', 'Sheensay_HTTP_Headers_Last_Modified' );

function Sheensay_HTTP_Headers_Last_Modified() {

    if ( ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || ( defined( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST ) || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) || ( is_admin() ) ) {
        return;
    }

    $last_modified = '';


    // Для страниц и записей
    if ( is_singular() ) {
        global $post;

        // Если пост запаролен - пропускаем его
        if ( post_password_required( $post ) )
            return;

        if ( !isset( $post -> post_modified_gmt ) ) {
            return;
        }

        $post_time = strtotime( $post -> post_modified_gmt );
        $modified_time = $post_time;

        // Если есть комментарий, обновляем дату
        if ( ( int ) $post -> comment_count > 0 ) {
            $comments = get_comments( array(
                'post_id' => $post -> ID,
                'number' => '1',
                'status' => 'approve',
                'orderby' => 'comment_date_gmt',
            ) );
            if ( !empty( $comments ) && isset( $comments[0] ) ) {
                $comment_time = strtotime( $comments[0] -> comment_date_gmt );
                if ( $comment_time > $post_time ) {
                    $modified_time = $comment_time;
                }
            }
        }

        $last_modified = str_replace( '+0000', 'GMT', gmdate( 'r', $modified_time ) );
    }


    // Cтраницы архивов: рубрики, метки, даты и тому подобное
    if ( is_archive() || is_home() ) {
        global $posts;

        if ( empty( $posts ) ) {
            return;
        }

        $post = $posts[0];

        if ( !isset( $post -> post_modified_gmt ) ) {
            return;
        }

        $post_time = strtotime( $post -> post_modified_gmt );
        $modified_time = $post_time;

        $last_modified = str_replace( '+0000', 'GMT', gmdate( 'r', $modified_time ) );
    }


    // Если заголовки уже отправлены - ничего не делаем
    if ( headers_sent() ) {
        return;
    }

    if ( !empty( $last_modified ) ) {
        header( 'Last-Modified: ' . $last_modified );

        if ( !is_user_logged_in() ) {
            if ( isset( $_SERVER['HTTP_IF_MODIFIED_SINCE'] ) && strtotime( $_SERVER['HTTP_IF_MODIFIED_SINCE'] ) >= $modified_time ) {
                $protocol = (isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1');
                header( $protocol . ' 304 Not Modified' );
            }
        }
    }
}


function varnish_safe_http_headers() {
    session_cache_limiter('');
    header_remove("Cache-Control");
    header("Cache-Control: public, max-age=60");
    if( !session_id() )
    {
        session_start();
    }
}
add_action( 'template_redirect', 'varnish_safe_http_headers' );




/**
 * Sets a cookie sitename_new_visitor if it doesn't exist already.
 */
function example_set_new_user_cookie() {
    if ( ! is_admin() && ! isset( $_COOKIE['sitename_new_visitor'] ) ) {
        setcookie( 'sitename_new_visitor', 1, time() + 3600 * 24 * 100, COOKIEPATH, COOKIE_DOMAIN, false );
    }
}
add_action( 'init', 'example_set_new_user_cookie');


// сжатие контента

if( extension_loaded('zlib') && ini_get('output_handler') != 'ob_gzhandler' ){
    add_action('wp', function(){ @ ob_end_clean(); @ ini_set('zlib.output_compression', 'on'); } );
}


/**
 * Отключить emoji
 */
function mhdn_disable_emoji() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'mhdn_disable_tinymce_emoji' );
}
add_action( 'init', 'mhdn_disable_emoji', 1 );

/**
 * Отключить плагин tinymce emoji
 */
function mhdn_disable_tinymce_emoji( $plugins ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
}





// Все скрипты JS подключаются в конце страницы

function footer_enqueue_scripts(){
    remove_action('wp_head','wp_print_scripts');
    remove_action('wp_head','wp_print_head_scripts',9);
    remove_action('wp_head','wp_enqueue_scripts',1);
    add_action('wp_footer','wp_print_scripts',5);
    add_action('wp_footer','wp_enqueue_scripts',5);
    add_action('wp_footer','wp_print_head_scripts',5);
}
add_action('after_setup_theme','footer_enqueue_scripts');





############################
## register taxonomies reviews
############################



#add_rewrite_rule( 'reviews/([^/]+)/?', 'index.php?taxonomy=reviews&term=$matches[1]&post_type=review', 'top' );
#add_rewrite_rule( 'reviews/([^/]+)/page/([0-9]{1,})/?', 'index.php?taxonomy=reviews&term=$matches[1]&post_type=review&paged=$matches[2]', 'top' );

register_post_type('review',
    array(
        'labels' => array(
            'name' => _x('Отзывы', 'post type general name'),
            'singular_name' => _x('Отзывы', 'post type singular name'),
            'add_new' => _x('Добавить отзывы', 'Добавить'),
            'add_new_item' => __('Добавить отзывы'),
            'edit_item' => __('Редактировать'),
            'new_item' => __('Новый'),
            'view_item' => __('Просмотреть'),
            'search_items' => __('Искать'),
            'not_found' =>  __('Ничего не найдено'),
            'not_found_in_trash' => __('в Корзине не найдено'),
        ),
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        '_builtin'            => false, // Это настраиваемый тип сообщения, не встроенный
        '_edit_link'          => 'post.php?post=%d',
        'query_var' => true,
        'show_in_quick_edit' => false,
        'show_admin_column' => false,
        //'permalink_epmask' => 'EP_NONE',
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 5,
        'exclude_from_search' => false,
        'menu_icon' => 'dashicons-groups',
        //'taxonomies' => array('category','post_tag'),
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            //'comments',
            //'revisions',
        ),
    )
);
register_taxonomy(
    'reviews', 'review', array(
        'hierarchical' => true,
        'label' => 'Категории отзывов',
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'query_var' => true,
        'rewrite' => true
    )
);




############################
## register taxonomies photo
############################

register_post_type('photo',
    array(
        'labels' => array(
            'name' => _x('Фото', 'post type general name'),
            'singular_name' => _x('Фото', 'post type singular name'),
            'add_new' => _x('Добавить фото', 'Добавить'),
            'add_new_item' => __('Добавить фото'),
            'edit_item' => __('Редактировать'),
            'new_item' => __('Новый'),
            'view_item' => __('Просмотреть'),
            'search_items' => __('Искать'),
            'not_found' =>  __('Ничего не найдено'),
            'not_found_in_trash' => __('в Корзине не найдено'),
        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        '_builtin'            => false, // Это настраиваемый тип сообщения, не встроенный
        '_edit_link'          => 'post.php?post=%d',
        'query_var' => true,
        'show_in_quick_edit' => false,
        'show_admin_column' => false,
        //'permalink_epmask' => 'EP_NONE',
        'capability_type' => 'post',
        'exclude_from_search' => false,
        'hierarchical' => true,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-video-alt3',
        //'taxonomies' => array('category','post_tag'),
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'comments',
            'revisions',
        ),
    )
);
register_taxonomy(
    'photos', 'photo', array(
        'hierarchical' => true,
        'label' => 'Категории фото',
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'query_var' => true,
        'rewrite' => true
    )
);



############################
## register taxonomies video
############################

register_post_type('video',
    array(
        'labels' => array(
            'name' => _x('Видео', 'post type general name'),
            'singular_name' => _x('Видео', 'post type singular name'),
            'add_new' => _x('Добавить Видео', 'Добавить'),
            'add_new_item' => __('Добавить Видео'),
            'edit_item' => __('Редактировать'),
            'new_item' => __('Новый'),
            'view_item' => __('Просмотреть'),
            'search_items' => __('Искать'),
            'not_found' =>  __('Ничего не найдено'),
            'not_found_in_trash' => __('в Корзине не найдено'),
        ),
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        '_builtin'            => false, // Это настраиваемый тип сообщения, не встроенный
        '_edit_link'          => 'post.php?post=%d',
        'query_var' => true,
        'show_in_quick_edit' => false,
        'show_admin_column' => false,
        //'permalink_epmask' => 'EP_NONE',
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,

        'menu_icon' => 'dashicons-groups',
        //'taxonomies' => array('category','post_tag'),
        'supports' => array(
            'title',
            //'editor',
            //'thumbnail',
            //'comments',
            //'revisions',
        ),
    )
);
register_taxonomy(
    'videos', 'video', array(
        'hierarchical' => true,
        'label' => 'Категории видео',
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'query_var' => true,
        'rewrite' => true
    )
);

function inspiry_pagination( $query ) {


    if($query->found_posts > 6) {
        echo "<div class='pagination'>";
        $big = 999999999; // need an unlikely integer
        echo paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url ( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'prev_text' => __( '<i class="fa fa-angle-left"></i>', 'inspiry' ),
            'next_text' => __( '<i class="fa fa-angle-right"></i>', 'inspiry' ),
            'current' => max( 1, get_query_var ( 'paged' ) ),
            'total' => $query->max_num_pages,
        ) );

        echo "</div>";
    }
}