<?php

add_action( 'wp_enqueue_scripts', 'wps_enqueue_jquery' );
/**
 * Enqueue jQuery from Google CDN with fallback to local WordPress
 *
 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @link http://codex.wordpress.org/Function_Reference/wp_register_script
 * @link http://codex.wordpress.org/Function_Reference/wp_deregister_script
 * @link http://codex.wordpress.org/Function_Reference/get_bloginfo
 * @link http://codex.wordpress.org/Function_Reference/is_wp_error
 * @link http://codex.wordpress.org/Function_Reference/set_transient
 * @link http://codex.wordpress.org/Function_Reference/get_transient
 *
 * @uses get_transient()        Get the value of a transient.
 * @uses set_transient()        Set/update the value of a transient.
 * @uses is_wp_error()          Check whether the passed variable is a WordPress Error.
 * @uses get_bloginfo()         returns information about your site.
 * @uses wp_deregister_script() Deregisters javascripts for use with wp_enqueue_script() later.
 * @uses wp_register_script()   Registers javascripts for use with wp_enqueue_script() later.
 * @uses wp_enqueue_script()    Enqueues javascript.
 */
function wps_enqueue_jquery() {
  // Setup Google URI, default
  $protocol = ( isset( $_SERVER['HTTPS'] ) && 'on' == $_SERVER['HTTPS'] ) ? 'https' : 'http';
  // Get Latest Version
  $url      = $protocol . '://code.jquery.com/jquery-latest.min.js';
  
  // Get Specific Version
  //$url      = $protocol . '://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js';
  
  // Setup WordPress URI
  $wpurl = get_bloginfo( 'wpurl') . '/wp-includes/js/jquery/jquery.js';
  
  // Setup version
  $ver = null;
  
  // Deregister WordPress default jQuery
  wp_deregister_script( 'jquery' );
  
  // Check transient, if false, set URI to WordPress URI
  delete_transient( 'google_jquery' );
  
  if ( 'false' == ( $google = get_transient( 'google_jquery' ) ) ) {
    $url = $wpurl;
  }
  // Transient failed
  elseif ( false === $google ) {
    // Ping Google
    $resp = wp_remote_head( $url );
    
    // Use Google jQuery
    if ( ! is_wp_error( $resp ) && 200 == $resp['response']['code'] ) {
      // Set transient for 5 minutes
      set_transient( 'google_jquery', 'true', 60 * 5 );
    } 
    
    // Use WordPress jQuery
    else {
      // Set transient for 5 minutes
      set_transient( 'google_jquery', 'false', 60 * 5 );
      
      // Use WordPress URI
      $url = $wpurl;
      
      // Set jQuery Version, WP stanards
      $ver = '1.8.2';
    }
  }
  
  // Register surefire jQuery
  wp_register_script( 'jquery', $url, array(), $ver, true );
  
  // Enqueue jQuery
  wp_enqueue_script( 'jquery' );
}


// Enqueues scripts and styles for front-end.
function _hero_scripts_styles() {
  global $wp_styles;
  
  wp_enqueue_style( 'ckhero-style', get_stylesheet_uri() );   // Load our main stylesheet.
  wp_enqueue_script( 'ck-functions', get_template_directory_uri() . '/js/functions.ck.js', array('jquery'), '1.0', true );  
  
  // Load the Internet Explorer specific stylesheet.
  wp_enqueue_style( '_hero-ie', get_template_directory_uri() . '/css/ie.css', array( 'ckhero-style' ), '20121010' );
  $wp_styles->add_data( '_hero-ie', 'conditional', 'lt IE 9' );

  // If we are on localhost, please load the livereload script provided by grunt.js
  if(!(strpos($_SERVER['SERVER_NAME'], 'localhost') === false)){
     wp_enqueue_script( 'livereload', 'http://localhost:35729/livereload.js' );
  }

  if (is_page(styleguide))
    wp_enqueue_script( 'ck-styleguide', get_template_directory_uri() . '/styleguide/styleguide.js', array('jquery'), true );
}
add_action( 'wp_enqueue_scripts', '_hero_scripts_styles' );

	//Add Featured Image Support
	add_theme_support('post-thumbnails');

	// Clean up the <head>
	function removeHeadLinks() {
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wlwmanifest_link');
	}
	add_action('init', 'removeHeadLinks');
	
	remove_action('wp_head', 'wp_generator');

	function register_menus() {
		register_nav_menus(
			array(
				'main-nav' => 'Main Navigation',
				'secondary-nav' => 'Footer Navigation',
				// 'sidebar-menu' => 'Sidebar Menu'
			)
		);
	}
	add_action( 'init', 'register_menus' );

	function register_widgets(){

		register_sidebar( array(
			'name' => __( 'Sidebar' ),
			'id' => 'main-sidebar',
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
}
add_action( 'widgets_init', 'register_widgets' );

if ( ! function_exists( '_hero_entry_meta' ) ) :

  //Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
function _hero_entry_meta() {
  // Translators: used between list items, there is a space after the comma.
  $categories_list = get_the_category_list( __( ', ', '_hero' ) );

  // Translators: used between list items, there is a space after the comma.
  $tag_list = get_the_tag_list( '', __( ', ', '_hero' ) );

  $date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
    esc_url( get_permalink() ),
    esc_attr( get_the_time() ),
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() )
  );
  $author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
    esc_attr( sprintf( __( 'View all posts by %s', '_hero' ), get_the_author() ) ),
    get_the_author()
  );

  // Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
  if ( $tag_list ) {
    $utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', '_hero' );
  } elseif ( $categories_list ) {
    $utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', '_hero' );
  } else {
    $utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', '_hero' );
  }

  printf(
    $utility_text,
    $categories_list,
    $tag_list,
    $date,
    $author
  );
}
endif;