<?php
/**
* 
* Header of our theme.
*
*/
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title(); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/_/js/vendor/html5.js" type="text/javascript"></script>
<![endif]-->

<!-- Minified, complete version of Modernizr. -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
    <div class="site-header-contnet">
      <nav id="utilNav" class="utility-nav" role="navigation">
        <?php wp_nav_menu( array( 'theme_location' => 'util-nav' ) ); ?>
      </nav><!-- #site-navigation -->
  		<nav id="site-nav" class="site-nav" role="navigation">
        <?php wp_nav_menu( array( 'theme_location' => 'main-nav' ) ); ?>
  		</nav><!-- #site-navigation -->
    </div>
  </header><!-- #masthead -->







