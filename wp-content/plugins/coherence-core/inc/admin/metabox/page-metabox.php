<?php
/*
 * Theme Metabox Options
 * @package coherence
 * @since 1.0.0
 * */

if (!defined('ABSPATH')) {
	exit(); // exit if access directly
}

if (class_exists('CSF')) {


	$coherence_prefix = 'coherence';


	/*-------------------------------------
	   Page Options
   -------------------------------------*/
	$coherence_group_meta = 'coherence_page_meta';

	CSF::createMetabox($coherence_group_meta, array(
		'title'     => esc_html__('Page Options', 'coherence'),
		'post_type' =>  array('page'),
	));
	//
	// Create a section
	CSF::createSection($coherence_group_meta, array(
		'title'  => esc_html__('Header Option', 'coherence'),
		'fields' => array(
			array(
				'id'         => 'enable_header_builder',
				'title'      => esc_html__('Enable Header Builder', 'coherence'),
				'type'       => 'switcher',
				'desc'       => esc_html__('You can set Yes / No to use header builder', 'coherence'),
				'default'    => false,
			),
			array(
				'id'          => 'header-builder-id',
				'type'        => 'select',
				'title'       => esc_html__('Select Header', 'coherence'),
				'placeholder' => esc_html__('Select a Header', 'coherence'),
				'options'     => coherence_get_header_builder_library(),
				'dependency'  => array('enable_header_builder', '==', true),
				'desc'        => esc_html__("You need to create first header from header builder", 'coherence')
			),
		)
	));

	//
	// breadcrumb
	CSF::createSection($coherence_group_meta, array(
		'title'  => esc_html__('Title bar', 'coherence'),
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => esc_html__('Title Bar', 'coherence'),
			),
			array(
				'id'      => $coherence_prefix . '_breadcrumb',
				'title'   => esc_html__('Titla bar', 'coherence'),
				'type'    => 'select',
				'options' => array(
					'show' => esc_html__('Show', 'coherence'),
					'hide' => esc_html__('Hide', 'coherence'),
				),
				'default' => 'show'
			),
		)

	));

	// Create a section
	CSF::createSection($coherence_group_meta, array(
		'title'  => esc_html__('Footer Option', 'coherence'),
		'fields' => array(
			array(
				'id'         => 'enable_footer_builder',
				'title'      => esc_html__('Enable Footer Builder', 'coherence'),
				'type'       => 'switcher',
				'desc'       => esc_html__('You can set Yes / No to use footer builder', 'coherence'),
				'default'    => false,
			),
			array(
				'id'          => 'footer-builder-id',
				'type'        => 'select',
				'title'       => esc_html__('Select Footer', 'coherence'),
				'placeholder' => esc_html__('Select a Footer', 'coherence'),
				'options'     => coherence_get_footer_builder_library(),
				'desc'        => esc_html__("You need to create first footer from footer builder", 'coherence'),
				'dependency'  => array('enable_footer_builder', '==', true)
			),
		)
	));

	$coherence_footer_meta = 'coherence_footer_meta';

	/*-------------------------------------
	   Footer Options
   -------------------------------------*/
	CSF::createMetabox($coherence_footer_meta, array(
		'title'     => esc_html__('Footer Options', 'coherence'),
		'post_type' => array('project', 'service', 'team')
	));


	// Create a section
	CSF::createSection($coherence_footer_meta, array(
		'title'  => esc_html__('Footer Option', 'coherence'),
		'fields' => array(
			array(
				'id'         => 'enable_footer_builder',
				'title'      => esc_html__('Enable Footer Builder', 'coherence'),
				'type'       => 'switcher',
				'desc'       => esc_html__('You can set Yes / No to use footer builder', 'coherence'),
				'default'    => false,
			),
			array(
				'id'          => 'footer-builder-id',
				'type'        => 'select',
				'title'       => esc_html__('Select Footer', 'coherence'),
				'placeholder' => esc_html__('Select a Footer', 'coherence'),
				'options'     => coherence_get_footer_builder_library(),
				'desc'        => esc_html__("You need to create first footer from footer builder", 'coherence'),
				'dependency'  => array('enable_footer_builder', '==', true)
			),
		)
	));
}//endif