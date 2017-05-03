<?php
/**
 * thunderbear functions and definitions
 *
 * @package thunderbear
 */

/**
 * Constants and important files
 */
define( 'THUNDERBEAR_NAME', 'ThunderBear Design' );
define( 'THUNDERBEAR_AUTHOR', 'ThunderBear Design Team' );
define( 'THUNDERBEAR_VERSION', '1.3.0' );
define( 'THUNDERBEAR_HOME', 'https://thunderbeardesign.com/downloads/thor-thunderbear' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'thunderbear_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function thunderbear_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on thunderbear, use a find and replace
	 * to change 'thunderbear' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'thunderbear', get_template_directory() . '/languages' );

	// Add theme support title tag.
	add_theme_support( 'title-tag' );

	// Add editor stylesheet
	add_editor_style( $stylesheet = 'editor-style.css' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'thunderbear' ),
		'footer' => __( 'Footer Menu', 'thunderbear' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'thunderbear_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	// Add Support for Aesop Story Telling
//	add_theme_support("aesop-component-styles", array("parallax", "image", "quote", "gallery", "content", "video", "audio", "collection", "chapter", "document", "character", "map", "timeline" ) );
}
endif; // thunderbear_setup
add_action( 'after_setup_theme', 'thunderbear_setup' );


// Show posts of 'post', 'page' and 'productdocuentation' post types on home page
function search_filter( $query ) {
  if ( !is_admin() && $query->is_main_query() ) {
    if ( $query->is_search ) {
      $query->set( 'post_type', array( 'post', 'page', 'productdocumentation' ) );
    }
  }
}
 
add_action( 'pre_get_posts','search_filter' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function thunderbear_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'thunderbear' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Extra Sidebar', 'thunderbear' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'thunderbear_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function thunderbear_scripts() {
	wp_enqueue_style( 'thunderbear-style', get_stylesheet_uri() );

	wp_enqueue_script( 'thunderbear-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'thunderbear-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'thunderbear_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

// Register Custom Navigation Walker
require_once('wp-bootstrap-navwalker.php');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Woocommerce compatibility file.
 */
require get_template_directory() . '/inc/woocommerce.php';

/**
 * Admin page
 */
//function thunderbear_updater() {
//	require( get_template_directory() . '/inc/admin/updater/theme-updater.php' );
//}
//add_action( 'after_setup_theme', 'thunderbear_updater' );

/**
 * Custom conditional tags
 */
require get_template_directory() . '/inc/conditional-tags.php';

/**
 * Custom EDD functions
 *
 * Only require if Easy Digital Downloads is activated
 */
if ( thunderbear_edd_is_activated() ) {
	require get_template_directory() . '/inc/edd-functions.php';
}

/**
 * Custom FES for EDD functions
 *
 * Only require if Frontend Submissions for Easy Digital Downloads is activated
 */
if ( thunderbear_fes_is_activated() ) {
	require get_template_directory() . '/inc/fes-functions.php';
}

/**
 * Thunderbear's widgets
 */
if ( thunderbear_edd_is_activated() ) {
	require get_template_directory() . '/inc/admin/widgets.php';
}

function prefix_theme_updater() {
	require( get_template_directory() . '/updater/theme-updater.php' );
}
add_action( 'after_setup_theme', 'prefix_theme_updater' );

/**
 * Replaces the excerpt "more" text by a link.
 */
function new_excerpt_more($more) {
    global $post;
	return '... <a class="moretag" href="'. get_permalink($post->ID) . '"> continue reading &raquo;</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');