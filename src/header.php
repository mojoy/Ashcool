<!DOCTYPE html>
<html <?php language_attributes(); ?>  dir="ltr">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title('|', true, 'right'); ?></title>
	<!--<base href="<?php bloginfo('url'); ?>/" />-->
    <link href="<?= bloginfo('template_directory'); ?>/css/mini.css" rel="stylesheet" type="text/css" />
	<?php wp_head(); ?>
    <script>(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script>
</head>
<body <?php body_class($class); ?>>
<div class="wrapper" id="wrapper">
    <div class="container-top">
        <div class="add-container-top">
            <header class="header">
                <div class="holder">
                    <div class="row-col">
                        <div class="col-3 header-left">
                            <?php dynamic_sidebar('header-left'); ?>
                        </div>
                        <div class="col-3">
                            <div class="logo"><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>" ><?php bloginfo('name'); ?></a></div>
                        </div>
                        <div class="col-3">
                            <div class="header-right-content">
                                <?php dynamic_sidebar('header-right'); ?>
                                <a href="#" title="Личный кабинет" class="login"><span>Личный кабинет</span></a>
                            </div>
                        </div>
                        <span class="nav-mob"><i></i><i></i><i></i></span>
                    </div>
                </div>
                <div class="row-nav">
                    <div class="holder">
                        <?php
                            $nav_args = array(
                                'theme_location'  => 'nav',
                                'menu_class'      => 'nav',
                                'menu_id'         => 'nav',
                                'echo'            => true,
                                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'depth'           => 0,
                            );
                            wp_nav_menu($nav_args);
                        ?>
                    </div>
                </div>
                <span class="btn-menu"><span></span><span></span><span></span></span>
            </header>
