<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

/**
 * Elementor image box widget.
 *
 * Elementor widget that displays an image, a headline and a text.
 *
 * @since 1.0.0
 */
class Widget_Content_Box extends Widget_Base
{

	/**
	 * Get widget name.
	 *
	 * Retrieve image box widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'coherence-core-content-box';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve image box widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Content Box', 'coherence-core');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve image box widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-info-box';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the button widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['coherence_widgets'];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return ['image', 'photo', 'visual', 'box' , 'icon box', 'icon'];
	}

	/**
	 * Register image box widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function register_controls()
	{
		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__('Content Box', 'coherence-core'),
			]
		);

		$this->add_control(
			'box_type',
			[
				'label' => __('Type', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'image',
				'options' => [
					'image' => __('Image', 'coherence-core'),
					'icon' => __('Icon', 'coherence-core'),
				]
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__('Choose Image', 'coherence-core'),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'box_type' => 'image'
				],
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'coherence-core'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
				'condition' => [
					'box_type' => 'icon'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
				'condition' => [
					'box_type' => 'image'
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' => esc_html__( 'View', 'coherence-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'coherence-core'),
					'stacked' => esc_html__( 'Stacked', 'coherence-core'),
					'framed' => esc_html__( 'Framed', 'coherence-core'),
				],
				'default' => 'default',
				'prefix_class' => 'elementor-view-',
				'condition' => [
					'box_type' => 'icon'
				],
			]
		);

		$this->add_control(
			'shape',
			[
				'label' => esc_html__( 'Shape', 'coherence-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => esc_html__( 'Circle', 'coherence-core'),
					'square' => esc_html__( 'Square', 'coherence-core'),
				],
				'default' => 'circle',
				'condition' => [
					'view!' => 'default',
					'selected_icon[value]!' => '',
					'box_type' => 'icon',
				],
				'prefix_class' => 'elementor-shape-',
			]
		);

		$this->add_control(
			'title_text',
			[
				'label' => esc_html__('Title & Description', 'coherence-core'),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__('This is the heading', 'coherence-core'),
				'placeholder' => esc_html__('Enter your title', 'coherence-core'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'description_text',
			[
				'label' => esc_html__('Content', 'coherence-core'),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'coherence-core'),
				'placeholder' => esc_html__('Enter your description', 'coherence-core'),
				'separator' => 'none',
				'rows' => 10,
				'show_label' => false,
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__('Link', 'coherence-core'),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__('https://your-link.com', 'coherence-core'),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'position',
			[
				'label' => esc_html__('Image Position', 'coherence-core'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'coherence-core'),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => esc_html__('Top', 'coherence-core'),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => esc_html__('Right', 'coherence-core'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'elementor-position-',
				'toggle' => false,
			]
		);

		$this->add_control(
			'title_size',
			[
				'label' => esc_html__('Title HTML Tag', 'coherence-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h3',
			]
		);

		$this->add_control(
			'view',
			[
				'label' => esc_html__('View', 'coherence-core'),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->register_search_style_image();
		$this->register_search_style_icon();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Content', 'coherence-core'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => esc_html__('Alignment', 'coherence-core'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'coherence-core'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'coherence-core'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'coherence-core'),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__('Justified', 'coherence-core'),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-coherence-core-content-box-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_vertical_alignment',
			[
				'label' => esc_html__('Vertical Alignment', 'coherence-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top' => esc_html__('Top', 'coherence-core'),
					'middle' => esc_html__('Middle', 'coherence-core'),
					'bottom' => esc_html__('Bottom', 'coherence-core'),
				],
				'default' => 'top',
				'prefix_class' => 'elementor-vertical-align-',
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => esc_html__('Title', 'coherence-core'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => esc_html__('Spacing', 'coherence-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-coherence-core-content-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .elementor-coherence-core-content-box-title',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'title_stroke',
				'selector' => '{{WRAPPER}} .elementor-coherence-core-content-box-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .elementor-coherence-core-content-box-title',
			]
		);

		$this->register_title_hover_style();

		$this->add_control(
			'heading_description',
			[
				'label' => esc_html__('Description', 'coherence-core'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__('Color', 'coherence-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-coherence-core-content-box-description' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .elementor-coherence-core-content-box-description',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'description_shadow',
				'selector' => '{{WRAPPER}} .elementor-coherence-core-content-box-description',
			]
		);

		$this->end_controls_section();
	}

	protected function register_search_style_image() {
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__('Image', 'coherence-core'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'box_type' => 'image'
				]
			]
		);

		$this->add_responsive_control(
			'image_space',
			[
				'label' => esc_html__('Spacing', 'coherence-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem'],
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-position-right .elementor-coherence-core-content-box-img' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-position-left .elementor-coherence-core-content-box-img' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-position-top .elementor-coherence-core-content-box-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .elementor-coherence-core-content-box-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_size',
			[
				'label' => esc_html__('Width', 'coherence-core') . ' (%)',
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-coherence-core-content-box-wrapper .elementor-coherence-core-content-box-img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .elementor-coherence-core-content-box-img img',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__('Border Radius', 'coherence-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em'],
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .elementor-coherence-core-content-box-img img' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__('Hover Animation', 'coherence-core'),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->start_controls_tabs('image_effects');

		$this->start_controls_tab(
			'normal',
			[
				'label' => esc_html__('Normal', 'coherence-core'),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .elementor-coherence-core-content-box-img img',
			]
		);

		$this->add_control(
			'image_opacity',
			[
				'label' => esc_html__('Opacity', 'coherence-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-coherence-core-content-box-img img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'background_hover_transition',
			[
				'label' => esc_html__('Transition Duration', 'coherence-core'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-coherence-core-content-box-img img' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover',
			[
				'label' => esc_html__('Hover', 'coherence-core'),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}}:hover .elementor-coherence-core-content-box-img img',
			]
		);

		$this->add_control(
			'image_opacity_hover',
			[
				'label' => esc_html__('Opacity', 'coherence-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover .elementor-coherence-core-content-box-img img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_search_style_icon() {
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Icon', 'coherence-core'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'selected_icon[value]',
							'operator' => '!=',
							'value' => '',
						],
						[
							'name' => 'box_type[value]',
							'operator' => '==',
							'value' => 'icon',
						],
					],
				],
			]
		);

		$this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab(
			'icon_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'coherence-core'),
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'coherence-core'),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'secondary_color',
			[
				'label' => esc_html__( 'Secondary Color', 'coherence-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'coherence-core'),
			]
		);

		$this->add_control(
			'hover_primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'coherence-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover, {{WRAPPER}}.elementor-view-default .elementor-icon:hover' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_secondary_color',
			[
				'label' => esc_html__( 'Secondary Color', 'coherence-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'coherence-core'),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => esc_html__( 'Spacing', 'coherence-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-position-right .elementor-coherence-core-content-box-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-position-left .elementor-coherence-core-content-box-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-position-top .elementor-coherence-core-content-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .elementor-coherence-core-content-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'coherence-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__( 'Padding', 'coherence-core'),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'condition' => [
					'view!' => 'default',
				],
			]
		);

		$active_breakpoints = Plugin::$instance->breakpoints->get_active_breakpoints();

		$rotate_device_args = [];

		$rotate_device_settings = [
			'default' => [
				'unit' => 'deg',
			],
		];

		foreach ( $active_breakpoints as $breakpoint_name => $breakpoint ) {
			$rotate_device_args[ $breakpoint_name ] = $rotate_device_settings;
		}

		$this->add_responsive_control(
			'rotate',
			[
				'label' => esc_html__( 'Rotate', 'coherence-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg', 'grad', 'rad', 'turn' ],
				'default' => [
					'unit' => 'deg',
				],
				'tablet_default' => [
					'unit' => 'deg',
				],
				'mobile_default' => [
					'unit' => 'deg',
				],
				'device_args' => $rotate_device_args,
				'selectors' => [
					'{{WRAPPER}} .elementor-coherence-core-content-box-icon .elementor-icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_responsive_control(
			'border_width',
			[
				'label' => esc_html__( 'Border Width', 'coherence-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'view' => 'framed',
				],
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'coherence-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'view!' => 'default',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_title_hover_style() {

		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'coherence-core'),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'coherence-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-coherence-core-content-box-title' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'coherence-core' ),
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => esc_html__('Color', 'coherence-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-coherence-core-content-box-title:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	}

	/**
	 * Render content box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$has_content = !Utils::is_empty($settings['title_text']) || !Utils::is_empty($settings['description_text']);

		$html = '<div class="elementor-coherence-core-content-box-wrapper">';

		if($settings['box_type'] == 'image') {
			$html .= $this->render_image($settings);
		}

		if($settings['box_type'] == 'icon') {
			$html .= $this->render_icon($settings);
		}

		if ($has_content) {
			$html .= '<div class="elementor-coherence-core-content-box-content">';

			if (!Utils::is_empty($settings['title_text'])) {
				$this->add_render_attribute('title_text', 'class', 'elementor-coherence-core-content-box-title');

				$this->add_inline_editing_attributes('title_text', 'none');

				$title_html = $settings['title_text'];

				if (!empty($settings['link']['url'])) {
					$title_html = sprintf('<a %1$s>%2$s</a>',$this->get_render_attribute_string('link'),$title_html);
				}

				$html .= sprintf('<%1$s %2$s>%3$s</%1$s>', Utils::validate_html_tag($settings['title_size']), $this->get_render_attribute_string('title_text'), $title_html);
			}

			if (!Utils::is_empty($settings['description_text'])) {
				$this->add_render_attribute('description_text', 'class', 'elementor-coherence-core-content-box-description');

				$this->add_inline_editing_attributes('description_text');

				$html .= sprintf('<p %1$s>%2$s</p>', $this->get_render_attribute_string('description_text'), $settings['description_text']);
			}

			$html .= '</div>';
		}

		$html .= '</div>';

		Utils::print_unescaped_internal_string($html);
	}

	private function render_icon($settings)
	{
		$html = '';
		$this->add_render_attribute( 'icon', 'class', [ 'elementor-icon', 'elementor-animation-' . $settings['hover_animation'] ] );

		$icon_tag = 'span';

		if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// add old default
			$settings['icon'] = 'fa fa-star';
		}

		$has_icon = ! empty( $settings['icon'] );

		if ( ! empty( $settings['link']['url'] ) ) {
			$icon_tag = 'a';

			$this->add_link_attributes( 'link', $settings['link'] );
		}

		if ( $has_icon ) {
			$this->add_render_attribute( 'i', 'class', $settings['icon'] );
			$this->add_render_attribute( 'i', 'aria-hidden', 'true' );
		}

		$this->add_render_attribute( 'description_text', 'class', 'elementor-icon-box-description' );

		$this->add_inline_editing_attributes( 'title_text', 'none' );
		$this->add_inline_editing_attributes( 'description_text' );
		if ( ! $has_icon && ! empty( $settings['selected_icon']['value'] ) ) {
			$has_icon = true;
		}
		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new = ! isset( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

		if($has_icon) {
			$html .='<div class="elementor-coherence-core-content-box-icon">';
			$html .= sprintf('<%1$s %2$s %3$s>',Utils::validate_html_tag( $icon_tag ),$this->get_render_attribute_string( 'icon' ),$this->get_render_attribute_string( 'link' ));
			if ( $is_new || $migrated ) {
				$html .= Icons_Manager::try_get_icon_html( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
			} elseif ( ! empty( $settings['icon'] ) ) {
				$html .= sprintf('<i %1$s></i>',$this->get_render_attribute_string( 'i' ));
			}
			
			$html .= sprintf('</%1$s>',Utils::validate_html_tag( $icon_tag ));
			$html .='</div>';
		}

		return $html;
	}

	private function render_image($settings) {
		$html = '';
		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'link', $settings['link'] );
		}

		if ( ! empty( $settings['image']['url'] ) ) {

			$image_html = wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ) );

			if ( ! empty( $settings['link']['url'] ) ) {
				$image_html = sprintf('<a %1$s>%2$s</a>',$this->get_render_attribute_string( 'link' ),$image_html);
			}

			$html = '<figure class="elementor-coherence-core-content-box-img">' . $image_html . '</figure>';
		}
		return $html;
	}

	/**
	 * Render content box widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template()
	{
		?>
			<# 
			
			var html='<div class="elementor-coherence-core-content-box-wrapper">'; 

			if(settings.box_type == 'image') {
				if(settings.image.url) 
				{ 
					var image= { 
						id: settings.image.id,
						url: settings.image.url,
						size: settings.thumbnail_size,
						dimension: settings.thumbnail_custom_dimension,
						model: view.getEditModel() 
					}; 
					
					var image_url = elementor.imagesManager.getImageUrl( image ); 
					var imageHtml='<img src="' + image_url + '" class="elementor-animation-' + settings.hover_animation + '" />' ; 
					if ( settings.link.url ) { 
						imageHtml='<a href="' + settings.link.url + '">' + imageHtml + '</a>' ; 
					} 
					
					html +='<figure class="elementor-coherence-core-content-box-img">' + imageHtml + '</figure>' ; 
				}
			} 
			
			if(settings.box_type == 'icon') {
				var link = settings.link.url ? 'href="' + settings.link.url + '"' : '',
				iconTag = link ? 'a' : 'span',
				iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' ),
				migrated = elementor.helpers.isIconMigrated( settings, 'selected_icon' );

				if ( settings.icon || settings.selected_icon.value ) {
					html +='<div class="elementor-coherence-core-content-box-icon">';
					html +='<'+iconTag+ " " + link +' class="elementor-icon elementor-animation-' + settings.hover_animation + '">';
						if ( iconHTML && iconHTML.rendered && ( ! settings.icon || migrated ) ) {
							html += iconHTML.value;
						} else {
							html +='<i class="'+settings.icon+'" aria-hidden="true"></i>';
						}
					html +='</'+iconTag+'>';
					html +='</div>';
				}
			}
			
			var hasContent=!! ( settings.title_text || settings.description_text ); 
			
			if (hasContent)
			{ 
				html +='<div class="elementor-coherence-core-content-box-content">' ; 
				if ( settings.title_text )
				{
					var title_html=settings.title_text, titleSizeTag=elementor.helpers.validateHTMLTag( settings.title_size ); 
					if ( settings.link.url )
					{ 
						title_html='<a href="' + settings.link.url + '">' + title_html + '</a>' ; 
					} 
					view.addRenderAttribute( 'title_text' , 'class' , 'elementor-coherence-core-content-box-title' );
					view.addInlineEditingAttributes( 'title_text' , 'none' );
					html +='<' + titleSizeTag + ' ' + view.getRenderAttributeString( 'title_text' ) + '>' + title_html + '</' + titleSizeTag + '>' ; 
				}
				
				if ( settings.description_text ) 
				{ 
					view.addRenderAttribute( 'description_text' , 'class' , 'elementor-coherence-core-content-box-description' );
					view.addInlineEditingAttributes( 'description_text' );
					html +='<p ' + view.getRenderAttributeString( 'description_text' ) + '>' + settings.description_text + '</p>' ; 
				}
				html +='</div>' ; 
			}
			html +='</div>' ; 
			print( html ); 
			#>
		<?php
	}

	public function on_import( $element ) {
		return Icons_Manager::on_import_migration( $element, 'icon', 'selected_icon', true );
	}
}
Plugin::instance()->widgets_manager->register(new Widget_Content_Box());
