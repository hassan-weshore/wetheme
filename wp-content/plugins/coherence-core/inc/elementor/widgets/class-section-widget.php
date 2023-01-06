<?php

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Element_Base;

defined('ABSPATH') || die();

class Coherence_Elementor_Custom_Controls
{

    public static function init()
    {
        //add_action( 'elementor/element/common/_section_style/after_section_end', [ __CLASS__, 'add_controls_section' ], 1 );
        add_action('elementor/element/column/section_advanced/after_section_end', [__CLASS__, 'add_controls_section'], 1);
        add_action('elementor/element/section/section_advanced/after_section_end', [__CLASS__, 'add_controls_section'], 1);
        add_action('elementor/frontend/before_render', [__CLASS__, 'before_section_render'], 1);

        // Coherence Annimations
        add_action('elementor/element/after_section_end', function ($element, $section_id) {

            if ('section_advanced' === $section_id || '_section_style' === $section_id) {

                $element->start_controls_section(
                    'coherence_custom_animations',
                    [
                        'label' => __('Animations & Parallax', 'Coherence Elementor Addons'),
                        'tab' => Controls_Manager::TAB_ADVANCED,
                    ]
                );

                // ld_el_parallax( $element ); // call parallax options
                //ld_el_content_animation( $element ); // call content animation options

                $element->end_controls_section();
            }
        }, 10, 2);

        // Iconbox Scale
        add_action('elementor/frontend/widget/before_render', function (Element_Base $element) {
            if (!$element->get_settings('enable_scale_animation')) {
                return;
            }

            $element->add_render_attribute('_wrapper', [
                'class' => 'coherence-iconbox-scale'
            ]);
        });

        // Wrap Columns
        add_action('elementor/element/section/section_layout/before_section_end', function ($control_stack) {

            $control_stack->start_injection([
                'at' => 'before',
                'of' => 'gap'
            ]);

            $control_stack->add_control(
                'coherence_columns_wrap',
                [
                    'label' => __('Wrap Columns', 'coherence-elementor-addons'),
                    'description' => __('Check this option if you want to wrap columns in multiple rows on desktop. Change column width to see the effect.', 'coherence-elementor-addons'),
                    'type' => Controls_Manager::SWITCHER,
                    'selectors' => [
                        '{{WRAPPER}} > .elementor-container' => 'flex-wrap: wrap;',
                    ],
                ]
            );

            $control_stack->end_injection();
        });

        // Additional Shape Colors
        add_action('elementor/element/section/section_shape_divider/before_section_end', function ($control_stack) {

            // Bottom
            $control_stack->start_injection([
                'at' => 'before',
                'of' => 'shape_divider_bottom_width'
            ]);

            $control_stack->add_control(
                'coherence_custom_shape_bottom_color2',
                [
                    'label' => __('Color 2', 'plugin-domain'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .elementor-shape-bottom .elementor-shape-fill:nth-child(2)' => 'fill: {{VALUE}}; fill-opacity: 1 !important; opacity: 1 !important;',
                    ],
                    'condition' => [
                        'shape_divider_bottom!' => '',
                    ],
                ]
            );

            $control_stack->add_control(
                'coherence_custom_shape_bottom_color3',
                [
                    'label' => __('Color 3', 'plugin-domain'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .elementor-shape-bottom .elementor-shape-fill:nth-child(3)' => 'fill: {{VALUE}}; fill-opacity: 1 !important; opacity: 1 !important;',
                    ],
                    'condition' => [
                        'shape_divider_bottom!' => '',
                    ],
                ]
            );

            $control_stack->add_control(
                'coherence_custom_shape_bottom_color4',
                [
                    'label' => __('Color 4', 'plugin-domain'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .elementor-shape-bottom .elementor-shape-fill:nth-child(4)' => 'fill: {{VALUE}}; fill-opacity: 1 !important; opacity: 1 !important;',
                    ],
                    'condition' => [
                        'shape_divider_bottom!' => '',
                    ],
                ]
            );

            $control_stack->end_injection();

            // Top
            $control_stack->start_injection([
                'at' => 'before',
                'of' => 'shape_divider_top_width'
            ]);

            $control_stack->add_control(
                'coherence_custom_shape_top_color2',
                [
                    'label' => __('Color 2', 'plugin-domain'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .elementor-shape-top .elementor-shape-fill:nth-child(2)' => 'fill: {{VALUE}}; fill-opacity: 1 !important; opacity: 1 !important;',
                    ],
                    'condition' => [
                        'shape_divider_top!' => '',
                    ],
                ]
            );

            $control_stack->add_control(
                'coherence_custom_shape_top_color3',
                [
                    'label' => __('Color 3', 'plugin-domain'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .elementor-shape-top .elementor-shape-fill:nth-child(3)' => 'fill: {{VALUE}}; fill-opacity: 1 !important; opacity: 1 !important;',
                    ],
                    'condition' => [
                        'shape_divider_top!' => '',
                    ],
                ]
            );

            $control_stack->add_control(
                'coherence_custom_shape_top_color4',
                [
                    'label' => __('Color 4', 'plugin-domain'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .elementor-shape-top .elementor-shape-fill:nth-child(4)' => 'fill: {{VALUE}}; fill-opacity: 1 !important; opacity: 1 !important;',
                    ],
                    'condition' => [
                        'shape_divider_top!' => '',
                    ],
                ]
            );

            $control_stack->end_injection();

            // Bottom shape animation
            $control_stack->start_injection([
                'at' => 'after',
                'of' => 'shape_divider_bottom_above_content'
            ]);

            $control_stack->end_injection();

            // Top shape animation
            $control_stack->start_injection([
                'at' => 'after',
                'of' => 'shape_divider_top_above_content'
            ]);

            $control_stack->end_injection();
        });
    }

    public static function add_controls_section(Element_Base $element)
    {

        if ('section' === $element->get_name()) {

            $element->start_controls_section(
                'coherence_custom_row_heading',
                [
                    'label' => __('Section Options', 'coherence-elementor-addons'),
                    'tab'   => Controls_Manager::TAB_LAYOUT,
                ]
            );

            if (get_post_type(get_the_ID()) !== 'coherence-header') {

                $page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers('page');
                $page_settings_model = $page_settings_manager->get_model(get_the_ID());

                $element->add_control(
                    'coherence_luminosity_data_attr',
                    [
                        'label' => __('Luminosity', 'coherence-elementor-addons'),
                        'type' => Controls_Manager::CHOOSE,
                        'options' => [
                            'default-auto' => [
                                'title' => __('Automatic', 'coherence-elementor-addons'),
                                'icon' => 'fa fa-adjust',
                            ],
                            'dark' => [
                                'title' => __('Dark', 'coherence-elementor-addons'),
                                'icon' => 'fa fa-moon',
                            ],
                            'light' => [
                                'title' => __('Light', 'coherence-elementor-addons'),
                                'icon' => 'fa fa-sun',
                            ],
                        ],
                        'default' => 'default-auto',
                        'toggle' => false,
                    ]
                );

                $element->add_control(
                    'coherence_section_scroll',
                    [
                        'label' => __('Section Scroll?', 'coherence-elementor-addons'),
                        'description' => __('Enable this option to make the section scrollable.', 'coherence-elementor-addons'),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __('On', 'coherence-elementor-addons'),
                        'label_off' => __('Off', 'coherence-elementor-addons'),
                        'return_value' => 'yes',
                        'default' => '',
                        'separator' => 'before',
                    ]
                );

                $element->add_control(
                    'custom_cursor_on_hover',
                    [
                        'label' => __('Custom cursor on hover', 'coherence-elementor-addons'),
                        'description' => __('For it to work, enable the following from: Theme Options > Extras > Custom Cursor', 'coherence-elementor-addons'),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __('On', 'coherence-elementor-addons'),
                        'label_off' => __('Off', 'coherence-elementor-addons'),
                        'return_value' => 'yes',
                        'default' => '',
                        'separator' => 'before',
                    ]
                );

                $element->add_control(
                    'custom_cursor_color',
                    [
                        'label' => __('Custom cursor color', 'coherence-elementor-addons'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} > .coherence-extra-cursor' => 'background: {{VALUE}};',
                        ],
                        'condition' => [
                            'custom_cursor_on_hover' => 'yes',
                        ],
                    ]
                );

                //  $page_enable_stack = $page_settings_model->get_settings('page_enable_stack');
                //   $page_enable_stack = $page_enable_stack === 'on' ? '' : array('coherence_disable_option' => 'on');

                $element->add_control(
                    'section_data_tooltip',
                    [
                        'label' => __('Section tooltip', 'coherence-elementor-addons'),
                        'type' => Controls_Manager::TEXT,
                        'description' => __('Add title as tooltip on stack page', 'coherence-elementor-addons'),
                        'render_type' => 'none',
                        //'condition' => $page_enable_stack
                    ]
                );

                $element->add_control(
                    'coherence_sticky_row',
                    [
                        'label' => __('Sticky Row', 'coherence-elementor-addons'),
                        'description' => __('Enable to make this row sticky', 'coherence-elementor-addons'),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __('On', 'coherence-elementor-addons'),
                        'label_off' => __('Off', 'coherence-elementor-addons'),
                        'return_value' => 'coherence-css-sticky',
                        'render_type' => 'none',
                        'default' => '',
                        'separator' => 'before',
                    ]
                );
            }

            // Header section controls
            if (get_post_type(get_the_ID()) === 'coherence-header') {

                $element->add_control(
                    'hide_on_sticky',
                    [
                        'label' => __('Hide On Sticky Header?', 'coherence-elementor-addons'),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __('On', 'coherence-elementor-addons'),
                        'label_off' => __('Off', 'coherence-elementor-addons'),
                        'return_value' => 'coherence-hide-onstuck',
                        'default' => '',
                        'condition' => array(
                            'show_on_sticky' => '',
                        ),
                    ]
                );

                $element->add_control(
                    'show_on_sticky',
                    [
                        'label' => __('Show Only On Sticky Header?', 'coherence-elementor-addons'),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __('On', 'coherence-elementor-addons'),
                        'label_off' => __('Off', 'coherence-elementor-addons'),
                        'return_value' => 'coherence-show-onstuck',
                        'default' => '',
                        'condition' => array(
                            'hide_on_sticky' => '',
                        ),
                    ]
                );

                $element->add_control(
                    'sticky_bar',
                    [
                        'label' => __('Vertical Bar?', 'coherence-elementor-addons'),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __('On', 'coherence-elementor-addons'),
                        'label_off' => __('Off', 'coherence-elementor-addons'),
                        'return_value' => 'yes',
                        'default' => '',
                    ]
                );

                $element->add_control(
                    'stickybar_placement',
                    [
                        'label' => __('Vertical Bar position', 'coherence-elementor-addons'),
                        'type' => Controls_Manager::CHOOSE,
                        'options' => [
                            'coherence-stickybar-left' => [
                                'title' => __('Left', 'coherence-elementor-addons'),
                                'icon' => 'eicon-arrow-left',
                            ],
                            'coherence-stickybar-right' => [
                                'title' => __('Right', 'coherence-elementor-addons'),
                                'icon' => 'eicon-arrow-right',
                            ],
                        ],
                        'default' => 'coherence-stickybar-left',
                        'toggle' => false,
                        'condition' => [
                            'sticky_bar' => 'yes'
                        ],
                    ]
                );
            }

            $element->end_controls_section();
        }

        if ('column' === $element->get_name()) {
            $element->start_controls_section(
                'coherence_custom_column_heading',
                [
                    'label' => __('Column Options', 'coherence-elementor-addons'),
                    'tab'   => Controls_Manager::TAB_LAYOUT,
                ]
            );

            $element->add_control(
                'enable_sticky_column',
                [
                    'label' => __('Sticky Column', 'coherence-elementor-addons'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('On', 'coherence-elementor-addons'),
                    'label_off' => __('Off', 'coherence-elementor-addons'),
                    'return_value' => 'yes',
                    'default' => '',
                ]
            );

            $element->add_control(
                'sticky_column_offset',
                [
                    'label' => __('Sticky Offset', 'coherence-elementor-addons'),
                    'type' => Controls_Manager::TEXT,
                    'default' => '30px',
                    'placeholder' => __('ex. 10px', 'coherence-elementor-addons'),
                    'condition' => [
                        'enable_sticky_column' => 'yes'
                    ],
                ]
            );

            $element->add_control(
                'enable_link',
                [
                    'label' => __('Enable Link', 'coherence-elementor-addons'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('On', 'coherence-elementor-addons'),
                    'label_off' => __('Off', 'coherence-elementor-addons'),
                    'return_value' => 'yes',
                    'default' => '',
                    'condition' => [
                        'coherence_disabled' => 'no',
                    ]
                ]
            );

            $element->add_control(
                'link',
                [
                    'label' => __('Link', 'coherence-elementor-addons'),
                    'type' => Controls_Manager::URL,
                    'placeholder' => __('https://your-link.com', 'coherence-elementor-addons'),
                    'show_external' => true,
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                    'condition' => [
                        'enable_link' => 'yes'
                    ]
                ]
            );
            $element->end_controls_section();
        }
    }

    public static function before_section_render(Element_Base $element)
    {

        // Section
        if ($element->get_settings('coherence_luminosity_data_attr') && 'default-auto' !== $element->get_settings('coherence_luminosity_data_attr')) {
            $element->add_render_attribute('_wrapper', [
                'data-section-luminosity' => $element->get_settings('coherence_luminosity_data_attr'),
            ]);
        }

        if ($element->get_settings('custom_cursor_on_hover')) {
            $element->add_render_attribute('_wrapper', [
                'data-coherence-custom-cursor' => 'true',
            ]);
        }

        if ($element->get_settings('coherence_section_scroll')) {
            $element->add_render_attribute('_wrapper', [
                'data-coherence-section-scroll' => 'true',
            ]);
        }

        if ($element->get_settings('hide_on_sticky')) {
            $element->add_render_attribute('_wrapper', [
                'class' => $element->get_settings('hide_on_sticky'),
            ]);
        }

        if ($element->get_settings('show_on_sticky')) {
            $element->add_render_attribute('_wrapper', [
                'class' => $element->get_settings('show_on_sticky'),
            ]);
        }

        if ($element->get_settings('sticky_bar')) {
            $placement = $element->get_settings('stickybar_placement');
            if (empty($placement)) {
                $placement = 'coherence-stickybar-left';
            }
            $element->add_render_attribute('_wrapper', [
                'class' => 'coherence-stickybar-wrap ' . $placement,
            ]);
        }

        if ($element->get_settings('coherence_enable_bottom_shape_animation')) {
            $element->add_render_attribute('_wrapper', [
                'class' => $element->get_settings('coherence_enable_bottom_shape_animation'),
            ]);
        }

        if ($element->get_settings('coherence_enable_top_shape_animation')) {
            $element->add_render_attribute('_wrapper', [
                'class' => $element->get_settings('coherence_enable_top_shape_animation'),
            ]);
        }

        if ($element->get_settings('enable_sticky_column')) {
            $element->add_render_attribute('_wrapper', [
                'class' => 'coherence-css-sticky-column',
                'style' => '--coherence-sticky-offset:' . $element->get_settings('sticky_column_offset'),
            ]);
        }

        if ($element->get_settings('section_data_tooltip')) {
            $element->add_render_attribute('_wrapper', [
                'data-tooltip' => $element->get_settings('section_data_tooltip'),
            ]);
        }

        if ($element->get_settings('coherence_sticky_row')) {
            $element->add_render_attribute('_wrapper', [
                'class' => $element->get_settings('coherence_sticky_row'),
            ]);
        }

        // Scale BG
        if ($element->get_settings('row_scaleBg_onhover')) {

            $image_uri = $element->get_settings('background_image');

            $element->add_render_attribute('_wrapper', [
                'class' => 'coherence-scale-bg-onhover',
                'data-row-bg' => $image_uri['url'],
            ]);
        }

        // Parallax
        if ($element->get_settings('coherence_parallax')) {

            $perspective = $element->get_settings('coherence_parallax_settings_perspective');

            $from_x = $element->get_settings('coherence_parallax_from_x');
            $from_y = $element->get_settings('coherence_parallax_from_y');
            $from_z = $element->get_settings('coherence_parallax_from_z');

            $from_scaleX = $element->get_settings('coherence_parallax_from_scaleX');
            $from_scaleY = $element->get_settings('coherence_parallax_from_scaleY');

            $from_rotationX = $element->get_settings('coherence_parallax_from_rotationX');
            $from_rotationY = $element->get_settings('coherence_parallax_from_rotationY');
            $from_rotationZ = $element->get_settings('coherence_parallax_from_rotationZ');

            $from_opacity = $element->get_settings('coherence_parallax_from_opacity');

            $from_transformOriginX = $element->get_settings('coherence_parallax_from_transformOriginX');
            $from_transformOriginY = $element->get_settings('coherence_parallax_from_transformOriginY');
            $from_transformOriginZ = $element->get_settings('coherence_parallax_from_transformOriginZ');

            $to_x = $element->get_settings('coherence_parallax_to_x');
            $to_y = $element->get_settings('coherence_parallax_to_y');
            $to_z = $element->get_settings('coherence_parallax_to_z');

            $to_scaleX = $element->get_settings('coherence_parallax_to_scaleX');
            $to_scaleY = $element->get_settings('coherence_parallax_to_scaleY');

            $to_rotationX = $element->get_settings('coherence_parallax_to_rotationX');
            $to_rotationY = $element->get_settings('coherence_parallax_to_rotationY');
            $to_rotationZ = $element->get_settings('coherence_parallax_to_rotationZ');

            $to_opacity = $element->get_settings('coherence_parallax_to_opacity');

            $to_transformOriginX = $element->get_settings('coherence_parallax_to_transformOriginX');
            $to_transformOriginY = $element->get_settings('coherence_parallax_to_transformOriginY');
            $to_transformOriginZ = $element->get_settings('coherence_parallax_to_transformOriginZ');

            $parallax_ease = $element->get_settings('coherence_parallax_settings_ease');
            $parallax_duration = $element->get_settings('coherence_parallax_settings_duration');
            $parallax_trigger = $element->get_settings('coherence_parallax_settings_trigger');
            $parallax_trigger_start = $element->get_settings('coherence_parallax_settings_trigger_start');
            $parallax_trigger_end = $element->get_settings('coherence_parallax_settings_trigger_end');

            $wrapper_attributes = $parallax_data = $parallax_data_from = $parallax_data_to = $parallax_opts = array();

            if (!empty($perspective) && !empty($perspective['size'])) {
                $parallax_data_from['transformPerspective'] = $perspective['size'] . $perspective['unit'];
            }

            if (!empty($from_x) && !empty($to_x) && $from_x != $to_x) {
                $parallax_data_from['x'] = $from_x['size'] . $from_x['unit'];
                $parallax_data_to['x'] = $to_x['size'] . $to_x['unit'];
            }
            if (!empty($from_y) && !empty($to_y) && $from_y != $to_y) {
                $parallax_data_from['y'] = $from_y['size'] . $from_y['unit'];
                $parallax_data_to['y'] = $to_y['size'] . $to_y['unit'];
            }
            if (!empty($from_z) && !empty($to_z) && $from_z != $to_z) {
                $parallax_data_from['z'] = $from_z['size'] . $from_z['unit'];
                $parallax_data_to['z'] = $to_z['size'] . $to_z['unit'];
            }

            if (!empty($from_scaleX) && !empty($to_scaleX) && $from_scaleX != $to_scaleX) {
                $parallax_data_from['scaleX'] = (float) $from_scaleX['size'];
                $parallax_data_to['scaleX'] = (float) $to_scaleX['size'];
            }
            if (!empty($from_scaleY) && !empty($to_scaleY) && $from_scaleY != $to_scaleY) {
                $parallax_data_from['scaleY'] = (float) $from_scaleY['size'];
                $parallax_data_to['scaleY'] = (float) $to_scaleY['size'];
            }

            if (!empty($from_rotationX) && !empty($to_rotationX) && $from_rotationX != $to_rotationX) {
                $parallax_data_from['rotationX'] = (int) $from_rotationX['size'];
                $parallax_data_to['rotationX'] = (int) $to_rotationX['size'];
            }
            if (!empty($from_rotationY) && !empty($to_rotationY) && $from_rotationY != $to_rotationY) {
                $parallax_data_from['rotationY'] = (int) $from_rotationY['size'];
                $parallax_data_to['rotationY'] = (int) $to_rotationY['size'];
            }
            if (!empty($from_rotationZ) && !empty($to_rotationZ) && $from_rotationZ != $to_rotationZ) {
                $parallax_data_from['rotationZ'] = (int) $from_rotationZ['size'];
                $parallax_data_to['rotationZ'] = (int) $to_rotationZ['size'];
            }

            if (!empty($from_opacity) && !empty($to_opacity) && $from_opacity != $to_opacity) {
                $parallax_data_from['opacity'] = (float) $from_opacity['size'];
                $parallax_data_to['opacity'] = (float) $to_opacity['size'];
            }

            $from_toriginX = isset($from_transformOriginX) && !empty($from_transformOriginX) ? $from_transformOriginX['size'] . $from_transformOriginX['unit'] : '';
            $from_toriginY = isset($from_transformOriginY) && !empty($from_transformOriginY) ? $from_transformOriginY['size'] . $from_transformOriginY['unit'] : '';
            $from_toriginZ = isset($from_transformOriginZ) && !empty($from_transformOriginZ) ? $from_transformOriginZ['size'] . $from_transformOriginZ['unit'] : '';

            $to_toriginX = isset($to_transformOriginX) && !empty($to_transformOriginX) ? $to_transformOriginX['size'] . $to_transformOriginX['unit'] : '';
            $to_toriginY = isset($to_transformOriginY) && !empty($to_transformOriginY) ? $to_transformOriginY['size'] . $to_transformOriginY['unit'] : '';
            $to_toriginZ = isset($to_transformOriginZ) && !empty($to_transformOriginZ) ? $to_transformOriginZ['size'] . $to_transformOriginZ['unit'] : '';

            if (
                !empty($from_toriginX) && !empty($from_toriginY) && !empty($from_toriginZ) &&
                !empty($to_toriginX) && !empty($to_toriginY) && !empty($to_toriginZ)
            ) {
                $parallax_data_from['transformOrigin'] = $from_toriginX . ' ' . $from_toriginY . ' ' . $from_toriginZ;
                $parallax_data_to['transformOrigin'] = $to_toriginX . ' ' . $to_toriginY . ' ' . $to_toriginZ;
            }

            if ($parallax_data_from['transformOrigin'] == $parallax_data_to['transformOrigin']) {
                unset($parallax_data_from['transformOrigin']);
                unset($parallax_data_to['transformOrigin']);
            }

            //Parallax general options
            $parallax_data['from'] = $parallax_data_from;
            $parallax_data['to'] = $parallax_data_to;

            if (is_array($parallax_data['from']) && !empty($parallax_data['from'])) {
                $wrapper_attributes[] = 'data-parallax-from=\'' . wp_json_encode($parallax_data['from']) . '\'';
            }
            if (is_array($parallax_data['to']) && !empty($parallax_data['to'])) {
                $wrapper_attributes[] = 'data-parallax-to=\'' . wp_json_encode($parallax_data['to']) . '\'';
            }

            if (isset($parallax_ease)) {
                $parallax_opts['ease'] = $parallax_ease;
            }
            if ('custom' !== $parallax_trigger) {
                $parallax_opts['start'] = esc_attr($parallax_trigger);
                if (isset($parallax_duration) && !empty($parallax_duration)) {
                    $dur = $parallax_duration['size'] >= 0 ? '+=' . abs($parallax_duration['size']) . $parallax_duration['unit'] . '' : '-=' . abs($parallax_duration['size']) . $parallax_duration['unit'] . '';
                    $parallax_opts['end'] = esc_attr('bottom'  . $dur . ' top');
                }
            } else {
                if (!empty($parallax_trigger_number_start)) {
                    $parallax_opts['start'] = esc_attr($parallax_trigger_number_start);
                }
                if (!empty($parallax_trigger_number_end)) {
                    $parallax_opts['end'] = esc_attr($parallax_trigger_number_end);
                }
            }
            if (!empty($parallax_opts)) {
                $wrapper_attributes[] = 'data-parallax-options=\'' . wp_json_encode($parallax_opts) . '\'';
            }

            $element->add_render_attribute('_wrapper', [
                'data-parallax' => 'true',
                'data-parallax-options' => wp_json_encode($parallax_opts),
                'data-parallax-from' => wp_json_encode($parallax_data['from']),
                'data-parallax-to' => wp_json_encode($parallax_data['to']),
            ]);
        }

        // Animation
        if ($element->get_settings('coherence_custom_animation')) {

            $ca_preset_values = array();
            $ca_opts = $ca_from_values = $ca_to_values = array();
            $animation_targets = array();

            $animation_preset = $element->get_settings('coherence_ca_preset');
            $ca_ease = $element->get_settings('coherence_ca_settings_ease');
            $ca_direction = $element->get_settings('coherence_ca_settings_direction');
            $ca_duration = $element->get_settings('coherence_ca_settings_duration')['size'];
            $ca_stagger = $element->get_settings('coherence_ca_settings_stagger')['size'];
            $ca_start_delay = $element->get_settings('coherence_ca_settings_start_delay')['size'];

            $ca_opts['addChildTimelines'] = false;
            // $ca_opts['addPerspective'] = false;

            switch ($element->get_name()) {
                case 'section':
                    array_push($animation_targets, ':scope > .elementor-container > .elementor-column');
                    break;
                case 'column':
                    // $ca_opts['addChildTimelines'] = true;
                    array_push($animation_targets, ':scope > .elementor-widget-wrap > .elementor-element > .elementor-widget-container');
                    array_push($animation_targets, ':scope > .elementor-widget-wrap > .elementor-section > .elementor-container > .elementor-column > .elementor-widget-wrap > .elementor-element:not(.coherence-el-has-inner-anim) > .elementor-widget-container');
                    array_push($animation_targets, ':scope > .elementor-widget-wrap > .elementor-widget-coherence_fancy_heading .coherence-split-lines .coherence-lines .split-inner');
                    array_push($animation_targets, ':scope > .elementor-widget-wrap > .elementor-widget-coherence_fancy_heading .coherence-split-words .coherence-words .split-inner');
                    array_push($animation_targets, ':scope > .elementor-widget-wrap > .elementor-widget-coherence_fancy_heading .coherence-split-chars .coherence-chars .split-inner');
                    array_push($animation_targets, ':scope > .elementor-widget-wrap > .elementor-widget-ld_custom_menu .coherence-fancy-menu > ul > li');
                    break;
                default:
                    // $ca_opts['addChildTimelines'] = true;

                    if ($element->get_name() === 'coherence_fancy_heading' && $element->get_settings('enable_split')) {

                        $split_type = $element->get_settings('split_type');

                        if ($split_type === 'lines') {
                            array_push($animation_targets, '.coherence-split-lines .coherence-lines .split-inner');
                        } else if ($split_type === 'words') {
                            array_push($animation_targets, '.coherence-split-words .coherence-words .split-inner');
                        } else if ($split_type === 'chars, words') {
                            array_push($animation_targets, '.coherence-split-chars .coherence-chars .split-inner');
                        }
                    } else if ($element->get_name() === 'ld_custom_menu') {
                        array_push($animation_targets, ':scope .coherence-fancy-menu > ul > li');
                    } else {
                        array_push($animation_targets, ':scope > .elementor-widget-container');
                    }

                    break;
            }

            $ca_opts['animationTarget'] = implode(', ', $animation_targets);

            if (!empty($ca_duration) && $ca_duration !== 1.6) {
                $ca_opts['duration'] = (float) ($ca_duration * 1000);
            }
            if (!empty($ca_start_delay) && $ca_start_delay !== 0) {
                $ca_opts['startDelay'] = (float) ($ca_start_delay * 1000);
            }
            if (!empty($ca_stagger) && $ca_stagger !== 0.16) {
                $ca_opts['delay'] = (float) ($ca_stagger * 1000);
            }
            if ($ca_ease !== 'power4.out') {
                $ca_opts['ease'] = $ca_ease;
            }
            if ($ca_direction !== 'forward') {
                $ca_opts['direction'] = $ca_direction;
            }

            if ('custom' !== $animation_preset) {

                $defined_animations = array(

                    'Fade In' => array(
                        'from' => array('opacity' => 0),
                        'to'   => array('opacity' => 1),
                    ),
                    'Fade In Down' => array(
                        'from' => array('opacity' => 0, 'translateY' => -150),
                        'to'   => array('opacity' => 1, 'translateY' => 0),
                    ),
                    'Fade In Up' => array(
                        'from' => array('opacity' => 0, 'translateY' => 150),
                        'to'   => array('opacity' => 1, 'translateY' => 0),
                    ),
                    'Fade In Left' => array(
                        'from' => array('opacity' => 0, 'translateX' => -150),
                        'to'   => array('opacity' => 1, 'translateX' => 0),
                    ),
                    'Fade In Right' => array(
                        'from' => array('opacity' => 0, 'translateX' => 150),
                        'to'   => array('opacity' => 1, 'translateX' => 0),
                    ),
                    'Flip In Y' => array(
                        'from' => array('opacity' => 0, 'translateX' => 150, 'rotationY' => 30),
                        'to'   => array('opacity' => 1, 'translateX' => 0, 'rotationY' => 0),
                    ),
                    'Flip In X' => array(
                        'from' => array('opacity' => 0, 'translateY' => 150, 'rotationX' => -30),
                        'to'   => array('opacity' => 1, 'translateY' => 0, 'rotationX' => 0),
                    ),
                    'Scale Up' => array(
                        'from' => array('opacity' => 0, 'scale' => 0.75),
                        'to'   => array('opacity' => 1, 'scale' => 1),
                    ),
                    'Scale Down' => array(
                        'from' => array('opacity' => 0, 'scale' => 1.25),
                        'to'   => array('opacity' => 1, 'scale' => 1),
                    ),

                );

                $ca_preset_values = $defined_animations[$animation_preset];
                $ca_from_values = $ca_preset_values['from'];
                $ca_to_values = $ca_preset_values['to'];
            } else {

                // From values
                $ca_from_x = $element->get_settings('coherence_ca_from_x');
                $ca_from_y = $element->get_settings('coherence_ca_from_y');
                $ca_from_z = $element->get_settings('coherence_ca_from_z');

                $ca_from_scaleX = $element->get_settings('coherence_ca_from_scaleX');
                $ca_from_scaleY = $element->get_settings('coherence_ca_from_scaleY');

                $ca_from_rotationX = $element->get_settings('coherence_ca_from_rotationX');
                $ca_from_rotationY = $element->get_settings('coherence_ca_from_rotationY');
                $ca_from_rotationZ = $element->get_settings('coherence_ca_from_rotationZ');

                $ca_from_transformOriginX = $element->get_settings('coherence_ca_from_transformOriginX');
                $ca_from_transformOriginY = $element->get_settings('coherence_ca_from_transformOriginY');
                $ca_from_transformOriginZ = $element->get_settings('coherence_ca_from_transformOriginZ');

                $ca_from_opacity = $element->get_settings('coherence_ca_from_opacity');

                // To values
                $ca_to_x = $element->get_settings('coherence_ca_to_x');
                $ca_to_y = $element->get_settings('coherence_ca_to_y');
                $ca_to_z = $element->get_settings('coherence_ca_to_z');

                $ca_to_scaleX = $element->get_settings('coherence_ca_to_scaleX');
                $ca_to_scaleY = $element->get_settings('coherence_ca_to_scaleY');

                $ca_to_rotationX = $element->get_settings('coherence_ca_to_rotationX');
                $ca_to_rotationY = $element->get_settings('coherence_ca_to_rotationY');
                $ca_to_rotationZ = $element->get_settings('coherence_ca_to_rotationZ');

                $ca_to_transformOriginX = $element->get_settings('coherence_ca_to_transformOriginX');
                $ca_to_transformOriginY = $element->get_settings('coherence_ca_to_transformOriginY');
                $ca_to_transformOriginZ = $element->get_settings('coherence_ca_to_transformOriginZ');

                $ca_to_opacity = $element->get_settings('coherence_ca_to_opacity');

                if (!empty($ca_from_x) && !empty($ca_to_x) && $ca_from_x != $ca_to_x) {
                    $ca_from_values['x'] = $ca_from_x['size'] . $ca_from_x['unit'];
                    $ca_to_values['x'] = $ca_to_x['size'] . $ca_to_x['unit'];
                }
                if (!empty($ca_from_y) && !empty($ca_to_y) && $ca_from_y != $ca_to_y) {
                    $ca_from_values['y'] = $ca_from_y['size'] . $ca_from_y['unit'];
                    $ca_to_values['y'] = $ca_to_y['size'] . $ca_to_y['unit'];
                }
                if (!empty($ca_from_z) && !empty($ca_to_z) && $ca_from_z != $ca_to_z) {
                    $ca_from_values['z'] = $ca_from_z['size'] . $ca_from_z['unit'];
                    $ca_to_values['z'] = $ca_to_z['size'] . $ca_to_z['unit'];
                }

                if (!empty($ca_from_scaleX) && !empty($ca_to_scaleX) && $ca_from_scaleX != $ca_to_scaleX) {
                    $ca_from_values['scaleX'] = (float) $ca_from_scaleX['size'];
                    $ca_to_values['scaleX'] = (float) $ca_to_scaleX['size'];
                }
                if (!empty($ca_from_scaleY) && !empty($ca_to_scaleY) && $ca_from_scaleY != $ca_to_scaleY) {
                    $ca_from_values['scaleY'] = (float) $ca_from_scaleY['size'];
                    $ca_to_values['scaleY'] = (float) $ca_to_scaleY['size'];
                }

                if (!empty($ca_from_rotationX) && !empty($ca_to_rotationX) && $ca_from_rotationX != $ca_to_rotationX) {
                    $ca_from_values['rotationX'] = (int) $ca_from_rotationX['size'];
                    $ca_to_values['rotationX'] = (int) $ca_to_rotationX['size'];
                }
                if (!empty($ca_from_rotationY) && !empty($ca_to_rotationY) && $ca_from_rotationY != $ca_to_rotationY) {
                    $ca_from_values['rotationY'] = (int) $ca_from_rotationY['size'];
                    $ca_to_values['rotationY'] = (int) $ca_to_rotationY['size'];
                }
                if (!empty($ca_from_rotationZ) && !empty($ca_to_rotationZ) && $ca_from_rotationZ != $ca_to_rotationZ) {
                    $ca_from_values['rotationZ'] = (int) $ca_from_rotationZ['size'];
                    $ca_to_values['rotationZ'] = (int) $ca_to_rotationZ['size'];
                }

                if (!empty($ca_from_opacity) && !empty($ca_to_opacity) && $ca_from_opacity != $ca_to_opacity) {
                    $ca_from_values['opacity'] = (float) $ca_from_opacity['size'];
                    $ca_to_values['opacity'] = (float) $ca_to_opacity['size'];
                }

                $ca_from_toriginX = isset($ca_from_transformOriginX) && !empty($ca_from_transformOriginX) ? $ca_from_transformOriginX['size'] . $ca_from_transformOriginX['unit'] : '';
                $ca_from_toriginY = isset($ca_from_transformOriginY) && !empty($ca_from_transformOriginY) ? $ca_from_transformOriginY['size'] . $ca_from_transformOriginY['unit'] : '';
                $ca_from_toriginZ = isset($ca_from_transformOriginZ) && !empty($ca_from_transformOriginZ) ? $ca_from_transformOriginZ['size'] . $ca_from_transformOriginZ['unit'] : '';

                $ca_to_toriginX = isset($ca_to_transformOriginX) && !empty($ca_to_transformOriginX) ? $ca_to_transformOriginX['size'] . $ca_to_transformOriginX['unit'] : '';
                $ca_to_toriginY = isset($ca_to_transformOriginY) && !empty($ca_to_transformOriginY) ? $ca_to_transformOriginY['size'] . $ca_to_transformOriginY['unit'] : '';
                $ca_to_toriginZ = isset($ca_to_transformOriginZ) && !empty($ca_to_transformOriginZ) ? $ca_to_transformOriginZ['size'] . $ca_to_transformOriginZ['unit'] : '';

                if (
                    !empty($ca_from_toriginX) && !empty($ca_from_toriginY) && !empty($ca_from_toriginZ) &&
                    !empty($ca_to_toriginX) && !empty($ca_to_toriginY) && !empty($ca_to_toriginZ)
                ) {

                    $ca_from_values['transformOrigin'] = $ca_from_toriginX . ' ' . $ca_from_toriginY . ' ' . $ca_from_toriginZ;
                    $ca_to_values['transformOrigin'] = $ca_to_toriginX . ' ' . $ca_to_toriginY . ' ' . $ca_to_toriginZ;

                    if ($ca_from_values['transformOrigin'] == $ca_to_values['transformOrigin']) {
                        unset($ca_from_values['transformOrigin']);
                        unset($ca_to_values['transformOrigin']);
                    }
                }
            }

            $ca_opts['initValues'] = !empty($ca_from_values) ? $ca_from_values : array();
            $ca_opts['animations'] = !empty($ca_to_values) ? $ca_to_values : array();

            $element->add_render_attribute('_wrapper', [
                'data-custom-animations' => 'true',
                'data-ca-options' => stripslashes(wp_json_encode($ca_opts)),
            ]);
        }
    }
}

Coherence_Elementor_Custom_Controls::init();
