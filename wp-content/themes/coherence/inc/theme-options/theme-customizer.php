<?php

/*
 * Theme Customize Options
 * @package coherence
 * @since 1.0.0
 * */

if (!defined('ABSPATH')) {
	exit(); // exit if access directly
}

if (class_exists('CSF')) {
	$coherence_prefix = 'coherence';

	CSF::createCustomizeOptions($coherence_prefix . '_customize_options');

	/*-------------------------------------
		** Theme Main Color
	-------------------------------------*/
	CSF::createSection($coherence_prefix . '_customize_options', array(
		'title'    => esc_html__('Coherence Primary Color', 'coherence'),
		'priority' => 10,
		'fields'   => array(
			array(
				'id'      => 'main_color',
				'type'    => 'color',
				'title'   => esc_html__('Theme Main Color', 'coherence'),
				'default' => '#0060FF',
				'desc'    => esc_html__('This is theme primary color, means it\'ll affect most of elements that have default color of our theme primary color', 'coherence')
			),
		)
	));

	/*-------------------------------------
	  ** Theme Body Options
  -------------------------------------*/
	CSF::createSection($coherence_prefix . '_customize_options', array(
		'title'    => esc_html__('Coherence Main Body', 'coherence'),
		'priority' => 10,
		'fields'   => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Main Body Options', 'coherence') . '</h3>'
			),
			array(
				'id'          => 'header_color',
				'type'        => 'color',
				'title'       => esc_html__('All Header Color', 'coherence'),
				'default'     => '#201654',
				'output_mode' => 'color',
				'output'      => array('h1, h2, h3, h4, h5, h6'),
			),
			array(
				'id'          => 'txt_Color',
				'type'        => 'color',
				'title'       => esc_html__('Body Text Color', 'coherence'),
				'default'     => '#696969',
				'output_mode' => 'color',
				'output'      => array('p', '.single-blog-inner .single-blog-details p'),
			),
		)
	));
}//endif