<?php

/**
 * Elementor Widget
 * @package Coherence
 * @since 1.0.0
 */

namespace Elementor;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Coherence_Button_Widget extends Widget_Base
{
	/**
	 * Get widget name.
	 *
	 * Retrieve button widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'coherence-Button-widget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve button widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Button', 'coherence-core');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve button widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-button coherence-element';
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
		return ['Coherence', 'coherence button' , 'button'];
	}

	/**
	 * Get button sizes.
	 *
	 * Retrieve an array of button sizes for the button widget.
	 *
	 * @since 3.4.0
	 * @access public
	 * @static
	 *
	 * @return array An array containing button sizes.
	 */
	public static function get_button_sizes()
	{
		return [
			'xs' => esc_html__('Extra Small', 'coherence-core'),
			'sm' => esc_html__('Small', 'coherence-core'),
			'md' => esc_html__('Medium', 'coherence-core'),
			'lg' => esc_html__('Large', 'coherence-core'),
			'xl' => esc_html__('Extra Large', 'coherence-core'),
		];
	}

	protected function register_button_controls_style(array $args = [])
	{

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__('Button', 'coherence-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .elementor-button',
				'condition' => $args['section_condition'],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .elementor-button',
				'condition' => $args['section_condition'],
			]
		);

		$this->start_controls_tabs('tabs_button_style', [
			'condition' => $args['section_condition'],
		]);

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__('Normal', 'coherence-core'),
				'condition' => $args['section_condition'],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__('Text Color', 'coherence-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .elementor-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
				'condition' => $args['section_condition'],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .elementor-button',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'global' => [
							'default' => Global_Colors::COLOR_ACCENT,
						],
					],
				],
				'condition' => $args['section_condition'],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__('Hover', 'coherence-core'),
				'condition' => $args['section_condition'],
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => esc_html__('Text Color', 'coherence-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button:hover, {{WRAPPER}} .elementor-button:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-button:hover svg, {{WRAPPER}} .elementor-button:focus svg' => 'fill: {{VALUE}};',
				],
				'condition' => $args['section_condition'],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_background_hover',
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .elementor-button:hover, {{WRAPPER}} .elementor-button:focus',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
				'condition' => $args['section_condition'],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__('Border Color', 'coherence-core'),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-button:hover, {{WRAPPER}} .elementor-button:focus' => 'border-color: {{VALUE}};',
				],
				'condition' => $args['section_condition'],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__('Hover Animation', 'coherence-core'),
				'type' => Controls_Manager::HOVER_ANIMATION,
				'condition' => $args['section_condition'],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .elementor-button',
				'separator' => 'before',
				'condition' => $args['section_condition'],
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label' => esc_html__('Border Radius', 'coherence-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => $args['section_condition'],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .elementor-button',
				'condition' => $args['section_condition'],
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label' => esc_html__('Padding', 'coherence-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
				'condition' => $args['section_condition'],
			]
		);

		$this->end_controls_section();
	}

	public function on_import($element)
	{
		return Icons_Manager::on_import_migration($element, 'icon', 'selected_icon');
	}


	protected function register_controls($args = [])
	{
		$default_args = [
			'section_condition' => [],
			'button_default_text' => esc_html__('Click here', 'coherence-core'),
			'text_control_label' => esc_html__('Text', 'coherence-core'),
			'alignment_control_prefix_class' => 'elementor%s-align-',
			'alignment_default' => '',
			'icon_exclude_inline_options' => [],
		];

		$args = wp_parse_args($args, $default_args);

		//Section Content
		$this->register_button_controls_content($args);
		//Section Styles
		$this->register_button_controls_style($args);
	}

	protected function register_button_controls_content(array $args = [])
	{

		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__('Button', 'coherence-core'),
			]
		);
		$this->add_control(
			'style',
			[
				'label' => esc_html__('Style', 'coherence-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'solid' => esc_html__('Solid', 'coherence-core'),
					'plain' => esc_html__('Plain', 'coherence-core'),
				],
				'condition' => $args['section_condition'],
			]
		);
		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__('width', 'coherence-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1200,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-button' => 'width: {{SIZE}}{{UNIT}};max-width: 100%;',
				],
				'condition' => $args['section_condition'],
			]
		);
		$this->add_control(
			'link-type',
			[
				'label' => esc_html__('Link Type', 'coherence-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'simple-click',
				'options' => [
					'simple-click' => esc_html__('Simple Click', 'coherence-core'),
					'lightbox' => esc_html__('Lightbox', 'coherence-core'), // image
					'modal-window' => esc_html__('Modal Window', 'coherence-core'), // popup
					'local-scroll' => esc_html__('Local Scroll', 'coherence-core'), //scroll by id
					'scroll-to-section-bellow' => esc_html__('Scroll to Section Bellow', 'coherence-core'),
				],
			]
		);
		$this->add_control(
			'text',
			[
				'label' => $args['text_control_label'],
				'type' => Controls_Manager::TEXT,
				'default' => $args['button_default_text'],
				'placeholder' => $args['button_default_text'],
				'condition' => $args['section_condition'],
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__('Link', 'coherence-core'),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'coherence-core'),
				'default' => [
					'url' => '#',
				],
				'condition' => $args['section_condition'],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__('Alignment', 'coherence-core'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
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
				],
				'prefix_class' => $args['alignment_control_prefix_class'],
				'default' => $args['alignment_default'],
				'condition' => $args['section_condition'],
			]
		);

		$this->add_control(
			'size',
			[
				'label' => esc_html__('Size', 'coherence-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => self::get_button_sizes(),
				'style_transfer' => true,
				'condition' => $args['section_condition'],
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__('Icon', 'coherence-core'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'media',
				'label_block' => true,
				'condition' => $args['section_condition'],
				'icon_exclude_inline_options' => $args['icon_exclude_inline_options'],
			]
		);

		$this->add_responsive_control(
			'icon_align',
			[
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => esc_html__('Left', 'coherence-core'),
						'icon' => 'eicon-arrow-left',
					],
					'right' => [
						'title' => esc_html__('Right', 'coherence-core'),
						'icon' => 'eicon-arrow-right',
					],
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label' => esc_html__('Icon Spacing', 'coherence-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-button .elementor-align-icon-up' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-button .elementor-align-icon-down' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => array_merge($args['section_condition'], ['selected_icon[value]!' => '']),
			]
		);

		$this->add_control(
			'view',
			[
				'label' => esc_html__('View', 'coherence-core'),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
				'condition' => $args['section_condition'],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render button widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @param \Elementor\Widget_Base|null $instance
	 *
	 * @since  3.4.0
	 * @access protected
	 */
	protected function render_button(Widget_Base $instance = null)
	{
		if (empty($instance)) {
			$instance = $this;
		}

		$settings = $instance->get_settings_for_display();

		$instance->add_render_attribute('wrapper', 'class', 'elementor-button-wrapper coherence-button-wrapper');

		if (!empty($settings['link']['url'])) {
			$instance->add_link_attributes('button', $settings['link']);
			$instance->add_render_attribute('button', 'class', 'elementor-button-link');
		}

		$instance->add_render_attribute('button', 'class', 'elementor-button');
		$instance->add_render_attribute('button', 'role', 'button');

		if (!empty($settings['size'])) {
			$instance->add_render_attribute('button', 'class', 'elementor-size-' . $settings['size']);
		}

		if (!empty($settings['style'])) {
			$instance->add_render_attribute('button', 'class', 'coherence-button-style-' . $settings['style']);
		}

		if (!empty($settings['hover_animation'])) {
			$instance->add_render_attribute('button', 'class', 'elementor-animation-' . $settings['hover_animation']);
		}
?>
		<div <?php $instance->print_render_attribute_string('wrapper'); ?>>
			<a <?php $instance->print_render_attribute_string('button'); ?>>
				<?php $this->render_text($instance); ?>
			</a>
		</div>
	<?php
	}

	/**
	 * Render button widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since  3.4.0
	 * @access protected
	 */
	protected function content_template()
	{
	?>
		<# view.addRenderAttribute( 'text' , 'class' , 'elementor-button-text' ); view.addInlineEditingAttributes( 'text' , 'none' ); var iconHTML=elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden' : true }, 'i' , 'object' ), migrated=elementor.helpers.isIconMigrated( settings, 'selected_icon' ); #>
			<div class="elementor-button-wrapper coherence-button-wrapper">
				<a class="elementor-button elementor-size-{{ settings.size }} coherence-button-style-{{settings.style}} elementor-animation-{{ settings.hover_animation }}" href="{{ settings.link.url }}" role="button">
					<span class="elementor-button-content-wrapper">
						<# if ( settings.icon || settings.selected_icon ) { #>
							<span class="elementor-button-icon elementor-align-icon-{{ settings.icon_align }}">
								<# if ( ( migrated || ! settings.icon ) && iconHTML.rendered ) { #>
									{{{ iconHTML.value }}}
									<# } else { #>
										<i class="{{ settings.icon }}" aria-hidden="true"></i>
										<# } #>
							</span>
							<# } #>
								<span {{{ view.getRenderAttributeString( 'text' ) }}}>{{{ settings.text }}}</span>
					</span>
				</a>
			</div>
		<?php
	}

	/**
	 * Render button text.
	 *
	 * Render button widget text.
	 *
	 * @param \Elementor\Widget_Base|null $instance
	 *
	 * @since  3.4.0
	 * @access protected
	 */
	protected function render_text(Widget_Base $instance = null)
	{
		// The default instance should be `$this` (a Button widget), unless the Trait is being used from outside of a widget (e.g. `Skin_Base`) which should pass an `$instance`.
		if (empty($instance)) {
			$instance = $this;
		}

		$settings = $instance->get_settings_for_display();

		$migrated = isset($settings['__fa4_migrated']['selected_icon']);
		$is_new = empty($settings['icon']) && Icons_Manager::is_migration_allowed();

		if (!$is_new && empty($settings['icon_align'])) {
			// @todo: remove when deprecated
			// added as bc in 2.6
			//old default
			$settings['icon_align'] = $instance->get_settings('icon_align');
		}

		$instance->add_render_attribute([
			'content-wrapper' => [
				'class' => 'elementor-button-content-wrapper',
			],
			'icon-align' => [
				'class' => [
					'elementor-button-icon',
					'elementor-align-icon-' . $settings['icon_align'],
				],
			],
			'text' => [
				'class' => 'elementor-button-text',
			],
		]);

		// TODO: replace the protected with public
		//$instance->add_inline_editing_attributes( 'text', 'none' );
		?>
			<span <?php $instance->print_render_attribute_string('content-wrapper'); ?>>
				<?php if (!empty($settings['icon']) || !empty($settings['selected_icon']['value'])) : ?>
					<span <?php $instance->print_render_attribute_string('icon-align'); ?>>
						<?php if ($is_new || $migrated) :
							Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']);
						else : ?>
							<i class="<?php echo esc_attr($settings['icon']); ?>" aria-hidden="true"></i>
						<?php endif; ?>
					</span>
				<?php endif; ?>
				<span <?php $instance->print_render_attribute_string('text'); ?>><?php $this->print_unescaped_setting('text'); ?></span>
			</span>
	<?php
	}

	/**
	 * Render button widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{
		$this->render_button();
	}
}
Plugin::instance()->widgets_manager->register(new Coherence_Button_Widget());
