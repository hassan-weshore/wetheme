<?php

/**
 * @package coherence Core
 * @version 1.0.0
 */
/*
Plugin Name: Cohérence Core Helper
Plugin URI:
Description: Les extentions associées au theme pour la bonne fonctionnement
Author: weshore
Version: 1.0.0
Author URI:https://weshore.com/
*/
/**  Related Theme Type */

global $related_theme_type;
$related_theme_type = array('COHERENCE', 'COHERENCE Child');
//define current theme name
$current_theme = !empty(wp_get_theme()) ? wp_get_theme()->get('Name') : '';
define('CURRENT_THEME_NAME', $current_theme);


/*
 * Define Plugin Dir Path
 * @since 1.0.0
 * */
define('COHERENCE_CORE_SELF_PATH', 'coherence-core/coherence-core.php');
define('COHERENCE_CORE_ROOT_PATH', plugin_dir_path(__FILE__));
define('COHERENCE_CORE_ROOT_URL', plugin_dir_url(__FILE__));
define('COHERENCE_CORE_LIB', COHERENCE_CORE_ROOT_PATH . 'lib');
define('COHERENCE_CORE_INC', COHERENCE_CORE_ROOT_PATH . 'inc');
define('COHERENCE_CORE_ADMIN', COHERENCE_CORE_INC . '/admin');
define('COHERENCE_CORE_ADMIN_ASSETS', COHERENCE_CORE_ROOT_URL . 'inc/admin/assets');
define('COHERENCE_CORE_CSS', COHERENCE_CORE_ROOT_URL . 'assets/css');
define('COHERENCE_CORE_IMG', COHERENCE_CORE_ROOT_URL . 'assets/img');
define('COHERENCE_CORE_JS', COHERENCE_CORE_ROOT_URL . 'assets/js');
define('COHERENCE_CORE_ELEMENTOR', COHERENCE_CORE_INC . '/elementor');
define('COHERENCE_CORE_SHORTCODES', COHERENCE_CORE_INC . '/shortcodes');
define('COHERENCE_CORE_WIDGETS', COHERENCE_CORE_INC . '/widgets');

/** Plugin version **/
define('COHERENCE_CORE_VERSION', '1.0.0');


//plugin core file include
if (file_exists(COHERENCE_CORE_INC . '/class-coherence-core-init.php')) {
	require_once COHERENCE_CORE_INC . '/class-coherence-core-init.php';
}


/**
 * Load plugin textdomain.
 */
add_action('plugins_loaded', 'coherences_core_language');
if (!function_exists('coherences_core_language')) {

	function coherences_core_language()
	{
		load_plugin_textdomain('coherence-core', false, plugin_basename(dirname(__FILE__)) . '/language');
	}
}

register_activation_hook(__FILE__, 'register_activation_coherence_core');

function register_activation_coherence_core() {
	add_option( 'activated-coherence-core', 'coherence-core' );
}

function load_plugin() {
    if ( is_admin() && get_option( 'activated-coherence-core' ) == 'coherence-core' ) {
	   $kit_active_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
	   $settings = get_post_meta( $kit_active_id, '_elementor_page_settings', true );
   
	   $default_breakpoints = [
	   	'active_breakpoints' => 
	   	[
	   		'viewport_mobile',
	   		'viewport_mobile_extra',
	   		'viewport_tablet',
	   		'viewport_tablet_extra',
	   		'viewport_laptop',
	   		'viewport_widescreen',
	   	],
	   	'viewport_md' => 601,
	   	'viewport_lg' => 1025,
	   	'viewport_mobile' => 600,
	   	'viewport_mobile_extra' => 800,
	   	'viewport_tablet' => 1024,
	   	'viewport_tablet_extra' => 1360,
	   	'viewport_laptop' => 1500,
	   	'viewport_widescreen' => 1920,
	   ];
   
	   $settings = array_merge($settings,$default_breakpoints);
	   update_post_meta($kit_active_id, '_elementor_page_settings' , $settings);

	   delete_option( 'activated-coherence-core' );
    }
}

add_action( 'admin_init', 'load_plugin' );