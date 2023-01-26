<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

use Elementor\Widget_Base;
use Elementor\Core\Schemes\Typography;

/**
 * Elementor Feature List widget.
 *
 * Elementor widget that displays an Feature List into the page.
 *
 * @since 1.0.0
 */
class Coherence_Feature_List_Widget extends Widget_Base
{
	public function get_name() {
		return 'coherence-feature-list';
	}

	public function get_title() {
		return esc_html__( 'Feature List', 'coherence-core' );
	}

	public function get_icon() {
		return 'eicon-editor-list-ul';
	}

	public function get_categories() {
		return ['coherence_widgets'];
	}

	public function get_keywords() {
		return ['coherence feature list','features','feature list','icon list' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_feature_list_general',
			[
				'label' => esc_html__( 'General', 'coherence-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'list_layout',
			[
				'label' => esc_html__( 'Layout', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'left',
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
					]
				],
				'prefix_class' => 'coherence-feature-list-',
				'render_type' => 'template',
				'selectors' => [
					'{{WRAPPER}} .coherence-feature-list-item' => 'justify-content: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_vertical_align',
			[
				'label' => esc_html__( 'Vertical Align', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'center',
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Top', 'coherence-core' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Middle', 'coherence-core' ),
						'icon' => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => esc_html__( 'Bottom', 'coherence-core' ),
						'icon' => 'eicon-v-align-bottom',
					]
				],
				'render_type' => 'template',
				'selectors' => [
					'{{WRAPPER}}.coherence-feature-list-left .coherence-feature-list-item' => 'align-items: {{VALUE}}',
					'{{WRAPPER}}.coherence-feature-list-right .coherence-feature-list-item' => 'align-items: {{VALUE}}'
				],
				'condition' => [
					'list_layout!' => 'center', 
				]
			]
		);

		$this->add_control(
			'feature_list_content_alignment',
			[
				'label' => esc_html__( 'Alignment', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start'	=> [
						'title' => esc_html__( 'Left', 'coherence-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'coherence-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => esc_html__( 'Right', 'coherence-core' ),
						'icon' => 'eicon-text-align-right',
					]
				],
				'prefix_class' => 'coherence-feature-list-align-',
				'render_type' => 'template',
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .coherence-feature-list-item' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'list_layout' => 'center', 
				]
			]
		);

		$this->add_control(
			'feature_list_icon_shape',
			[
				'label'	   => esc_html__( 'Icon Shape', 'coherence-core' ),
				'type'		=> \Elementor\Controls_Manager::SELECT,
				'default'	 => 'square',
				'label_block' => false,
				'options'	 => [
					'square'  => esc_html__( 'Square', 'coherence-core' ),
					'rhombus' => esc_html__( 'Rhombus', 'coherence-core' )
				],
				'separator' => 'before',
				'prefix_class' => 'coherence-feature-list-'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'large',
			]
		);

		$this->add_control(
			'feature_list_title_tag',
			[
				'label' => esc_html__( 'Title HTML Tag', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'P' => 'p'
				],
				'default' => 'h2'
			]
		);

		$this->add_control(
			'feature_list_line',
			[
				'label' => esc_html__( 'Show Line', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'render_type' => 'template',
				'prefix_class' => 'coherence-feature-list-line-',
				'separator' => 'before',
				'default' => 'yes',
				'condition' => [
					'list_layout' => ['left', 'right']
				]
			]
		);

		$this->add_responsive_control(
			'list_item_spacing',
			[
				'label' => esc_html__('Spacing', 'coherence-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default' => [
					'top' => '15',
					'right' => '15',
					'bottom' => '15',
					'left' => '15',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-coherence-feature-list .coherence-feature-list-icon-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'render_type' => 'template',
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'list_item_title_distance',
			[
				'label' => esc_html__( 'Title Distance', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .coherence-feature-list-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'render_type' => 'template'
			]
		);

		$this->add_control(
			'list_item_media_distance',
			[
				'label' => esc_html__( 'Media Distance', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .coherence-feature-list-icon-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'list_layout' => 'center'
				] 
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content','coherence-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->start_controls_tabs(
			'list_tabs'
		);

		$repeater->start_controls_tab(
			'content_tab',
			[
				'label' => __('Content', 'coherence-core'),
			]
		);

		$repeater->add_control(
			'feature_list_media_type',
			[
				'label'	   => esc_html__('Media Type', 'coherence-core'),
				'type'		=> \Elementor\Controls_Manager::SELECT,
				'options'	 => [
					'icon' => esc_html__('Icon', 'coherence-core'),
					'image' => esc_html__('Image', 'coherence-core'),
				],
				'default'	 => 'icon',
				'label_block' => false,
			]
		);

		$repeater->add_control(
			'list_icon',
			[
				'label' => esc_html__( 'Select Icon', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				'label_block' => false,
				'skin' => 'inline',
				'condition' => [
					'feature_list_media_type' => 'icon'
				]
			]
		);

		$repeater->add_control(
			'list_image',
			[
				'label' => esc_html__( 'Choose Image', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'skin' => 'inline',
				'condition' => [
					'feature_list_media_type' => 'image'
				]
			]
		);

		$repeater->add_control(
			'list_title', [
				'label' => esc_html__( 'Title', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'coherence-core' ),
				'separator' => 'before',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_title_url',
			[
				'label' => esc_html__('Title Link','coherence-core'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'coherence-core' ),
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_content',
			[
				'label' => esc_html__('Content','coherence-core'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'List Content', 'coherence-core' ),
				'placeholder' => esc_html__( 'Type your description here', 'coherence-core' ),
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'styles_tab',
			[
				'label' => __( 'Style', 'coherence-core' ),
			]
		);

		$repeater->add_control(
			'feature_list_custom_styles',
			[
				'label' => esc_html__( 'Custom Styles', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$repeater->add_control(
			'feature_list_title_color_unique',
			[
				'label' => esc_html__( 'Title Color', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .coherence-feature-list-title a.coherence-feature-list-url' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .coherence-feature-list-title' => 'color: {{VALUE}}'
				],
				'condition' => [
					'feature_list_custom_styles' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'feature_list_description_color',
			[
				'label'  => esc_html__( 'Description Color', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .coherence-feature-list-description' => 'color: {{VALUE}}',
				],
                'condition' => [
					'feature_list_custom_styles' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'feature_list_icon_color_unique',
			[
				'label'  => esc_html__( 'Icon Color', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .coherence-feature-list-icon-inner-wrap i' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .coherence-feature-list-icon-inner-wrap svg path' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'feature_list_custom_styles' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'feature_list_icon_wrapper_bg_color_unique',
			[
				'label'  => esc_html__( 'Icon Bg Color', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#966CE6',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .coherence-feature-list-icon-inner-wrap' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'feature_list_custom_styles' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'feature_list_icon_wrapper_border_color_unique',
			[
				'label'  => esc_html__( 'Icon Border Color', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#6A65FF',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .coherence-feature-list-icon-inner-wrap' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'feature_list_custom_styles' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'custom_styles_hover_heading',
			[
				'label' => esc_html__('Hover Options', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
                'condition' => [
					'feature_list_custom_styles' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'feature_list_title_color_hover',
			[
				'label' => esc_html__( 'Title Color', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .coherence-feature-list-title a.coherence-feature-list-url:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .coherence-feature-list-title:hover' => 'color: {{VALUE}}'
				],
				'condition' => [
					'feature_list_custom_styles' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'feature_list_description_color_hover',
			[
				'label'  => esc_html__( 'Description Color Hover', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .coherence-feature-list-description:hover' => 'color: {{VALUE}}',
				],
                'condition' => [
					'feature_list_custom_styles' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'feature_list_icon_color_hover',
			[
				'label'  => esc_html__( 'Icon Color', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .coherence-feature-list-icon-inner-wrap:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .coherence-feature-list-icon-inner-wrap:hover svg path' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'feature_list_custom_styles' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'feature_list_icon_wrapper_bg_color_hover',
			[
				'label'  => esc_html__( 'Icon Bg Color', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .coherence-feature-list-icon-inner-wrap:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'feature_list_custom_styles' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'feature_list_icon_wrapper_border_color_hover',
			[
				'label'  => esc_html__( 'Icon Border Color', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .coherence-feature-list-icon-inner-wrap:hover' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'feature_list_custom_styles' => 'yes',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Repeater List', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => esc_html__( 'Feature List', 'coherence-core' ),
						'list_content' => esc_html__( 'Add multiple feature items, set different icons or images for each feature and also give custom links if needed.', 'coherence-core' ),
						'list_icon' => [
							'value' => 'fas fa-rocket',
							'library' => 'solid'
						],
					],
					[
						'list_title' => esc_html__( 'Custom Styles', 'coherence-core' ),
						'list_content' => esc_html__( 'Easily customize every aspect of your list from widget styles but also you can give custom colors to each item as well.', 'coherence-core' ),
						'list_icon' => [
							'value' => 'fas fa-paint-brush',
							'library' => 'solid'
						],
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_feature_list_icon_styles',
			[
				'label' => esc_html__( 'Media', 'coherence-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'feature_list_icon_color',
			[
				'label'  => esc_html__( 'Color', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .coherence-feature-list-icon-inner-wrap i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .coherence-feature-list-icon-inner-wrap svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'feature_list_icon_wrapper_bg_color',
			[
				'label'  => esc_html__( 'Background Color', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#6A65FF',
				'selectors' => [
					'{{WRAPPER}} .coherence-feature-list-icon-inner-wrap' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'feature_list_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 25,
				],
				'selectors' => [
					'{{WRAPPER}} .coherence-feature-list-icon-wrap i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .coherence-feature-list-icon-wrap svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'feature_list_icon_wrapper_size',
			[
				'label' => esc_html__( 'Box Size', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'render_type' => 'template',
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 75,
				],
				'selectors' => [
					'{{WRAPPER}} .coherence-feature-list-icon-inner-wrap' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}'
				]
			]
		);

		$this->add_control(
			'feature_list_icon_wrapper_border_type',
			[
				'label' => esc_html__( 'Border Type', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'None', 'coherence-core' ),
					'solid' => esc_html__( 'Solid', 'coherence-core' ),
					'double' => esc_html__( 'Double', 'coherence-core' ),
					'dotted' => esc_html__( 'Dotted', 'coherence-core' ),
					'dashed' => esc_html__( 'Dashed', 'coherence-core' ),
					'groove' => esc_html__( 'Groove', 'coherence-core' ),
				],
				'default' => 'none',
				'selectors' => [
					'{{WRAPPER}} .coherence-feature-list-icon-inner-wrap' => 'border-style: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'feature_list_icon_wrapper_border_color',
			[
				'label'  => esc_html__( 'Border Color', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .coherence-feature-list-icon-inner-wrap' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'feature_list_icon_wrapper_border_type!' => 'none',
				]
			]
		);

		$this->add_control(
			'feature_list_icon_wrapper_border_width',
			[
				'label' => esc_html__( 'Border Width', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'top' => 1,
					'right' => 1,
					'bottom' => 1,
					'left' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .coherence-feature-list-icon-inner-wrap' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'feature_list_icon_wrapper_border_type!' => 'none',
				]
			]
		);

		$this->add_control(
			'feature_list_icon_wrapper_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' , '%'],
				'default' => [
					'top' => 5,
					'right' => 5,
					'bottom' => 5,
					'left' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .coherence-feature-list-icon-inner-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_feature_list_line_styles',
			[
				'label' => esc_html__( 'Line', 'coherence-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'feature_list_line' => 'yes'
				]
			]
		);

		$this->add_control(
			'feature_list_line_color',
			[
				'label' => esc_html__( 'Color', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#6A65FF',
				'selectors' => [
					'{{WRAPPER}} .coherence-feature-list-line' => 'border-color: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'feature_list_line_width',
			[
				'label' => esc_html__( 'Width', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .coherence-feature-list-line' => 'border-left-width: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'feature_list_line_border_type',
			[
				'label'	   => esc_html__( 'Type', 'coherence-core' ),
				'type'		=> \Elementor\Controls_Manager::SELECT,
				'default'	 => 'solid',
				'label_block' => false,
				'options'	 => [
					'solid'  => esc_html__( 'Solid', 'coherence-core' ),
					'dashed' => esc_html__( 'Dashed', 'coherence-core' ),
					'dotted' => esc_html__( 'Dotted', 'coherence-core' ),
				],
				'selectors'   => [
					'{{WRAPPER}} .coherence-feature-list-line' => 'border-left-style: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_feature_list_title_&_description_styles',
			[
				'label' => esc_html__( 'Title & Description', 'coherence-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label' => esc_html__( 'Title', 'coherence-core' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'feature_list_title_color',
			[
				'label'  => esc_html__( 'Color', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .coherence-feature-list-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .coherence-feature-list-title a.coherence-feature-list-url' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'	 => 'feature_list_title',
				'scheme' => Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .coherence-feature-list-title',
				'fields_options' => [
					'typography' => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '500',
					],
					'font_family' => [
						'default' => 'Roboto',
					],
					'font_size'   => [
						'default' => [
							'size' => '20',
							'unit' => 'px',
						]
					]
				]
			]
		);

		$this->add_control(
			'description_heading',
			[
				'label' => esc_html__( 'Description', 'coherence-core' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'feature_list_description_color',
			[
				'label'  => esc_html__( 'Color', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#6E6B6B',
				'selectors' => [
					'{{WRAPPER}} .coherence-feature-list-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'	 => 'feature_list_description',
				'scheme' => Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .coherence-feature-list-description',
				'fields_options' => [
					'typography' => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_family' => [
						'default' => 'Roboto',
					],
					'font_size'   => [
						'default' => [
							'size' => '14',
							'unit' => 'px',
						]
					]
				]
			]
		);

		$this->end_controls_section();

		//List Style
		$this->section_list_style();
	}

	public function section_list_style() {

		$this->start_controls_section(
			'section_list_styles',
			[
				'label' => esc_html__( 'List', 'coherence-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
			Group_Control_Background::get_type(),
			[
				'name' => 'feature_list_list_background',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}}.elementor-widget-coherence-feature-list .coherence-feature-list-item',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}}.elementor-widget-coherence-feature-list .coherence-feature-list-item',
			]
		);

		$this->add_control(
			'feature_list_box',
			[
				'label' => esc_html__( 'Show Border List', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'render_type' => 'template',
				'separator' => 'before',
				'default' => 'no',
			]
		);

		$this->add_control(
			'feature_list_box_color',
			[
				'label' => esc_html__('Color', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#6A65FF',
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-coherence-feature-list .coherence-feature-list-item' => 'border-color: {{VALUE}}'
				],
				'condition' => [
					'feature_list_box' => 'yes'
				],
			]
		);

		$this->add_control(
			'feature_list_box_width',
			[
				'label' => esc_html__( 'Width', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-coherence-feature-list .coherence-feature-list-item' => 'border-width: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
				'condition' => [
					'feature_list_box' => 'yes'
				],
			]
		);

		$this->add_control(
			'feature_list_box_border_type',
			[
				'label'	   => esc_html__( 'Type', 'coherence-core' ),
				'type'		=> \Elementor\Controls_Manager::SELECT,
				'default'	 => 'solid',
				'label_block' => false,
				'options'	 => [
					'solid'  => esc_html__( 'Solid', 'coherence-core' ),
					'dashed' => esc_html__( 'Dashed', 'coherence-core' ),
					'dotted' => esc_html__( 'Dotted', 'coherence-core' ),
				],
				'selectors'   => [
					'{{WRAPPER}}.elementor-widget-coherence-feature-list .coherence-feature-list-item' => 'border-style: {{VALUE}};',
				],
				'condition' => [
					'feature_list_box' => 'yes'
				],
			]
		);

		$this->add_responsive_control(
			'list_spacing',
			[
				'label' => esc_html__('Margin', 'coherence-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default' => [
					'top' => '15',
					'right' => '15',
					'bottom' => '15',
					'left' => '15',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-coherence-feature-list .coherence-feature-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'render_type' => 'template',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'list_padding',
			[
				'label' => esc_html__('Padding', 'coherence-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default' => [
					'top' => '5',
					'right' => '5',
					'bottom' => '5',
					'left' => '5',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-coherence-feature-list .coherence-feature-list-item' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'render_type' => 'template',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'feature_list_items_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' , '%'],
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-coherence-feature-list .coherence-feature-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'feature_tab_hover',
			[
				'label' => esc_html__('Hover', 'coherence-core'),
			]
		);

		//HOVER CONTROLS HERE

		$this->add_control(
			'feature_list_box_background_hover',
			[
				'label'  => esc_html__( 'Background Color', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-coherence-feature-list .coherence-feature-list-item:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'feature_list_box_shadow_hover',
				'selector' => '{{WRAPPER}}.elementor-widget-coherence-feature-list .coherence-feature-list-item:hover',
			]
		);

		$this->add_control(
			'feature_list_box_color_hover',
			[
				'label' => esc_html__('Color', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-coherence-feature-list .coherence-feature-list-item:hover' => 'border-color: {{VALUE}}'
				],
				'condition' => [
					'feature_list_box' => 'yes'
				],
			]
		);

		$this->add_control(
			'feature_list_box_width_hover',
			[
				'label' => esc_html__( 'Width', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-coherence-feature-list .coherence-feature-list-item:hover' => 'border-width: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
				'condition' => [
					'feature_list_box' => 'yes'
				],
			]
		);

		$this->add_control(
			'feature_list_box_border_type_hover',
			[
				'label'	   => esc_html__( 'Type', 'coherence-core' ),
				'type'		=> \Elementor\Controls_Manager::SELECT,
				'default'	 => 'solid',
				'label_block' => false,
				'options'	 => [
					'solid'  => esc_html__( 'Solid', 'coherence-core' ),
					'dashed' => esc_html__( 'Dashed', 'coherence-core' ),
					'dotted' => esc_html__( 'Dotted', 'coherence-core' ),
				],
				'selectors'   => [
					'{{WRAPPER}}.elementor-widget-coherence-feature-list .coherence-feature-list-item:hover' => 'border-style: {{VALUE}};',
				],
				'condition' => [
					'feature_list_box' => 'yes'
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( $settings['list'] ) {
			$count_items = 0;
			echo '<div class="coherence-feature-list-wrap">';
				echo '<ul class="coherence-feature-list">';
					foreach (  $settings['list'] as $item ) {
						$this->add_link_attributes( 'list_title_url'. $count_items, $item['list_title_url'] );
						echo '<li class="coherence-feature-list-item elementor-repeater-item-' . esc_attr( $item['_id'] ) .'">';
							echo '<div class="coherence-feature-list-icon-wrap">';
							echo '<span class="coherence-feature-list-line"></span>';
								echo '<div class="coherence-feature-list-icon-inner-wrap">';
									if ( 'icon' === $item['feature_list_media_type'] ) {
										\Elementor\Icons_Manager::render_icon( $item['list_icon'], [ 'aria-hidden' => 'true' ] );
									} else {
										$src = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $item['list_image']['id'], 'thumbnail', $settings );
										echo '<img src="'. esc_url($src) .'">';
									}
								echo '</div>';
							echo '</div>';
							echo '<div class="coherence-feature-list-content-wrap">';
								if ( empty($item['list_title_url']) ) {
									echo '<'. esc_attr($settings['feature_list_title_tag']) .' class="coherence-feature-list-title">'. wp_kses_post($item['list_title']) .'</'. esc_attr($settings['feature_list_title_tag']) .'>';
								} else {
									echo '<'. esc_attr($settings['feature_list_title_tag']) .' class="coherence-feature-list-title"><a class="coherence-feature-list-url" '. $this->get_render_attribute_string( 'list_title_url'. $count_items ) .'>'. wp_kses_post($item['list_title']) .'</a></'. esc_attr($settings['feature_list_title_tag']) .'>';
								}
								echo '<p class="coherence-feature-list-description">'. wp_kses_post($item['list_content']) .'</p>';
							echo '</div>';
						echo '</li>';
						$count_items++;
					}
				echo '</ul>';
			echo '</div>';
		}
	}

}
Plugin::instance()->widgets_manager->register(new Coherence_Feature_List_Widget());
