<?php

/**
 * Thème Cohérence communication functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Thème_Cohérence_communication
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

define('COHERENCE_ROOT_PATH', get_template_directory());
define('COHERENCE_ROOT_URL', get_template_directory_uri());
define('COHERENCE_CSS', COHERENCE_ROOT_URL . '/assets/css');
define('COHERENCE_JS', COHERENCE_ROOT_URL . '/assets/js');
define('COHERENCE_INC', COHERENCE_ROOT_PATH . '/inc');
define('COHERENCE_THEME_OPTIONS', COHERENCE_INC . '/theme-options');
define('COHERENCE_THEME_STYLESHEETS', COHERENCE_INC . '/theme-stylesheets');
define('COHERENCE_THEME_OPTIONS_IMG', COHERENCE_ROOT_URL . '/inc/theme-options/img');





/**
 * define theme info
 * @since 1.0.0
 * */
if (is_child_theme()) {
	$coherence_theme        = wp_get_theme();
	$coherence_parent_theme = $coherence_theme->Template;
	$coherence_theme_info   = wp_get_theme($coherence_parent_theme);
} else {
	$coherence_theme_info = wp_get_theme();
}
define('COHERENCE_DEV_MODE', false);
$coherence_version = COHERENCE_DEV_MODE ? time() : $coherence_theme_info->get('Version');
define('COHERENCE_NAME', $coherence_theme_info->get('Name'));
define('COHERENCE_VERSION', $coherence_version);
define('COHERENCE_AUTHOR', $coherence_theme_info->get('Author'));
define('COHERENCE_AUTHOR_URI', $coherence_theme_info->get('AuthorURI'));


/*
* Include theme init file
* @since 1.0.0
*/
if (file_exists(COHERENCE_INC . '/class-coherence-init.php')) {
	require_once COHERENCE_INC . '/class-coherence-init.php';
}


/*
* template functions
* @since 1.0.0
*/
if (file_exists(COHERENCE_INC . '/template-functions.php')) {
	require_once COHERENCE_INC . '/template-functions.php';
}

/*
* template tags
* @since 1.0.0
*/
if (file_exists(COHERENCE_INC . '/template-tags.php')) {
	require_once COHERENCE_INC . '/template-tags.php';
}


/*
* Include theme options helper functions
* @since 1.0.0
*/
if (file_exists(COHERENCE_INC . '/get-theme-options.php')) {
	require_once COHERENCE_INC . '/get-theme-options.php';
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function coherence_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Thème Cohérence communication, use a find and replace
		* to change 'coherence' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('coherence', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'coherence'),
			'topmenu' => esc_html__('Top header menu', 'coherence'),
			'footermenu' => esc_html__('Menu footer', 'coherence'),
		)
	);

	//Enable support for Post Formats.
	//See http://codex.wordpress.org/Post_Formats
	add_theme_support('post-formats', array(
		'audio', 'gallery', 'link', 'quote', 'video'
	));


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
			'coherence_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

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
}
add_action('after_setup_theme', 'coherence_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function coherence_content_width()
{
	$GLOBALS['content_width'] = apply_filters('coherence_content_width', 640);
}
add_action('after_setup_theme', 'coherence_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function coherence_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'coherence'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'coherence'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'coherence_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function coherence_scripts()
{
	wp_enqueue_style('coherence-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('coherence-style', 'rtl', 'replace');

	wp_enqueue_script('coherence-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'coherence_scripts');

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
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}
