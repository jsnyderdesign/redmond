<?php
/**
 * redmond functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package redmond
 */

if ( ! function_exists( 'redmond_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function redmond_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on redmond, use a find and replace
	 * to change 'redmond' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'redmond', get_template_directory() . '/languages' );

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
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'redmond' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'redmond_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'redmond_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function redmond_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'redmond_content_width', 640 );
}
add_action( 'after_setup_theme', 'redmond_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function redmond_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'redmond' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'redmond' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'redmond_widgets_init' );

/** Adds portfolio custom post type **/
add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'portfolio',
    array(
      'labels' => array(
				'name' => __( 'Portfolio', 'Post Type General Name', 'textdomain' ),
				'singular_name' => __( 'Portfolio', 'Post Type Singular Name', 'textdomain' ),
				'menu_name' => __( 'Portfolio', 'textdomain' ),
				'name_admin_bar' => __( 'Portfolio', 'textdomain' ),
				'archives' => __( 'Portfolio Archives', 'textdomain' ),
				'attributes' => __( 'Portfolio Attributes', 'textdomain' ),
				'parent_item_colon' => __( 'Parent Portfolio:', 'textdomain' ),
				'all_items' => __( 'All Portfolio', 'textdomain' ),
				'add_new_item' => __( 'Add New Portfolio', 'textdomain' ),
				'add_new' => __( 'Add New', 'textdomain' ),
				'new_item' => __( 'New Portfolio', 'textdomain' ),
				'edit_item' => __( 'Edit Portfolio', 'textdomain' ),
				'update_item' => __( 'Update Portfolio', 'textdomain' ),
				'view_item' => __( 'View Portfolio', 'textdomain' ),
				'view_items' => __( 'View Portfolio', 'textdomain' ),
				'search_items' => __( 'Search Portfolio', 'textdomain' ),
				'not_found' => __( 'Not found', 'textdomain' ),
				'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
				'featured_image' => __( 'Featured Image', 'textdomain' ),
				'set_featured_image' => __( 'Set featured image', 'textdomain' ),
				'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
				'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
				'insert_into_item' => __( 'Insert into Portfolio', 'textdomain' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Portfolio', 'textdomain' ),
				'items_list' => __( 'Portfolio list', 'textdomain' ),
				'items_list_navigation' => __( 'Portfolio list navigation', 'textdomain' ),
				'filter_items_list' => __( 'Filter Portfolio list', 'textdomain' ),
      ),
			'label' => __( 'Portfolio', 'textdomain' ),
			'description' => __( '', 'textdomain' ),
			'labels' => $labels,
			'menu_icon' => '',
			'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'author', ),
			'taxonomies' => array(),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 5,
			'show_in_admin_bar' => true,
			'show_in_nav_menus' => true,
			'can_export' => true,
			'has_archive' => true,
			'hierarchical' => false,
			'exclude_from_search' => false,
			'show_in_rest' => true,
			'publicly_queryable' => true,
			'capability_type' => 'post',
    )
  );
	// Creates ability for users to submit their own custom taxonomy for the portfolio pieces.
	register_taxonomy(
		'Project Categories',
		array('portfolio'),
		array(
				'hierarchical' => true, 'label' => 'Project Categories', 'singular_label' => 'Project Category', 'rewrite' => true)
	);
}


/** Displays portfolio custom post types on the front-page.php **/
function portfolio( $atts = null, $content = null, $tag = null ) {

    $out = '';

    $args = array(
        'numberposts' => '6',
        'post_status' => 'publish',
        'post_type' => 'portfolio' ,
    );

    $recent = wp_get_recent_posts( $args );

    if ( $recent ) {

        $out .= '<section class="overview">';

        $out .= '<h4>Recent Projects</h4>';

        $out .= '<div class="overview">';

        foreach ( $recent as $item ) {

            $out .= '<a href="' . get_permalink( $item['ID'] ) . '">';
            $out .= get_the_post_thumbnail( $item['ID'] );
            $out .= '</a>';
        }

        $out .= '</div></section>';
    }

    if ( $tag ) {
        return $out;
    } else {
        echo $out;
    }

}
/** Adds ability to call function through shortcode **/
add_shortcode( 'recentposts', 'portfolio' );



/**
 * Enqueue scripts and styles.
 */
function redmond_scripts() {
	wp_enqueue_style( 'redmond-style', get_stylesheet_uri() );

	wp_enqueue_script( 'redmond-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'redmond-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'redmond_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
