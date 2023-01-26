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

if (!defined('ABSPATH')) {
	exit;   // Exit if accessed directly.
}

/**
 * Coherence Core Site Logo widget
 *
 * Coherence Core widget for Site Logo.
 *
 * @since 1.3.0
 */
class Coherence_Logo_Widget extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'logo';
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
		return ['Coherence', 'coherence logo' , 'logo'];
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
	public function get_title()
	{
		return __('Site Logo', 'coherence-core');
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
	public function get_icon()
	{
		return 'eicon-logo coherence-element';
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
	public function get_categories()
	{
		return ['coherence_widgets'];
	}

	/**
	 * Register Site Logo controls.
	 *
	 * @since 1.5.7
	 * @access protected
	 */
	protected function register_controls()
	{
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
	protected function register_content_site_logo_controls()
	{
		$this->start_controls_section(
			'section_site_logo',
			[
				'label' => __('Site Logo', 'coherence-core'),
			]
		);

		$this->add_responsive_control(
			'logo',
			[
				'label'     => __('Add Logo', 'coherence-core'),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => [
					'active' => true,
				],
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'logo_size_desktop',
			[
				'label' => esc_html__('Logo Desktop Size', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$exclude_image_size = [
			'coherence_team_524X462',
			'coherence_team_794X320',
			'coherence_service_750X390',
			'coherence_blog_80X80',
			'coherence_blog__378X324',
			'coherence_blog__360X308',
			'coherence_blog__360X254',
			'coherence_blog__80X80',
			'coherence_team__269X286',
			'coherence_team__86X86',
			'coherence_project__357X472',
			'coherence_project__362X410',
			'coherence_project__360X554',
			'coherence_project__362X262',
			'coherence_project_details__756X305',
			'medium_large',
			'large',
			'1536x1536',
			'2048x2048',
		];


		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'logo_thum', // Usage: `logo_thum_size` and `logo_thum_custom_dimension`
				'label'   => __('Logo Size', 'coherence-core'),
				'exclude' => $exclude_image_size,
				'default' => 'thumbnail',
			]
		);

		$this->add_control(
			'logo_size_tablet',
			[
				'label' => esc_html__('Logo Tablet Size', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'logo_thum_tablet',
				'label'   => __('Logo Size', 'coherence-core'),
				'exclude' => $exclude_image_size,
				'default' => 'thumbnail',
			]
		);

		$this->add_control(
			'logo_size_mobile',
			[
				'label' => esc_html__('Logo Mobile Size', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'logo_thum_mobile',
				'label'   => __('Logo Size', 'coherence-core'),
				'exclude' => $exclude_image_size,
				'default' => 'thumbnail',
			]
		);

		$this->add_control(
			'logo_sticky',
			[
				'label'     => __('Logo sticky', 'coherence-core'),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => [
					'active' => true,
				],
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'logo_size_sticky',
			[
				'label' => esc_html__('Logo Sticky Size', 'coherence-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'logo_thum_sticky',
				'label'   => __('Logo Size', 'coherence-core'),
				'exclude' => $exclude_image_size,
				'default' => 'thumbnail',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'              => __('Alignment', 'coherence-core'),
				'type'               => Controls_Manager::CHOOSE,
				'options'            => [
					'left'   => [
						'title' => __('Left', 'coherence-core'),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'coherence-core'),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __('Right', 'coherence-core'),
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
				'label'   => __('Caption', 'coherence-core'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'no'  => __('No', 'coherence-core'),
					'yes' => __('Yes', 'coherence-core'),
				],
				'default' => 'no',
			]
		);

		$this->add_control(
			'caption',
			[
				'label'       => __('Custom Caption', 'coherence-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __('Enter caption', 'coherence-core'),
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
				'label'   => __('Link', 'coherence-core'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'none'    => __('None', 'coherence-core'),
					'custom'  => __('Custom URL', 'coherence-core'),
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label'       => __('Link', 'coherence-core'),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __('https://your-link.com', 'coherence-core'),
				'condition'   => [
					'link_to' => 'custom',
				],
				'show_label'  => false,
			]
		);

		$this->add_control(
			'view',
			[
				'label'   => __('View', 'coherence-core'),
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
	protected function register_site_logo_styling_controls()
	{
		$this->start_controls_section(
			'section_style_site_logo_image',
			[
				'label' => __('Site logo', 'coherence-core'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label'              => __('Width', 'coherence-core'),
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
				'size_units'         => ['%', 'px', 'vw'],
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
				'label'              => __('Max Width', 'coherence-core') . ' (%)',
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
				'size_units'         => ['%'],
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
				'label'     => __('Background Color', 'coherence-core'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .coherence-core-site-logo-set .coherence-core-site-logo-container' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'site_logo_image_border',
			[
				'label'       => __('Border Style', 'coherence-core'),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'none',
				'label_block' => false,
				'options'     => [
					'none'   => __('None', 'coherence-core'),
					'solid'  => __('Solid', 'coherence-core'),
					'double' => __('Double', 'coherence-core'),
					'dotted' => __('Dotted', 'coherence-core'),
					'dashed' => __('Dashed', 'coherence-core'),
				],
				'selectors'   => [
					'{{WRAPPER}} .coherence-core-site-logo-container .coherence-core-site-logo-img' => 'border-style: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'site_logo_image_border_size',
			[
				'label'      => __('Border Width', 'coherence-core'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
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
				'label'     => __('Border Color', 'coherence-core'),
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
				'label'              => __('Border Radius', 'coherence-core'),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px', '%'],
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

		$this->start_controls_tabs('image_effects');

		$this->start_controls_tab(
			'normal',
			[
				'label' => __('Normal', 'coherence-core'),
			]
		);

		$this->add_control(
			'opacity',
			[
				'label'     => __('Opacity', 'coherence-core'),
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
				'label' => __('Hover', 'coherence-core'),
			]
		);
		$this->add_control(
			'opacity_hover',
			[
				'label'     => __('Opacity', 'coherence-core'),
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
				'label'     => __('Transition Duration', 'coherence-core'),
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
				'label' => __('Hover Animation', 'coherence-core'),
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
	protected function register_site_logo_caption_styling_controls()
	{
		$this->start_controls_section(
			'section_style_caption',
			[
				'label'     => __('Caption', 'coherence-core'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'caption_source!' => 'none',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => __('Text Color', 'coherence-core'),
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
				'label'     => __('Background Color', 'coherence-core'),
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
				'label'              => __('Padding', 'coherence-core'),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px', 'em', '%'],
				'selectors'          => [
					'{{WRAPPER}} .widget-image-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'frontend_available' => true,
			]
		);
		$this->add_responsive_control(
			'caption_space',
			[
				'label'              => __('Spacing', 'coherence-core'),
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
	private function has_caption($settings)
	{
		return (!empty($settings['caption_source']) && 'no' !== $settings['caption_source']);
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
	private function get_caption($settings)
	{
		$caption = '';
		if ('yes' === $settings['caption_source']) {
			$caption = !empty($settings['caption']) ? $settings['caption'] : '';
		}
		return $caption;
	}

	private function get_logos($settings): void
	{

		$logo = wp_kses_post(Group_Control_Image_Size::get_attachment_image_html($settings, 'logo_thum',  'logo'));

		if(!empty($settings['logo_tablet'])) {
			$logo_tablet = wp_kses_post(Group_Control_Image_Size::get_attachment_image_html($settings, 'logo_thum_tablet',  'logo_tablet'));
		}

		if(!empty($settings['logo_mobile'])) {
			$logo_mobile = wp_kses_post(Group_Control_Image_Size::get_attachment_image_html($settings, 'logo_thum_mobile',  'logo_mobile'));
		}

		//Logo sticky 
		if(!empty($settings['logo_mobile'])) {
			$logo_sticky = wp_kses_post(Group_Control_Image_Size::get_attachment_image_html($settings, 'logo_thum_sticky',  'logo_sticky'));
		}


		$logo_tablet = !empty($logo_tablet) ? $logo_tablet : $logo;
		$logo_mobile = !empty($logo_mobile) ? $logo_mobile : $logo;

		$link = $this->get_link_url($settings);

		if (!empty($logo_sticky)) {
?>
			<?php if ($link) : ?>
				<a href="<?php echo esc_url($link['url']); ?>">
				<?php endif; ?>
				<span class="logo d-none logo-sticky">
					<?php echo $logo_sticky; ?>
				</span>
				<?php if ($link) : ?>
				</a>
			<?php endif; ?>
		<?php
		}

		if (!empty($logo) || !empty($logo_tablet) || !empty($logo_mobile)) {
		?>
			<?php if ($link) : ?>
				<a href="<?php echo esc_url($link['url']); ?>">
				<?php endif; ?>
				<span class="logo d-none d-lg-inline logo-desktop">
					<?php echo $logo; ?>
				</span>
				<span class="logo d-none d-sm-inline d-lg-none logo-tablet">
					<?php echo $logo_tablet; ?>
				</span>
				<span class="logo d-inline d-sm-none logo-mobile">
					<?php echo $logo_mobile; ?>
				</span>
				<?php if ($link) : ?>
				</a>
			<?php endif; ?>
		<?php
		} else {
			echo '<img src="' . site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png">';
		}
	}

	/**
	 * Render Site Image output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$has_caption = $this->has_caption($settings);
		$this->add_render_attribute('wrapper', 'class', 'coherence-core-site-logo');

		$class = '';
		if (Plugin::$instance->editor->is_edit_mode()) {
			$class = 'elementor-non-clickable';
		} else {
			$class = 'elementor-clickable';
		}
		?>

		<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
			<?php if ($has_caption) : ?>
				<figure class="wp-caption">
				<?php endif; ?>

				<div class="coherence-core-site-logo-set">
					<div class="coherence-core-site-logo-container">
						<?php $this->get_logos($settings); ?>
					</div>
				</div>

				<?php if ($has_caption) : $caption_text = $this->get_caption($settings); ?>

					<?php if (!empty($caption_text)) : ?>
						<div class="coherence-core-caption-width">
							<figcaption class="widget-image-caption wp-caption-text"><?php echo wp_kses_post($caption_text); ?></figcaption>
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
	}
}

Plugin::instance()->widgets_manager->register(new Coherence_Logo_Widget());
