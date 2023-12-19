<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 19.12.2017
 * Time: 7:34
 */
?>
<div class="box">
	<strong class="ttl">Категории блога</strong>
	<ul class="cat-items">
		<?php
		$variable = wp_list_categories('echo=0&show_count=1&depth=-1&title_li=0');
		//$variable = str_replace(array('('), '<span>', $variable);
		//$variable = str_replace(array(')'), '</span>', $variable);
		echo $variable;
		?>
	</ul>
</div>
