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

class Coherence_Heading_Widget extends Widget_Heading
{
	public function  __construct($data = [], $args = null)
	{
		parent::__construct($data, $args);
		add_action('elementor/element/before_section_end', [$this, 'inject_register_controls'], 99, 3);
		add_action('elementor/element/after_section_end', [$this, 'inject_register_controls_style'], 99, 3);
	}

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
		parent::register_controls();

		//Override control title
		$this->update_control(
			'title',
			[
				'dynamic' => [
					'active' => false,
				],
			]
		);
		$this->remove_control('link');
	}

	public function inject_register_controls($element, $section_id, $args)
	{
		if ('section_title' === $section_id && $element->get_name() === 'coherence_Heading_widget') {

			$element->add_control(
				'option_title_heading',
				[
					'label' => esc_html__('Option Title', 'coherence-core'),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$element->add_control(
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

			$element->add_control(
				'custom_link',
				[
					'label' => esc_html__('Link', 'coherence-core'),
					'type' => Controls_Manager::URL,
					'dynamic' => [
						'active' => false,
					],
					'default' => [
						'url' => '',
					],
					'separator' => 'after',
					'condition' => ['show_link[value]' => 'yes'],
				]
			);
			$element->add_control(
				'option_sub_and_summary_heading',
				[
					'label' => esc_html__('Sub Title and Content', 'coherence-core'),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$element->add_control(
				'sub_title',
				[
					'label' => esc_html__('Sub Title', 'coherence-core'),
					'type' => Controls_Manager::TEXT,
					'placeholder' => esc_html__('Enter your Sub Title', 'coherence-core'),
					'label_block' => true,
				]
			);
			$element->add_control(
				'summary_title',
				[
					'label' => esc_html__('Content', 'coherence-core'),
					'type' => Controls_Manager::TEXTAREA,
					'placeholder' => esc_html__('Enter your Content', 'coherence-core'),
				]
			);
			$element->add_control(
				'option_separator_heading',
				[
					'label' => esc_html__('Option Separator', 'coherence-core'),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$element->add_control(
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
			$element->add_responsive_control(
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

			$element->add_responsive_control(
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

			$element->add_responsive_control(
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

			$element->add_responsive_control(
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

			$element->add_control(
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

			$element->add_control(
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

			$element->add_control(
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
		}
	}

	public function inject_register_controls_style($element, $section_id, $args)
	{
		if ($section_id == 'section_title_style' && $element->get_name() == 'coherence_Heading_widget') {
			$element->start_controls_section(
				'section_sub_title_style',
				[
					'label' => esc_html__('Sub Title', 'coherence-core'),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'sub_title[value]!' => '',
					],
				]
			);
			$element->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'sub_titletypography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' => '{{WRAPPER}}  .coherence-heading .separator-sub-title',
				]
			);

			$element->add_control(
				'sub_title_color',
				[
					'label' => esc_html__('Text Color', 'coherence-core'),
					'type' => Controls_Manager::COLOR,
					'global' => [
						'default' => Global_Colors::COLOR_PRIMARY,
					],
					'selectors' => [
						'{{WRAPPER}} .coherence-heading .separator-sub-title' => 'color: {{VALUE}};',
					],
				]
			);
			$element->add_responsive_control(
				'sub_title_justify_content',
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
						'{{WRAPPER}} .coherence-heading .separator-sub-title' => 'justify-content: {{VALUE}};',
					],
				]
			);
			$element->add_responsive_control(
				'sub_title_margin',
				[
					'label' => esc_html__('Margin', 'coherence-core'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors' => [
						'{{WRAPPER}} .coherence-heading .separator-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$element->add_control(
				'sub_title_separators_option',
				[
					'label' => esc_html__('Separators Option', 'coherence-core'),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$element->add_control(
				'sub_title_separators_color',
				[
					'label' => esc_html__('Color', 'coherence-core'),
					'type' => Controls_Manager::COLOR,
					'global' => [
						'default' => Global_Colors::COLOR_PRIMARY,
					],
					'selectors' => [
						'{{WRAPPER}} .coherence-heading .separator-sub-title::after' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .coherence-heading .separator-sub-title::before' => 'background-color: {{VALUE}};',
					],
				]
			);
			$element->add_responsive_control(
				'sub_title_separator_width',
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
						'{{WRAPPER}} .coherence-heading .separator-sub-title::after' => 'width: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .coherence-heading .separator-sub-title::before' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$element->add_responsive_control(
				'sub_title_separator_height',
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
						'{{WRAPPER}} .coherence-heading .separator-sub-title::after' => 'height: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .coherence-heading .separator-sub-title::before' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$element->end_controls_section();

			$element->start_controls_section(
				'section_summary_style',
				[
					'label' => esc_html__('Content', 'coherence-core'),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'summary_title[value]!' => '',
					],
				]
			);
			$element->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'summary_title_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' => '{{WRAPPER}}  .coherence-heading .text-summary-title',
				]
			);

			$element->add_control(
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
			$element->add_responsive_control(
				'summary_text_align',
				[
					'label' => esc_html__('Text Align', 'coherence-core'),
					'type' => Controls_Manager::SELECT,
					'default' => 'center',
					'options' => [
						'center' => esc_html__('Center', 'coherence-core'),
						'left' => esc_html__('Left', 'coherence-core'),
						'right' => esc_html__('Right', 'coherence-core'),
					],
					'selectors' => [
						'{{WRAPPER}}  .coherence-heading .text-summary-title' => 'text-align: {{VALUE}};',
					],
				]
			);
			$element->add_responsive_control(
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
			$element->end_controls_section();
		}
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
		if (!empty($settings['sub_title'])) {
			echo '<span class="separator-sub-title">' . $settings['sub_title'] . '</span>';
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
			
			if ( settings.sub_title !=='' ) { #>
				<span class="separator-sub-title">{{{settings.sub_title}}}</span>
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
