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
					'layout_four' => __('Layout Four', 'coherence-core'),
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

		$this->add_control(
			'header_nav_elements_padding',
			[
				'label' => esc_html__('Padding', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .navbar .navbar-nav li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'more_options_hover',
			[
				'label' => esc_html__('Hover Options', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'header_nav_espace_underline',
			[
				'label' => esc_html__('Underline offset (%)', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .navbar-collapse .navbar-nav > li > a:after' => 'bottom: {{SIZE}}{{UNIT}};',
				],
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


		$this->add_responsive_control(
			'logo',
			[
				'label' => __('Logo', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'logo_thum', // Usage: `logo_thum_size` and `logo_thum_custom_dimension`
				'default' => 'full',
				'separator' => 'none',
			]
		);

		$this->add_responsive_control(
			'logo_pos_top',
			[
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label' => esc_html__('Position Top', 'coherence-core'),
				'placeholder' => '0',
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .navbar-area .nav-container .logo' => 'top: {{VALUE}}px;',
				],
				'condition' => [
					'layout_type' => ['layout_one', 'layout_three', 'layout_two']
				],
			]
		);

		$this->add_responsive_control(
			'logo_pos_left',
			[
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label' => esc_html__('Position Left', 'coherence-core'),
				'placeholder' => '0',
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .navbar-area .nav-container .logo' => 'left: {{VALUE}}px;',
				],
				'condition' => [
					'layout_type' => ['layout_one', 'layout_three', 'layout_two']
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

		// Start Section [demande un devis]
		$this->start_controls_section(
			'btn_devis',
			[
				'label' => __('Demande Un Devis', 'coherence-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'layout_type' => ['layout_four'],
				],
			]
		);

		$this->add_control(
			'btn_devis_enable',
			[
				'label' => esc_html__('activer la section', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'coherence-core'),
				'label_off' => esc_html__('Hide', 'coherence-core'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'btn_devis_text',
			[
				'label' => esc_html__('Button Text', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Demande un devis', 'coherence-core'),
				'condition' => [
					'btn_devis_enable[value]' => 'yes',
				],
			]
		);

		$this->add_control(
			'btn_devis_url',
			[
				'label' => esc_html__('Url', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('#', 'coherence-core'),
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
				],
				'condition' => [
					'btn_devis_enable[value]' => 'yes',
				],
			]
		);

		$this->add_control(
			'btn_devis_padding',
			[
				'label' => esc_html__('Padding', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} header.header-core .btn-header.btn-devis' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};height: auto;line-height: initial;',
				],
				'condition' => [
					'btn_devis_enable[value]' => 'yes',
				],
			]
		);

		$this->add_control(
			'btn_devis_border_radius',
			[
				'label' => esc_html__('Border radius', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} header.header-core .btn-header.btn-devis' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};height: auto;line-height: initial;',
				],
				'condition' => [
					'btn_devis_enable[value]' => 'yes',
				],
			]
		);

		$this->add_control(
			'btn_devis_bg_color',
			[
				'label' => esc_html__('Background color', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} header.header-core .btn-header.btn-devis' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'btn_devis_enable[value]' => 'yes',
				],
			]
		);

		$this->add_control(
			'btn_devis_border_color',
			[
				'label' => esc_html__('Border color', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} header.header-core .btn-header.btn-devis' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'btn_devis_enable[value]' => 'yes',
				],
			]
		);

		$this->add_control(
			'btn_devis_text_color',
			[
				'label' => esc_html__('Text color', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} header.header-core .btn-header.btn-devis' => 'color: {{VALUE}}',
				],
				'condition' => [
					'btn_devis_enable[value]' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'btn_devis_text_typography',
				'selector' => '{{WRAPPER}} header.header-core .btn-header.btn-devis',
				'condition' => [
					'btn_devis_enable[value]' => 'yes',
				],
			]
		);

		$this->add_control(
			'section_btn_devis_hover',
			[
				'label' => esc_html__('Hover Options', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'btn_devis_enable[value]' => 'yes',
				],
			]
		);

		$this->add_control(
			'btn_devis_bg_color_hover',
			[
				'label' => esc_html__('Background color', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} header.header-core .btn-header.btn-devis:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'btn_devis_enable[value]' => 'yes',
				],
			]
		);

		$this->add_control(
			'btn_devis_border_color_hover',
			[
				'label' => esc_html__('Border color', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} header.header-core .btn-header.btn-devis:hover' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'btn_devis_enable[value]' => 'yes',
				],
			]
		);

		$this->add_control(
			'btn_devis_text_color_hover',
			[
				'label' => esc_html__('Text color', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} header.header-core .btn-header.btn-devis:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					'btn_devis_enable[value]' => 'yes',
				],
			]
		);

		$this->end_controls_section();
		// End Section [demande un devis]

		// Start Section [telephone]
		$this->start_controls_section(
			'btn_phone',
			[
				'label' => __('Phone Section', 'coherence-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' =>
				[
					'layout_type' => ['layout_four']
				],
			]
		);
		$this->add_control(
			'btn_phone_enable',
			[
				'label' => esc_html__('Activate section', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'coherence-core'),
				'label_off' => esc_html__('Hide', 'coherence-core'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'btn_phone_text',
			[
				'label' => esc_html__('Button Text', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__('Contact us', 'coherence-core'),
				'condition' => [
					'btn_phone_enable[value]' => 'yes',
				],
			]
		);
		$this->add_control(
			'btn_phone_number',
			[
				'label' => esc_html__('Phone number', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__('+212600112233', 'coherence-core'),
				'condition' => [
					'btn_phone_enable[value]' => 'yes',
				],
			]
		);
		$this->add_control(
			'btn_phone_padding',
			[
				'label' => esc_html__('Padding', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} header.header-core .btn-header.btn-phone' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};height: auto;line-height: initial;',
				],
				'condition' => [
					'btn_phone_enable[value]' => 'yes',
				],
			]
		);
		$this->add_control(
			'btn_phone_border_radius',
			[
				'label' => esc_html__('Border radius', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} header.header-core .btn-header.btn-phone' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};height: auto;line-height: initial;',
				],
				'condition' => [
					'btn_phone_enable[value]' => 'yes',
				],
			]
		);
		$this->add_control(
			'btn_phone_bg_color',
			[
				'label' => esc_html__('Background color', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} header.header-core .btn-header.btn-phone' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'btn_phone_enable[value]' => 'yes',
				],
			]
		);
		$this->add_control(
			'btn_phone_border_color',
			[
				'label' => esc_html__('Border color', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} header.header-core .btn-header.btn-phone' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'btn_phone_enable[value]' => 'yes',
				],
			]
		);
		$this->add_control(
			'btn_phone_text_color',
			[
				'label' => esc_html__('Text color', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} header.header-core .btn-header.btn-phone' => 'color: {{VALUE}}',
				],
				'condition' => [
					'btn_phone_enable[value]' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'btn_phone_text_typography',
				'selector' => '{{WRAPPER}} header.header-core .btn-header.btn-phone',
				'condition' => [
					'btn_phone_enable[value]' => 'yes',
				],
			]
		);
		$this->add_control(
			'section_btn_phone_hover',
			[
				'label' => esc_html__('Hover Options', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'btn_phone_enable[value]' => 'yes',
				],
			]
		);
		$this->add_control(
			'btn_phone_bg_color_hover',
			[
				'label' => esc_html__('Background color', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} header.header-core .btn-header.btn-phone:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'btn_phone_enable[value]' => 'yes',
				],
			]
		);
		$this->add_control(
			'btn_phone_border_color_hover',
			[
				'label' => esc_html__('Border color', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} header.header-core .btn-header.btn-phone:hover' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'btn_phone_enable[value]' => 'yes',
				],
			]
		);
		$this->add_control(
			'btn_phone_text_color_hover',
			[
				'label' => esc_html__('Text color', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} header.header-core .btn-header.btn-phone:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					'btn_phone_enable[value]' => 'yes',
				],
			]
		);
		$this->end_controls_section();
		// End Section [telephone]

		//General style
		$this->start_controls_section(
			'general_style',
			[
				'label' => esc_html__('Style Options', 'coherence-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'top_bar_options',
			[
				'label' => esc_html__('Top Bar Options', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'layout_type' => ['layout_two', 'layout_three']
				],
			]
		);


		coherence_core_typo_and_color_options($this, 'Top Bar', '{{WRAPPER}} .navbar-top ul li p,{{WRAPPER}} .navbar-top ul li p span', ['layout_one', 'layout_three']);
		coherence_core_typo_and_color_options($this, 'Top Bar Title', '{{WRAPPER}} .navbar-top .media .media-body h6', ['layout_two']);
		coherence_core_typo_and_color_options($this, 'Top Bar Text', '{{WRAPPER}} .navbar-top .media .media-body p', ['layout_two']);
		coherence_core_typo_and_color_options($this, 'Top Bar Background', '{{WRAPPER}} .navbar-top', ['layout_one', 'layout_three', 'layout_two'], 'background-color', false);
		//coherence_core_typo_and_color_options($this, 'Top Bar Background', '{{WRAPPER}} .navbar-top', ['layout_two'], 'background-color', true);

		$this->add_control(
			'header_nav_options',
			[
				'label' => esc_html__('Header Navigation Options', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'header_nav_hover_color',
			[
				'label' => esc_html__('Color', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .navbar .navbar-nav li:hover a:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .navbar .navbar-nav li:hover a ,{{WRAPPER}} #header-four .menu_navbar li a' => 'color: {{VALUE}};',
					'{{WRAPPER}} header .header-core-navbar ul li.menu-item-has-children::after' => 'color: {{VALUE}};',
					'{{WRAPPER}} header .header-core-navbar ul li a::after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'header_nav_hover_bg_color',
			[
				'label' => esc_html__('Background color', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .navbar .navbar-nav li:hover' => 'background-color: {{VALUE}} ; transition: all 0.6s;',
				],
				'condition' => [
					'layout_type' => ['layout_two', 'layout_three']
				],
			]
		);

		coherence_core_typo_and_color_options($this, 'Header background color', '{{WRAPPER}} .navbar-area, {{WRAPPER}} .navbar-area .nav-container.navbar-bg:after', ['layout_one'], 'background-color', false);
		coherence_core_typo_and_color_options($this, 'Nav Bar Background', '{{WRAPPER}} .navbar-area-2, {{WRAPPER}} .navbar-area-3 , {{WRAPPER}} header .header-core-navbar', ['layout_two', 'layout_three', 'layout_four'], 'background-color', false);
		//coherence_core_typo_and_color_options($this, 'Nav Bar Background', '{{WRAPPER}} .navbar-area-3', ['layout_three'], 'background-color', false);

		coherence_core_typo_and_color_options($this, 'Navigation', '{{WRAPPER}} .navbar-area-1 .nav-container .navbar-collapse .navbar-nav > li > a,
		{{WRAPPER}} .navbar-area-2 .nav-container .navbar-collapse .navbar-nav > li a,
		{{WRAPPER}} .navbar-area-3 .nav-container .navbar-collapse .navbar-nav > li a, {{WRAPPER}}  .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:before, {{WRAPPER}}  .navbar-nav li.menu-item-has-children:after', ['layout_one', 'layout_two', 'layout_three']);

		$this->add_control(
			'btn_header_contact',
			[
				'label' => esc_html__('Button Contact Options', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'layout_type' => ['layout_one', 'layout_two', 'layout_three']
				]
			]
		);

		coherence_core_typo_and_color_options($this, 'Button ', '{{WRAPPER}} .btn-base,{{WRAPPER}} .btn.btn-black', ['layout_one', 'layout_two', 'layout_three']);
		coherence_core_typo_and_color_options($this, 'Button  Background', '{{WRAPPER}} .btn-base,{{WRAPPER}} .btn.btn-black', ['layout_one', 'layout_two', 'layout_three'], 'background-color', false);

		$this->add_control(
			'btn_header_contact_hover',
			[
				'label' => esc_html__('Hover Options', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'layout_type' => ['layout_one', 'layout_two', 'layout_three']
				]
			]
		);

		$this->add_control(
			'contact_text_color',
			[
				'label' => esc_html__('Color', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .navbar .btn-base' => 'border-radius: 0;',
					'{{WRAPPER}} .navbar .btn-base:hover' => 'color: {{VALUE}} !important;',
				],
				'condition' => [
					'layout_type' => ['layout_one', 'layout_two', 'layout_three']
				]
			]
		);

		$this->add_control(
			'contact_bg_color_after',
			[
				'label' => esc_html__('Background color', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .navbar .btn-base::after' => 'background-color: {{VALUE}};left: -50%;',
					'{{WRAPPER}} .navbar .btn-base:hover::after' => 'width: 150%;',
				],
				'condition' => [
					'layout_type' => ['layout_one', 'layout_two', 'layout_three']
				]
			]
		);

		$this->add_control(
			'btn_contact_padding',
			[
				'label' => esc_html__('Padding', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .navbar .btn-base' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};height: auto;line-height: initial;',
				],
				'condition' => [
					'layout_type' => ['layout_one', 'layout_two', 'layout_three']
				]
			]
		);

		$this->end_controls_section();
		$this->_register_controls_nav_style();
	}

	protected function _register_controls_nav_style()
	{
		$this->start_controls_section(
			'general_style_nav',
			[
				'label' => esc_html__('Navigation Options', 'coherence-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'navigation_icon_color',
			[
				'label' => esc_html__('Navigation Icon Color', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .navbar-collapse .navbar-nav>li.menu-item-has-children:before' => 'background-color : {{VALUE}}',
					'{{WRAPPER}} .navbar-collapse .navbar-nav>li.menu-item-has-children:after' => 'background-color : {{VALUE}}',
				],
			]
		);
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
		$header = $settings['layout_type'] ?? '';
		$template_path =  apply_filters('change_default_header_layout', 'header-one.php');

		switch ($header) {
			case 'layout_one':
				$template_path = 'headers/header-one.php';
				break;
			case 'layout_two':
				$template_path = 'headers/header-two.php';
				break;
			case 'layout_three':
				$template_path = 'headers/header-three.php';
				break;
			case 'layout_four':
				$template_path = 'headers/header-four.php';
				break;
		}

		$header_file = coherence_get_template($template_path);

		if (!empty($header_file)) {

			$logo = wp_kses_post(Group_Control_Image_Size::get_attachment_image_html($settings, 'logo_thum',  'logo'));
			$logo_tablet = wp_kses_post(Group_Control_Image_Size::get_attachment_image_html($settings, 'logo_thum',  'logo_tablet'));
			$logo_mobile = wp_kses_post(Group_Control_Image_Size::get_attachment_image_html($settings, 'logo_thum',  'logo_mobile'));

			$logo_tablet = !empty($logo_tablet) ? $logo_tablet : $logo;
			$logo_mobile = !empty($logo_mobile) ? $logo_mobile : $logo;

			$logo_type = $settings['logo_type'] ?? '';
			$menu = $settings['nav_menu'] ?? '';
			ob_start();
			include_once $header_file;
			echo  ob_get_clean();
		}
	}
}

Plugin::instance()->widgets_manager->register(new Coherence_Header_Widget());
