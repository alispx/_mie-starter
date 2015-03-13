<?php
/**
 * _ib functions and definitions
 *
 * @package _mie
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 750; /* pixels */

if ( ! function_exists( '_mie_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function _mie_setup() {
	global $cap, $content_width;

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	if ( function_exists( 'add_theme_support' ) ) {

		/**
		 * Add default posts and comments RSS feed links to head
		*/
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails on posts and pages
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		*/
		add_theme_support( 'post-thumbnails' );

		/**
		 * Enable support for Post Formats
		*/
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	}

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on _ib, use a find and replace
	 * to change '_mie' to the name of your theme in all the template files
	*/
	load_theme_textdomain( '_mie', get_template_directory() . '/languages' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menus( array(
		'primary'  => __( 'Header bottom menu', '_mie' ),
	) );

	add_theme_support( "title-tag" );
}
endif; // _mie_setup
add_action( 'after_setup_theme', '_mie_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function _mie_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', '_mie' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', '_mie_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function _mie_scripts() {

	// load bootstrap css
	wp_enqueue_style( '_mie-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
        
         wp_enqueue_style( '_mie-fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css' , array(), '4.0.3', 'all' );

	// load _ib styles
	wp_enqueue_style( '_mie-style', get_stylesheet_uri() );

	// load bootstrap js
	wp_enqueue_script('_mie-bootstrapjs', get_template_directory_uri().'/assets/js/bootstrap.js', array('jquery') );

	// load bootstrap wp js
	wp_enqueue_script( '_mie-bootstrapwp', get_template_directory_uri() . '/assets/js/bootstrap-wp.js', array('jquery') );

	wp_enqueue_script( '_mie-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( '_mie-keyboard-image-navigation', get_template_directory_uri() . '/assets/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', '_mie_scripts' );

define( 'MIE_DIR', trailingslashit( get_template_directory() . '/customizer' ) );
define( 'MIE_URI', trailingslashit( get_template_directory_uri() . '/customizer' ) );
require_once( get_template_directory() . '/customizer/mie-customizer.php' );
require_once( get_template_directory() . '/customizer/customizer-data.php' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/includes/bootstrap-wp-navwalker.php';



