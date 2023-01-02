<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
/**
* Elementor heading widget.
*
* Elementor widget that displays an eye-catching headlines.
*
* @since 1.0.0
*/

class Coherence_Heading_Widget extends Widget_Heading {
	public function  __construct($data = [], $args = null) {
		parent::__construct( $data, $args );
		add_action( 'elementor/element/before_section_end', [$this,'inject_register_controls'], 99, 3 );
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
	public function get_name() {
		return 'coherence_Heading_widget';
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
	protected function register_controls() {
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
		$this->update_control(
			'link',
			[
				'dynamic' => [
					'active' => false,
				],
				'condition' => [ 'show_link[value]' => 'yes' ],
			]
		);
	}

	public function inject_register_controls($element, $section_id, $args) {
		if('section_title' === $section_id && $element->get_name() === 'coherence_Heading_widget') {

			$element->add_control(
				'option_title_heading',
				[
					'label' => esc_html__( 'Option Title', 'coherence-core' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$element->add_control(
				'show_link',
				[
					'label' => esc_html__( 'Title link', 'coherence-core' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'coherence-core' ),
					'label_off' => esc_html__( 'Hide', 'coherence-core' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			// $element->add_control(
			// 	'gradient_font_color',
			// 	[
			// 		'label' => esc_html__( 'Gradient Font Color', 'coherence-core' ),
			// 		'type' => \Elementor\Controls_Manager::SWITCHER,
			// 		'label_on' => esc_html__( 'Show', 'coherence-core' ),
			// 		'label_off' => esc_html__( 'Hide', 'coherence-core' ),
			// 		'return_value' => 'yes',
			// 		'default' => 'no',
			// 	]
			// );

            $element->add_control(
				'show_separator',
				[
					'label' => esc_html__( 'Show Separator', 'coherence-core' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'coherence-core' ),
					'label_off' => esc_html__( 'Hide', 'coherence-core' ),
					'return_value' => 'yes',
					'default' => 'no',
				]
			);

			$element->add_responsive_control(
				'separator_title',
				[
					'label' => esc_html__( 'Separator Title', 'coherence-core' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'none',
					'options' => [
						'none' => esc_html__( 'None', 'coherence-core' ),
						'single-solid' => esc_html__( 'Single Solid', 'coherence-core' ),
						'single-dashed' => esc_html__( 'Single Dashed', 'coherence-core' ),
						'single-dotted' => esc_html__( 'Single Dotted', 'coherence-core' ),
						'double-solid' => esc_html__( 'Double Solid', 'coherence-core' ),
						'double-dashed' => esc_html__( 'Double Dashed', 'coherence-core' ),
						'double-dotted' => esc_html__( 'Double Dotted', 'coherence-core' ),
					],
				]
			);

            $element->add_responsive_control(
				'separator_type',
				[
					'label' => esc_html__( 'Separator Type', 'coherence-core' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'block',
					'options' => [
						'block' => esc_html__( 'Block', 'coherence-core' ),
						'inline-block' => esc_html__( 'Inline Block', 'coherence-core' ),
					],
                    'selectors' => [
                        '{{WRAPPER}} [class*="coherence-core-heading"]' => 'display: {{VALUE}};',
                    ],
				]
			);

            $element->add_control(
                'separator_space_title',
                [
                    'label' => esc_html__( 'Space Between Separator / Title', 'coherence-core' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px','em'],
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
                ]
            );

            $element->add_control(
                'double_separator_thickness',
                [
                    'label' => esc_html__( 'Thickness Separator', 'coherence-core' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px','em'],
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
                ]
            );

            $element->add_control(
                'separator_color',
                [
                    'label' => esc_html__( 'Separator Color', 'coherence-core' ),
                    'type' => Controls_Manager::COLOR,
                    'global' => [
                        'default' => Global_Colors::COLOR_PRIMARY,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} [class*="coherence-core-heading"]' => 'border-color: {{VALUE}};',
                    ],
                ]
            );

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
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( '' === $settings['title'] ) {
			return;
		}

		$this->add_render_attribute( 'title', 'class', "elementor-heading-title coherence-core-heading-{$settings['separator_title']}" );

		if ( ! empty( $settings['size'] ) ) {
			$this->add_render_attribute( 'title', 'class', 'elementor-size-' . $settings['size'] );
		}

		$this->add_inline_editing_attributes( 'title' );

		$title = $settings['title'];

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'url', $settings['link'] );

			$title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
		}

		$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', Utils::validate_html_tag( $settings['header_size'] ), $this->get_render_attribute_string( 'title' ), $title );

		// PHPCS - the variable $title_html holds safe data.
		echo $title_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

    /**
	 * Render heading widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() {
		?>
        <div class="coherence-heading">
        <#
        var title = settings.title;
        var show_separator = settings.show_separator;

		if ( '' !== settings.link.url ) {
			title = '<a href="' + settings.link.url + '">' + title + '</a>';
		}

        view.addRenderAttribute( 'title', 'class', [ 'elementor-heading-title', 'elementor-size-' + settings.size ] );
        view.addInlineEditingAttributes( 'title' );

        var headerSizeTag = elementor.helpers.validateHTMLTag( settings.header_size )
        if ( headerSizeTag ) {
            #>
            <{{{headerSizeTag}}} {{{view.getRenderAttributeString( 'title' )}}}>{{{title}}}</{{{headerSizeTag}}}>
            <#
        } 
        if ( show_separator === 'yes' ) {
            #>
                <span class="coherence-core-heading-{{{settings.separator_title}}}"></span>
            <#
            }
        #>
        </div>
		<?php
	}

} 

Plugin::instance()->widgets_manager->register(new Coherence_Heading_Widget());