<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;

class Coherence_Section_Interactions
{
	private static $instance = null;
	public $parallax_sections = array();
	public $interactions = array();

	public static function instance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function __construct()
	{
		if (!defined('COHERENCE_ELEMENTOR_SECTION_INTERACTIONS_DIR')) {
			define('COHERENCE_ELEMENTOR_SECTION_INTERACTIONS_DIR', rtrim(__DIR__, ' /\\'));
		}

		if (!defined('COHERENCE_ELEMENTOR_SECTION_INTERACTIONS_URL')) {
			define('COHERENCE_ELEMENTOR_SECTION_INTERACTIONS_URL', rtrim(plugin_dir_url(__FILE__), ' /\\'));
		}
		add_action('elementor/element/after_section_end', array($this, 'add_coherence_options_section'), 10, 3);
		add_action('elementor/element/before_section_end', array($this, 'before_options_section_end'), 10, 3);
		add_action('elementor/frontend/before_render', array($this, 'before_render'));
		add_action('elementor/element/section/section_background/after_section_end', array($this, 'after_section_end'), 10, 2);
		add_action('elementor/element/column/section_style/after_section_end', array($this, 'after_column_end'), 10, 2);
		add_action('elementor/frontend/section/before_render', array($this, 'section_before_render'));
		add_action('elementor/element/before_render', array($this, 'section_before_render'));
		add_action('elementor/frontend/column/before_render', array($this, 'section_before_render'));
		add_action('elementor/frontend/before_enqueue_scripts', array($this, 'enqueue_scripts'), 9);
		add_action('elementor/element/parse_css', [$this, 'add_post_css'], 10, 2);
	}

	public function before_options_section_end($element, $section_id, $args)
	{

		if ($section_id === 'coherence_options') {
			$element->add_control(
				'coherence_interactions_heading',
				[
					'label' => esc_html__('Interactions', 'coherence-core'),
					'type' => Controls_Manager::HEADING,
				]
			);

			$element->add_control(
				'coherence_sticky_row',
				[
					'label' => __('Sticky Row', 'coherence-core'),
					'description' => __('Enable to make this row sticky', 'coherence-core'),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __('On', 'coherence-core'),
					'label_off' => __('Off', 'coherence-core'),
					'return_value' => 'coherence-css-sticky',
					'render_type' => 'none',
					'default' => '',
					'separator' => 'before',
				]
			);


			$element->add_control(
				'coherence_interaction_vertical_scroll',
				[
					'label' => __('Vertical Scroll', 'coherence-core'),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __('On', 'coherence-core'),
					'label_off' => __('Off', 'coherence-core'),
					'return_value' => 'yes',
					'default' => '',
					'frontend_available' => true,
					'render_type' => 'none',
				]
			);

			$element->add_control(
				'coherence_interaction_vertical_scroll_direction',
				[
					'label' => __('Direction', 'coherence-core'),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'' => __('Up', 'coherence-core'),
						'negative' => __('Down', 'coherence-core'),
					],
					'condition' => ['coherence_interaction_vertical_scroll' => 'yes'],
					'frontend_available' => true,
					'render_type' => 'none',
				]
			);

			$element->add_control(
				'coherence_interaction_vertical_scroll_speed',
				[
					'label' => __('Speed', 'coherence-core'),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 4,
					],
					'range' => [
						'px' => [
							'max' => 10,
							'step' => 0.1,
						],
					],
					'condition' => ['coherence_interaction_vertical_scroll' => 'yes'],
					'frontend_available' => true,
					'render_type' => 'none',
				]
			);

			$element->add_control(
				'coherence_interaction_vertical_scroll_range',
				[
					'label' => __('Viewport', 'coherence-core'),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'sizes' => [
							'start' => 0,
							'end' => 100,
						],
						'unit' => '%',
					],
					'labels' => [
						__('Bottom', 'coherence-core'),
						__('Top', 'coherence-core'),
					],
					'scales' => 1,
					'handles' => 'range',
					'condition' => ['coherence_interaction_vertical_scroll' => 'yes'],
					'frontend_available' => true,
					'render_type' => 'none',
				]
			);

			$element->add_control(
				'coherence_interaction_horizontal_scroll',
				[
					'label' => __('Horizontal Scroll', 'coherence-core'),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __('On', 'coherence-core'),
					'label_off' => __('Off', 'coherence-core'),
					'return_value' => 'yes',
					'default' => '',
					'frontend_available' => true,
					'render_type' => 'none',
					'separator' => 'before',
				]
			);

			$element->add_control(
				'coherence_interaction_horizontal_scroll_direction',
				[
					'label' => __('Direction', 'coherence-core'),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'' => __('Left', 'coherence-core'),
						'negative' => __('Right', 'coherence-core'),
					],
					'condition' => ['coherence_interaction_horizontal_scroll' => 'yes'],
					'frontend_available' => true,
					'render_type' => 'none',
				]
			);

			$element->add_control(
				'coherence_interaction_horizontal_scroll_speed',
				[
					'label' => __('Speed', 'coherence-core'),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 4,
					],
					'range' => [
						'px' => [
							'max' => 10,
							'step' => 0.1,
						],
					],
					'condition' => ['coherence_interaction_horizontal_scroll' => 'yes'],
					'frontend_available' => true,
					'render_type' => 'none',
				]
			);

			$element->add_control(
				'coherence_interaction_horizontal_scroll_range',
				[
					'label' => __('Viewport', 'coherence-core'),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'sizes' => [
							'start' => 0,
							'end' => 100,
						],
						'unit' => '%',
					],
					'labels' => [
						__('Bottom', 'coherence-core'),
						__('Top', 'coherence-core'),
					],
					'scales' => 1,
					'handles' => 'range',
					'condition' => ['coherence_interaction_horizontal_scroll' => 'yes'],
					'frontend_available' => true,
					'render_type' => 'none',
				]
			);

			$element->add_control(
				'coherence_interaction_mouse',
				[
					'label' => __('Mouse Effects', 'coherence-core'),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __('On', 'coherence-core'),
					'label_off' => __('Off', 'coherence-core'),
					'default' => '',
					'return_value' => 'yes',
					'separator' => 'before',
					'frontend_available' => true,
					'render_type' => 'none',
				]
			);

			$element->add_control(
				'coherence_interaction_mouse_direction',
				[
					'label' => __('Direction', 'coherence-core'),
					'type' => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						'' => __('Opposite', 'coherence-core'),
						'negative' => __('Direct', 'coherence-core'),
					],
					'condition' => ['coherence_interaction_mouse' => 'yes'],
					'frontend_available' => true,
					'render_type' => 'none',
				]
			);

			$element->add_control(
				'coherence_interaction_mouse_speed',
				[
					'label' => __('Speed', 'coherence-core'),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 1,
					],
					'range' => [
						'px' => [
							'max' => 10,
							'step' => 0.1,
						],
					],
					'condition' => ['coherence_interaction_mouse' => 'yes'],
					'frontend_available' => true,
					'render_type' => 'none',
				]
			);

			$element->add_control(
				'coherence_interaction_devices',
				[
					'label' => __('Apply Effects On', 'coherence-core'),
					'type' => Controls_Manager::SELECT2,
					'multiple' => true,
					'label_block' => 'true',
					'default' => ['desktop', 'tablet', 'mobile'],
					'options' => [
						'desktop' => __('Desktop', 'coherence-core'),
						'tablet' => __('Tablet', 'coherence-core'),
						'mobile' => __('Mobile', 'coherence-core'),
					],
					'conditions'   => [
						'relation' => 'or',
						'terms' => [
							[
								'name'	 => 'coherence_interaction_mouse',
								'operator' => ' == ',
								'value'	=> 'yes',
							],
							[
								'name'	 => 'coherence_interaction_vertical_scroll',
								'operator' => ' == ',
								'value'	=> 'yes',
							],
							[
								'name'	 => 'coherence_interaction_horizontal_scroll',
								'operator' => ' == ',
								'value'	=> 'yes',
							],
						]
					],
					'frontend_available' => true,
					'render_type' => 'none',
				]
			);
		}
	}

	public function add_coherence_options_section($element, $section_id, $args)
	{

		if ($section_id === '_section_responsive') {

			$element->start_controls_section(
				'coherence_options',
				array(
					'label' => esc_html__('Coherence Options', 'coherence-core'),
					'tab' => Controls_Manager::TAB_ADVANCED,
				)
			);

			$element->add_control(
				'coherence_custom_css_heading',
				[
					'label' => esc_html__('Custom CSS', 'coherence-core'),
					'type' => Controls_Manager::HEADING,
				]
			);

			$element->add_control(
				'coherence_custom_css_before_decsription',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => __('Add your own custom CSS here', 'coherence-core'),
					'content_classes' => 'elementor-descriptor',
				]
			);

			$element->add_control(
				'coherence_custom_css',
				[
					'type' => Controls_Manager::CODE,
					'label' => __('Custom CSS', 'coherence-core'),
					'language' => 'css',
					'render_type' => 'none',
					'frontend_available' => true, 'frontend_available' => true,
					'show_label' => false,
					'separator' => 'none',
				]
			);

			$element->add_control(
				'coherence_custom_css_after_decsription',
				[
					'raw' => __('Use "selector" to target wrapper element. Examples:<br>selector {color: red;} // For main element<br>selector .child-element {margin: 10px;} // For child element<br>.my-class {text-align: center;} // Or use any custom selector', 'coherence-core'),
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-descriptor',
				]
			);

			$element->end_controls_section();
		}
	}

	public function after_section_end($obj, $args)
	{

		$obj->start_controls_section(
			'coherence_section_parallax',
			array(
				'label' => esc_html__('Coherence Section Parallax', 'coherence-core'),
				'tab' => Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->parallax_controls($obj);

		$obj->end_controls_section();
	}

	public function after_column_end($obj, $args)
	{
		$obj->start_controls_section(
			'coherence_column_parallax',
			array(
				'label' => esc_html__('Coherence Column Parallax', 'coherence-core'),
				'tab' => Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->parallax_controls($obj);

		$obj->end_controls_section();
	}

	public function parallax_controls($obj)
	{

		$obj->add_control(
			'coherence_parallax_activate',
			[
				'label' => 'Parallax Background',
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('On', 'coherence-core'),
				'label_off' => __('Off', 'coherence-core'),
				'frontend_available' => true,
			]
		);

		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'coherence_parallax_background',
				'label' => 'Parallax Background',
				'selector' => '{{WRAPPER}} .coherence-section-parallax-background',
				'condition' => [
					'coherence_parallax_activate' => 'yes',
				]
			]
		);

		$obj->add_control(
			'coherence_parallax_type',
			[
				'label' => __('Parallax type', 'coherence-core'),
				'type' => Controls_Manager::SELECT,
				'label_block' => false,
				'options' => [
					'vertical' => __('Vertical', 'coherence-core'),
					'horizontal' => __('Horizontal', 'coherence-core'),
					'fixed' => __('Fixed', 'coherence-core'),
				],
				'default' => 'vertical',
				'frontend_available' => true,
				'condition' => [
					'coherence_parallax_activate' => 'yes',
				]
			]
		);


		$obj->add_control(
			'coherence_parallax_activate_mobile',
			[
				'label' => 'Parallax on Mobiles',
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('On', 'coherence-core'),
				'label_off' => __('Off', 'coherence-core'),
				'frontend_available' => true,
				'condition' => [
					'coherence_parallax_activate' => 'yes',
					'coherence_parallax_type' => 'vertical'
				]
			]
		);
	}


	public function section_before_render($obj)
	{
		$data = $obj->get_data();
		$type = isset($data['elType']) ? $data['elType'] : 'section';
		$settings = $data['settings'];
		//|| $obj->get_type() === 'container'
		if ('section' === $type || 'column' === $type || 'container' ===  $obj->get_name()) {

			if (isset($settings['coherence_parallax_activate']) && $settings['coherence_parallax_activate'] == 'yes') {
				$this->parallax_sections[$data['id']] = array(
					'parallax' => true,
					'mobile' => isset($settings['coherence_parallax_activate_mobile']) && $settings['coherence_parallax_activate_mobile'] == 'yes',
					'type' => isset($settings['coherence_parallax_type']) ? $settings['coherence_parallax_type'] : 'vertical',
				);
			}
		}
	}


	public function before_render($obj)
	{
		$data = $obj->get_data();
		$settings = $data['settings'];
		if (isset($settings['coherence_interaction_vertical_scroll']) && $settings['coherence_interaction_vertical_scroll'] == 'yes') {
			$this->interactions[$data['id']]['vertical_scroll'] = 'yes';
			$this->interactions[$data['id']]['vertical_scroll_direction'] = (isset($settings['coherence_interaction_vertical_scroll_direction']) && $settings['coherence_interaction_vertical_scroll_direction'] === 'negative') ? -1 : 1;
			$this->interactions[$data['id']]['vertical_scroll_speed'] = isset($settings['coherence_interaction_vertical_scroll_speed']['size']) ? $settings['coherence_interaction_vertical_scroll_speed']['size'] : 4;
			$this->interactions[$data['id']]['vertical_viewport_bottom'] = isset($settings['coherence_interaction_vertical_scroll_range']['sizes']['start']) ? $settings['coherence_interaction_vertical_scroll_range']['sizes']['start'] : 0;
			$this->interactions[$data['id']]['vertical_viewport_top'] = isset($settings['coherence_interaction_vertical_scroll_range']['sizes']['end']) ? $settings['coherence_interaction_vertical_scroll_range']['sizes']['end'] : 100;
			$this->interactions[$data['id']]['devices'] = isset($settings['coherence_interaction_devices']) ? $settings['coherence_interaction_devices'] : '';
		}

		if (isset($settings['coherence_interaction_horizontal_scroll']) && $settings['coherence_interaction_horizontal_scroll'] == 'yes') {
			$this->interactions[$data['id']]['horizontal_scroll'] = 'yes';
			$this->interactions[$data['id']]['horizontal_scroll_direction'] = (isset($settings['coherence_interaction_horizontal_scroll_direction']) && $settings['coherence_interaction_horizontal_scroll_direction'] === 'negative') ? -1 : 1;
			$this->interactions[$data['id']]['horizontal_scroll_speed'] = isset($settings['coherence_interaction_horizontal_scroll_speed']['size']) ? $settings['coherence_interaction_horizontal_scroll_speed']['size'] : 4;
			$this->interactions[$data['id']]['horizontal_viewport_bottom'] = isset($settings['coherence_interaction_horizontal_scroll_range']['sizes']['start']) ? $settings['coherence_interaction_horizontal_scroll_range']['sizes']['start'] : 0;
			$this->interactions[$data['id']]['horizontal_viewport_top'] = isset($settings['coherence_interaction_horizontal_scroll_range']['sizes']['end']) ? $settings['coherence_interaction_horizontal_scroll_range']['sizes']['end'] : 100;
			$this->interactions[$data['id']]['devices'] = isset($settings['coherence_interaction_devices']) ? $settings['coherence_interaction_devices'] : '';
		}

		if (isset($settings['coherence_interaction_mouse']) && $settings['coherence_interaction_mouse'] == 'yes') {
			$this->interactions[$data['id']]['mousemove'] = 'yes';
			$this->interactions[$data['id']]['mouse_direction'] = isset($settings['coherence_interaction_mouse_direction']) && $settings['coherence_interaction_mouse_direction'] === 'negative' ? 1 : -1;
			$this->interactions[$data['id']]['mouse_speed'] = isset($settings['coherence_interaction_mouse_speed']) ? $settings['coherence_interaction_mouse_speed']['size'] : 1;
			$this->interactions[$data['id']]['mouse_speed'] = isset($settings['coherence_interaction_mouse_speed']) ? $settings['coherence_interaction_mouse_speed']['size'] : 1;
			$this->interactions[$data['id']]['devices'] = isset($settings['coherence_interaction_devices']) ? $settings['coherence_interaction_devices'] : '';
		}
	}

	public function add_post_css($post_css, $element)
	{
		if ($post_css instanceof Dynamic_CSS) {
			return;
		}

		if ($element->get_type() === 'section') {

			$output_css = '';
			$section_selector = $post_css->get_element_unique_selector($element);


			foreach ($element->get_children() as $child) {

				if ($child->get_type() === 'column') {

					$settings = $child->get_settings();

					if (!empty($settings['coherence_column_breakpoints_list'])) {

						$column_selector = $post_css->get_element_unique_selector($child);

						foreach ($settings['coherence_column_breakpoints_list'] as $breakpoint) {

							$media_min_width = !empty($breakpoint['media_min_width']) && !empty($breakpoint['media_min_width']['size']) ? intval($breakpoint['media_min_width']['size']) : 0;
							$media_max_width = !empty($breakpoint['media_max_width']) && !empty($breakpoint['media_max_width']['size']) ? intval($breakpoint['media_max_width']['size']) : 0;

							if ($media_min_width > 0 || $media_max_width > 0) {

								$media_query = array();
								if ($media_max_width > 0) {
									$media_query[] = '(max-width:' . $media_max_width . 'px)';
								}
								if ($media_min_width > 0) {
									$media_query[] = '(min-width:' . $media_min_width . 'px)';
								}

								if ($css = $this->generate_breakpoint_css($column_selector, $breakpoint)) {
									$css = $section_selector . ' > .elementor-container > .elementor-row{flex-wrap: wrap;}' . $css;
									$output_css .= '@media ' . implode(' and ', $media_query) . '{' . $css . '}';
								}
							}
						}
					}
				}
			}

			if (!empty($output_css)) {
				$post_css->get_stylesheet()->add_raw_css($output_css);
			}
		}

		$element_settings = $element->get_settings();
		if (empty($element_settings['coherence_custom_css'])) {
			return;
		}
		$custom_css = trim($element_settings['coherence_custom_css']);
		if (empty($custom_css)) {
			return;
		}
		$custom_css = str_replace('selector', $post_css->get_element_unique_selector($element), $custom_css);
		$post_css->get_stylesheet()->add_raw_css($custom_css);
	}


	public function enqueue_scripts()
	{

		if (!empty($this->interactions) || \Elementor\Plugin::$instance->preview->is_preview_mode()) {
			wp_enqueue_script('rellax', COHERENCE_ELEMENTOR_SECTION_INTERACTIONS_URL . '/assets/js/rellax.min.js', array(), null, true);
			wp_enqueue_script('coherence-interactions', COHERENCE_ELEMENTOR_SECTION_INTERACTIONS_URL . '/assets/js/interactions.js', array('jquery', 'elementor-frontend', 'rellax'), null, true);
			wp_localize_script(
				'coherence-interactions',
				'coherence_interactions',
				$this->interactions
			);
		}

		if (!empty($this->parallax_sections) || \Elementor\Plugin::$instance->preview->is_preview_mode()) {
			wp_enqueue_style('coherence-section-parallax', COHERENCE_ELEMENTOR_SECTION_INTERACTIONS_URL . '/assets/css/section-parallax.css');
			wp_enqueue_script('coherence-section-parallax', COHERENCE_ELEMENTOR_SECTION_INTERACTIONS_URL . '/assets/js/section-parallax.js', array('jquery', 'elementor-frontend', 'parallax'), null, true);
			wp_localize_script(
				'coherence-section-parallax',
				'coherence-section-parallax',
				$this->parallax_sections
			);
		}
	}
}

Coherence_Section_Interactions::instance();
