<?php
/**
 * WayUP functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WayUP
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.1' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wayup_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on WayUP, use a find and replace
		* to change 'wayup' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'wayup', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-header' => esc_html__( 'Header Navigation', 'wayup' ),
			'menu-footer-1' => esc_html__( 'Footer Navigation 1', 'wayup' ),
			'menu-footer-2' => esc_html__( 'Footer Navigation 2', 'wayup' ),


		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'wayup_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);


  add_image_size('testimonial-thumb', 225, 131, true);

}
add_action( 'after_setup_theme', 'wayup_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wayup_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wayup_content_width', 640 );
}
add_action( 'after_setup_theme', 'wayup_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wayup_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wayup' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wayup' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wayup_widgets_init' );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

require get_template_directory() . '/inc/options-panel-redux.php';
require get_template_directory() . '/inc/breadcrums.php';
require get_template_directory() . '/inc/metaboxes.php';

//========================================================================================================================================================


/**
 * Enqueue scripts and styles.
 */
function wayup_scripts() {
	wp_enqueue_style( 'wayup-style', get_stylesheet_uri() );
	wp_enqueue_style( 'wayup-vendor', get_template_directory_uri().'/assets/css/vendor.min.css', array(), _S_VERSION );	
	wp_enqueue_style( 'wayup-main', get_template_directory_uri().'/assets/css/main.min.css', array(), _S_VERSION );

  wp_style_add_data( 'wayup-style', 'rtl', 'replace' );

	wp_enqueue_script( 'jquery3.1.1', 'http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js');
	wp_enqueue_script( 'goodshare', 'https://cdn.jsdelivr.net/npm/goodshare.js@4/goodshare.min.js', array(), '', true);

	wp_enqueue_script( 'wayup-vendor', get_template_directory_uri() . '/assets/js/vendor.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'wayup-common', get_template_directory_uri() . '/assets/js/common.min.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'wayup-svg-sprite', get_template_directory_uri() . '/assets/img/svg-sprite/svg-sprite.js', array(), '1.0', false );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wayup_scripts' );

//========================================================================================================================================================

function wayap_admin_scripts($hook) {
	
	// Add scripts for metaboxes
  	if ( $hook == 'post.php' || $hook == 'post-new.php' || $hook == 'page-new.php' || $hook == 'page.php' ) {
		wp_enqueue_script( 'aletheme_metaboxes', get_template_directory_uri() . '/assets/js/metaboxes.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'media-upload', 'thickbox') );
  	}
	
}
add_action( 'admin_enqueue_scripts', 'wayap_admin_scripts', 10 );


//========================================================================================================================================================

add_filter('body_class', 'wayup_body_class');
function wayup_body_class( $classes) {
  if (is_page_template('template-home.php')){
    $classes[]='is-home';
  }else{
    $classes[]='inner-page';
  }
  return $classes;
}

//========================================================================================================================================================

function wayup_register_custom_post_type() {
   
  register_post_type( 'testimonial', array(
    'labels'             => array(
      'name'                  => _x( 'Reviews', 'Post type general name', 'wayup' ),
      'singular_name'         => _x( 'Review', 'Post type singular name', 'wayup' ),
      'add_new'               => __( 'Add New', 'wayup' ),
  ),
    'description'        => 'Recipe custom post type.',
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'testimonials' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => 20,
    'menu_icon'          => 'dashicons-testimonial',
    'supports'           => array( 'title', 'editor', 'thumbnail' ),
    'taxonomies'         => array( 'category', 'post_tag' ),
    'show_in_rest'       => true,
) );
register_post_type( 'service', array(
  'labels'             => array(
    'name'                  => _x( 'Services', 'Post type general name', 'wayup' ),
    'singular_name'         => _x( 'Service', 'Post type singular name', 'wayup' ),
    'add_new'               => __( 'Add New', 'wayup' ),
),
  'description'        => 'Recipe custom post type.',
  'public'             => true,
  'publicly_queryable' => true,
  'show_ui'            => true,
  'show_in_menu'       => true,
  'query_var'          => true,
  'rewrite'            => array( 'slug' => 'services' ),
  'capability_type'    => 'post',
  'has_archive'        => true,
  'hierarchical'       => false,
  'menu_position'      => 20,
  'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
  'taxonomies'         => array( 'category', 'post_tag' ),
  'show_in_rest'       => true,
  'menu_icon'          => 'dashicons-megaphone',

) );
register_post_type( 'news', array(
  'labels'             => array(
    'name'                  => _x( 'News', 'Post type general name', 'wayup' ),
    'singular_name'         => _x( 'News', 'Post type singular name', 'wayup' ),
    'add_new'               => __( 'Add New', 'wayup' ),
),
  'description'        => 'Recipe custom post type.',
  'public'             => true,
  'publicly_queryable' => true,
  'show_ui'            => true,
  'show_in_menu'       => true,
  'query_var'          => true,
  'rewrite'            => array( 'slug' => 'news' ),
  'capability_type'    => 'post',
  'has_archive'        => true,
  'hierarchical'       => false,
  'menu_position'      => 20,
  'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
  'taxonomies'         => array( 'category', 'post_tag' ),
  'show_in_rest'       => true,
  'menu_icon'          => 'dashicons-format-aside',
) );
register_post_type( 'feature', array(
  'labels'             => array(
    'name'                  => _x( 'Cases', 'Post type general name', 'wayup' ),
    'singular_name'         => _x( 'Case', 'Post type singular name', 'wayup' ),
    'add_new'               => __( 'Add New', 'wayup' ),
),
  'description'        => 'Recipe custom post type.',
  'public'             => true,
  'publicly_queryable' => true,
  'show_ui'            => true,
  'show_in_menu'       => true,
  'query_var'          => true,
  'rewrite'            => array( 'slug' => 'feature' ),
  'capability_type'    => 'post',
  'has_archive'        => true,
  'hierarchical'       => false,
  'menu_position'      => 20,
  'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
  'taxonomies'         => array( 'category', 'post_tag' ),
  'show_in_rest'       => true,
  'menu_icon'          => 'dashicons-saved',
) );

}
add_action( 'init', 'wayup_register_custom_post_type' );

function aletheme_metaboxes($meta_boxes) {
	
	$meta_boxes = array();

    $prefix = "wayup_";

    $meta_boxes[] = array(
        'id'         => 'testimonial_metaboxes',
        'title'      => 'Data for rewiev',
        'pages'      => array( 'testimonial', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'page-template', 'value' => array('template-press.php'), ), // Specific post templates to display this metabox
        'fields' => array(
            array(
                'name' => 'Social link',
                'desc' => 'Insert the Social link',
                'id'   => $prefix . 'social_link',
                'type' => 'text',
            ),
            array(
              'name' => 'Date',
              'desc' => 'Pick the Date',
              'id'   => $prefix . 'tasty_date',
              'type' => 'text_date',
          ),
        )
    );
// 6 lesson end

	return $meta_boxes;
}