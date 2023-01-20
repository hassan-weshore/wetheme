<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

/**
 * Elementor image widget.
 *
 * Elementor widget that displays an image into the page.
 *
 * @since 1.0.0
 */
class Coherence_Image_Widget extends Widget_Base
{

	/**
	 * Get widget name.
	 *
	 * Retrieve image widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'coherence-image';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve image widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Image', 'coherence-core');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve image widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-image-bold coherence-element';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the image widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *Custom Caption
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
		return ['image', 'photo', 'visual'];
	}

	/**
	 * Register image widget controls.
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
				'label' => esc_html__('Image', 'coherence-core'),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__('Choose Image', 'coherence-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'large',
				'separator' => 'none',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__('Alignment', 'coherence-core'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'coherence-core' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'coherence-core' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'coherence-core' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'coherence-core-align-image-',
			]
		);

		$this->add_control(
			'title_source',
			[
				'label' => esc_html__('Title', 'coherence-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__('None', 'coherence-core'),
					'title' => esc_html__('Image Title', 'coherence-core'),
					'alt' => esc_html__('Image Alt', 'coherence-core'),
					'custom' => esc_html__('Custom Title', 'coherence-core'),
				],
				'default' => 'none',
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html('Text','coherence-core'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => esc_html__('Enter your image title', 'coherence-core'),
				'condition' => [
					'title_source' => 'custom',
				],

			]
		);

		$this->add_control(
			'caption_source',
			[
				'label' => esc_html__('Caption', 'coherence-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__('None', 'coherence-core'),
					'attachment' => esc_html__('Attachment Caption', 'coherence-core'),
					'custom' => esc_html__('Custom Caption', 'coherence-core'),
				],
				'default' => 'none',
			]
		);

		$this->add_control(
			'caption',
			[
				'label' => esc_html__('Text', 'coherence-core'),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => '',
				'placeholder' => esc_html__('Enter your image caption', 'coherence-core'),
				'condition' => [
					'caption_source' => 'custom',
				],
			]
		);

		$this->add_control(
			'link_to',
			[
				'label' => esc_html__('Link', 'coherence-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__('None', 'coherence-core'),
					'file' => esc_html__('Media File', 'coherence-core'),
					'custom' => esc_html__('Custom URL', 'coherence-core'),
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__('Link', 'coherence-core'),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'coherence-core'),
				'condition' => [
					'link_to' => 'custom',
				],
				'show_label' => false,
			]
		);

		$this->add_control(
			'open_lightbox',
			[
				'label' => esc_html__('Lightbox', 'coherence-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__('Default', 'coherence-core'),
					'yes' => esc_html__('Yes', 'coherence-core'),
					'no' => esc_html__('No', 'coherence-core'),
				],
				'condition' => [
					'link_to' => 'file',
				],
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

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__('Image', 'coherence-core'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__('Width', 'coherence-core'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => ['%', 'px', 'vw'],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} figure' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'space',
			[
				'label' => esc_html__('Max Width', 'coherence-core'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => ['%', 'px', 'vw'],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} figure' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => esc_html__('Height', 'coherence-core'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => ['px', 'vh'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} figure img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'object-fit',
			[
				'label' => esc_html__('Object Fit', 'coherence-core'),
				'type' => Controls_Manager::SELECT,
				'condition' => [
					'height[size]!' => '',
				],
				'options' => [
					'' => esc_html__('Default', 'coherence-core'),
					'fill' => esc_html__('Fill', 'coherence-core'),
					'cover' => esc_html__('Cover', 'coherence-core'),
					'contain' => esc_html__('Contain', 'coherence-core'),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} figure img' => 'object-fit: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'separator_panel_style',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs('image_effects');

		$this->start_controls_tab(
			'normal',
			[
				'label' => esc_html__('Normal', 'coherence-core'),
			]
		);

		$this->add_control(
			'opacity',
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
					'{{WRAPPER}} figure img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} figure img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover',
			[
				'label' => esc_html__('Hover', 'coherence-core'),
			]
		);

		$this->add_control(
			'opacity_hover',
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
					'{{WRAPPER}} figure:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->additional_controls_style_image_hover();

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}}  figure:hover img',
			]
		);

		$this->add_control(
			'background_hover_transition',
			[
				'label' => esc_html__('Transition Duration', 'coherence-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  figure img' => 'transition-duration: {{SIZE}}s',
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

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} img',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__('Border Radius', 'coherence-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}}  figure img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}}  figure img',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_caption',
			[
				'label' => esc_html__('Caption', 'coherence-core'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'caption_source!' => 'none',
				],
			]
		);

		$this->add_responsive_control(
			'caption_align',
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
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .coherence-figure figcaption .image-caption' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__('Text Color', 'coherence-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .coherence-figure figcaption .image-caption' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typography',
				'selector' => '{{WRAPPER}} .coherence-figure figcaption .image-caption',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'caption_text_shadow',
				'selector' => '{{WRAPPER}} .coherence-figure figcaption .image-caption',
			]
		);

		$this->add_responsive_control(
			'caption_margin',
			[
				'label' => esc_html__('Margin', 'coherence-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .coherence-figure figcaption .image-caption' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'caption_padding',
			[
				'label' => esc_html__('Padding', 'coherence-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .coherence-figure figcaption .image-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->title_style();

		$this->animation_widget_image_section();
	}

	public function title_style(){

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__('Title', 'coherence-core'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'title_source!' => 'none',
				],
			]
		);

		$this->add_responsive_control(
			'title_align',
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
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .coherence-figure figcaption .image-title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Title Color', 'coherence-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .coherence-figure figcaption .image-title' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .coherence-figure figcaption .image-title',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .coherence-figure figcaption .image-title',
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Margin', 'coherence-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .coherence-figure figcaption .image-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Padding', 'coherence-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .coherence-figure figcaption .image-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public function animation_widget_image_section() {
		$this->start_controls_section(
			'section_style_animation',
			[
				'label' => esc_html__('Animation', 'coherence-core'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'animation_class',
			[
				'label' => __('Select Animation', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'default' => 'imghvr-fade',
				'options' => [
					'imghvr-fade' => __('Fade', 'coherence-core'),
					'imghvr-push-up' => __('Push up', 'coherence-core'),
					'imghvr-push-down' => __('Push down', 'coherence-core'),
					'imghvr-push-left' => __('Push left', 'coherence-core'),
					'imghvr-push-right' => __('Push right', 'coherence-core'),
					'imghvr-slide-up' => __('Slide up', 'coherence-core'),
					'imghvr-slide-down' => __('Slide down', 'coherence-core'),
					'imghvr-slide-left' => __('Slide left', 'coherence-core'),
					'imghvr-slide-right' => __('Slide right', 'coherence-core'),
					'imghvr-reveal-up' => __('Reveal up', 'coherence-core'),
					'imghvr-reveal-down' => __('Reveal down', 'coherence-core'),
					'imghvr-reveal-left' => __('Reveal left', 'coherence-core'),
					'imghvr-reveal-right' => __('Reveal right', 'coherence-core'),
					'imghvr-hinge-up' => __('Hinge up', 'coherence-core'),
					'imghvr-hinge-down' => __('Hinge down', 'coherence-core'),
					'imghvr-hinge-left' => __('Hinge left', 'coherence-core'),
					'imghvr-hinge-right' => __('Hinge right', 'coherence-core'),
					'imghvr-flip-horiz' => __('Flip Horiz', 'coherence-core'),
					'imghvr-flip-vert' => __('Flip Vert', 'coherence-core'),
					'imghvr-flip-diag-1' => __('Flip Diag 1', 'coherence-core'),
					'imghvr-flip-diag-2' => __('Flip Diag 2', 'coherence-core'),
					'imghvr-shutter-out-horiz' => __('Shutter out horiz', 'coherence-core'),
					'imghvr-shutter-out-vert' => __('Shutter out vert', 'coherence-core'),
					'imghvr-shutter-out-diag-1' => __('Shutter out diag 1', 'coherence-core'),
					'imghvr-shutter-out-diag-2' => __('Shutter out diag 2', 'coherence-core'),
					'imghvr-shutter-in-horiz' => __('Shutter in horiz', 'coherence-core'),
					'imghvr-shutter-in-vert' => __('Shutter in vert', 'coherence-core'),
					'imghvr-shutter-in-out-horiz' => __('Shutter in out horiz', 'coherence-core'),
					'imghvr-shutter-in-out-vert' => __('Shutter in out vert', 'coherence-core'),
					'imghvr-shutter-in-out-diag-1' => __('Shutter in out diag 1', 'coherence-core'),
					'imghvr-shutter-in-out-diag-2' => __('Shutter in out diag 2', 'coherence-core'),
					'imghvr-fold-up' => __('Fold up', 'coherence-core'),
					'imghvr-fold-down' => __('Fold down', 'coherence-core'),
					'imghvr-fold-left' => __('Fold left', 'coherence-core'),
					'imghvr-fold-right' => __('Fold right', 'coherence-core'),
					'imghvr-zoom-in' => __('Zoom in', 'coherence-core'),
					'imghvr-zoom-out' => __('Zoom out', 'coherence-core'),
					'imghvr-zoom-out-up' => __('Zoom out up', 'coherence-core'),
					'imghvr-zoom-out-down' => __('Zoom out down', 'coherence-core'),
					'imghvr-zoom-out-left' => __('Zoom out left', 'coherence-core'),
					'imghvr-zoom-out-right' => __('Zoom out right', 'coherence-core'),
					'imghvr-zoom-out-flip-horiz' => __('Zoom out flip horiz', 'coherence-core'),
					'imghvr-zoom-out-flip-vert' => __('Zoom out flip vert', 'coherence-core'),
					'imghvr-blur' => __('imghvr blur', 'coherence-core'),
				]
			]
		);

		$this->end_controls_section();
	}

	public function additional_controls_style_image_hover()
	{

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_hover',
				'types' => ['classic','gradient'],
				'selector' => '
				{{WRAPPER}} figure:after, {{WRAPPER}} figure:before,
				{{WRAPPER}} figure[class^=imghvr-] figcaption,
				{{WRAPPER}} figure[class*=" imghvr-"] figcaption,
				{{WRAPPER}} figure[class^=imghvr-],
				{{WRAPPER}} figure[class*=" imghvr-"]',
			]
		);

		$this->add_control(
			'opacity_background',
			[
				'label' => esc_html__('Opacity Background', 'coherence-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} figure:after' => 'opacity: {{SIZE}};',
					'{{WRAPPER}} figure:before' => 'opacity: {{SIZE}};',
					//'{{WRAPPER}} figure[class^=imghvr-]:hover figcaption' => 'opacity: {{SIZE}};',
					//'{{WRAPPER}} figure[class*=" imghvr-"]:hover figcaption' => 'opacity: {{SIZE}};',
					//'{{WRAPPER}} figure[class^=imghvr-]:hover' => 'opacity: {{SIZE}};' ,
					//'{{WRAPPER}} figure[class*=" imghvr-"]:hover' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'heading_icon',
			[
				'label' => esc_html__('Icon', 'coherence-core'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_icon',
			[
				'label' => esc_html__('Show', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'coherence-core'),
				'label_off' => esc_html__('No', 'coherence-core'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__('Icon', 'coherence-core'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
				'condition' => [
					'show_icon' => 'yes'
				]
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'coherence-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .section-icon svg path' => 'fill: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);
		
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__('Taille', 'coherence-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 15,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section-icon svg' => 'font-size : {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_icon' => 'yes'
				]
			]
		);


		$this->add_responsive_control(
			'rotate',
			[
				'label' => esc_html__('Rotate', 'coherence-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['deg', 'grad', 'rad', 'turn'],
				'default' => [
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .section-icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
				'condition' => [
					'show_icon' => 'yes'
				],
				'separator' => 'after',
			]
		);
	}

	/**
	 * Check if the current widget has caption
	 *
	 * @access private
	 * @since 2.3.0
	 *
	 * @param array $settings
	 *
	 * @return boolean
	 */
	private function has_caption($settings)
	{
		return (!empty($settings['caption_source']) && 'none' !== $settings['caption_source']);
	}

	/**
	 * Check if the current image animation class
	 * 
	 * @access private
	 * 
	 * @param array $settings
	 * 
	 * @return string
	 */

	 private function animation_class($settings) {
		return (!empty($settings['animation_class']) && 'none' !== $settings['animation_class']) ? $settings['animation_class'] : '';
	 }

	/**
	 * Get the caption for current widget.
	 *
	 * @access private
	 * @since 2.3.0
	 * @param $settings
	 *
	 * @return string
	 */
	private function get_caption($settings)
	{
		$caption = '';
		if (!empty($settings['caption_source'])) {
			switch ($settings['caption_source']) {
				case 'attachment':
					$caption = wp_get_attachment_caption($settings['image']['id']);
					break;
				case 'custom':
					$caption = !Utils::is_empty($settings['caption']) ? $settings['caption'] : '';
			}
		}
		return $caption;
	}

	/**
	 * Check if the current widget has title
	 *
	 * @access private
	 *
	 * @param array $settings
	 *
	 * @return boolean
	 */
	private function has_title($settings)
	{
		return (!empty($settings['title_source']) && 'none' !== $settings['title_source']);
	}

	/**
	 * Get the Title for current image.
	 *
	 * @access private
	 * @param $settings
	 *
	 * @return string
	 */
	private function get_title_image($settings)
	{
		$text = '';
		if (!empty($settings['title_source'])) {
			$id = $settings['image']['id'] ; 
			switch ($settings['title_source']) {
				case 'title':
					$text = get_the_title($id);
					break;
				case 'alt':
					$text =get_post_meta($id, '_wp_attachment_image_alt', true);
					break;
				case 'custom':
					$text = !Utils::is_empty($settings['title']) ? $settings['title'] : '';
			}
		}
		return $text;
	}

	/**
	 * Render image widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		if (empty($settings['image']['url'])) {
			return;
		}

		if (!Plugin::$instance->experiments->is_feature_active('e_dom_optimization')) {
			$this->add_render_attribute('wrapper', 'class', 'elementor-image');
		}

		$has_caption = $this->has_caption($settings);
		$has_title = $this->has_title($settings);

		$link = $this->get_link_url($settings);

		if ($link) {
			$this->add_link_attributes('link', $link);

			if (Plugin::$instance->editor->is_edit_mode()) {
				$this->add_render_attribute('link', [
					'class' => 'elementor-clickable',
				]);
			}

			if ('custom' !== $settings['link_to']) {
				$this->add_lightbox_data_attributes('link', $settings['image']['id'], $settings['open_lightbox']);
			}
		} ?>
		<?php if (!Plugin::$instance->experiments->is_feature_active('e_dom_optimization')) { ?>
			<div <?php $this->print_render_attribute_string('wrapper'); ?>>
			<?php } ?>
			
			<figure class="coherence-figure  <?php echo $this->animation_class($settings); ?>">
				<?php Group_Control_Image_Size::print_attachment_image_html($settings); ?>
					<figcaption class="widget-image-caption coherence-figure-text">
						<div class="content">
							<div class="section-icon">
								<?php
									if ($settings['show_icon'] === 'yes') {
										echo '<i class="fa '.$settings['selected_icon']['value'].'"></i>';
									}
								?>
							</div>
							<?php
								if($has_title) {
									echo '<div class="image-title">'.wp_kses_post($this->get_title_image($settings)).'</div>';
								}
								if ($has_caption) {
									echo '<p class="image-caption">'. wp_kses_post($this->get_caption($settings)).'</p>';
								}
							?>
						</div>
					</figcaption>
				<?php if ($link) : ?>
					<a <?php $this->print_render_attribute_string('link'); ?>></a>
				<?php endif; ?>
			</figure>
			<?php if (!Plugin::$instance->experiments->is_feature_active('e_dom_optimization')) { ?>
			</div>
		<?php } ?>
<?php
	}

		/**
	 * Render image widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() {
		?>
		<# if ( settings.image.url ) {
			var image = {
				id: settings.image.id,
				url: settings.image.url,
				size: settings.image_size,
				dimension: settings.image_custom_dimension,
				model: view.getEditModel()
			};

			var image_url = elementor.imagesManager.getImageUrl( image );

			if ( ! image_url ) {
				return;
			}

			var hasCaption = function() {
				if( ! settings.caption_source || 'none' === settings.caption_source ) {
					return false;
				}
				return true;
			}

			var hasTitle = function() {
				if( ! settings.title_source || 'none' === settings.title_source ) {
					return false;
				}
				return true;
			}

			var ensureAttachmentData = function( id , attr) {
				if ( 'undefined' === typeof wp.media.attachment( id ).get(attr) ) {
					wp.media.attachment( id ).fetch().then( function( data ) {
						view.render();
					} );
				}
			}

			var getAttachment = function( id , attrValue) {
				if ( ! id  || !attrValue) {
					return '';
				}
				ensureAttachmentData( id , attrValue);
				return wp.media.attachment( id ).get(attrValue);
			}

			var getCaption = function() {
				if ( ! hasCaption() ) {
					return '';
				}
				return 'custom' === settings.caption_source ? settings.caption : getAttachment( settings.image.id , 'caption');
			}

			var getTitle = function() {
				if ( ! hasTitle() ) {
					return '';
				}

				if('custom' === settings.title_source) {
					return settings.title;
				}else if('alt' === settings.title_source) {
					return  getAttachment( settings.image.id , 'alt');
				}else{
					return  getAttachment( settings.image.id , 'title');
				}
			}

			var link_url;

			if ( 'custom' === settings.link_to ) {
				link_url = settings.link.url;
			}

			if ( 'file' === settings.link_to ) {
				link_url = settings.image.url;
			}

			<?php if ( ! Plugin::$instance->experiments->is_feature_active( 'e_dom_optimization' ) ) { ?>
				#><div class="elementor-image{{ settings.shape ? ' elementor-image-shape-' + settings.shape : '' }}"><#
			<?php } ?>

			var imgClass = '' , figureClass;

			if ( '' !== settings.hover_animation ) {
				imgClass = 'elementor-animation-' + settings.hover_animation;
			}

			if ( '' !== settings.animation_class ) {
				figureClass = settings.animation_class;
			}

			#>
			<figure class="coherence-figure  {{figureClass}}">
				<img src="{{ image_url }}" class="{{ imgClass }}" />
				<figcaption class="widget-image-caption coherence-figure-text">
					<div class="content">
						<div class="section-icon">
							<# if(settings.show_icon === 'yes' && settings.selected_icon.value !== '') { 
								#><i class="fa {{settings.selected_icon.value}}"></i><#
							} #>
						</div>
						
						<div class="image-title">
							{{{ getTitle() }}}
						</div>

						<# if ( hasCaption() ) {
							#><p class="image-caption">{{{ getCaption() }}}</p><#
						} #>
					</div>
				</figcaption>
				<# if ( link_url ) {
					#><a class="elementor-clickable" data-elementor-open-lightbox="{{ settings.open_lightbox }}" href="{{ link_url }}"><#
				}#>
			</figure>
		<#

			<?php if ( ! Plugin::$instance->experiments->is_feature_active( 'e_dom_optimization' ) ) { ?>
				#></div><#
			<?php } ?>

		} #>
		<?php
	}


	/**
	 * Retrieve image widget link URL.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param array $settings
	 *
	 * @return array|string|false An array/string containing the link URL, or false if no link.
	 */
	private function get_link_url($settings)
	{
		if ('none' === $settings['link_to']) {
			return false;
		}

		if ('custom' === $settings['link_to']) {
			if (empty($settings['link']['url'])) {
				return false;
			}

			return $settings['link'];
		}

		return [
			'url' => $settings['image']['url'],
		];
	}
}
Plugin::instance()->widgets_manager->register(new Coherence_Image_Widget());
