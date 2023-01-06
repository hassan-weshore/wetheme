<?php

/**
 * Elementor Widget Logo
 * @package Coherence
 * @since 1.0.0
 */

use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Plugin;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * Coherence Core Site Logo widget
 *
 * Coherence Core widget for Site Logo.
 *
 * @since 1.3.0
 */
class Coherence_Logo_Widget extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'logo';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Site Logo', 'coherence-core' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-logo';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'coherence_widgets' ];
	}

	/**
	 * Register Site Logo controls.
	 *
	 * @since 1.5.7
	 * @access protected
	 */
	protected function register_controls() {
		$this->register_content_site_logo_controls();
		$this->register_site_logo_styling_controls();
		$this->register_site_logo_caption_styling_controls();
	}

	/**
	 * Register Site Logo General Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_content_site_logo_controls() {
		$this->start_controls_section(
			'section_site_image',
			[
				'label' => __( 'Site Logo', 'coherence-core' ),
			]
		);

		$this->add_control(
			'site_logo_fallback',
			[
				'label'       => __( 'Custom Image', 'coherence-core' ),
				'type'        => Controls_Manager::SWITCHER,
				'yes'         => __( 'Yes', 'coherence-core' ),
				'no'          => __( 'No', 'coherence-core' ),
				'default'     => 'no',
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'custom_image',
			[
				'label'     => __( 'Add Image', 'coherence-core' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => [
					'active' => true,
				],
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'site_logo_fallback' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'site_logo_size',
				'label'   => __( 'Image Size', 'coherence-core' ),
				'default' => 'medium',
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label'              => __( 'Alignment', 'coherence-core' ),
				'type'               => Controls_Manager::CHOOSE,
				'options'            => [
					'left'   => [
						'title' => __( 'Left', 'coherence-core' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'coherence-core' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'coherence-core' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'            => 'center',
				'selectors'          => [
					'{{WRAPPER}} .coherence-core-site-logo-container, {{WRAPPER}} .coherence-core-caption-width figcaption' => 'text-align: {{VALUE}};',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'caption_source',
			[
				'label'   => __( 'Caption', 'coherence-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'no'  => __( 'No', 'coherence-core' ),
					'yes' => __( 'Yes', 'coherence-core' ),
				],
				'default' => 'no',
			]
		);

		$this->add_control(
			'caption',
			[
				'label'       => __( 'Custom Caption', 'coherence-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( 'Enter caption', 'coherence-core' ),
				'condition'   => [
					'caption_source' => 'yes',
				],
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'link_to',
			[
				'label'   => __( 'Link', 'coherence-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'coherence-core' ),
					'none'    => __( 'None', 'coherence-core' ),
					'file'    => __( 'Media File', 'coherence-core' ),
					'custom'  => __( 'Custom URL', 'coherence-core' ),
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label'       => __( 'Link', 'coherence-core' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'coherence-core' ),
				'condition'   => [
					'link_to' => 'custom',
				],
				'show_label'  => false,
			]
		);

		$this->add_control(
			'open_lightbox',
			[
				'label'     => __( 'Lightbox', 'coherence-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => [
					'default' => __( 'Default', 'coherence-core' ),
					'yes'     => __( 'Yes', 'coherence-core' ),
					'no'      => __( 'No', 'coherence-core' ),
				],
				'condition' => [
					'link_to' => 'file',
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label'   => __( 'View', 'coherence-core' ),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);
		$this->end_controls_section();
	}
	/**
	 * Register Site Image Style Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_site_logo_styling_controls() {
		$this->start_controls_section(
			'section_style_site_logo_image',
			[
				'label' => __( 'Site logo', 'coherence-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label'              => __( 'Width', 'coherence-core' ),
				'type'               => Controls_Manager::SLIDER,
				'default'            => [
					'unit' => '%',
				],
				'tablet_default'     => [
					'unit' => '%',
				],
				'mobile_default'     => [
					'unit' => '%',
				],
				'size_units'         => [ '%', 'px', 'vw' ],
				'range'              => [
					'%'  => [
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
				'selectors'          => [
					'{{WRAPPER}} .coherence-core-site-logo .coherence-core-site-logo-container img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'space',
			[
				'label'              => __( 'Max Width', 'coherence-core' ) . ' (%)',
				'type'               => Controls_Manager::SLIDER,
				'default'            => [
					'unit' => '%',
				],
				'tablet_default'     => [
					'unit' => '%',
				],
				'mobile_default'     => [
					'unit' => '%',
				],
				'size_units'         => [ '%' ],
				'range'              => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .coherence-core-site-logo img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'separator_panel_style',
			[
				'type'  => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_control(
			'site_logo_background_color',
			[
				'label'     => __( 'Background Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .coherence-core-site-logo-set .coherence-core-site-logo-container' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'site_logo_image_border',
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
					'{{WRAPPER}} .coherence-core-site-logo-container .coherence-core-site-logo-img' => 'border-style: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'site_logo_image_border_size',
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
					'site_logo_image_border!' => 'none',
				],
				'selectors'  => [
					'{{WRAPPER}} .coherence-core-site-logo-container .coherence-core-site-logo-img' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'site_logo_image_border_color',
			[
				'label'     => __( 'Border Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'condition' => [
					'site_logo_image_border!' => 'none',
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .coherence-core-site-logo-container .coherence-core-site-logo-img' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label'              => __( 'Border Radius', 'coherence-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%' ],
				'selectors'          => [
					'{{WRAPPER}} .coherence-core-site-logo img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'frontend_available' => true,
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_box_shadow',
				'exclude'  => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .coherence-core-site-logo img',
			]
		);

		$this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab(
			'normal',
			[
				'label' => __( 'Normal', 'coherence-core' ),
			]
		);

		$this->add_control(
			'opacity',
			[
				'label'     => __( 'Opacity', 'coherence-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .coherence-core-site-logo img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'css_filters',
				'selector' => '{{WRAPPER}} .coherence-core-site-logo img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover',
			[
				'label' => __( 'Hover', 'coherence-core' ),
			]
		);
		$this->add_control(
			'opacity_hover',
			[
				'label'     => __( 'Opacity', 'coherence-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .coherence-core-site-logo:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'background_hover_transition',
			[
				'label'     => __( 'Transition Duration', 'coherence-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max'  => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .coherence-core-site-logo img' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .coherence-core-site-logo:hover img',
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'coherence-core' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}
	/**
	 * Register Site Logo style Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_site_logo_caption_styling_controls() {
		$this->start_controls_section(
			'section_style_caption',
			[
				'label'     => __( 'Caption', 'coherence-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'caption_source!' => 'none',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => __( 'Text Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .widget-image-caption' => 'color: {{VALUE}};',
				],
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->add_control(
			'caption_background_color',
			[
				'label'     => __( 'Background Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-image-caption' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'caption_typography',
				'selector' => '{{WRAPPER}} .widget-image-caption',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'caption_text_shadow',
				'selector' => '{{WRAPPER}} .widget-image-caption',
			]
		);

		$this->add_responsive_control(
			'caption_padding',
			[
				'label'              => __( 'Padding', 'coherence-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', 'em', '%' ],
				'selectors'          => [
					'{{WRAPPER}} .widget-image-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'frontend_available' => true,
			]
		);
		$this->add_responsive_control(
			'caption_space',
			[
				'label'              => __( 'Spacing', 'coherence-core' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'            => [
					'size' => 0,
					'unit' => 'px',
				],
				'selectors'          => [
					'{{WRAPPER}} .widget-image-caption' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: 0px;',
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Check if the current widget has caption
	 *
	 * @access private
	 * @since 1.3.0
	 *
	 * @param array $settings returns settings.
	 *
	 * @return boolean
	 */
	private function has_caption( $settings ) {
		return ( ! empty( $settings['caption_source'] ) && 'no' !== $settings['caption_source'] );
	}

	/**
	 * Get the caption for current widget.
	 *
	 * @access private
	 * @since 1.3.0
	 * @param array $settings returns the caption.
	 *
	 * @return string
	 */
	private function get_caption( $settings ) {
		$caption = '';
		if ( 'yes' === $settings['caption_source'] ) {
			$caption = ! empty( $settings['caption'] ) ? $settings['caption'] : '';
		}
		return $caption;
	}

	/**
	 * Render Site Image output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.3.0
	 * @param array $size returns the size of an image.
	 * @access public
	 */
	public function site_image_url( $size ) {
		$settings = $this->get_settings_for_display();
		if ( ! empty( $settings['custom_image']['url'] ) ) {
			$logo = wp_get_attachment_image_src( $settings['custom_image']['id'], $size, true );
		} else {
			$logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), $size, true );
		}
		return $logo[0];
	}

	/**
	 * Render Site Image output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function render() {
		$link     = '';
		$settings = $this->get_settings_for_display();

		$has_caption = $this->has_caption( $settings );

		$this->add_render_attribute( 'wrapper', 'class', 'coherence-core-site-logo' );

		$size = $settings['site_logo_size_size'];

		$site_image = $this->site_image_url( $size );

		if ( site_url() . '/wp-includes/images/media/default.png' === $site_image ) {
			$site_image = site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png';
		} else {
			$site_image = $site_image;
		}

		if ( 'file' === $settings['link_to'] ) {
				$link = $site_image;
				$this->add_render_attribute( 'link', 'href', $link );
		} elseif ( 'default' === $settings['link_to'] ) {
			$link = site_url();
			$this->add_render_attribute( 'link', 'href', $link );
		} else {
			$link = $this->get_link_url( $settings );

			if ( $link ) {
				$this->add_link_attributes( 'link', $link );
			}
		}
		$class = '';
		if ( Plugin::$instance->editor->is_edit_mode() ) {
			$class = 'elementor-non-clickable';
		} else {
			$class = 'elementor-clickable';
		}
		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
		<?php if ( $has_caption ) : ?>
				<figure class="wp-caption">
		<?php endif; ?>
		<?php if ( $link ) : ?>
					<?php
					if ( 'no' === $settings['open_lightbox'] ) {
						$class = 'elementor-non-clickable';
					}
					?>
				<a data-elementor-open-lightbox="<?php echo esc_attr( $settings['open_lightbox'] ); ?>"  class='<?php echo  esc_attr( $class ); ?>' <?php echo $this->get_render_attribute_string( 'link' ); ?>>
		<?php endif; ?>
		<?php
		if ( empty( $site_image ) ) {
			return;
		}
		$img_animation = '';

		if ( 'custom' !== $size ) {
			$image_size = $size;
		} else {
			require_once ELEMENTOR_PATH . 'includes/libraries/bfi-thumb/bfi-thumb.php';

			$image_dimension = $settings['site_logo_size_custom_dimension'];

			$image_size = [
				// Defaults sizes.
				0           => null, // Width.
				1           => null, // Height.

				'bfi_thumb' => true,
				'crop'      => true,
			];

			$has_custom_size = false;
			if ( ! empty( $image_dimension['width'] ) ) {
				$has_custom_size = true;
				$image_size[0]   = $image_dimension['width'];
			}

			if ( ! empty( $image_dimension['height'] ) ) {
				$has_custom_size = true;
				$image_size[1]   = $image_dimension['height'];
			}

			if ( ! $has_custom_size ) {
				$image_size = 'full';
			}
		}

		$image_url = $site_image;

		if ( ! empty( $settings['custom_image']['url'] ) ) {
			$image_data = wp_get_attachment_image_src( $settings['custom_image']['id'], $image_size, true );
		} else {
			$image_data = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), $image_size, true );
		}

		$site_image_class = 'elementor-animation-';

		if ( ! empty( $settings['hover_animation'] ) ) {
			$img_animation = $settings['hover_animation'];
		}
		if ( ! empty( $image_data ) ) {
			$image_url = $image_data[0];
		}

		if ( site_url() . '/wp-includes/images/media/default.png' === $image_url ) {
			$image_url = site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png';
		} else {
			$image_url = $image_url;
		}

		$class_animation = $site_image_class . $img_animation;

		$image_unset = site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png';

		if ( $image_unset !== $image_url ) {
			$image_url = $image_url;
		}

		?>
			<div class="coherence-core-site-logo-set">           
				<div class="coherence-core-site-logo-container">
					<img class="coherence-core-site-logo-img <?php echo esc_attr( $class_animation ); ?>"  src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( Control_Media::get_image_alt( $settings['custom_image'] ) ); ?>"/>
				</div>
			</div>
		<?php if ( $link ) : ?>
					</a>
		<?php endif; ?>
		<?php
		if ( $has_caption ) :
			$caption_text = $this->get_caption( $settings );
			?>
			<?php if ( ! empty( $caption_text ) ) : ?>
					<div class="coherence-core-caption-width"> 
						<figcaption class="widget-image-caption wp-caption-text"><?php echo wp_kses_post( $caption_text ); ?></figcaption>
					</div>
			<?php endif; ?>
				</figure>
		<?php endif; ?>
		</div>  
			<?php
	}

	/**
	 * Retrieve Site Logo widget link URL.
	 *
	 * @since 1.3.0
	 * @access private
	 *
	 * @param array $settings returns settings.
	 * @return array|string|false An array/string containing the link URL, or false if no link.
	 */
	private function get_link_url( $settings ) {
		if ( 'none' === $settings['link_to'] ) {
			return false;
		}

		if ( 'custom' === $settings['link_to'] ) {
			if ( empty( $settings['link']['url'] ) ) {
				return false;
			}
			return $settings['link'];
		}

		if ( 'default' === $settings['link_to'] ) {
			if ( empty( $settings['link']['url'] ) ) {
				return false;
			}
			return site_url();
		}
	}
}

Plugin::instance()->widgets_manager->register(new Coherence_Logo_Widget());