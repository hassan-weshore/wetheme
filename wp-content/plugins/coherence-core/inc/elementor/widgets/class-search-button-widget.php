<?php

/**
 * Elementor Widget Search Button
 * @package Coherence
 * @since 1.0.0
 */

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Border;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * Coherence Core Search Button.
 *
 * Coherence Core widget for Search Button.
 *
 * @since 1.5.0
 */
class Coherence_Search_Button_Widget extends Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.5.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'search-button';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.5.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Search', 'coherence-core' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.5.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-search';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.5.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'coherence_widgets' ];
	}

	/**
	 * Retrieve the list of scripts the navigation menu depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.5.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'coherence-core-frontend-js' ];
	}

	/**
	 * Register Search Button controls.
	 *
	 * @since 1.5.7
	 * @access protected
	 */
	protected function register_controls() {
		$this->register_general_content_controls();
		$this->register_search_style_controls();
	}
	/**
	 * Register Search General Controls.
	 *
	 * @since 1.5.0
	 * @access protected
	 */
	protected function register_general_content_controls() {
		$this->start_controls_section(
			'section_general_fields',
			[
				'label' => __( 'Search Box', 'coherence-core' ),
			]
		);

		$this->add_control(
			'layout',
			[
				'label'        => __( 'Layout', 'coherence-core' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'text',
				'options'      => [
					'text'      => __( 'Input Box', 'coherence-core' ),
					'icon'      => __( 'Icon', 'coherence-core' ),
					'icon_text' => __( 'Input Box With Button', 'coherence-core' ),
				],
				'prefix_class' => 'coherence-core-search-layout-',
				'render_type'  => 'template',
			]
		);

		$this->add_control(
			'placeholder',
			[
				'label'     => __( 'Placeholder', 'coherence-core' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Type & Hit Enter', 'coherence-core' ) . '...',
				'condition' => [
					'layout!' => 'icon',
				],
			]
		);

		$this->add_responsive_control(
			'size',
			[
				'label'              => __( 'Size', 'coherence-core' ),
				'type'               => Controls_Manager::SLIDER,
				'default'            => [
					'size' => 50,
				],
				'selectors'          => [
					'{{WRAPPER}} .coherence-core-search-form__container' => 'min-height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .coherence-core-search-submit'      => 'min-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .coherence-core-search-form__input' => 'padding-left: calc({{SIZE}}{{UNIT}} / 5); padding-right: calc({{SIZE}}{{UNIT}} / 5)',
				],
				'condition'          => [
					'layout!' => 'icon',
				],
				'render_type'        => 'template',
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();
	}
	/**
	 * Register Search Style Controls.
	 *
	 * @since 1.5.0
	 * @access protected
	 */
	protected function register_search_style_controls() {
		$this->start_controls_section(
			'section_input_style',
			[
				'label' => __( 'Input', 'coherence-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'input_typography',
				'selector' => '{{WRAPPER}} input[type="search"].coherence-core-search-form__input,{{WRAPPER}} .coherence-core-search-icon-toggle',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->add_responsive_control(
			'input_icon_size',
			[
				'label'              => __( 'Width', 'coherence-core' ),
				'type'               => Controls_Manager::SLIDER,
				'default'            => [
					'size' => 250,
				],
				'range'              => [
					'px' => [
						'min' => 0,
						'max' => 1500,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .coherence-core-input-focus .coherence-core-search-icon-toggle input[type=search]' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'          => [
					'layout' => 'icon',
				],
				'frontend_available' => true,
			]
		);

		$this->start_controls_tabs( 'tabs_input_colors' );

		$this->start_controls_tab(
			'tab_input_normal',
			[
				'label'     => __( 'Normal', 'coherence-core' ),
				'condition' => [
					'layout!' => 'icon',
				],
			]
		);

		$this->add_control(
			'input_text_color',
			[
				'label'     => __( 'Text Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'selectors' => [
					'{{WRAPPER}} .coherence-core-search-form__input' => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout!' => 'icon',
				],
			]
		);

		$this->add_control(
			'input_placeholder_color',
			[
				'label'     => __( 'Placeholder Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'selectors' => [
					'{{WRAPPER}} .coherence-core-search-form__input::placeholder' => 'color: {{VALUE}}',
				],
				'default'   => '#7A7A7A6B',
				'condition' => [
					'layout!' => 'icon',
				],
			]
		);

		$this->add_control(
			'input_background_color',
			[
				'label'     => __( 'Background Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ededed',
				'selectors' => [
					'{{WRAPPER}} .coherence-core-search-form__input, {{WRAPPER}} .coherence-core-input-focus .coherence-core-search-icon-toggle .coherence-core-search-form__input' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .coherence-core-search-icon-toggle .coherence-core-search-form__input' => 'background-color: transparent;',
				],
				'condition' => [
					'layout!' => 'icon',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'input_box_shadow',
				'selector'  => '{{WRAPPER}} .coherence-core-search-form__container,{{WRAPPER}} input.coherence-core-search-form__input',
				'condition' => [
					'layout!' => 'icon',
				],
			]
		);
		$this->add_control(
			'border_style',
			[
				'label'       => __( 'Border Style', 'coherence-core' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'none',
				'label_block' => false,
				'options'     => [
					'none'   => __( 'None', 'coherence-core' ),
					'solid'  => __( 'Solid', 'coherence-core' ),
					'double' => __( 'Double', 'coherence-core' ),
					'dotted' => __( 'Dotted', 'coherence-core' ),
					'dashed' => __( 'Dashed', 'coherence-core' ),
				],
				'selectors'   => [
					'{{WRAPPER}} .coherence-core-search-form__container ,{{WRAPPER}} .coherence-core-search-icon-toggle .coherence-core-search-form__input,{{WRAPPER}} .coherence-core-input-focus .coherence-core-search-icon-toggle .coherence-core-search-form__input' => 'border-style: {{VALUE}};',
				],
				'condition'   => [
					'layout!' => 'icon',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label'     => __( 'Border Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'condition' => [
					'border_style!' => 'none',
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .coherence-core-search-form__container, {{WRAPPER}} .coherence-core-search-icon-toggle .coherence-core-search-form__input,{{WRAPPER}} .coherence-core-input-focus .coherence-core-search-icon-toggle .coherence-core-search-form__input' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'layout!' => 'icon',
				],
			]
		);

		$this->add_control(
			'border_width',
			[
				'label'      => __( 'Border Width', 'coherence-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default'    => [
					'top'    => '1',
					'bottom' => '1',
					'left'   => '1',
					'right'  => '1',
					'unit'   => 'px',
				],
				'condition'  => [
					'border_style!' => 'none',
				],
				'selectors'  => [
					'{{WRAPPER}} .coherence-core-search-form__container, {{WRAPPER}} .coherence-core-search-icon-toggle .coherence-core-search-form__input,{{WRAPPER}} .coherence-core-input-focus .coherence-core-search-icon-toggle .coherence-core-search-form__input' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'layout!' => 'icon',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'     => __( 'Border Radius', 'coherence-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default'   => [
					'size' => 3,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .coherence-core-search-form__container, {{WRAPPER}} .coherence-core-search-icon-toggle .coherence-core-search-form__input,{{WRAPPER}} .coherence-core-input-focus .coherence-core-search-icon-toggle .coherence-core-search-form__input' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
				'condition' => [
					'layout!' => 'icon',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_input_focus',
			[
				'label'     => __( 'Focus', 'coherence-core' ),
				'condition' => [
					'layout!' => 'icon',
				],
			]
		);

		$this->add_control(
			'input_text_color_focus',
			[
				'label'     => __( 'Text Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .coherence-core-input-focus .coherence-core-search-form__input:focus,
					{{WRAPPER}} .coherence-core-search-button-wrapper input[type=search]:focus' => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout!' => 'icon',
				],
			]
		);

		$this->add_control(
			'input_placeholder_hover_color',
			[
				'label'     => __( 'Placeholder Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'selectors' => [
					'{{WRAPPER}} .coherence-core-search-form__input:focus::placeholder' => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout!' => 'icon',
				],
			]
		);

		$this->add_control(
			'input_background_color_focus',
			[
				'label'     => __( 'Background Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .coherence-core-input-focus .coherence-core-search-form__input:focus,
					{{WRAPPER}}.coherence-core-search-layout-icon .coherence-core-search-icon-toggle .coherence-core-search-form__input' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'layout!' => 'icon',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'           => 'input_box_shadow_focus',
				'selector'       =>
				'{{WRAPPER}} .coherence-core-search-button-wrapper.coherence-core-input-focus .coherence-core-search-form__container,
				 {{WRAPPER}} .coherence-core-search-button-wrapper.coherence-core-input-focus input.coherence-core-search-form__input',
				'fields_options' => [
					'box_shadow_type' => [
						'separator' => 'default',
					],
				],
				'condition'      => [
					'layout!' => 'icon',
				],
			]
		);

		$this->add_control(
			'input_border_color_focus',
			[
				'label'     => __( 'Border Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .coherence-core-input-focus .coherence-core-search-form__container,
					 {{WRAPPER}} .coherence-core-input-focus .coherence-core-search-icon-toggle .coherence-core-search-form__input' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'layout!' => 'icon',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'icon_text_color_focus',
			[
				'label'     => __( 'Text Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .coherence-core-input-focus .coherence-core-search-form__input:focus' => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout' => 'icon',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_text_background_color_focus',
			[
				'label'     => __( 'Background Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ededed',
				'selectors' => [
					'{{WRAPPER}} .coherence-core-input-focus .coherence-core-search-form__input:focus' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => 'icon',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'           => 'icon_box_shadow_focus',
				'selector'       =>
				'{{WRAPPER}} .coherence-core-search-button-wrapper.coherence-core-input-focus .coherence-core-search-form__container,
				 {{WRAPPER}} .coherence-core-search-button-wrapper.coherence-core-input-focus input.coherence-core-search-form__input',
				'fields_options' => [
					'box_shadow_type' => [
						'separator' => 'default',
					],
				],
				'condition'      => [
					'layout' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_border_style',
			[
				'label'       => __( 'Border Style', 'coherence-core' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'none',
				'label_block' => false,
				'options'     => [
					'none'   => __( 'None', 'coherence-core' ),
					'solid'  => __( 'Solid', 'coherence-core' ),
					'double' => __( 'Double', 'coherence-core' ),
					'dotted' => __( 'Dotted', 'coherence-core' ),
					'dashed' => __( 'Dashed', 'coherence-core' ),
				],
				'selectors'   => [
					'{{WRAPPER}} .coherence-core-input-focus .coherence-core-search-icon-toggle .coherence-core-search-form__input' => 'border-style: {{VALUE}};',
				],
				'condition'   => [
					'layout' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_border_color_focus',
			[
				'label'     => __( 'Border Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .coherence-core-input-focus .coherence-core-search-form__container,
					 {{WRAPPER}} .coherence-core-input-focus .coherence-core-search-icon-toggle .coherence-core-search-form__input' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'layout'             => 'icon',
					'icon_border_style!' => 'none',
				],
			]
		);

		$this->add_control(
			'icon_border_width',
			[
				'label'      => __( 'Border Width', 'coherence-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default'    => [
					'top'    => '1',
					'bottom' => '1',
					'left'   => '1',
					'right'  => '1',
					'unit'   => 'px',
				],
				'condition'  => [
					'icon_border_style!' => 'none',
					'layout'             => 'icon',
				],
				'selectors'  => [
					'{{WRAPPER}} .coherence-core-input-focus .coherence-core-search-icon-toggle .coherence-core-search-form__input' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_focus_border_radius',
			[
				'label'     => __( 'Border Radius', 'coherence-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default'   => [
					'size' => 3,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .coherence-core-input-focus .coherence-core-search-icon-toggle .coherence-core-search-form__input' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'layout' => 'icon',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label'     => __( 'Button', 'coherence-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'icon_text',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_colors' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'coherence-core' ),
			]
		);

		$this->add_control(
			'button_icon_color',
			[
				'label'     => __( 'Icon Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} button.coherence-core-search-submit' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'           => 'button_background',
				'label'          => __( 'Background', 'coherence-core' ),
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'selector'       => '{{WRAPPER}} .coherence-core-search-submit',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color'      => [
						'default' => '#818a91',
					],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'coherence-core' ),
			]
		);

		$this->add_control(
			'button_text_color_hover',
			[
				'label'     => __( 'Icon Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .coherence-core-search-submit:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_background_color_hover',
			[
				'label'     => __( 'Background Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .coherence-core-search-submit:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'button_background_color_hover!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'button_background_hover',
				'label'     => __( 'Background', 'coherence-core' ),
				'types'     => [ 'classic', 'gradient' ],
				'exclude'   => [ 'image' ],
				'selector'  => '{{WRAPPER}} .coherence-core-search-submit:hover',
				'condition' => [
					'button_background_color_hover' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_size',
			[
				'label'              => __( 'Icon Size', 'coherence-core' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'            => [
					'size' => '16',
					'unit' => 'px',
				],
				'selectors'          => [
					'{{WRAPPER}} .coherence-core-search-submit' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'condition'          => [
					'layout!' => 'icon',
				],
				'separator'          => 'before',
				'render_type'        => 'template',
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'button_width',
			[
				'label'              => __( 'Width', 'coherence-core' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'max'  => 500,
						'step' => 5,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .coherence-core-search-form__container .coherence-core-search-submit' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .coherence-core-close-icon-yes button#clear_with_button' => 'right: {{SIZE}}{{UNIT}}',
				],
				'condition'          => [
					'layout' => 'icon_text',
				],
				'render_type'        => 'template',
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_style',
			[
				'label'     => __( 'Icon', 'coherence-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'icon',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_toggle_color' );

		$this->start_controls_tab(
			'tab_toggle_normal',
			[
				'label' => __( 'Normal', 'coherence-core' ),
			]
		);

		$this->add_control(
			'toggle_color',
			[
				'label'     => __( 'Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .coherence-core-search-icon-toggle i' => 'color: {{VALUE}}; border-color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_toggle_hover',
			[
				'label' => __( 'Hover', 'coherence-core' ),
			]
		);

		$this->add_control(
			'toggle_color_hover',
			[
				'label'     => __( 'Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .coherence-core-search-icon-toggle i:hover' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'toggle_icon_size',
			[
				'label'              => __( 'Icon Size', 'coherence-core' ),
				'type'               => Controls_Manager::SLIDER,
				'default'            => [
					'size' => 15,
				],
				'selectors'          => [
					'{{WRAPPER}} .coherence-core-search-icon-toggle input[type=search]' => 'padding: 0 calc( {{SIZE}}{{UNIT}} / 2);',
					'{{WRAPPER}} .coherence-core-search-icon-toggle i.fa-search:before' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .coherence-core-search-icon-toggle i.fa-search, {{WRAPPER}} .coherence-core-search-icon-toggle' => 'width: {{SIZE}}{{UNIT}};',

				],
				'condition'          => [
					'layout' => 'icon',
				],
				'separator'          => 'before',
				'render_type'        => 'template',
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_close_icon',
			[
				'label'     => __( 'Close Icon', 'coherence-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'icon',
				],
			]
		);

		$this->add_responsive_control(
			'close_icon_size',
			[
				'label'              => __( 'Size', 'coherence-core' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default'            => [
					'size' => '20',
					'unit' => 'px',
				],
				'selectors'          => [
					'{{WRAPPER}} .coherence-core-search-form__container button#clear i:before,
					{{WRAPPER}} .coherence-core-search-icon-toggle button#clear i:before,
				{{WRAPPER}} .coherence-core-search-form__container button#clear-with-button i:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'frontend_available' => true,

			]
		);

		$this->start_controls_tabs( 'close_icon_normal' );

		$this->start_controls_tab(
			'normal_close_button',
			[
				'label' => __( 'Normal', 'coherence-core' ),
			]
		);
		$this->add_control(
			'text_color',
			[
				'label'     => __( 'Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '#7a7a7a',
				'selectors' => [
					'{{WRAPPER}} .coherence-core-search-form__container button#clear-with-button,
					{{WRAPPER}} .coherence-core-search-form__container button#clear,
					{{WRAPPER}} .coherence-core-search-icon-toggle button#clear' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover_close_icon',
			[
				'label' => __( 'Hover', 'coherence-core' ),
			]
		);

		$this->add_control(
			'hover_close_icon_text',
			[
				'label'     => __( 'Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .coherence-core-search-form__container button#clear-with-button:hover,
					{{WRAPPER}} .coherence-core-search-form__container button#clear:hover,
					{{WRAPPER}} .coherence-core-search-icon-toggle button#clear:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}
	/**
	 * Render Search button output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.5.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
			'input',
			[
				'placeholder' => $settings['placeholder'],
				'class'       => 'coherence-core-search-form__input',
				'type'        => 'search',
				'name'        => 's',
				'title'       => __( 'Search', 'coherence-core' ),
				'value'       => get_search_query(),

			]
		);

		$this->add_render_attribute(
			'container',
			[
				'class' => [ 'coherence-core-search-form__container' ],
				'role'  => 'tablist',
			]
		);
		?>
		<form class="coherence-core-search-button-wrapper" role="search" action="<?php echo home_url(); ?>" method="get">
			<?php if ( 'icon' === $settings['layout'] ) { ?>
			<div class = "coherence-core-search-icon-toggle">
				<input <?php echo $this->get_render_attribute_string( 'input' ); ?>>
				<i class="fas fa-search" aria-hidden="true"></i>
			</div>
			<?php } else { ?>
			<div <?php echo wp_kses_post( $this->get_render_attribute_string( 'container' ) ); ?>>
				<?php if ( 'text' === $settings['layout'] ) { ?>
					<input <?php echo $this->get_render_attribute_string( 'input' ); ?>>
						<button id="clear" type="reset">
							<i class="fas fa-times clearable__clear" aria-hidden="true"></i>
						</button>
				<?php } else { ?>
					<input <?php echo $this->get_render_attribute_string( 'input' ); ?>>
					<button id="clear-with-button" type="reset">
						<i class="fas fa-times" aria-hidden="true"></i>
					</button>
					<button class="coherence-core-search-submit" type="submit">
						<i class="fas fa-search" aria-hidden="true"></i>
					</button>
				<?php } ?>
			</div>
		<?php } ?>
		</form>
		<?php
	}
}
Plugin::instance()->widgets_manager->register(new Coherence_Search_Button_Widget());