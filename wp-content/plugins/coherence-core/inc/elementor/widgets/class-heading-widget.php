<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

/**
 * Elementor heading widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */

class Coherence_Heading_Widget extends Widget_Base
{

	/**
	 * Get widget name.
	 *
	 * Retrieve Heading widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'coherence_Heading_widget';
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
	public function get_icon()
	{
		return 'eicon-t-letter coherence-element';
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
	 * Register heading widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function register_controls()
	{
		//title controls
		$this->register_title_controls();
		//style title
		$this->register_style_title_controls();
		//style Sup title
		$this->register_style_sup_title_controls();
		//style Summary
		$this->register_style_summary_controls();
	}

	public function register_title_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'coherence-core' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'coherence-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your title', 'coherence-core' ),
				'default' => esc_html__( 'Add Your Heading Text Here', 'coherence-core' ),
			]
		);

		$this->add_control(
			'size',
			[
				'label' => esc_html__( 'Size', 'coherence-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Default', 'coherence-core' ),
					'small' => esc_html__( 'Small', 'coherence-core' ),
					'medium' => esc_html__( 'Medium', 'coherence-core' ),
					'large' => esc_html__( 'Large', 'coherence-core' ),
					'xl' => esc_html__( 'XL', 'coherence-core' ),
					'xxl' => esc_html__( 'XXL', 'coherence-core' ),
				],
			]
		);

		$this->add_control(
			'header_size',
			[
				'label' => esc_html__( 'HTML Tag', 'coherence-core' ),
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
				'default' => 'h2',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'coherence-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'coherence-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'coherence-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'coherence-core' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'coherence-core' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' => esc_html__( 'View', 'coherence-core' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->add_control(
			'option_title_heading',
			[
				'label' => esc_html__('Option Title', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_link',
			[
				'label' => esc_html__('Title Link', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'coherence-core'),
				'label_off' => esc_html__('Hide', 'coherence-core'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'custom_link',
			[
				'label' => esc_html__('Link', 'coherence-core'),
				'type' => Controls_Manager::URL,
				'default' => [
					'url' => '',
				],
				'separator' => 'after',
				'condition' => ['show_link[value]' => 'yes'],
			]
		);
		$this->add_control(
			'option_sup_and_summary_heading',
			[
				'label' => esc_html__('Sup Title and Content', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'sup_title',
			[
				'label' => esc_html__('Sup Title', 'coherence-core'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('Enter your Sup Title', 'coherence-core'),
				'label_block' => true,
			]
		);
		$this->add_responsive_control(
			'sup_title_justify_content',
			[
				'label' => esc_html__('Justify Content', 'coherence-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'center' => esc_html__('Center', 'coherence-core'),
					'flex-start' => esc_html__('Flex Start', 'coherence-core'),
					'flex-end' => esc_html__('Flex End', 'coherence-core'),
					'space-around' => esc_html__('Space Around', 'coherence-core'),
					'space-between' => esc_html__('Space Between', 'coherence-core'),
					'space-evenly' => esc_html__('Space Evenly', 'coherence-core'),
				],
				'selectors' => [
					'{{WRAPPER}} .coherence-heading .separator-sup-title' => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'sup_title!' => '',
				]
			]
		);
		$this->add_control(
			'summary_title',
			[
				'label' => esc_html__('Content', 'coherence-core'),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Enter your Content', 'coherence-core'),
			]
		);
		$this->add_responsive_control(
			'summary_text_align',
			[
				'label' => esc_html__('Text Align', 'coherence-core'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'coherence-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'coherence-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'coherence-core' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' =>  esc_html__( 'Justify', 'coherence-core' ),
						'icon' => 'eicon-text-align-justify',
					]
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}}  .coherence-heading .text-summary-title' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'summary_title!' => '',
				]
			]
		);
		$this->add_control(
			'option_separator_heading',
			[
				'label' => esc_html__('Option Separator', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_separator',
			[
				'label' => esc_html__('Show Separator', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'coherence-core'),
				'label_off' => esc_html__('Hide', 'coherence-core'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_responsive_control(
			'separator_type',
			[
				'label' => esc_html__('Separator Type', 'coherence-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'single-solid',
				'options' => [
					'single-solid' => esc_html__('Single Solid', 'coherence-core'),
					'single-dashed' => esc_html__('Single Dashed', 'coherence-core'),
					'single-dotted' => esc_html__('Single Dotted', 'coherence-core'),
					'double-solid' => esc_html__('Double Solid', 'coherence-core'),
					'double-dashed' => esc_html__('Double Dashed', 'coherence-core'),
					'double-dotted' => esc_html__('Double Dotted', 'coherence-core'),
				],
				'condition' => [
					'show_separator[value]' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'separator_width',
			[
				'label' => esc_html__('Separator width (%)', 'coherence-core'),
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
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} [class*="coherence-core-heading"]' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_separator[value]' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'separator_top_width',
			[
				'label' => esc_html__('Separator Top Width (px)', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} [class*="coherence-core-heading"]' => 'border-top-width: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'separator_type',
							'operator' => '!==',
							'value' => 'single-solid',
						],
						[
							'name' => 'separator_type',
							'operator' => '!==',
							'value' => 'single-dashed',
						],
						[
							'name' => 'separator_type',
							'operator' => '!==',
							'value' => 'single-dotted',
						],
						[
							'name' => 'show_separator',
							'operator' => '===',
							'value' => 'yes',
						],
					],
				],
			]
		);
		$this->add_responsive_control(
			'separator_bottom_width',
			[
				'label' => esc_html__('Separator Bottom Width (px)', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} [class*="coherence-core-heading"]' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_separator[value]' => 'yes',
				],
			]
		);
		$this->add_control(
			'separator_space_title',
			[
				'label' => esc_html__('Space Between Separator / Title', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'min' => 0,
					],
					'em' => [
						'min' => 0,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} [class*="coherence-core-heading"]' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_separator[value]' => 'yes',
				],
			]
		);
		$this->add_control(
			'double_separator_thickness',
			[
				'label' => esc_html__('Space Between Separators', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'min' => 0,
					],
					'em' => [
						'min' => 0,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} [class*="coherence-core-heading"]' => 'height: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'separator_type',
							'operator' => '!==',
							'value' => 'single-solid',
						],
						[
							'name' => 'separator_type',
							'operator' => '!==',
							'value' => 'single-dashed',
						],
						[
							'name' => 'separator_type',
							'operator' => '!==',
							'value' => 'single-dotted',
						],
						[
							'name' => 'show_separator',
							'operator' => '===',
							'value' => 'yes',
						],
					],
				],
			]
		);
		$this->add_control(
			'separator_color',
			[
				'label' => esc_html__('Separator Color', 'coherence-core'),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} [class*="coherence-core-heading"]' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'show_separator[value]' => 'yes',
				],
			]
		);
		$this->end_controls_section();
	}

	public function register_style_title_controls() {
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'coherence-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'coherence-core' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-heading-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .elementor-heading-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .elementor-heading-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .elementor-heading-title',
			]
		);

		$this->add_control(
			'blend_mode',
			[
				'label' => esc_html__( 'Blend Mode', 'coherence-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Normal', 'coherence-core' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'difference' => 'Difference',
					'exclusion' => 'Exclusion',
					'hue' => 'Hue',
					'luminosity' => 'Luminosity',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-heading-title' => 'mix-blend-mode: {{VALUE}}',
				],
				'separator' => 'none',
			]
		);

		$this->end_controls_section();
	}

	public function register_style_sup_title_controls() {
		$this->start_controls_section(
			'section_sup_title_style',
			[
				'label' => esc_html__('Sup Title', 'coherence-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'sup_title[value]!' => '',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sup_titletypography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}}  .coherence-heading .separator-sup-title',
			]
		);
		$this->add_control(
			'sup_title_color',
			[
				'label' => esc_html__('Text Color', 'coherence-core'),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .coherence-heading .separator-sup-title' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->add_responsive_control(
			'sup_title_margin',
			[
				'label' => esc_html__('Margin', 'coherence-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .coherence-heading .separator-sup-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'sup_title_separators_option',
			[
				'label' => esc_html__('Separators Option', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'sup_title_separators_color',
			[
				'label' => esc_html__('Color', 'coherence-core'),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .coherence-heading .separator-sup-title::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .coherence-heading .separator-sup-title::before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'sup_title_separator_width',
			[
				'label' => esc_html__('Width', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 200
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .coherence-heading .separator-sup-title::after' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .coherence-heading .separator-sup-title::before' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'sup_title_separator_height',
			[
				'label' => esc_html__('Height (px)', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .coherence-heading .separator-sup-title::after' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .coherence-heading .separator-sup-title::before' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	public function register_style_summary_controls() {
		$this->start_controls_section(
			'section_summary_style',
			[
				'label' => esc_html__('Content', 'coherence-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'summary_title[value]!' => '',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'summary_title_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}}  .coherence-heading .text-summary-title',
			]
		);
		$this->add_control(
			'summary_color',
			[
				'label' => esc_html__('Content Color', 'coherence-core'),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}}  .coherence-heading .text-summary-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'summary_margin',
			[
				'label' => esc_html__('Margin', 'coherence-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}}  .coherence-heading .text-summary-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render heading widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		if ('' === $settings['title']) {
			return;
		}

		$this->add_render_attribute('title', 'class', "elementor-heading-title");

		if (!empty($settings['size'])) {
			$this->add_render_attribute('title', 'class', 'elementor-size-' . $settings['size']);
		}

		$this->add_inline_editing_attributes('title');

		$title = $settings['title'];

		if (!empty($settings['custom_link']['url'])) {
			$this->add_link_attributes('url', $settings['custom_link']);

			$title = sprintf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('url'), $title);
		}

		$title_html = sprintf('<%1$s %2$s>%3$s</%1$s>', Utils::validate_html_tag($settings['header_size']), $this->get_render_attribute_string('title'), $title);

		// PHPCS - the variable $title_html holds safe data.
		echo '<div class="coherence-heading">';
		if (!empty($settings['sup_title'])) {
			echo '<span class="separator-sup-title">' . $settings['sup_title'] . '</span>';
		}
		echo $title_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		if (!empty($settings['show_separator']) && $settings['show_separator'] ==  'yes') {
			echo '<span class="coherence-core-heading-' . $settings['separator_type'] . '"></span>';
		}
		if (!empty($settings['summary_title'])) {
			echo '<p class="text-summary-title">' . $settings['summary_title'] . '</p>';
		}
		echo '</div>';
	}

	/**
	 * Render heading widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template()
	{
?>
		<div class="coherence-heading">
			<#
			var title=settings.title; var show_separator=settings.show_separator;
			view.addRenderAttribute( 'title' , 'class' , [ 'elementor-heading-title' , 'elementor-size-' + settings.size ] );
			view.addInlineEditingAttributes( 'title' );
			
			if ( settings.sup_title !=='' ) { #>
				<span class="separator-sup-title">{{{settings.sup_title}}}</span>
			<# } 
				
			var headerSizeTag=elementor.helpers.validateHTMLTag( settings.header_size ) 
			if ( headerSizeTag ) { #>
					<{{{headerSizeTag}}} {{{view.getRenderAttributeString( 'title' )}}}>{{{title}}}</{{{headerSizeTag}}}>
			<# } 
			
			if ( show_separator==='yes' ) { #>
				<span class="coherence-core-heading-{{{settings.separator_type}}}"></span>
			<# } 
			
			if ( settings.summary_title !=='' ) { #>
				<p class="text-summary-title">{{{settings.summary_title}}}</p>
			<# } 
			
			#>
		</div>
<?php
	}
}

Plugin::instance()->widgets_manager->register(new Coherence_Heading_Widget());
