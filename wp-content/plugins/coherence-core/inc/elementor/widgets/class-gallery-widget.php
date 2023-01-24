<?php
namespace Elementor;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor image gallery widget.
 *
 * Elementor widget that displays a set of images in an aligned grid.
 *
 * @since 1.0.0
 */
class Coherence_Gallery_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve image gallery widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'image-gallery';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve image gallery widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Gallery', 'coherence-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve image gallery widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return ' eicon-gallery-masonry';
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
	public function get_keywords() {
		return [ 'image', 'photo', 'visual', 'gallery' ];
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
	 * Register image gallery widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_gallery',
			[
				'label' => esc_html__( 'Image Gallery', 'coherence-core' ),
			]
		);

		$this->add_control(
			'wp_gallery',
			[
				'label' => esc_html__( 'Add Images', 'coherence-core' ),
				'type' => Controls_Manager::GALLERY,
				'show_label' => false,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [ 'custom' ],
				'separator' => 'none',
			]
		);

		$this->add_control(
			'autoHeight',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => __( 'Auto-Height', 'coherence-core' ),
				'default' => 'yes',
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => esc_html__('Height', 'coherence-core'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => 200,
				],
				'size_units' => ['px', 'vh'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 650,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-item img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'autoHeight' => '',
				]
			]
		);

		$this->add_control(
			'object_fit',
			[
				'label' => esc_html__( 'Object Fit', 'coherence-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'cover' => esc_html__( 'Cover', 'coherence-core' ),
					'contain' => esc_html__( 'contain', 'coherence-core' ),
					'fill' => esc_html__( 'fill', 'coherence-core' ),
					'inherit' => esc_html__( 'Inherit', 'coherence-core' ),
					'initial' => esc_html__( 'Initial', 'coherence-core' ),
					'none' => esc_html__( 'None', 'coherence-core' ),
					'revert' => esc_html__( 'Revert', 'coherence-core' ),
					'scale-down' => esc_html__( 'Scale Down', 'coherence-core' ),
					'unset' => esc_html__( 'Unset', 'coherence-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-item img' => 'object-fit: {{VALUE}};',
				],
				'condition' => [
					'autoHeight' => '',
				]
			]
		);

		$gallery_columns = range( 1, 10 );
		$gallery_columns = array_combine( $gallery_columns, $gallery_columns );

		$this->add_control(
			'gallery_columns',
			[
				'label' => esc_html__( 'Columns', 'coherence-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 4,
				'options' => $gallery_columns,
			]
		);

		$this->add_control(
			'gallery_link',
			[
				'label' => esc_html__( 'Link', 'coherence-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'file' => esc_html__( 'Media File', 'coherence-core' ),
					'attachment' => esc_html__( 'Attachment Page', 'coherence-core' ),
					'none' => esc_html__( 'None', 'coherence-core' ),
				],
			]
		);

		$this->add_control(
			'open_lightbox',
			[
				'label' => esc_html__( 'Lightbox', 'coherence-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'default' => esc_html__( 'Default', 'coherence-core' ),
					'yes' => esc_html__( 'Yes', 'coherence-core' ),
					'no' => esc_html__( 'No', 'coherence-core' ),
				],
				'condition' => [
					'gallery_link' => 'file',
				],
			]
		);

		$this->add_control(
			'gallery_rand',
			[
				'label' => esc_html__( 'Order By', 'coherence-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Default', 'coherence-core' ),
					'rand' => esc_html__( 'Random', 'coherence-core' ),
				],
				'default' => '',
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

		$this->end_controls_section();

		$this->start_controls_section(
			'section_gallery_images',
			[
				'label' => esc_html__( 'Images', 'coherence-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_spacing',
			[
				'label' => esc_html__( 'Spacing', 'coherence-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Default', 'coherence-core' ),
					'custom' => esc_html__( 'Custom', 'coherence-core' ),
				],
				'prefix_class' => 'gallery-spacing-',
				'default' => '',
			]
		);

		$columns_margin = is_rtl() ? '0 0 -{{SIZE}}{{UNIT}} -{{SIZE}}{{UNIT}};' : '0 -{{SIZE}}{{UNIT}} -{{SIZE}}{{UNIT}} 0;';
		$columns_padding = is_rtl() ? '0 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}};' : '0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0;';

		$this->add_control(
			'image_spacing_custom',
			[
				'label' => esc_html__( 'Image Spacing', 'coherence-core' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => false,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-item' => 'padding:' . $columns_padding,
					'{{WRAPPER}} .gallery' => 'margin: ' . $columns_margin,
				],
				'condition' => [
					'image_spacing' => 'custom',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .gallery-item img',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'coherence-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .gallery-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_caption',
			[
				'label' => esc_html__( 'Caption', 'coherence-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'gallery_display_caption',
			[
				'label' => esc_html__( 'Display', 'coherence-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'show' => esc_html__( 'Show', 'coherence-core' ),
					'show-on-hover' => esc_html__( 'Show on Hover', 'coherence-core' ),
					'none' => esc_html__( 'Hide', 'coherence-core' ),
				],
				'prefix_class' => 'gallery-type-',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .gallery-item .gallery-caption' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'gallery_display_caption!' => 'none',
				],
			]
		);

		$this->add_responsive_control(
			'caption_padding',
			[
				'label' => esc_html__('Caption Padding', 'coherence-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .gallery-item .gallery-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'gallery_display_caption!' => 'none',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'coherence-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gallery-item .gallery-caption' => 'color: {{VALUE}};',
				],
				'condition' => [
					'gallery_display_caption!' => 'none',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .gallery-item .gallery-caption',
				'condition' => [
					'gallery_display_caption!' => 'none',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'caption_shadow',
				'selector' => '{{WRAPPER}} .gallery-item .gallery-caption',
				'condition' => [
					'gallery_display_caption!' => 'none',
				],
			]
		);

		$this->add_control(
			'on_hover',
			[
				'label' => esc_html__( 'On Hover', 'coherence-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'gallery_display_caption' => 'show-on-hover',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_figure',
				'types' => ['classic','gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .gallery-item .gallery-caption',
				'condition' => [
					'gallery_display_caption' => 'show-on-hover',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render image gallery widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( ! $settings['wp_gallery'] ) {
			return;
		}

		$ids = wp_list_pluck( $settings['wp_gallery'], 'id' );

		$this->add_render_attribute( 'shortcode', 'ids', implode( ',', $ids ) );
		$this->add_render_attribute( 'shortcode', 'size', $settings['thumbnail_size'] );

		if ( $settings['gallery_columns'] ) {
			$this->add_render_attribute( 'shortcode', 'columns', $settings['gallery_columns'] );
		}

		if ( $settings['gallery_link'] ) {
			$this->add_render_attribute( 'shortcode', 'link', $settings['gallery_link'] );
		}

		if ( ! empty( $settings['gallery_rand'] ) ) {
			$this->add_render_attribute( 'shortcode', 'orderby', $settings['gallery_rand'] );
		}
		?>
		<div class="elementor-image-gallery">
			<?php
			add_filter( 'wp_get_attachment_link', [ $this, 'add_lightbox_data_to_image_link' ], 10, 2 );

			echo do_shortcode( '[gallery ' . $this->get_render_attribute_string( 'shortcode' ) . ']' );

			remove_filter( 'wp_get_attachment_link', [ $this, 'add_lightbox_data_to_image_link' ] );
			?>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register(new Coherence_Gallery_Widget());