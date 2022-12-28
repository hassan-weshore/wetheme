<?php
// Control core classes for avoid errors
if (class_exists('CSF')) {
	$coherence_allowed_html = 'coherence_core_allowed_tags';

	//
	// Set a unique slug-like ID
	$coherence_prefix = 'coherence';

	//
	// Create options
	CSF::createOptions($coherence_prefix . '_theme_options', array(
		'menu_title'      => 'Theme Option',
		'menu_slug'       => 'coherence-theme-option',
		'menu_type'       => 'submenu',
		'enqueue_webfont' => true,
		'show_footer'     => true,
		'show_in_customizer'      => false,
		'footer_text'             => 'Merci WeTheme',
		'footer_after'            => '',
		'footer_credit'           => 'Copyright Weshore communication',
		'framework_title' => COHERENCE_NAME . ' <small>V- ' . esc_html(COHERENCE_VERSION) . esc_html__(' Par ', 'coherence') . '<a href="' . esc_url(COHERENCE_AUTHOR_URI) . '" target="_blank">' . COHERENCE_AUTHOR . '</a> </small>',
	));

	//
	// Create a section
	CSF::createSection($coherence_prefix . '_theme_options', array(
		'title'  => 'General',
		'icon'   => 'fa fa-wrench',
		'fields' => array(

			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Preloader Options', 'coherence') . '</h3>'
			),
			array(
				'id'      => 'preloader_enable',
				'title'   => esc_html__('Preloader', 'coherence'),
				'type'    => 'switcher',
				'desc'    => esc_html__('you can set Yes / No to enable/disable preloader', 'coherence'),
				'default' => true,
			),
			array(
				'id'      => 'preloader_color',
				'title'   => esc_html__('Preloader  color', 'coherence'),
				'type'    => 'color',
				'desc'    => esc_html__('you can set tbe  color for preloader', 'coherence'),

				'dependency'  => array('preloader_enable', '==', true),
			),
			array(
				'id'      => 'preloader_background',
				'title'   => esc_html__('Preloader Background color', 'coherence'),
				'type'    => 'color',
				'desc'    => esc_html__('you can set the background color for preloader', 'coherence'),
				'dependency'  => array('preloader_enable', '==', true),
			),
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Back Top Options', 'coherence') . '</h3>'
			),
			array(
				'id'      => 'back_top_enable',
				'title'   => esc_html__('Back Top', 'coherence'),
				'type'    => 'switcher',
				'desc'    => esc_html__('you can set Yes / No to show/hide back to top', 'coherence'),
				'default' => true,
			),
			array(
				'id'      => 'back_top_background',
				'title'   => esc_html__('Back Top Background color', 'coherence'),
				'type'    => 'color',
				'desc'    => esc_html__('you can set the background color for Back Top', 'coherence'),
				'dependency'  => array('back_top_enable', '==', true),
			),
			array(
				'id'      => 'back_top_color',
				'title'   => esc_html__('Back Top  color', 'coherence'),
				'type'    => 'color',
				'desc'    => esc_html__('you can set the color for Back Top', 'coherence'),
				'dependency'  => array('back_top_enable', '==', true),
			),
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('General informations', 'coherence') . '</h3>'
			),
			array(
				'id'         => 'header_number',
				'title'      => esc_html__('Phone Number For Contact Info', 'coherence'),
				'type'       => 'text',
				'desc'       => esc_html__('This content will display if you have "Contact Info" selected for the Header Content 1 or 2 option above.', 'coherence'),
				//'dependency'  => array('enable_header_builder', '==', false),
				'placeholder'  => 'Call Us Today! 1.555.555'
			),
			array(
				'id'         => 'header_email',
				'title'      => esc_html__('Email Address For Contact Info', 'coherence'),
				'type'       => 'text',
				'desc'       => esc_html__('This content will display if you have "Contact Info" selected for the Header Content 1 or 2 option above.', 'coherence'),
				//'dependency'  => array('enable_header_builder', '==', false),
				'default'  => get_bloginfo('admin_email'),
			),
			array(
				'id'         => 'telephone_1',
				'title'      => esc_html__('Numero de Tél 1', 'coherence'),
				'type'       => 'text',
				'subtitle'       => esc_html__('Tshortcode [phoneNumber1] OU CSS class "phoneNumber1"', 'coherence'),
				//'dependency'  => array('enable_header_builder', '==', false),
				'placeholder'  => 'Call Us Today! 1.555.555.555'
			),
			array(
				'id'         => 'telephone_2',
				'title'      => esc_html__('Numero de Tél 2', 'coherence'),
				'type'       => 'text',
				'desc'       => esc_html__('Tshortcode [phoneNumber2] OU CSS class "phoneNumber2"', 'coherence'),
				//'dependency'  => array('enable_header_builder', '==', false),
				'placeholder'  => 'Call Us Today! 1.555.555'
			),
			array(
				'id'         => 'Adresse_physique',
				'title'      => esc_html__('Adresse Physique', 'coherence'),
				'type'       => 'text',
				//'desc'       => esc_html__('shortcode [AdressePhysique] OU CSS class "AdressePhysique"', 'coherence'),
				//'dependency'  => array('enable_header_builder', '==', false),

			),
			array(
				'id'         => 'Horaire_travail',
				'title'      => esc_html__('Horaire Travail', 'coherence'),
				'type'       => 'textarea',
				//'desc'       => esc_html__('shortcode [HoraireTravail] OU CSS class "HoraireTravail"', 'coherence'),
				//'dependency'  => array('enable_header_builder', '==', false),

			),
			array(
				'id'         => 'Map_iframe',
				'title'      => esc_html__('Map Iframe', 'coherence'),
				'type'       => 'textarea',
				//	'desc'       => esc_html__('shortcode [MapIframe] OU CSS class "MapIframe"', 'coherence'),
				//'dependency'  => array('enable_header_builder', '==', false),

			),
		)
	));

	// Create a section for Layout options
	CSF::createSection($coherence_prefix . '_theme_options', array(
		'title'  => 'Layout',
		'icon'   => 'fa fa-wrench',
		'fields' => array(

			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Layout Options', 'coherence') . '</h3>'
			),
			array(
				'id'      => 'layout',
				'title'   => esc_html__('Layout', 'coherence'),
				'type'    => 'radio',
				'subtitle'    => esc_html__('Controls the site layout.', 'coherence'),
				'options'    => array(
					'boxed' => 'Boxed',
					'wide' => 'Wide',
				),
				'default'    => 'wide'
			),
			array(
				'id'      => 'site_width',
				'title'   => esc_html__('Site Width', 'coherence'),
				'type'    => 'dimensions',
				'subtitle'    => esc_html__('Controls the overall site width. Enter value including any valid CSS unit, ex: 1200px.'),
				'height' => false,
				'show_units' => true,
				'dependency'  => array('layout', '==', 'boxed'),
				'default'  => array(
					'width'  => '1200',
					'unit'   => 'px',
				),
			),
			array(
				'id'    => 'bg_image',
				'icon'  => 'fa fa-header',
				'title'   => esc_html__('Background Image For Page', 'coherence'),
				'subtitle'    => esc_html__('Select an image to use for a full page background.', 'coherence'),
				'type'    => 'background',
				'dependency'  => array('layout', '==', 'boxed'),
			),
			array(
				'id'    => 'content_background_color',
				'type'  => 'background',
				'title' => esc_html__('Content background Color', 'coherence'),
				'subtitle' => esc_html__('Controls the background color of the content area. ', 'coherence'),
				//'dependency'  => array('layout', '==', 'boxed'),
			),

			array(
				'id'      => 'content_width',
				'title'   => esc_html__('Content Width', 'coherence'),
				'type'    => 'dimensions',
				'subtitle'    => esc_html__('Controls the overall content width. Enter value including any valid CSS unit, ex: 1200px.'),
				'height' => false,
				'show_units' => false,
				'dependency'  => array('layout', '==', 'wide'),
				'default'  => array(
					'width'  => '1140',
					'unit'   => 'px',
				),
			),

		)
	));

	// Create a section for Resposive options
	CSF::createSection($coherence_prefix . '_theme_options', array(
		'title'  => 'Responsive',
		'icon'   => 'fa fa-wrench',
		'fields' => array(

			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Responsive Options', 'coherence') . '</h3>'
			),
			array(
				'id'      => 'responsive',
				'title'   => esc_html__('Responsive Design', 'coherence'),
				'type'    => 'switcher',
				'subtitle'    => esc_html__('Turn on to use the responsive design features. If set to off, the fixed layout is used.', 'coherence'),
				'text_on'  => 'Yes',
				'text_off' => 'No',
				'default'    => true,
			),
			array(
				'id'      => 'grid_main_break_point',
				'title'   => esc_html__('Grid Responsive Breakpoint', 'coherence'),
				'type'    => 'slider',
				'subtitle'    => esc_html__('Controls when grid layouts (blog/portfolio) start to break into smaller columns. Further breakpoints are auto calculated. In pixels.'),
				'default' => 1000,
				'step'    => 1,
				'unit'    => 'px',
				'max' => 2000,
				'dependency'  => array('responsive', '==', true),
			),
			array(
				'id'      => 'side_header_break_point',
				'title'   => esc_html__('Header Responsive Breakpoint', 'coherence'),
				'type'    => 'slider',
				'subtitle'    => esc_html__('Controls when the desktop header changes to the mobile header. In pixels.'),
				'default' => 800,
				'step'    => 1,
				'unit'    => 'px',
				'min' => 768,
				'max' => 991,
				'dependency'  => array('responsive', '==', true),
			),
			array(
				'id'      => 'content_break_point',
				'title'   => esc_html__('Site Content Responsive Breakpoint', 'coherence'),
				'type'    => 'slider',
				'subtitle'    => esc_html__('Controls when the site content area changes to the mobile layout. This includes all content below the header including the footer. In pixels.'),
				'default' => 800,
				'step'    => 1,
				'unit'    => 'px',
				'max' => 2000,
				'dependency'  => array('responsive', '==', true),
			),
			array(
				'id'      => 'sidebar_break_point',
				'title'   => esc_html__('Sidebar Responsive Breakpoint', 'coherence'),
				'type'    => 'slider',
				'subtitle'    => esc_html__('Controls when sidebars change to the mobile layout. In pixels.'),
				'default' => 800,
				'step'    => 1,
				'unit'    => 'px',
				'max' => 2000,
				'dependency'  => array('responsive', '==', true),
			),
			array(
				'id'      => 'mobilezoom',
				'title'   => esc_html__('Mobile Device Zoom', 'coherence'),
				'type'    => 'switcher',
				'subtitle'    => esc_html__('Turn on to enable pinch to zoom on mobile devices.', 'coherence'),
				'text_on'  => 'On',
				'text_off' => 'Off',
				'default'    => true,
				'dependency'  => array('responsive', '==', true),
			),

		)
	));


	/*-------------------------------------------------------
	   ** Entire Site Header  Options
	 --------------------------------------------------------*/
	CSF::createSection(
		$coherence_prefix . '_theme_options',
		array(
			'title' => esc_html__('Header Option', 'coherence'),
			'id'    => 'entire_site_header_options',
			'icon'  => 'fa fa-header'
		)
	);
	CSF::createSection($coherence_prefix . '_theme_options', array(
		'title'  => esc_html__('Header Content', 'coherence'),
		'id'     => 'logo_options',
		'icon'   => 'fa fa-ellipsis-h',
		'parent' => 'entire_site_header_options',
		'fields' => array(
			array(
				'id'         => 'show_top_bar',
				'title'      => esc_html__('Enable Top Bar', 'coherence'),
				'type'       => 'switcher',
				'desc'       => esc_html__('You can set Yes / No to show or hide top bar', 'coherence'),
				'default'    => true,
			),
			/*array(
				'id'         => 'header_position',
				'title'      => esc_html__('Header Position', 'coherence'),
				'type'       => 'button_set',
				'desc'       => esc_html__('Controls the position of the header to be in the top, left or right of the site. The main menu height, header padding and logo margin options will auto adjust based off your selection for ideal aesthetics.', 'coherence'),
				'options'  => array(
					'top'   => esc_html__('Top', 'coherence'),
					'left'   => esc_html__('Left', 'coherence'),
					'right' => esc_html__('Right', 'coherence'),
				),
				'default'  => 'top'
			),*/
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

			array(
				'id'         => 'slider_position',
				'title'      => esc_html__('Slider Position', 'coherence'),
				'type'       => 'button_set',
				'desc'       => esc_html__('Controls if the slider displays below or above the header.', 'coherence'),
				'dependency'  => array('enable_header_builder', '==', false),
				'options'  => array(
					'below'   => esc_html__('Below', 'coherence'),
					'above'   => esc_html__('Above', 'coherence'),
				),
				'default'  => 'below'
			),
			/*array(
				'id'         => 'header_left_content',
				'title'      => esc_html__('Header Content left', 'coherence'),
				'type'       => 'button_set',
				'desc'       => esc_html__('Controls the content that displays in the top left section.', 'coherence'),
				'dependency'  => array('enable_header_builder', '==', false),
				'options'  => array(
					'contact_info'   => esc_html__('Contact Info', 'coherence'),
					'social_link'   => esc_html__('Social links', 'coherence'),
					'navigation'   => esc_html__('Navigation', 'coherence'),
					'leave_empty'   => esc_html__('Leave empty', 'coherence'),
				),
				'default'  => 'contact_info'
			),
			array(
				'id'         => 'header_right_content',
				'title'      => esc_html__('Header Content right', 'coherence'),
				'type'       => 'button_set',
				'desc'       => esc_html__('Controls the content that displays in the top right section.', 'coherence'),
				'dependency'  => array('enable_header_builder', '==', false),
				'options'  => array(
					'contact_info'   => esc_html__('Contact Info', 'coherence'),
					'social_link'   => esc_html__('Social links', 'coherence'),
					'navigation'   => esc_html__('Navigation', 'coherence'),
					'leave_empty'   => esc_html__('Leave empty', 'coherence'),
				),
				'default'  => 'contact_info'
			),*/




			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Logo', 'coherence') . '</h3>',
				'dependency'  => array('enable_header_builder', '==', false),
			),
			/*array(
				'id'    => 'logo_alignment',
				'icon'  => 'fa fa-header',
				'title'   => esc_html__('Logo Alignment', 'coherence'),
				'type'    => 'radio',
				'options'    => array(
					'left' => 'Left',
					'center' => 'Center',
					'right' => 'Right',
				),
				'default'    => 'left',
				'inline' => true,
				'subtitle'    => esc_html__('Controls the logo alignment. "Center" only works on Header 5 and Side Headers.', 'coherence'),
				'dependency'  => array('enable_header_builder', '==', false),
			),*/

			array(
				'id'    => 'logo_margin',
				'icon'  => 'fa fa-header',
				'title'   => esc_html__('Logo Alignment', 'coherence'),
				'subtitle'    => esc_html__('Controls the logo alignment. "Center" only works on Header 5 and Side Headers.', 'coherence'),
				'type'    => 'spacing',
				'output_mode' => 'margin', // or margin, relative
				'default'     => array(
					'top'       => '10',
					'right'     => '20',
					'bottom'    => '10',
					'left'      => '20',
					'unit'      => 'px',
				),
				'dependency'  => array('enable_header_builder', '==', false),
			),
			array(
				'id'    => 'logo_principale',
				'icon'  => 'fa fa-header',
				'title'   => esc_html__('Default Logo', 'coherence'),
				'subtitle'    => esc_html__('Select an image file for your logo.', 'coherence'),
				'type'    => 'upload',
				'library'      => 'image',
				'placeholder'  => 'http://',
				'dependency'  => array('enable_header_builder', '==', false),

			),
			array(
				'id'    => 'logo_principale_dimention',
				'icon'  => 'fa fa-header',
				'title'   => esc_html__('Default Logo dimention', 'coherence'),
				'subtitle'    => esc_html__('Dimentions.', 'coherence'),
				'type'    => 'dimensions',
				'dependency'  => array('enable_header_builder', '==', false),

			),

			array(
				'id'    => 'logo_principale_dimention_sticky',
				'icon'  => 'fa fa-header',
				'title'   => esc_html__('Sticky Logo dimention', 'coherence'),
				'subtitle'    => esc_html__('Sticky dimentions.', 'coherence'),
				'type'    => 'dimensions',
				'dependency'  => array('enable_header_builder', '==', false),

			),
			array(
				'id'    => 'logo_principale_dimention_mobile',
				'icon'  => 'fa fa-header',
				'title'   => esc_html__('Mobile Logo dimention', 'coherence'),
				'subtitle'    => esc_html__('Mobile dimentions.', 'coherence'),
				'type'    => 'dimensions',
				'dependency'  => array('enable_header_builder', '==', false),

			),
			array(
				'id'    => 'mobile_logo',
				'icon'  => 'fa fa-header',
				'title'   => esc_html__('Mobile Logo', 'coherence'),
				'subtitle'    => esc_html__('Select an image file for your mobile logo.', 'coherence'),
				'type'    => 'upload',
				'dependency'  => array('enable_header_builder', '==', false),
			),
			array(
				'id'         => 'enable_search_in_mobile',
				'title'      => esc_html__('Enable search in mobile', 'coherence'),
				'type'       => 'switcher',
				'desc'       => esc_html__('You can set Yes / No to enable search in mobile header', 'coherence'),
				'default'    => false,
				'dependency'  => array('enable_header_builder', '==', false),
			),
			array(
				'id'      => 'mobile_search_color',
				'title'   => esc_html__('Mobile icon search color', 'coherence'),
				'type'    => 'color',
				'output_mode' => 'background-color',
				'subtitle'    => esc_html__('Select a color for mobile search icon.', 'coherence'),
				'dependency'  => array('enable_header_builder', '==', false),
			),
			array(
				'id'      => 'header_background_color',
				'title'   => esc_html__('Header Background Image', 'coherence'),
				'type'    => 'color',
				'output_mode' => 'background-color',
				'subtitle'    => esc_html__('Select an image for the header background. If left empty, the header background color will be used. For top headers the image displays on top of the header background color and will only display if header background color opacity is set to 1. For side headers the image displays behind the header background color so the header background opacity must be set below 1 to see the image.', 'coherence'),
				'dependency'  => array('enable_header_builder', '==', false),
			),
		)
	));

	/*
	CSF::createSection($coherence_prefix . '_theme_options', array(
		'title'  => esc_html__('Header Background Image', 'coherence'),
		'id'     => 'header_background',
		'icon'   => 'fa fa-ellipsis-h',
		'parent' => 'entire_site_header_options',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Header Background Image', 'coherence') . '</h3>'
			),
			array(
				'id'      => 'header_background_image',
				'title'   => esc_html__('Header Background Image', 'coherence'),
				'type'    => 'background',
				'subtitle'    => esc_html__('Select an image for the header background. If left empty, the header background color will be used. For top headers the image displays on top of the header background color and will only display if header background color opacity is set to 1. For side headers the image displays behind the header background color so the header background opacity must be set below 1 to see the image.', 'coherence'),
				//'default' => false,
			),

		)
	));
*/

	CSF::createSection($coherence_prefix . '_theme_options', array(
		'title'  => esc_html__('Header Styling', 'coherence'),
		'id'     => 'header_background',
		'icon'   => 'fa fa-ellipsis-h',
		'parent' => 'entire_site_header_options',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Header Styling', 'coherence') . '</h3>'
			),
			array(
				'id'      => 'header_padding',
				'title'   => esc_html__('Header Padding', 'coherence'),
				'type'    => 'spacing',
				'subtitle'    => esc_html__('Controls the top/right/bottom/left padding for the header. Enter values including any valid CSS unit, ex: 0px, 0px, 0px, 0px.', 'coherence'),
				'default'  => array(
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px',
				),
			),
			array(
				'id'      => 'header_margin',
				'title'   => esc_html__('Header Margin', 'coherence'),
				'type'    => 'spacing',
				'subtitle'    => esc_html__('Controls the top/right/bottom/left margin for the header. Enter values including any valid CSS unit, ex: 0px, 0px, 0px, 0px.', 'coherence'),
				'default'  => array(
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px',
				),
			),
			array(
				'id'         => 'header_100_width',
				'title'      => esc_html__('100% Header Width', 'coherence'),
				'type'       => 'switcher',
				'subtitle'       => esc_html__('Turn on to have the header area display at 100% width according to the window size. Turn off to follow site width.', 'coherence'),
				'text_on'  => 'On',
				'text_off' => 'Off',
				//'default'    => false,
				//'dependency'  => array('header_background_image', '==', true),

			),

		)
	));


	CSF::createSection($coherence_prefix . '_theme_options', array(
		'title'  => esc_html__('Sticky Header', 'coherence'),
		'id'     => 'Sticky_Header',
		'icon'   => 'fa fa-ellipsis-h',
		'parent' => 'entire_site_header_options',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Sticky Header', 'coherence') . '</h3>'
			),
			array(
				'id'      => 'sticky_header',
				'title'   => esc_html__('Sticky Header', 'coherence'),
				'type'    => 'switcher',
				'subtitle'    => esc_html__('Turn on to enable a sticky header.', 'coherence'),
				'label'   => esc_html__('Do you want activate it ?'),
				'default' => true
			),
			array(
				'id'      => 'header_sticky_tablet',
				'title'   => esc_html__('Sticky Header on Tablets', 'coherence'),
				'type'    => 'switcher',
				'subtitle'    => esc_html__('Turn on to enable a sticky header when scrolling on tablets.', 'coherence'),
				'label'   => esc_html__('Do you want activate it ?'),
				'default' => false,
				'dependency'  => array('sticky_header', '==', true),
			),
			array(
				'id'      => 'header_sticky_mobile',
				'title'   => esc_html__('Sticky Header on Mobiles', 'coherence'),
				'type'    => 'switcher',
				'subtitle'    => esc_html__('Turn on to enable a sticky header when scrolling on mobiles.', 'coherence'),
				'label'   => esc_html__('Do you want activate it ?'),
				'default' => false,
				'dependency'  => array('sticky_header', '==', true),
			),
			array(
				'id'      => 'header_sticky_shadow',
				'title'   => esc_html__('Sticky Header Shadow', 'coherence'),
				'type'    => 'switcher',
				'subtitle'    => esc_html__('Turn on to display a sticky header drop shadow.', 'coherence'),
				'label'   => esc_html__('Do you want activate it ?'),
				'default' => false,
				'dependency'  => array('sticky_header', '==', true),
			),
		)
	));

	/*-------------------------------------------------------
	   ** Pages and Template
	 --------------------------------------------------------*/
	CSF::createSection($coherence_prefix . '_theme_options', array(
		'title' => esc_html__('Menu', 'coherence'),
		'id'    => 'site_header_menu',
		'icon'  => 'fa fa-bars',
	));

	CSF::createSection($coherence_prefix . '_theme_options', array(
		'title' => esc_html__('Menu', 'coherence'),
		'id'    => 'heading_menu',
		'icon'  => 'fa fa-bars',
		'parent' => 'site_header_menu',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Main Menu', 'coherence') . '</h3>'
			),
			array(
				'id'    => 'nav_menu_margin',
				'type'  => 'spacing',
				'title' => esc_html__('Main Menu line Height', 'coherence'),
				'subtitle' => esc_html__('Controls the menu line height. In pixels.', 'coherence'),
				'default'  => array(
					'unit'   => 'px',
				),
			),
			array(
				'id'    => 'dropdown_menu_width',
				'type'  => 'slider',
				'title' => esc_html__('Main Menu Dropdown Width', 'coherence'),
				'subtitle' => esc_html__('Controls the width of the dropdown. In pixels.', 'coherence'),
				'unit'    => 'px',
				'default' => 120,
				'max'     => 500,
			),
			array(
				'id'    => 'mainmenu_dropdown_vertical_padding',
				'type'  => 'spacing',
				'title' => esc_html__('Main Menu Dropdown Item Padding', 'coherence'),
				'subtitle' => esc_html__('Controls the top/bottom padding for dropdown menu items. In pixels.', 'coherence'),
				'default'  => array(
					'unit'   => 'px',
				),
			),
			array(
				'id'    => 'mainmenu_dropdown_display_divider',
				'type'    => 'switcher',
				'title' => esc_html__('Main Menu Dropdown Divider', 'coherence'),
				'subtitle' => esc_html__('Turn on to display a divider line on dropdown menu items.', 'coherence'),
				'default' => false,
			),
			array(
				'id'    => 'mainmenu_dropdown_divider_border',
				'type'    => 'border',
				'title' => esc_html__('Main Menu Dropdown Divider', 'coherence'),
				'subtitle' => esc_html__('Turn on to display a divider line on dropdown menu items.', 'coherence'),
				'default' => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
					'style'  => 'solid',
					'color'  => '#1e73be',
					'unit'          => 'px',
				),
				'dependency' => array('mainmenu_dropdown_display_divider', '==', 'true')
			),
			array(
				'id'    => 'main_nav_search_icon',
				'type'  => 'switcher',
				'title' => esc_html__('Main Menu Search Icon', 'coherence'),
				'subtitle' => esc_html__('Turn on to display the search icon in the main menu.', 'coherence'),
				'default' => false,
			),
			array(
				'id'    => 'menu_sub_bg_color',
				'type'  => 'color',
				'title' => esc_html__('Main Menu Dropdown Background Color', 'coherence'),
				'subtitle' => esc_html__('Controls the background color of the main menu dropdown.', 'coherence'),
			),
			array(
				'id'    => 'menu_bg_hover_color',
				'type'  => 'color',
				'title' => esc_html__('Main Menu Dropdown Background Hover Color', 'coherence'),
				'subtitle' => esc_html__('Controls the background hover color of the main menu dropdown.', 'coherence'),
			),

			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Main Menu Typography', 'coherence') . '</h3>'
			),
			array(
				'id'    => 'nav_typography',
				'type'  => 'typography',
				'title' => esc_html__('Menus Typography', 'coherence'),
				'subtitle' => esc_html__('These settings control the typography for all main menu top-level items..', 'coherence'),
			),
			array(
				'id'    => 'menu_hover_color',
				'type'  => 'color',
				'title' => esc_html__('Main Menu Font Hover/Active Color', 'coherence'),
				'subtitle' => esc_html__('Controls the color for main menu text hover and active states, highlight bar and dropdown border.', 'coherence'),
			),
			array(
				'id'    => 'menu_hover_first_color',
				'type'  => 'typography',
				'title' => esc_html__('Main Menu Dropdown Font style', 'coherence'),
				'subtitle' => esc_html__('Controls the font size for main menu dropdown text. Enter value including any valid CSS unit, ex: 14px.', 'coherence'),
			),
			array(
				'id'    => 'sub_menu_hover_color',
				'type'  => 'color',
				'title' => esc_html__('Sub Menu Font Hover/Active Color', 'coherence'),
				'subtitle' => esc_html__('Controls the color for sub menu text hover and active states, highlight bar and dropdown border.', 'coherence'),
			),
			array(
				'id'    => 'side_nav_font_size',
				'type'  => 'number',
				'unit'        => 'px',
				'output_mode' => 'width',
				'default'     => 16,
				'title' => esc_html__('Side Navigation Font Size', 'coherence'),
				'subtitle' => esc_html__('Controls the font size for the menu text when using the side navigation page template. Enter value including any valid CSS unit, ex: 16px.', 'coherence'),
			),
		)

	));
	/*
	CSF::createSection($coherence_prefix . '_theme_options', array(
		'title'  => esc_html__('Secondary Top Menu', 'coherence'),
		'id'     => 'heading_secondary_top_menu',
		'icon'   => 'fa fa-ellipsis-h',
		'parent' => 'site_header_menu',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Secondary Top Menu', 'coherence') . '</h3>'
			),
			array(
				'id'      => 'topmenu_dropwdown_width',
				'title'   => esc_html__('Secondary Menu Dropdown Width', 'coherence'),
				'type'    => 'slider',
				'default' => 200,
				'max' => 500,
				'subtitle'    => esc_html__('Controls the width of the secondary menu dropdown. In pixels.', 'coherence'),
				//'default' => false,
			),
			array(
				'id'      => 'header_top_first_border_color',
				'title'   => esc_html__('Secondary Menu Divider Color', 'coherence'),
				'type'    => 'color',
				'subtitle'    => esc_html__('Controls the divider color of the first level secondary menu.', 'coherence'),
				//'default' => false,
			),
			array(
				'id'      => 'header_top_sub_bg_color',
				'title'   => esc_html__('Secondary Menu Dropdown Background Color', 'coherence'),
				'type'    => 'color',
				'subtitle'    => esc_html__('Controls the background color of the secondary menu dropdown.', 'coherence'),
				//'default' => false,
			),
			array(
				'id'      => 'header_top_menu_bg_hover_color',
				'title'   => esc_html__('Secondary Menu Dropdown Background Hover Color', 'coherence'),
				'type'    => 'color',
				'subtitle'    => esc_html__('Controls the background hover color of the secondary menu dropdown.', 'coherence'),
				//'default' => false,
			),
			array(
				'id'      => 'header_top_menu_sub_sep_color',
				'title'   => esc_html__('Secondary Menu Dropdown Separator Color', 'coherence'),
				'type'    => 'color',
				'subtitle'    => esc_html__('Controls the color of the separators in the secondary menu dropdown.', 'coherence'),
				//'default' => false,
			),
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Secondary Top Menu Typography', 'coherence') . '</h3>'
			),
			array(
				'id'      => 'snav_font_size',
				'title'   => esc_html__('Secondary Menu Font Size', 'coherence'),
				'type'    => 'number',
				'subtitle'    => esc_html__('Controls the font size for secondary menu text. Enter value including any valid CSS unit, ex: 12px.', 'coherence'),
				'default' => 12,
				'unit' => 'px'
			),
			array(
				'id'      => 'sec_menu_lh',
				'title'   => esc_html__('Secondary Menu Line Height', 'coherence'),
				'type'    => 'number',
				'subtitle'    => esc_html__('Controls the line height for secondary menu. Enter value including any valid CSS unit, ex: 48px.', 'coherence'),
				'default' => 48,
				'unit' => 'px'
			),
			array(
				'id'      => 'snav_color',
				'title'   => esc_html__('Secondary Menu Font Color', 'coherence'),
				'type'    => 'color',
				'subtitle'    => esc_html__('Controls the color for secondary menu text.', 'coherence'),
				//'default' => false,
			),
			array(
				'id'      => 'header_top_menu_sub_color',
				'title'   => esc_html__('Secondary Menu Dropdown Font Color', 'coherence'),
				'type'    => 'color',
				'subtitle'    => esc_html__('Controls the color for secondary menu dropdown text.', 'coherence'),
				//'default' => false,
			),
			array(
				'id'      => 'header_top_menu_sub_hover_color',
				'title'   => esc_html__('Secondary Menu Dropdown Font Hover Color', 'coherence'),
				'type'    => 'color',
				'subtitle'    => esc_html__('Controls the hover color for secondary menu dropdown text.', 'coherence'),
				//'default' => false,
			),
		)
	));*/

	CSF::createSection($coherence_prefix . '_theme_options', array(
		'title'  => esc_html__('Menu mobile', 'coherence'),
		'id'     => 'heading_mobile_menu',
		'icon'   => 'fa fa-ellipsis-h',
		'parent' => 'site_header_menu',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Mobile Menu Typography', 'coherence') . '</h3>'
			),
			array(
				'id'      => 'mobile_menu_typography',
				'title'   => esc_html__('Mobile Menu Typography', 'coherence'),
				'type'    => 'typography',
				'subtitle'    => esc_html__('These settings control the typography for mobile menu.', 'coherence'),
				//'default' => false,
			),
			/*array(
				'id'      => 'mobile_menu_font_hover_color',
				'title'   => esc_html__('Mobile Menu Hover Color', 'coherence'),
				'type'    => 'color',
				'subtitle'    => esc_html__('Controls the hover color of the mobile menu item. Also, used to highlight current mobile menu item.', 'coherence'),
				//'default' => false,
			),*/

			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Mobile Menu', 'coherence') . '</h3>'
			),
			/*array(
				'id'      => 'topmenu_dropwdown_width',
				'title'   => esc_html__('Mobile Menu Design Style', 'coherence'),
				'type'    => 'radio',
				'options'    => array(
					'classic' => 'Classic',
					'moderne' => 'Moderne',
					'flayout' => 'Flayout',
				),
				'default'    => 'classic',
				'inline' => true,
				'subtitle'    => esc_html__('Controls the design of the mobile menu. Flyout design style only allows parent level menu items.', 'coherence'),
			),*/
			array(
				'id'      => 'mobile_menu_background_color',
				'title'   => esc_html__('Mobile Menu Background Color', 'coherence'),
				'type'    => 'color',
				'subtitle'    => esc_html__('Controls the background color of the mobile menu dropdown and classic mobile menu box.', 'coherence'),
				//'default' => false,
			),
			array(
				'id'      => 'mobile_menu_hover_color',
				'title'   => esc_html__('Mobile Menu Background Hover Color', 'coherence'),
				'type'    => 'color',
				'subtitle'    => esc_html__('Controls the background hover color of the mobile menu dropdown.', 'coherence'),
				//'default' => false,
			),
			array(
				'id'      => 'mobile_menu_border_color',
				'title'   => esc_html__('Mobile Menu Border Color', 'coherence'),
				'type'    => 'border',
				'subtitle'    => esc_html__('Controls the border and divider colors of the mobile menu dropdown and classic mobile menu box.', 'coherence'),
				'default' => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
					'style'  => 'solid',
					'color'  => '#1e73be',
					'unit'          => 'px',
				),
			),

		)
	));

	/*
	CSF::createSection(
		$coherence_prefix . '_theme_options',
		array(
			'title' => esc_html__('Logo', 'coherence'),
			'id'    => 'heading_logo',
			'icon'  => 'fa fa-header'
		)
	);
	CSF::createSection(
		$coherence_prefix . '_theme_options',
		array(
			'title' => esc_html__('Logo', 'coherence'),
			'id'    => 'logo_options_wrapper',
			'icon'  => 'fa fa-header',
			'parent'  => 'heading_logo',
			'fields' => array(
				array(
					'type'    => 'subheading',
					'content' => '<h3>' . esc_html__('Logo', 'coherence') . '</h3>'
				),
				array(
					'id'    => 'logo_alignment',
					'icon'  => 'fa fa-header',
					'title'   => esc_html__('Logo Alignment', 'coherence'),
					'type'    => 'radio',
					'options'    => array(
						'left' => 'Left',
						'center' => 'Center',
						'right' => 'Right',
					),
					'default'    => 'left',
					'inline' => true,
					'subtitle'    => esc_html__('Controls the logo alignment. "Center" only works on Header 5 and Side Headers.', 'coherence'),
				),

				array(
					'id'    => 'logo_margin',
					'icon'  => 'fa fa-header',
					'title'   => esc_html__('Logo Alignment', 'coherence'),
					'subtitle'    => esc_html__('Controls the logo alignment. "Center" only works on Header 5 and Side Headers.', 'coherence'),
					'type'    => 'spacing',
					'output_mode' => 'margin', // or margin, relative
					'default'     => array(
						'top'       => '10',
						'right'     => '20',
						'bottom'    => '10',
						'left'      => '20',
						'unit'      => 'px',
					),
				),
				array(
					'id'    => 'logo_principale',
					'icon'  => 'fa fa-header',
					'title'   => esc_html__('Default Logo', 'coherence'),
					'subtitle'    => esc_html__('Select an image file for your logo.', 'coherence'),
					'type'    => 'upload',
					'library'      => 'image',
					'placeholder'  => 'http://',

				),
				array(
					'id'    => 'sticky_header_logo',
					'icon'  => 'fa fa-header',
					'title'   => esc_html__('Sticky Header Logo', 'coherence'),
					'subtitle'    => esc_html__('Select an image file for your sticky header logo.', 'coherence'),
					'type'    => 'upload',
				),
				array(
					'id'    => 'mobile_logo',
					'icon'  => 'fa fa-header',
					'title'   => esc_html__('Mobile Logo', 'coherence'),
					'subtitle'    => esc_html__('Select an image file for your mobile logo.', 'coherence'),
					'type'    => 'upload',
				),
			)
		)
	);
*/


	CSF::createSection(
		$coherence_prefix . '_theme_options',
		array(
			'title' => esc_html__('Favicon', 'coherence'),
			'id'    => 'favicons',
			'icon'  => 'fa fa-header',
			'parent'  => 'heading_logo',
			'fields' => array(
				array(
					'type'    => 'subheading',
					'content' => '<h3>' . esc_html__('Favicon', 'coherence') . '</h3>'
				),
				array(
					'id'    => 'fav_icon',
					'icon'  => 'fa fa-header',
					'title'   => esc_html__('Favicon', 'coherence'),
					'subtitle'    => esc_html__('Favicon for your website at 32px x 32px or 64px x 64px.', 'coherence'),
					'type'    => 'upload',
				),
				array(
					'id'    => 'fav_icon_apple_touch',
					'icon'  => 'fa fa-header',
					'title'   => esc_html__('Apple Touch Icon', 'coherence'),
					'subtitle'    => esc_html__('Favicon for Apple iOS devices at 180px x 180px.', 'coherence'),
					'type'    => 'upload',
				),
				array(
					'id'    => 'fav_icon_android',
					'icon'  => 'fa fa-header',
					'title'   => esc_html__('Android Devices Icon', 'coherence'),
					'subtitle'    => esc_html__('Favicon for Android-based devices at 192px x 192px.', 'coherence'),
					'type'    => 'upload',
				),
				array(
					'id'    => 'fav_icon_edge',
					'icon'  => 'fa fa-header',
					'title'   => esc_html__('Microsoft Edge Icon', 'coherence'),
					'subtitle'    => esc_html__('Favicon for Microsoft Edge browsers at 270px x 270px.', 'coherence'),
					'type'    => 'upload',
				),

			)
		)
	);

	CSF::createSection(
		$coherence_prefix . '_theme_options',
		array(
			'title' => esc_html__('Page Title Bar', 'coherence'),
			'id'    => 'page_title_bar',
			'icon'  => 'fa fa-header'
		)
	);

	CSF::createSection(
		$coherence_prefix . '_theme_options',
		array(
			'title' => esc_html__('Title Bar', 'coherence'),
			'id'    => 'title_bar_styling',
			'icon'  => 'fa fa-header',
			'parent' => 'page_title_bar',
			'fields' => array(
				array(
					'type'    => 'subheading',
					'content' => '<h3>' . esc_html__('Title Bar', 'coherence') . '</h3>'
				),
				array(
					'id'    => 'title_bar_enable',
					'type'  => 'switcher',
					'title' => esc_html__('Enable title bar', 'coherence'),
					'subtitle' => esc_html__('Turn on to display Title Bar.', 'coherence'),
					'default' => true,
				),
				array(
					'id'      => 'title_bar_header_font',
					'type'    => 'typography',
					'title'   => esc_html__('H2 Title Typography', 'coherence'),
					'default' => array(
						'color'       => '#fff',
						'font-family' => 'Open Sans',
						'font-size'   => '16',
						'line-height' => '20',
						'unit'        => 'px',
						'type'        => 'google',
					),
					'dependency' => array('title_bar_enable', '==', 'true')
				),

				array(
					'id'    => 'title_bar_text_color',
					'type'  => 'typography',
					'title' => esc_html__('Title bar Text Color', 'coherence'),
					'subtitle' => esc_html__('Controls the text color of the breadcrumbs font. ', 'coherence'),
					'default' => array(
						'color'       => '#fff',
						'font-family' => 'Open Sans',
						'font-size'   => '16',
						'line-height' => '20',
						'unit'        => 'px',
						'type'        => 'google',
					),
					'dependency' => array('title_bar_enable', '==', 'true')

				),
				array(
					'id'    => 'title_bar_padding',
					'icon'  => 'fa fa-header',
					'title'   => esc_html__('Title Bar Padding', 'coherence'),
					'subtitle'    => esc_html__('Controls the Title Bar padding. Enter value including any valid CSS unit, ex: 0px.', 'coherence'),
					'type'    => 'spacing',
					'output_mode' => 'padding', // or margin, relative
					'default'     => array(
						'top'       => '200',
						'right'     => '0',
						'bottom'    => '200',
						'left'      => '0',
						'unit'      => 'px',
					),
					'dependency' => array('title_bar_enable', '==', 'true')
				),
				array(
					'id'    => 'title_bar_bg_color',
					'icon'  => 'fa fa-header',
					'title'   => esc_html__('Title Bar Background Color', 'coherence'),
					'subtitle'    => esc_html__('Controls the background color of the Title Bar.', 'coherence'),
					'type'    => 'background',
					'dependency' => array('title_bar_enable', '==', 'true')
				),
				array(
					'id'    => 'title_bar_heading_color',
					'icon'  => 'fa fa-header',
					'title'   => esc_html__('Title Bar Widget Headings Color', 'coherence'),
					'subtitle'    => esc_html__('Controls the color of the Title Bar widget heading text.', 'coherence'),
					'type'    => 'color',
					'dependency' => array('title_bar_enable', '==', 'true')
				),
			)
		)
	);

	CSF::createSection($coherence_prefix . '_theme_options', array(
		'title'  => esc_html__('Breadcrumb', 'coherence'),
		'id'     => 'breadcrumb_options',
		'icon'   => 'fa fa-ellipsis-h',
		'parent' => 'page_title_bar',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Breadcrumb Options', 'coherence') . '</h3>'
			),
			array(
				'id'      => 'breadcrumb_enable',
				'title'   => esc_html__('Breadcrumb', 'coherence'),
				'type'    => 'switcher',
				'desc'    => esc_html__('you can set Yes / No to show/hide breadcrumb', 'coherence'),
				'default' => true,
			),
			array(
				'id'    => 'breadcrumb_separator',
				'type'  => 'text',
				'title' => esc_html__('Breadcrumbs Separator', 'coherence'),
				'subtitle' => esc_html__('Controls the type of separator between each breadcrumb.', 'coherence'),
				'dependency'  => array('breadcrumb_enable', '==', true),
			),
			array(
				'id'    => 'breadcrumbs_text_color',
				'type'  => 'color',
				'title' => esc_html__('Breadcrumbs link Color', 'coherence'),
				'subtitle' => esc_html__('Controls the text color of the breadcrumbs font. ', 'coherence'),
				'dependency'  => array('breadcrumb_enable', '==', true),

			),
			array(
				'id'    => 'breadcrumbs_text_hover_color',
				'type'  => 'color',
				'title' => esc_html__('Breadcrumbs link Hover Color', 'coherence'),
				'subtitle' => esc_html__('Controls the text hover color of the breadcrumbs font.', 'coherence'),
				'dependency'  => array('breadcrumb_enable', '==', true),

			),
			array(
				'id'    => 'breadcrumbs_separator_color',
				'type'  => 'color',
				'title' => esc_html__('Breadcrumbs separator Color', 'coherence'),
				'subtitle' => esc_html__('Controls the text hoverseparator color of the breadcrumbs font.', 'coherence'),
				'dependency'  => array('breadcrumb_enable', '==', true),

			),

		)
	));




	CSF::createSection(
		$coherence_prefix . '_theme_options',
		array(
			'title' => esc_html__('Sidebar Styling', 'coherence'),
			'id'    => 'heading_sidebars',
			'icon'  => 'fa fa-header'
		)
	);
	CSF::createSection(
		$coherence_prefix . '_theme_options',
		array(
			'title' => esc_html__('Sidebar Styling', 'coherence'),
			'id'    => 'sidebar_styling',
			'icon'  => 'fa fa-header',
			'parent' => 'heading_sidebars',
			'fields' => array(
				array(
					'type'    => 'subheading',
					'content' => '<h3>' . esc_html__('Sidebar Styling', 'coherence') . '</h3>'
				),
				array(
					'id'    => 'sidebar_padding',
					'icon'  => 'fa fa-header',
					'title'   => esc_html__('Sidebar Padding', 'coherence'),
					'subtitle'    => esc_html__('Controls the sidebar padding. Enter value including any valid CSS unit, ex: 0px.', 'coherence'),
					'type'    => 'spacing',
					'output_mode' => 'padding', // or margin, relative
					'default'     => array(
						'top'       => '0',
						'right'     => '0',
						'bottom'    => '4',
						'left'      => '0',
						'unit'      => 'px',
					),
				),
				array(
					'id'    => 'sidebar_bg_color',
					'icon'  => 'fa fa-header',
					'title'   => esc_html__('Sidebar Background Color', 'coherence'),
					'subtitle'    => esc_html__('Controls the background color of the sidebar.', 'coherence'),
					'type'    => 'color',
				),
				array(
					'id'    => 'sidebar_heading_color',
					'icon'  => 'fa fa-header',
					'title'   => esc_html__('Sidebar Widget Headings Color', 'coherence'),
					'subtitle'    => esc_html__('Controls the color of the sidebar widget heading text.', 'coherence'),
					'type'    => 'color',
				),
			)
		)
	);

	//id'    => 'sidebar_styling',

	// blog option
	CSF::createSection($coherence_prefix . '_theme_options', array(
		'title'  => esc_html__('Blog Page', 'coherence'),
		'id'     => 'blog_page',
		'icon'   => 'fa fa-ellipsis-h',
		'parent' => 'heading_sidebars',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Blog Page Option', 'coherence') . '</h3>'
			),
			array(
				'id'      => $coherence_prefix . '_blog_layout',
				'type'    => 'image_select',
				'title'   => esc_html__('Select Page Layout', 'coherence'),
				'options' => array(
					'full-width'    => COHERENCE_THEME_OPTIONS_IMG . '/page/D.png',
					'left-sidebar'  => COHERENCE_THEME_OPTIONS_IMG . '/page/L.png',
					'right-sidebar' => COHERENCE_THEME_OPTIONS_IMG . '/page/R.png',
				),
				'default' => 'right-sidebar'
			),
			//single_page
			array(
				'id'    => 'sidebar_blog',
				'icon'  => 'fa fa-header',
				'title'   => esc_html__('Global Page Sidebar', 'coherence'),
				'subtitle'    => esc_html__('Select sidebar that will display on all pages.', 'coherence'),
				'type'    => 'select',
				'options' => 'sidebars'
			),
			array(
				'type'    => 'switcher',
				'id'      => 'blog_spacing_enable',
				'title'   => esc_html__('Blog Page Spacing', 'coherence'),
				'desc'    => esc_html__('you can set yes to enable blog page spacing', 'coherence'),
				'default' => false
			),
			array(
				'id'         => 'blog_top_padding',
				'title'      => esc_html__('Blog Page Spacing Top', 'coherence'),
				'type'       => 'slider',
				'desc'       => esc_html__('you can set Padding Top for Blog Page container.', 'coherence'),
				'min'        => 0,
				'max'        => 500,
				'step'       => 1,
				'unit'       => 'px',
				'default'    => 20,
				'dependency' => array('blog_spacing_enable', '==', 'true')
			),
			array(
				'id'         => 'blog_bottom_padding',
				'title'      => esc_html__('Blog Page Spacing Bottom', 'coherence'),
				'type'       => 'slider',
				'desc'       => esc_html__('you can set Padding Bottom for Blog page container.', 'coherence'),
				'min'        => 0,
				'max'        => 500,
				'step'       => 1,
				'unit'       => 'px',
				'default'    => 20,
				'dependency' => array('blog_spacing_enable', '==', 'true')
			),
		)
	));

	// blog single option
	CSF::createSection($coherence_prefix . '_theme_options', array(
		'title'  => esc_html__('Blog Single Page', 'coherence'),
		'id'     => 'single_page',
		'icon'   => 'fa fa-ellipsis-h',
		'parent' => 'heading_sidebars',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Blog Single Page Option', 'coherence') . '</h3>'
			),
			array(
				'id'      => $coherence_prefix . '_single_page_layout',
				'type'    => 'image_select',
				'title'   => esc_html__('Select Page Layout', 'coherence'),
				'options' => array(
					'full-width'    => COHERENCE_THEME_OPTIONS_IMG . '/page/D.png',
					'left-sidebar'  => COHERENCE_THEME_OPTIONS_IMG . '/page/L.png',
					'right-sidebar' => COHERENCE_THEME_OPTIONS_IMG . '/page/R.png',
				),
				'default' => 'right-sidebar'
			),

			array(
				'id'    => 'sidebar_single_page',
				'icon'  => 'fa fa-header',
				'title'   => esc_html__('Global Page Sidebar', 'coherence'),
				'subtitle'    => esc_html__('Select sidebar that will display on all pages.', 'coherence'),
				'type'    => 'select',
				'options' => 'sidebars'
			),
			array(
				'type'    => 'switcher',
				'id'      => 'social_share',
				'title'   => esc_html__('Display Social Share', 'coherence'),
				'default' => false
			),
			array(
				'type'    => 'switcher',
				'id'      => 'blog_details_spacing_enable',
				'title'   => esc_html__('Blog Details Page Spacing', 'coherence'),
				'desc'    => esc_html__('you can set yes to enable blog details page spacing', 'coherence'),
				'default' => false
			),
			array(
				'id'         => 'single_top_padding',
				'title'      => esc_html__('Blog Single Page Spacing Top', 'coherence'),
				'type'       => 'slider',
				'desc'       => esc_html__('you can set padding Top for Blog Single Page container.	', 'coherence'),
				'min'        => 0,
				'max'        => 500,
				'step'       => 1,
				'unit'       => 'px',
				'default'    => 20,
				'dependency' => array('blog_details_spacing_enable', '==', 'true')
			),
			array(
				'id'         => 'single_bottom_padding',
				'title'      => esc_html__('Blog Single Page Spacing Bottom', 'coherence'),
				'type'       => 'slider',
				'desc'       => esc_html__('you can set padding Bottom for Blog Single page container.', 'coherence'),
				'min'        => 0,
				'max'        => 500,
				'step'       => 1,
				'unit'       => 'px',
				'default'    => 20,
				'dependency' => array('blog_details_spacing_enable', '==', 'true')
			),
		)
	));

	// archive page option
	CSF::createSection($coherence_prefix . '_theme_options', array(
		'title'  => esc_html__('Archive  Page', 'coherence'),
		'id'     => 'archive_page',
		'icon'   => 'fa fa-ellipsis-h',
		'parent' => 'heading_sidebars',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Archive Page Option', 'coherence') . '</h3>'
			),
			array(
				'id'      => $coherence_prefix . '_archive_layout',
				'type'    => 'image_select',
				'title'   => esc_html__('Select Page Layout', 'coherence'),
				'options' => array(
					'full-width'    => COHERENCE_THEME_OPTIONS_IMG . '/page/D.png',
					'left-sidebar'  => COHERENCE_THEME_OPTIONS_IMG . '/page/L.png',
					'right-sidebar' => COHERENCE_THEME_OPTIONS_IMG . '/page/R.png',
				),
				'default' => 'right-sidebar'
			),
			array(
				'type'    => 'switcher',
				'id'      => 'archive_page_spacing_enable',
				'title'   => esc_html__('Archive Page Spacing', 'coherence'),
				'desc'    => esc_html__('you can set yes to enable archive page spacing', 'coherence'),
				'default' => false
			),
			array(
				'id'         => 'archive_top_padding',
				'title'      => esc_html__('Archive  Page Spacing Top', 'coherence'),
				'type'       => 'slider',
				'desc'       => esc_html__('you can set padding top for archive page container.', 'coherence'),
				'min'        => 0,
				'max'        => 500,
				'step'       => 1,
				'unit'       => 'px',
				'default'    => 220,
				'dependency' => array('archive_page_spacing_enable', '==', 'true')
			),
			array(
				'id'         => 'archive_bottom_padding',
				'title'      => esc_html__('Archive Page Spacing Bottom', 'coherence'),
				'type'       => 'slider',
				'desc'       => esc_html__('you can set padding bottom for archive page container.', 'coherence'),
				'min'        => 0,
				'max'        => 500,
				'step'       => 1,
				'unit'       => 'px',
				'default'    => 220,
				'dependency' => array('archive_page_spacing_enable', '==', 'true')
			),
		)
	));

	// search page option
	CSF::createSection($coherence_prefix . '_theme_options', array(
		'title'  => esc_html__('Search  Page', 'coherence'),
		'id'     => 'search_page',
		'icon'   => 'fa fa-ellipsis-h',
		'parent' => 'heading_sidebars',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Search Page Option', 'coherence') . '</h3>'
			),
			array(
				'id'      => $coherence_prefix . '_search_layout',
				'type'    => 'image_select',
				'title'   => esc_html__('Select Page Layout', 'coherence'),
				'options' => array(
					'full-width'    => COHERENCE_THEME_OPTIONS_IMG . '/page/D.png',
					'left-sidebar'  => COHERENCE_THEME_OPTIONS_IMG . '/page/L.png',
					'right-sidebar' => COHERENCE_THEME_OPTIONS_IMG . '/page/R.png',
				),
				'default' => 'right-sidebar'
			),
			array(
				'type'    => 'switcher',
				'id'      => 'search_page_spacing_enable',
				'title'   => esc_html__('Search Page Spacing', 'coherence'),
				'desc'    => esc_html__('you can set yes to enable search page spacing', 'coherence'),
				'default' => false
			),
			array(
				'id'         => 'search_top_padding',
				'title'      => esc_html__('Search  Page Spacing Top', 'coherence'),
				'type'       => 'slider',
				'desc'       => esc_html__('you can set padding top for search page container.', 'coherence'),
				'min'        => 0,
				'max'        => 500,
				'step'       => 1,
				'unit'       => 'px',
				'default'    => 20,
				'dependency' => array('search_page_spacing_enable', '==', 'true')
			),
			array(
				'id'         => 'search_bottom_padding',
				'title'      => esc_html__('Search Page Spacing Bottom', 'coherence'),
				'type'       => 'slider',
				'desc'       => esc_html__('you can set Padding Bottom for search page container.', 'coherence'),
				'min'        => 0,
				'max'        => 500,
				'step'       => 1,
				'unit'       => 'px',
				'default'    => 20,
				'dependency' => array('search_page_spacing_enable', '==', 'true')
			),
		)
	));


	/*  404 page options */
	CSF::createSection($coherence_prefix . '_theme_options', array(
		'id'     => '404_page',
		'title'  => esc_html__('404 Page', 'coherence'),
		'parent' => 'heading_sidebars',
		'icon'   => 'fa fa-exclamation-triangle',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('404 Page Options', 'coherence') . '</h3>',
			),
			array(
				'id'         => '404_title',
				'title'      => esc_html__('Title', 'coherence'),
				'type'       => 'text',
				'attributes' => array('placeholder' => esc_html__('404', 'coherence'))
			),
			array(
				'id'         => '404_subtitle',
				'title'      => esc_html__('Sub Title', 'coherence'),
				'type'       => 'text',
				'attributes' => array('placeholder' => esc_html__('Sorry. we couldn\'t find that page', 'coherence'))
			),
			array(
				'id'         => '404_button_text',
				'title'      => esc_html__('Button Text', 'coherence'),
				'type'       => 'text',
				'attributes' => array('placeholder' => esc_html__('Go Back', 'coherence'))
			)
		)
	));

	/*

	CSF::createSection(
		$coherence_prefix . '_theme_options',
		array(
			'title' => esc_html__('Background', 'coherence'),
			'id'    => 'site_background',
			'icon'  => 'fa fa-header'
		)
	);

	CSF::createSection(
		$coherence_prefix . '_theme_options',
		array(
			'title' => esc_html__('Page Background', 'coherence'),
			'id'    => 'page_bg_subsection',
			'icon'  => 'fa fa-header',
			'parent' => 'site_background',
			'fields' => array(
				array(
					'type'    => 'subheading',
					'content' => '<h3>' . esc_html__('Page Background', 'coherence') . '</h3>'
				),
				array(
					'id'    => 'bg_image',
					'icon'  => 'fa fa-header',
					'title'   => esc_html__('Background Image For Page', 'coherence'),
					'subtitle'    => esc_html__('Select an image to use for a full page background.', 'coherence'),
					'type'    => 'background',
				),
				array(
					'id'    => 'bg_color',
					'icon'  => 'fa fa-header',
					'title'   => esc_html__('Background Color For Page', 'coherence'),
					'subtitle'    => esc_html__('Controls the background color for the page. When the color value is set to anything below 100% opacity, the color will overlay the background image if one is uploaded.', 'coherence'),
					'type'    => 'color',
				),
			)
		)
	);
*/
	/*-------------------------------------------------------
	   ** Pages and Template
	 --------------------------------------------------------*/
	CSF::createSection($coherence_prefix . '_theme_options', array(
		'id'    => 'pages_and_template',
		'title' => esc_html__('Pages & Template', 'coherence'),
		'icon'  => 'fa fa-files-o'
	));



	/*-------------------------------------------------------
	   ** Typography  Options
  --------------------------------------------------------*/
	CSF::createSection($coherence_prefix . '_theme_options', array(
		'id'     => 'typography',
		'title'  => esc_html__('Typography', 'coherence'),
		'icon'   => 'fa fa-text-width',

	));
	CSF::createSection($coherence_prefix . '_theme_options', array(
		'id'     => 'global_typography',
		'title'  => esc_html__('Body Typography', 'coherence'),
		'icon'   => 'fa fa-text-width',
		'parent' => 'typography',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Body Font Options', 'coherence') . '</h3>',
			),
			array(
				'type'    => 'switcher',
				'id'      => 'body_font_enable',
				'title'   => esc_html__('Body Font', 'coherence'),
				'desc'    => esc_html__('you can set yes to select different body font', 'coherence'),
				'default' => false
			),
			array(
				'type'           => 'typography',
				'title'          => esc_html__('Typography', 'coherence'),
				'id'             => 'coherence_body_font',
				'default'        => array(
					'font-family' => 'Rubik',
					'font-size'   => '16',
					'line-height' => '26',
					'unit'        => 'px',
					'type'        => 'google',
				),
				'color'          => true,
				'subset'         => false,
				'text_align'     => false,
				'text_transform' => false,
				'letter_spacing' => false,
				'desc'           => esc_html__('you can set font for all html tags (if not use different heading font)', 'coherence'),
				'dependency'     => array('body_font_enable', '==', 'true')
			),
			array(
				'type'    => 'link_color',
				'id'      => 'link_color',
				'title'   => esc_html__('Link Color', 'coherence'),
				'desc'    => esc_html__('Controls the color of all text links.', 'coherence'),
				'color'     => true,
				'hover'     => true,
				'visited'   => true,
				'active'    => true,
				'focus'     => true,
				'output'  => '.linkColor',
			),


		)
	));

	CSF::createSection($coherence_prefix . '_theme_options', array(
		'id'     => 'headers_typography_section',
		'title'  => esc_html__('Heading Typography', 'coherence'),
		'icon'   => 'fa fa-text-width',
		'parent' => 'typography',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Heading Typography', 'coherence') . '</h3>',
			),

			array(
				'type'           => 'typography',
				'title'          => esc_html__('H1 Headings Typography', 'coherence'),
				'id'             => 'h1_typography',
				'desc'           => esc_html__('These settings control the typography for all H1 headings.', 'coherence'),
			),
			array(
				'type'           => 'typography',
				'title'          => esc_html__('H2 Headings Typography', 'coherence'),
				'id'             => 'h2_typography',
				'desc'           => esc_html__('These settings control the typography for all H2 headings.', 'coherence'),
			),
			array(
				'type'           => 'typography',
				'title'          => esc_html__('H3 Headings Typography', 'coherence'),
				'id'             => 'h3_typography',
				'desc'           => esc_html__('These settings control the typography for all H3 headings.', 'coherence'),
			),
			array(
				'type'           => 'typography',
				'title'          => esc_html__('H4 Headings Typography', 'coherence'),
				'id'             => 'h4_typography',
				'desc'           => esc_html__('These settings control the typography for all H4 headings.', 'coherence'),
			),
			array(
				'type'           => 'typography',
				'title'          => esc_html__('H5 Headings Typography', 'coherence'),
				'id'             => 'h5_typography',
				'desc'           => esc_html__('These settings control the typography for all H5 headings.', 'coherence'),
			),
			array(
				'type'           => 'typography',
				'title'          => esc_html__('H6 Headings Typography', 'coherence'),
				'id'             => 'h6_typography',
				'desc'           => esc_html__('These settings control the typography for all H6 headings.', 'coherence'),
			),
		)
	));
	/*-------------------------------------------------------
		 ** Footer  Options
	--------------------------------------------------------*/
	CSF::createSection($coherence_prefix . '_theme_options', array(
		'title'  => esc_html__('Footer', 'coherence'),
		'id'     => 'footer_options',
		'icon'   => 'fa fa-copyright',

	));
	CSF::createSection($coherence_prefix . '_theme_options', array(
		'id'     => 'footer_content_options_subsection',
		'title'  => esc_html__('Footer Content', 'coherence'),
		'parent' => 'footer_options',
		'icon'   => 'fa fa-exclamation-triangle',

		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Footer Options', 'coherence') . '</h3>'
			),
			array(
				'id'         => 'footer_widgets',
				'title'      => esc_html__('Footer Widgets', 'coherence'),
				'type'       => 'switcher',
				'desc'       => esc_html__('Turn on to display footer widgets.', 'coherence'),
				'default'    => true,
			),
			array(
				'id'         => 'enable_footer_builder',
				'title'      => esc_html__('Enable Footer Builder', 'coherence'),
				'type'       => 'switcher',
				'desc'       => esc_html__('You can set Yes / No to use footer builder', 'coherence'),
				'default'    => false,
				'dependency'  => array('footer_widgets', '==', true)
			),
			array(
				'id'          => 'footer-builder-id',
				'type'        => 'select',
				'title'       => esc_html__('Select Footer', 'coherence'),
				'placeholder' => esc_html__('Select a Footer', 'coherence'),
				'options'     => coherence_get_footer_builder_library(),
				'desc'        => esc_html__("You need to create first footer from footer builder", 'coherence'),
				'dependency' => array(
					array('enable_footer_builder', '==', true),
					array('footer_widgets', '==', true)
				)
			),

			array(
				'id'         => 'copyright_area_spacing',
				'title'      => esc_html__('Copyright Area Spacing', 'coherence'),
				'type'       => 'switcher',
				'desc'       => esc_html__('you can set Yes / No to set copyright area spacing', 'coherence'),
				'default'    => false,
				'dependency' => array(
					array('enable_footer_builder', '==', false),
					array('footer_widgets', '==', true)
				)
			),

			array(
				'id'         => 'copyright_area_top_spacing',
				'title'      => esc_html__('Copyright Area Top Spacing', 'coherence'),
				'type'       => 'slider',
				'desc'       => esc_html__('you can set padding for copyright area top', 'coherence'),
				'min'        => 0,
				'max'        => 500,
				'step'       => 1,
				'unit'       => 'px',
				'dependency' => array(
					array('enable_footer_builder', '==', false),
					array('copyright_area_spacing', '==', true),
					array('footer_widgets', '==', true)
				)
			),
			array(
				'id'         => 'copyright_area_bottom_spacing',
				'title'      => esc_html__('Copyright Area Bottom Spacing', 'coherence'),
				'type'       => 'slider',
				'desc'       => esc_html__('you can set padding for copyright area bottom', 'coherence'),
				'min'        => 0,
				'max'        => 500,
				'step'       => 1,
				'unit'       => 'px',
				'dependency' => array(
					array('enable_footer_builder', '==', false),
					array('copyright_area_spacing', '==', true),
					array('footer_widgets', '==', true)
				)
			),
			array(
				'id'         => 'copyright_text',
				'title'      => esc_html__('Copyright Area Text', 'coherence'),
				'type'       => 'code_editor',
				'settings' => array(
					'theme'  => 'mdn-like',
					'mode'   => 'htmlmixed',
				),
				'desc'       => esc_html__('enter copyright text', 'coherence'),
				'dependency' => array(
					array('enable_footer_builder', '==', false),
					array('footer_widgets', '==', true)
				)
			),

			array(
				'id'    => 'copyright_text_typo',
				'type'  => 'typography',
				'title' => esc_html__('Copyright text style', 'coherence'),
				'subtitle' => esc_html__('Controls the text style of the copyright font.', 'coherence'),
				'dependency' => array(
					array('enable_footer_builder', '==', false),
					array('footer_widgets', '==', true)
				)

			),
			array(
				'id'    => 'copyright_background_color',
				'type'  => 'color',
				'title' => esc_html__('Copyright background Color', 'coherence'),
				'subtitle' => esc_html__('Controls the background color of the copyright font.', 'coherence'),
				'dependency' => array(
					array('enable_footer_builder', '==', false),
					array('footer_widgets', '==', true)
				)

			),
			array(
				'id'    => 'default_footer_padding',
				'icon'  => 'fa fa-header',
				'title'   => esc_html__('Default footer Padding', 'coherence'),
				'subtitle'    => esc_html__('Controls the default footer padding. Enter value including any valid CSS unit, ex: 0px.', 'coherence'),
				'type'    => 'spacing',
				'output_mode' => 'padding', // or margin, relative
				'default'     => array(
					'top'       => '20',
					'right'     => '0',
					'bottom'    => '20',
					'left'      => '0',
					'unit'      => 'px',
				),
				'dependency' => array(
					array('enable_footer_builder', '==', false),
					array('footer_widgets', '==', true)
				)
			),

		)
	));

	/*CSF::createSection($coherence_prefix . '_theme_options', array(
		'id'     => 'footer_background_image_options_subsection',
		'title'  => esc_html__('Footer Background Image', 'coherence'),
		'parent' => 'footer_options',
		'icon'   => 'fa fa-exclamation-triangle',

		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Footer Background Image', 'coherence') . '</h3>'
			),
			array(
				'id'         => 'footerw_bg_image',
				'title'      => esc_html__('Background Image For Footer Widget Area', 'coherence'),
				'type'       => 'background',
				'desc'       => esc_html__('Select an image for the footer widget background. If left empty, the footer background color will be used. This is a dependent option that always stays visible because other options can utilize it.', 'coherence'),

			),
		)
	)); */
	/*
	CSF::createSection($coherence_prefix . '_theme_options', array(
		'id'     => 'footer_styling_options_subsection',
		'title'  => esc_html__('Footer Styling', 'coherence'),
		'parent' => 'footer_options',
		'icon'   => 'fa fa-exclamation-triangle',

		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Footer Styling', 'coherence') . '</h3>'
			),
			array(
				'id'         => 'footer_100_width',
				'title'      => esc_html__('100% Footer Width', 'coherence'),
				'type'       => 'switcher',
				'desc'       => esc_html__('Turn on to have the footer area display at 100% width according to the window size. Turn off to follow site width. This is a dependent option that always stays visible because other options can utilize it.', 'coherence'),
				'default'    => false,
			),
			array(
				'id'    => 'footer_area_padding',
				'icon'  => 'fa fa-header',
				'title'   => esc_html__('Footer Padding', 'coherence'),
				'subtitle'    => esc_html__('Controls the top/right/bottom/left padding for the footer. Enter values including any valid CSS unit, ex: 60px, 64px, 0px, 0px. This is a dependent option that always stays visible because other options can utilize it.', 'coherence'),
				'type'    => 'spacing',
				'output_mode' => 'padding', // or margin, relative
				'default'     => array(
					'top'       => '60',
					'right'     => '0',
					'bottom'    => '64',
					'left'      => '0',
					'unit'      => 'px',
				),
			),
			array(
				'id'         => 'footer_border',
				'title'      => esc_html__('Footer Border', 'coherence'),
				'type'       => 'border',
				'desc'       => esc_html__('Controls the size of the top footer border. In pixels. This is a dependent option that always stays visible because other options can utilize it.', 'coherence'),
				'default'    => false,
			),
			array(
				'id'    => 'copyright_padding',
				'icon'  => 'fa fa-header',
				'title'   => esc_html__('Copyright Padding', 'coherence'),
				'subtitle'    => esc_html__('Controls the top/bottom padding for the copyright area. Enter values including any valid CSS unit, ex: 20px, 20px.', 'coherence'),
				'type'    => 'spacing',
				'output_mode' => 'padding', // or margin, relative
				'default'     => array(
					'top'       => '20',
					'right'     => '0',
					'bottom'    => '20',
					'left'      => '0',
					'unit'      => 'px',
				)
			),
			array(
				'id'    => 'copyright_bg_color',
				'icon'  => 'fa fa-header',
				'title'   => esc_html__('Copyright Background Color', 'coherence'),
				'subtitle'    => esc_html__('Controls the background color of the footer copyright area.', 'coherence'),
				'type'    => 'color',
			),
			array(
				'id'         => 'copyright_border_size',
				'title'      => esc_html__('Copyright Border Size', 'coherence'),
				'type'       => 'border',
				'desc'       => esc_html__('Controls the size of the top copyright border. In pixels', 'coherence'),

			),
		)
	));*/


	//Extra

	CSF::createSection(
		$coherence_prefix . '_theme_options',
		array(
			'title' => esc_html__('Extras', 'coherence'),
			'id'    => 'extra_section',
			'icon'  => 'fa fa-header'
		)
	);

	CSF::createSection($coherence_prefix . '_theme_options', array(
		'id'     => 'misc_options_section',
		'title'  => esc_html__('Miscellaneous', 'coherence'),
		'parent' => 'extra_section',
		'icon'   => 'fa fa-exclamation-triangle',

		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Miscellaneous', 'coherence') . '</h3>'
			),
			array(
				'id'         => 'comments_pages',
				'title'      => esc_html__('Comments on Pages', 'coherence'),
				'type'       => 'switcher',
				'desc'       => esc_html__('Turn on to allow comments on regular pages.', 'coherence'),
				'default'    => false,
			),
			array(
				'id'         => 'featured_images_pages',
				'title'      => esc_html__('Featured Images on Pages', 'coherence'),
				'type'       => 'switcher',
				'desc'       => esc_html__('Turn on to display featured images on regular pages.', 'coherence'),
				'default'    => false,
			),

		)
	));

	// Backup section
	CSF::createSection($coherence_prefix . '_theme_options', array(
		'title'  => esc_html__('Backup', 'coherence'),
		'id'     => 'backup_options',
		'icon'   => 'fa fa-window-restore',
		'fields' => array(
			array(
				'type' => 'backup',
			),
		)
	));
}
