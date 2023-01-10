<?php

/**
 * Elementor Widget
 * @package Coherence
 * @since 1.0.0
 */

namespace Elementor;

use Elementor\Includes\Widgets\Traits\Button_Trait;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

class Coherence_Button_Widget extends Widget_Base
{

	use Button_Trait;

	public function  __construct($data = [], $args = null)
	{
		parent::__construct($data, $args);

		add_action('elementor/element/after_section_start', [$this, 'inject_button_custom_control'], 10, 3);
	}

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
		return 'eicon-button';
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


	protected function register_controls()
	{
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__('Button', 'coherence-core'),
			]
		);

		$this->override_register_button_content_controls();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__('Button', 'coherence-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->override_register_button_style_controls();

		$this->end_controls_section();
	}

	protected function override_register_button_style_controls()
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

		$this->register_button_style_controls();
		$this->update_control('button_text_color', [
			'default' => '#000',
		]);
	}

	protected function override_register_button_content_controls()
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
		//[$args] => Pour remplacer tous les arguments hérités de la fonction parent , si tu veux tu peux supprimer car la valeur par défaut et un tableau vide []
		$this->register_button_content_controls($args);
		//Remove control button_type
		$this->remove_control('button_type');
		////Remove control Button ID
		$this->remove_control('button_css_id');
		//Update control Icon
		$this->update_control('selected_icon', [
			'skin' => 'media',
			'label_block' => true,
		]);

		//Update Type and icon positions
		$this->update_responsive_control(
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

		$this->update_control(
			'icon_indent',
			[
				'selectors' => [
					'{{WRAPPER}} .elementor-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-button .elementor-align-icon-up' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-button .elementor-align-icon-down' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => array_merge($args['section_condition'], ['selected_icon[value]!' => '']),
			]
		);

		$this->update_control(
			'text',
			[
				'dynamic' => [
					'active' => false,
				],
			]
		);
		//Update link
		$this->update_control(
			'link',
			[
				'dynamic' => [
					'active' => false,
				],
			]
		);
		//Update align Delete option justify 
		$this->update_responsive_control(
			'align',
			[
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
			]
		);
	}

	/**
	 * Action elementor/element/after_section_start
	 * Function inject_button_custom_control
	 * @since 1.0.0
	 * @access public
	 * 
	 */

	public function inject_button_custom_control($element, $section_id, $args)
	{

		if ('coherence-Button-widget' === $element->get_name() && 'section_button' === $section_id) {
			$element->add_responsive_control(
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
			$element->add_control(
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
			$element->add_control(
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
		}
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

		if (!empty($settings['button_css_id'])) {
			$instance->add_render_attribute('button', 'id', $settings['button_css_id']);
		}

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
				<a id="{{ settings.button_css_id }}" class="elementor-button elementor-size-{{ settings.size }} coherence-button-style-{{settings.style}} elementor-animation-{{ settings.hover_animation }}" href="{{ settings.link.url }}" role="button">
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
