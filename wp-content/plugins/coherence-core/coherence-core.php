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
define('COHERENCE_CORE_LIB', COHERENCE_CORE_ROOT_PATH . '/lib');
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
