<?php

/**
 * Elementor Widget
 * @package Coherence
 * @since 1.0.0
 */

namespace Elementor;

class Coherence_Header_Widget extends Widget_Base
{

	/**
	 * Get widget name.
	 *
	 * Retrieve Elementor widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'coherence-Header-widget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Elementor widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Header', 'coherence-core');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Elementor widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-product-info';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Elementor widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['coherence_widgets'];
	}

	/**
	 * Register Elementor widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls()
	{

		$this->start_controls_section(
			'layout_section',
			[
				'label' => __('Layout', 'coherence-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout_type',
			[
				'label' => __('Select Layout', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'default' => 'layout_one',
				'options' => [
					'layout_one' => __('Layout One', 'coherence-core'),
					'layout_two' => __('Layout Two', 'coherence-core'),
					'layout_three' => __('Layout Three', 'coherence-core'),
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'navigation',
			[
				'label' => __('Navigation', 'coherence-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'nav_menu',
			[
				'label' => __('Select Nav Menu', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => coherence_core_nav_menu(),
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'logo_section',
			[
				'label' => __('Logo', 'coherence-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'logo_type',
			[
				'label' => esc_html__('Logo Type', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'image',
				'options' => [
					'image'  => esc_html__('Image', 'coherence-core'),
					'icon' => esc_html__('Icon', 'coherence-core'),
				],
			]
		);

		$this->add_control(
			'logo',
			[
				'label' => __('Logo', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'logo_type' => 'image'
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'icon_logo',
			[
				'label' => __('Icon Logo', 'coherence-addon'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'condition' => [
					'logo_type' => 'icon',
				],
			]
		);

		$this->add_control(
			'mobile_icon_logo',
			[
				'label' => __('Mobile Icon Logo', 'coherence-addon'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'condition' => [
					'logo_type' => 'icon',
					'layout_type' => 'layout_three',
				],
			]
		);

		$this->add_control(
			'mobile_logo',
			[
				'label' => __('Mobile Logo', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'layout_type' => ['layout_two', 'layout_three'],
					'logo_type' => 'image'
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'logo_dimension',
			[
				'label' => __('Logo Dimension', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'description' => __('Set Custom Logo Size.', 'coherence-core'),
				'default' => [
					'width' => '',
					'height' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__('Style Section', 'textdomain'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__('Spacing', 'textdomain'),
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'desktop_default' => [
					'size' => 30,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 20,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .widget-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'top_bar',
			[
				'label' => __('Top Bar', 'coherence-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$topbar_left_list = new \Elementor\Repeater();

		$topbar_left_list->add_control(
			'icon',
			[
				'label' => __('Select Icon', 'alori-addon'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-clock',
					'library' => 'brands',
				],
				'label_block' => true,
			]
		);

		$topbar_left_list->add_control(
			'text',
			[
				'label' => esc_html__('Text', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Opening Hour 9:00am - 10:00pm', 'coherence-core'),
			]
		);


		$this->add_control(
			'topbar_left_list',
			[
				'label' => esc_html__('Topbar Left Content', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'condition' => [
					'layout_type' => ['layout_one', 'layout_three']
				],
				'fields' => $topbar_left_list->get_controls(),
				'title_field' => '{{{ text }}}',
			]
		);

		$topbar_items = new \Elementor\Repeater();

		$topbar_items->add_control(
			'icon',
			[
				'label' => __('Select Icon', 'alori-addon'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-clock',
					'library' => 'brands',
				],
				'label_block' => true,
			]
		);

		$topbar_items->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Office time', 'coherence-core'),
			]
		);

		$topbar_items->add_control(
			'text',
			[
				'label' => esc_html__('Text', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Opening Hour 9:00am - 10:00pm', 'coherence-core'),
			]
		);


		$this->add_control(
			'topbar_items',
			[
				'label' => esc_html__('Topbar Items', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'condition' => [
					'layout_type' => 'layout_two'
				],
				'fields' => $topbar_items->get_controls(),
				'title_field' => '{{{ text }}}',
			]
		);

		$this->add_control(
			'topbar_right_text',
			[
				'label' => esc_html__('Right Text', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Hot Line: (+00)-333-444-555', 'coherence-core'),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'social_network',
			[
				'label' => __('Social Network', 'coherence-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'social_network_title',
			[
				'label' => esc_html__('Social Network Title', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__(' Follow Us On:', 'coherence-core'),
				'condition' => [
					'layout_type' => 'layout_one'
				]
			]
		);

		$social_icons = new \Elementor\Repeater();

		$social_icons->add_control(
			'social_icon',
			[
				'label' => __('Select Icon', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fab fa-facebook',
					'library' => 'brands',
				],
				'label_block' => true,
			]
		);

		$social_icons->add_control(
			'social_url',
			[
				'label' => __('Add Url', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __('#', 'coherence-core'),
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
				],
				'show_label' => false,
			]
		);

		$this->add_control(
			'social_icons',
			[
				'label' => __('Social Icons', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $social_icons->get_controls(),
				'default' => [
					[
						'social_url' => [
							'url' => '#',
							'is_external' => true,
							'nofollow' => true,
						],
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'other',
			[
				'label' => __('Other', 'coherence-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'search_status',
			[
				'label' => esc_html__('Search Enable ?', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'coherence-core'),
				'label_off' => esc_html__('No', 'coherence-core'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'button_label',
			[
				'label' => esc_html__('Button Text', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Contact', 'coherence-core'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'button_url',
			[
				'label' => esc_html__('Button Url', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('#', 'coherence-core'),
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
				],
				'show_label' => false,
			]
		);

		$this->end_controls_section();

		//General style
		$this->start_controls_section(
			'general_style',
			[
				'label' => esc_html__('Style Options', 'coherence-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		coherence_core_typo_and_color_options($this, 'Top Bar', '{{WRAPPER}} .navbar-top ul li p,{{WRAPPER}} .navbar-top ul li p span', ['layout_one', 'layout_three']);
		coherence_core_typo_and_color_options($this, 'Top Bar Title', '{{WRAPPER}} .navbar-top .media .media-body h6', ['layout_two']);
		coherence_core_typo_and_color_options($this, 'Top Bar Text', '{{WRAPPER}} .navbar-top .media .media-body p', ['layout_two']);
		coherence_core_typo_and_color_options($this, 'Header background color', '{{WRAPPER}} .navbar-area, {{WRAPPER}} .navbar-area .nav-container.navbar-bg:after', ['layout_one'], 'background-color', false);
		coherence_core_typo_and_color_options($this, 'Top Bar Background', '{{WRAPPER}} .navbar-top', ['layout_one', 'layout_three', 'layout_two'], 'background-color', false);
		//coherence_core_typo_and_color_options($this, 'Top Bar Background', '{{WRAPPER}} .navbar-top', ['layout_two'], 'background-color', true);
		coherence_core_typo_and_color_options($this, 'Nav Bar Background', '{{WRAPPER}} .navbar-area-2, {{WRAPPER}} .navbar-area-3', ['layout_two', 'layout_three'], 'background-color', false);
		//coherence_core_typo_and_color_options($this, 'Nav Bar Background', '{{WRAPPER}} .navbar-area-3', ['layout_three'], 'background-color', false);

		coherence_core_typo_and_color_options($this, 'Navigation', '{{WRAPPER}} .navbar-area-1 .nav-container .navbar-collapse .navbar-nav > li > a,
		{{WRAPPER}} .navbar-area-2 .nav-container .navbar-collapse .navbar-nav > li a,
		{{WRAPPER}} .navbar-area-3 .nav-container .navbar-collapse .navbar-nav > li a, {{WRAPPER}}  .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:before, {{WRAPPER}}  .navbar-nav li.menu-item-has-children:after', ['layout_one', 'layout_two', 'layout_three']);

		coherence_core_typo_and_color_options($this, 'Button ', '{{WRAPPER}} .btn-base,{{WRAPPER}} .btn.btn-black', ['layout_one', 'layout_two', 'layout_three']);
		coherence_core_typo_and_color_options($this, 'Button  Background', '{{WRAPPER}} .btn-base,{{WRAPPER}} .btn.btn-black', ['layout_one', 'layout_two', 'layout_three'], 'background-color', false);


		$this->end_controls_section();
	}
	/**
	 * Render Elementor widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		include coherence_get_template('header-one.php');
		include coherence_get_template('header-two.php');
		include coherence_get_template('header-three.php');
	}
}

Plugin::instance()->widgets_manager->register(new Coherence_Header_Widget());
