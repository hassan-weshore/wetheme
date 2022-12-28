<?php

/**
 *
 * Get option
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if (!function_exists('coherence_get_option')) {
	function coherence_get_option($option = '', $default = null)
	{
		$options = get_option('coherence_theme_options'); // Attention: Set your unique id of the framework

		return (isset($options[$option])) ? $options[$option] : $default;
	}
}


if (!function_exists('coherence_switcher_option')) {

	function coherence_switcher_option($option = '', $default = null)
	{
		$options    = get_option('coherence_theme_options'); // Attention: Set your unique id of the framework
		$return_val = (isset($options[$option])) ? $options[$option] : $default;
		$return_val = ('1' == $return_val) ? true : false;

		return $return_val;
	}
}

/**
 *
 * Get customize option
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */


if (!function_exists('coherence_get_customize_option')) {

	function coherence_get_customize_option($option = '', $default = null)
	{
		$options = get_option('coherence_customize_options'); // Attention: Set your unique id of the framework

		return (isset($options[$option])) ? $options[$option] : $default;
	}
}
