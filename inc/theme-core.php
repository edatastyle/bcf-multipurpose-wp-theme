<?php
/**
 * Business Consultant Finder functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Business_Consultant_Finder
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'business_consultant_finder_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function business_consultant_finder_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Business Consultant Finder, use a find and replace
		 * to change 'business-consultant-finder' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'business-consultant-finder', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'business-consultant-finder' ),
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
		add_theme_support( 'custom-background', apply_filters( 'business_consultant_finder_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		/*
		* Enable support for Post Formats.
		* See https://developer.wordpress.org/themes/functionality/post-formats/
		*/
		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'gallery',
			'audio',
			'quote'
		) );
	}
endif;
add_action( 'after_setup_theme', 'business_consultant_finder_setup' );

/**
 * Registers an editor stylesheet for the theme.
 */
function business_consultant_finder_add_editor_styles() {
    add_editor_style( '//fonts.googleapis.com/css?family=K2D|Roboto+Condensed|Roboto' );
}
add_action( 'admin_init', 'business_consultant_finder_add_editor_styles' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function business_consultant_finder_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'business_consultant_finder_content_width', 640 );
}
add_action( 'after_setup_theme', 'business_consultant_finder_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function business_consultant_finder_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'business-consultant-finder' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'business-consultant-finder' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Header Right', 'business-consultant-finder' ),
		'id'            => 'logo-right',
		'description'   => esc_html__( 'Add widgets here.', 'business-consultant-finder' ),
		'before_widget' => '<div id="%1$s"  class="col-md-4 pd-10 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span>',
		'after_title'   => '</span>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'business-consultant-finder' ),
		'id'            => 'footer',
		'description'   => esc_html__( 'Add widgets here.', 'business-consultant-finder' ),
		'before_widget' => '<div id="%1$s" class="col-md-4 col-lg-4 col-sm-6 %2$s"><div class="widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Static Home Page', 'business-consultant-finder' ),
		'id'            => 'front_page_sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'business-consultant-finder' ),
		'before_widget' => '<div id="%1$s"  class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title screen-reader-text">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'business_consultant_finder_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function business_consultant_finder_scripts() {
	/* PLUGIN CSS */
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=K2D|Roboto+Condensed|Roboto&display=swap');
	wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/vendors/bootstrap/css/bootstrap.css' ), array(), '4.3.1' );
	wp_enqueue_style( 'font', get_theme_file_uri( '/vendors/fontawesome/css/regular.css' ), array(), '5.8.1' );
	wp_enqueue_style( 'font-awesome-5', get_theme_file_uri( '/vendors/fontawesome/css/all.css' ), array(), '5.8.1' );
	wp_enqueue_style( 'rd-navbar', get_theme_file_uri( '/vendors/rd-navbar/rd-navbar.css' ), array(), '2.2.5' );
	wp_enqueue_style( 'owl-carousel', get_theme_file_uri( '/vendors/owlcarousel/assets/owl.carousel.css' ), array(), '2.3.4' );
	wp_enqueue_style( 'magnific-popup', get_theme_file_uri( '/vendors/magnific-popup/magnific-popup.css' ), array(), '1.1.0' );
	
	
	wp_enqueue_style( 'business-consultant-finder-style', get_stylesheet_uri() );
	wp_enqueue_style( 'business-consultant-finder-color-scheme', get_theme_file_uri( '/assets/color-scheme.css' ) );	
		
	wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/vendors/bootstrap/js/bootstrap.js' ), 0, '4.3.1', true );
	wp_enqueue_script( 'toTop', get_theme_file_uri( '/vendors/jquery.toTop.js' ), 0, '1.1', true );
	wp_enqueue_script( 'rd-navbar', get_theme_file_uri( '/vendors/rd-navbar/jquery.rd-navbar.js' ), 0, '', true );
	wp_enqueue_script( 'owl-carousel', get_theme_file_uri( '/vendors/owlcarousel/owl.carousel.js' ), 0, '2.3.4', true );
	wp_enqueue_script( 'magnific-popup', get_theme_file_uri( '/vendors/magnific-popup/magnific-popup.js' ), 0, '1.1.0', true );
	wp_enqueue_script( 'skrollr', get_theme_file_uri( '/vendors/skrollr/skrollr.js' ), 0, '1.1.0', true );
	
	//owl-carousel.css
	wp_enqueue_script( 'business-consultant-finder-js', get_theme_file_uri( '/assets/business-consultant-finder.js'), array('jquery','masonry','imagesloaded'), '1.0.0', true);
	
		
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'business_consultant_finder_scripts' );