<?php

/**
 * Elementor Widget
 * @package COHERENCE
 * @since 1.0.0
 */

namespace Elementor;

class Coherence_Banner_Widget extends Widget_Base
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
		return 'coherence-banner-widget';
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
		return esc_html__('Banier', 'coherence-core');
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
		return 'eicon-product-info coherence-element';
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
				'label' => esc_html__('Layout', 'coherence-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout_type',
			[
				'label' => esc_html__('Select Layout', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'default' => 'layout_one',
				'options' => [
					'layout_one' => esc_html__('Layout One', 'coherence-core'),
					'layout_two' => esc_html__('Layout Two', 'coherence-core'),
					'layout_three' => esc_html__('Layout Three', 'coherence-core'),
				]
			]
		);

		$this->end_controls_section();

		/*
		* content
		*/
		$this->start_controls_section(
			'content',
			[
				'label' => esc_html__('Content', 'coherence-core'),
				'tab'   => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'layout_type' => ['layout_one', 'layout_two']
				]
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Add Title', 'coherence-core'),
			]
		);

		$this->add_control(
			'sub_title',
			[
				'label' => esc_html__('Sub Title', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Add Sub Title', 'coherence-core'),
			]
		);

		$this->add_control(
			'summary',
			[
				'label' => esc_html__('Summary', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Add Summary', 'coherence-core'),
			]
		);

		$this->add_control(
			'button_label',
			[
				'label' => esc_html__('Button Text', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Discover More', 'coherence-core'),
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

		$this->add_control(
			'button_label_two',
			[
				'label' => esc_html__('Button Text Two', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Discover More', 'coherence-core'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'button_url_two',
			[
				'label' => esc_html__('Button Url Two', 'coherence-core'),
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

		$this->add_control(
			'banner_image',
			[
				'label' => esc_html__('Banner Image', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,

				'default' => [],
			]
		);

		$this->add_control(
			'shape_type',
			[
				'label' => esc_html__('Shape Type', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'image',
				'options' => [
					'image'  => esc_html__('Image', 'coherence-core'),
					'icon' => esc_html__('Icon', 'coherence-core'),
				],
			]
		);

		$this->add_control(
			'bg_shape',
			[
				'label' => esc_html__('Background Shape', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'shape_type' => 'image'
				],
				'default' => [],
			]
		);

		$this->add_control(
			'shape_icon',
			[
				'label' => __('Shape Icon', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'condition' => [
					'shape_type' => 'icon'
				],
			]
		);

		$this->add_control(
			'image_shape',
			[
				'label' => esc_html__('Image Shape', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [],
				'condition' => [
					'layout_type' => 'layout_one'
				]

			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'layout_three_content',
			[
				'label' => esc_html__('Content', 'coherence-core'),
				'tab'   => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'layout_type' =>  'layout_three'
				]
			]
		);

		$slider = new \Elementor\Repeater();

		$slider->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Add Title', 'coherence-core'),
			]
		);

		$slider->add_control(
			'sub_title',
			[
				'label' => esc_html__('Sub Title', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Add Sub Title', 'coherence-core'),
			]
		);

		$slider->add_control(
			'summary',
			[
				'label' => esc_html__('Summary', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Add Summary', 'coherence-core'),
			]
		);

		$slider->add_control(
			'button_label',
			[
				'label' => esc_html__('Button Text', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Discover More', 'coherence-core'),
				'label_block' => true,
			]
		);

		$slider->add_control(
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

		$slider->add_control(
			'button_label_two',
			[
				'label' => esc_html__('Button Text Two', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Discover More', 'coherence-core'),
				'label_block' => true,
			]
		);

		$slider->add_control(
			'button_url_two',
			[
				'label' => esc_html__('Button Url Two', 'coherence-core'),
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

		$slider->add_control(
			'slider_image',
			[
				'label' => esc_html__('Slider Image', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,

				'default' => [],
			]
		);

		$this->add_control(
			'slider',
			[
				'label' => esc_html__('Slider Items', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $slider->get_controls(),
				'title_field' => '{{{ title }}}',
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

		coherence_core_typo_and_color_options($this, 'Title', '{{WRAPPER}} .banner-inner.style-white .title,{{WRAPPER}} .banner-inner .title', ['layout_one', 'layout_two', 'layout_three']);
		coherence_core_typo_and_color_options($this, 'Title Primary', '{{WRAPPER}} .banner-inner .title span,{{WRAPPER}} .banner-inner .title span', ['layout_two', 'layout_three']);
		coherence_core_typo_and_color_options($this, 'Sub Title', '{{WRAPPER}} .banner-inner .sub-title', ['layout_one', 'layout_two', 'layout_three']);

		coherence_core_typo_and_color_options($this, 'Summary', '{{WRAPPER}} .banner-inner .content', ['layout_two']);

		coherence_core_typo_and_color_options($this, 'Button One', '{{WRAPPER}} .btn-base', ['layout_one', 'layout_two', 'layout_three']);
		coherence_core_typo_and_color_options($this, 'Button One Background', '{{WRAPPER}} .btn-base', ['layout_one', 'layout_two', 'layout_three'], 'background-color', false);

		coherence_core_typo_and_color_options($this, 'Button Two', '{{WRAPPER}} .btn-border-white, {{WRAPPER}} .btn-black', ['layout_one', 'layout_two', 'layout_three']);
		coherence_core_typo_and_color_options($this, 'Button Two Background', '{{WRAPPER}} .btn-border-white, {{WRAPPER}} .btn-black', ['layout_one', 'layout_two', 'layout_three'], 'background-color', false);

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
		include coherence_get_template('banner-one.php');
		include coherence_get_template('banner-two.php');
		include coherence_get_template('banner-three.php');
	}
}

Plugin::instance()->widgets_manager->register(new Coherence_Banner_Widget());
