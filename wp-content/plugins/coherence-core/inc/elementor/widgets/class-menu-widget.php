<?php

/**
 * Elementor Widget
 * @package Coherence
 * @since 1.0.0
 */
namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Widget_Base;
use Elementor\Plugin;

class Coherence_Menu_Widget extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * Retrieve Menu widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'menu';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Menu widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Menu', 'coherence-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Menu widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-nav-menu';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Menu widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'coherence_widgets' ];
	}

    /**
	 * Menu index.
	 *
	 * @access protected
	 * @var $nav_menu_index
	 */
	protected $nav_menu_index = 1;

	/**
	 * Retrieve the list of scripts the navigation menu depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'coherence-core-frontend-js' ];
	}

	/**
	 * Retrieve the menu index.
	 *
	 * Used to get index of nav menu.
	 *
	 * @since 1.3.0
	 * @access protected
	 *
	 * @return string nav index.
	 */
	protected function get_nav_menu_index() {
		return $this->nav_menu_index++;
	}

	/**
	 * Retrieve the list of available menus.
	 *
	 * Used to get the list of available menus.
	 *
	 * @since 1.3.0
	 * @access private
	 *
	 * @return array get WordPress menus list.
	 */
	private function get_available_menus() {

		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
	}

	/**
	 * Check if the Elementor is updated.
	 *
	 * @since 1.3.0
	 *
	 * @return boolean if Elementor updated.
	 */
	public static function is_elementor_updated() {
		if ( class_exists( 'Elementor\Icons_Manager' ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Register Nav Menu controls.
	 *
	 * @since 1.5.7
	 * @access protected
	 */
	protected function register_controls() {

		$this->register_general_content_controls();
		$this->register_style_content_controls();
		$this->register_dropdown_content_controls();
	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_general_content_controls() {

		$this->start_controls_section(
			'section_menu',
			[
				'label' => __( 'Menu', 'coherence-core' ),
			]
		);

		$menus = $this->get_available_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				[
					'label'        => __( 'Menu', 'coherence-core' ),
					'type'         => Controls_Manager::SELECT,
					'options'      => $menus,
					'default'      => array_keys( $menus )[0],
					'save_default' => true,
					/* translators: %s Nav menu URL */
					'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'coherence-core' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		} else {
			$this->add_control(
				'menu',
				[
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %s Nav menu URL */
					'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'coherence-core' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}

		$this->add_control(
			'menu_last_item',
			[
				'label'     => __( 'Last Menu Item', 'coherence-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'none' => __( 'Default', 'coherence-core' ),
					'cta'  => __( 'Button', 'coherence-core' ),
				],
				'default'   => 'none',
				'condition' => [
					'layout!' => 'expandible',
				],
			]
		);

		$this->add_control(
			'schema_support',
			[
				'label'        => __( 'Enable Schema Support', 'coherence-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'coherence-core' ),
				'label_off'    => __( 'No', 'coherence-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'render_type'  => 'template',
				'separator'    => 'before',
			]
		);

		$current_theme = wp_get_theme();

		if ( 'Twenty Twenty-One' === $current_theme->get( 'Name' ) ) {
			$this->add_control(
				'hide_theme_icons',
				[
					'label'        => __( 'Hide + & - Sign', 'coherence-core' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Yes', 'coherence-core' ),
					'label_off'    => __( 'No', 'coherence-core' ),
					'return_value' => 'yes',
					'default'      => 'no',
					'prefix_class' => 'coherence-core-nav-menu__theme-icon-',
				]
			);
		}

		$this->end_controls_section();

			$this->start_controls_section(
				'section_layout',
				[
					'label' => __( 'Layout', 'coherence-core' ),
				]
			);

			$this->add_control(
				'layout',
				[
					'label'   => __( 'Layout', 'coherence-core' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'horizontal',
					'options' => [
						'horizontal' => __( 'Horizontal', 'coherence-core' ),
						'vertical'   => __( 'Vertical', 'coherence-core' ),
						'expandible' => __( 'Expanded', 'coherence-core' ),
						'flyout'     => __( 'Flyout', 'coherence-core' ),
					],
				]
			);

			$this->add_control(
				'navmenu_align',
				[
					'label'        => __( 'Alignment', 'coherence-core' ),
					'type'         => Controls_Manager::CHOOSE,
					'options'      => [
						'left'    => [
							'title' => __( 'Left', 'coherence-core' ),
							'icon'  => 'eicon-h-align-left',
						],
						'center'  => [
							'title' => __( 'Center', 'coherence-core' ),
							'icon'  => 'eicon-h-align-center',
						],
						'right'   => [
							'title' => __( 'Right', 'coherence-core' ),
							'icon'  => 'eicon-h-align-right',
						],
						'justify' => [
							'title' => __( 'Justify', 'coherence-core' ),
							'icon'  => 'eicon-h-align-stretch',
						],
					],
					'default'      => 'left',
					'condition'    => [
						'layout' => [ 'horizontal', 'vertical' ],
					],
					'prefix_class' => 'coherence-core-nav-menu__align-',
				]
			);

			$this->add_control(
				'flyout_layout',
				[
					'label'     => __( 'Flyout Orientation', 'coherence-core' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'left',
					'options'   => [
						'left'  => __( 'Left', 'coherence-core' ),
						'right' => __( 'Right', 'coherence-core' ),
					],
					'condition' => [
						'layout' => 'flyout',
					],
				]
			);

			$this->add_control(
				'flyout_type',
				[
					'label'       => __( 'Appear Effect', 'coherence-core' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'normal',
					'label_block' => false,
					'options'     => [
						'normal' => __( 'Slide', 'coherence-core' ),
						'push'   => __( 'Push', 'coherence-core' ),
					],
					'render_type' => 'template',
					'condition'   => [
						'layout' => 'flyout',
					],
				]
			);

			$this->add_responsive_control(
				'hamburger_align',
				[
					'label'                => __( 'Hamburger Align', 'coherence-core' ),
					'type'                 => Controls_Manager::CHOOSE,
					'default'              => 'center',
					'options'              => [
						'left'   => [
							'title' => __( 'Left', 'coherence-core' ),
							'icon'  => 'eicon-h-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'coherence-core' ),
							'icon'  => 'eicon-h-align-center',
						],
						'right'  => [
							'title' => __( 'Right', 'coherence-core' ),
							'icon'  => 'eicon-h-align-right',
						],
					],
					'selectors_dictionary' => [
						'left'   => 'margin-right: auto',
						'center' => 'margin: 0 auto',
						'right'  => 'margin-left: auto',
					],
					'selectors'            => [
						'{{WRAPPER}} .coherence-core-nav-menu__toggle,
						{{WRAPPER}} .coherence-core-nav-menu-icon' => '{{VALUE}}',
					],
					'condition'            => [
						'layout' => [ 'expandible', 'flyout' ],
					],
					'label_block'          => false,
					'frontend_available'   => true,
				]
			);

			$this->add_responsive_control(
				'hamburger_menu_align',
				[
					'label'              => __( 'Menu Items Align', 'coherence-core' ),
					'type'               => Controls_Manager::CHOOSE,
					'options'            => [
						'flex-start'    => [
							'title' => __( 'Left', 'coherence-core' ),
							'icon'  => 'eicon-h-align-left',
						],
						'center'        => [
							'title' => __( 'Center', 'coherence-core' ),
							'icon'  => 'eicon-h-align-center',
						],
						'flex-end'      => [
							'title' => __( 'Right', 'coherence-core' ),
							'icon'  => 'eicon-h-align-right',
						],
						'space-between' => [
							'title' => __( 'Justify', 'coherence-core' ),
							'icon'  => 'eicon-h-align-stretch',
						],
					],
					'default'            => 'space-between',
					'condition'          => [
						'layout' => [ 'expandible', 'flyout' ],
					],
					'selectors'          => [
						'{{WRAPPER}} li.menu-item a' => 'justify-content: {{VALUE}};',
						'{{WRAPPER}} li .elementor-button-wrapper' => 'text-align: {{VALUE}};',
						'{{WRAPPER}}.coherence-core-menu-item-flex-end li .elementor-button-wrapper' => 'text-align: right;',
					],
					'prefix_class'       => 'coherence-core-menu-item-',
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'submenu_icon',
				[
					'label'        => __( 'Submenu Icon', 'coherence-core' ),
					'type'         => Controls_Manager::SELECT,
					'default'      => 'arrow',
					'options'      => [
						'arrow'   => __( 'Arrows', 'coherence-core' ),
						'plus'    => __( 'Plus Sign', 'coherence-core' ),
						'classic' => __( 'Classic', 'coherence-core' ),
					],
					'prefix_class' => 'coherence-core-submenu-icon-',
				]
			);

			$this->add_control(
				'submenu_animation',
				[
					'label'        => __( 'Submenu Animation', 'coherence-core' ),
					'type'         => Controls_Manager::SELECT,
					'default'      => 'none',
					'options'      => [
						'none'     => __( 'Default', 'coherence-core' ),
						'slide_up' => __( 'Slide Up', 'coherence-core' ),
					],
					'prefix_class' => 'coherence-core-submenu-animation-',
					'condition'    => [
						'layout' => 'horizontal',
					],
				]
			);

			$this->add_control(
				'link_redirect',
				[
					'label'        => __( 'Action On Menu Click', 'coherence-core' ),
					'type'         => Controls_Manager::SELECT,
					'default'      => 'child',
					'description'  => __( 'For Horizontal layout, this will affect on the selected breakpoint', 'coherence-core' ),
					'options'      => [
						'child'     => __( 'Open Submenu', 'coherence-core' ),
						'self_link' => __( 'Redirect To Self Link', 'coherence-core' ),
					],
					'prefix_class' => 'coherence-core-link-redirect-',
				]
			);

			$this->add_control(
				'heading_responsive',
				[
					'type'      => Controls_Manager::HEADING,
					'label'     => __( 'Responsive', 'coherence-core' ),
					'separator' => 'before',
					'condition' => [
						'layout' => [ 'horizontal', 'vertical' ],
					],
				]
			);

		$this->add_control(
			'dropdown',
			[
				'label'        => __( 'Breakpoint', 'coherence-core' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'tablet',
				'options'      => [
					'mobile' => __( 'Mobile (768px >)', 'coherence-core' ),
					'tablet' => __( 'Tablet (1025px >)', 'coherence-core' ),
					'none'   => __( 'None', 'coherence-core' ),
				],
				'prefix_class' => 'coherence-core-nav-menu__breakpoint-',
				'condition'    => [
					'layout' => [ 'horizontal', 'vertical' ],
				],
				'render_type'  => 'template',
			]
		);

		$this->add_control(
			'resp_align',
			[
				'label'                => __( 'Alignment', 'coherence-core' ),
				'type'                 => Controls_Manager::CHOOSE,
				'options'              => [
					'left'   => [
						'title' => __( 'Left', 'coherence-core' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'coherence-core' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'coherence-core' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'              => 'center',
				'description'          => __( 'This is the alignement of menu icon on selected responsive breakpoints.', 'coherence-core' ),
				'condition'            => [
					'layout'    => [ 'horizontal', 'vertical' ],
					'dropdown!' => 'none',
				],
				'selectors_dictionary' => [
					'left'   => 'margin-right: auto',
					'center' => 'margin: 0 auto',
					'right'  => 'margin-left: auto',
				],
				'selectors'            => [
					'{{WRAPPER}} .coherence-core-nav-menu__toggle' => '{{VALUE}}',
				],
			]
		);

		$this->add_control(
			'full_width_dropdown',
			[
				'label'        => __( 'Full Width', 'coherence-core' ),
				'description'  => __( 'Enable this option to stretch the Sub Menu to Full Width.', 'coherence-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'coherence-core' ),
				'label_off'    => __( 'No', 'coherence-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'dropdown!' => 'none',
					'layout!'   => 'flyout',
				],
				'render_type'  => 'template',
			]
		);

		if ( $this->is_elementor_updated() ) {
			$this->add_control(
				'dropdown_icon',
				[
					'label'       => __( 'Menu Icon', 'coherence-core' ),
					'type'        => Controls_Manager::ICONS,
					'label_block' => 'true',
					'default'     => [
						'value'   => 'fas fa-align-justify',
						'library' => 'fa-solid',
					],
					'condition'   => [
						'dropdown!' => 'none',
					],
				]
			);
		} else {
			$this->add_control(
				'dropdown_icon',
				[
					'label'       => __( 'Icon', 'coherence-core' ),
					'type'        => Controls_Manager::ICON,
					'label_block' => 'true',
					'default'     => 'fa fa-align-justify',
					'condition'   => [
						'dropdown!' => 'none',
					],
				]
			);
		}

		if ( $this->is_elementor_updated() ) {
			$this->add_control(
				'dropdown_close_icon',
				[
					'label'       => __( 'Close Icon', 'coherence-core' ),
					'type'        => Controls_Manager::ICONS,
					'label_block' => 'true',
					'default'     => [
						'value'   => 'far fa-window-close',
						'library' => 'fa-regular',
					],
					'condition'   => [
						'dropdown!' => 'none',
					],
				]
			);
		} else {
			$this->add_control(
				'dropdown_close_icon',
				[
					'label'       => __( 'Close Icon', 'coherence-core' ),
					'type'        => Controls_Manager::ICON,
					'label_block' => 'true',
					'default'     => 'fa fa-close',
					'condition'   => [
						'dropdown!' => 'none',
					],
				]
			);
		}

		$this->end_controls_section();
	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_style_content_controls() {

		$this->start_controls_section(
			'section_style_main-menu',
			[
				'label'     => __( 'Main Menu', 'coherence-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'expandible',
				],
			]
		);

		$this->add_responsive_control(
			'width_flyout_menu_item',
			[
				'label'              => __( 'Flyout Box Width', 'coherence-core' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'max' => 500,
						'min' => 100,
					],
				],
				'default'            => [
					'size' => 300,
					'unit' => 'px',
				],
				'selectors'          => [
					'{{WRAPPER}} .coherence-core-flyout-wrapper .coherence-core-side' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .coherence-core-flyout-open.left'  => 'left: -{{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .coherence-core-flyout-open.right' => 'right: -{{SIZE}}{{UNIT}}',
				],
				'condition'          => [
					'layout' => 'flyout',
				],
				'render_type'        => 'template',
				'frontend_available' => true,
			]
		);

			$this->add_responsive_control(
				'padding_flyout_menu_item',
				[
					'label'              => __( 'Flyout Box Padding', 'coherence-core' ),
					'type'               => Controls_Manager::SLIDER,
					'range'              => [
						'px' => [
							'max' => 50,
						],
					],
					'default'            => [
						'size' => 30,
						'unit' => 'px',
					],
					'selectors'          => [
						'{{WRAPPER}} .coherence-core-flyout-content' => 'padding: {{SIZE}}{{UNIT}}',
					],
					'condition'          => [
						'layout' => 'flyout',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'padding_horizontal_menu_item',
				[
					'label'              => __( 'Horizontal Padding', 'coherence-core' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'range'              => [
						'px' => [
							'max' => 50,
						],
					],
					'default'            => [
						'size' => 15,
						'unit' => 'px',
					],
					'selectors'          => [
						'{{WRAPPER}} .menu-item a.coherence-core-menu-item' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .menu-item a.coherence-core-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 20px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .coherence-core-nav-menu__layout-vertical .menu-item ul ul a.coherence-core-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 40px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .coherence-core-nav-menu__layout-vertical .menu-item ul ul ul a.coherence-core-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 60px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .coherence-core-nav-menu__layout-vertical .menu-item ul ul ul ul a.coherence-core-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 80px );padding-right: {{SIZE}}{{UNIT}};',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'padding_vertical_menu_item',
				[
					'label'              => __( 'Vertical Padding', 'coherence-core' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'range'              => [
						'px' => [
							'max' => 50,
						],
					],
					'default'            => [
						'size' => 15,
						'unit' => 'px',
					],
					'selectors'          => [
						'{{WRAPPER}} .menu-item a.coherence-core-menu-item, {{WRAPPER}} .menu-item a.coherence-core-sub-menu-item' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'menu_space_between',
				[
					'label'              => __( 'Space Between', 'coherence-core' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'range'              => [
						'px' => [
							'max' => 100,
						],
					],
					'selectors'          => [
						'body:not(.rtl) {{WRAPPER}} .coherence-core-nav-menu__layout-horizontal .coherence-core-nav-menu > li.menu-item:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}}',
						'body.rtl {{WRAPPER}} .coherence-core-nav-menu__layout-horizontal .coherence-core-nav-menu > li.menu-item:not(:last-child)' => 'margin-left: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} nav:not(.coherence-core-nav-menu__layout-horizontal) .coherence-core-nav-menu > li.menu-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
						'(tablet)body:not(.rtl) {{WRAPPER}}.coherence-core-nav-menu__breakpoint-tablet .coherence-core-nav-menu__layout-horizontal .coherence-core-nav-menu > li.menu-item:not(:last-child)' => 'margin-right: 0px',
						'(mobile)body:not(.rtl) {{WRAPPER}}.coherence-core-nav-menu__breakpoint-mobile .coherence-core-nav-menu__layout-horizontal .coherence-core-nav-menu > li.menu-item:not(:last-child)' => 'margin-right: 0px',
						'(tablet)body {{WRAPPER}} nav.coherence-core-nav-menu__layout-vertical .coherence-core-nav-menu > li.menu-item:not(:last-child)' => 'margin-bottom: 0px',
						'(mobile)body {{WRAPPER}} nav.coherence-core-nav-menu__layout-vertical .coherence-core-nav-menu > li.menu-item:not(:last-child)' => 'margin-bottom: 0px',
					],
					'condition'          => [
						'layout!' => 'expandible',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'menu_row_space',
				[
					'label'              => __( 'Row Spacing', 'coherence-core' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'range'              => [
						'px' => [
							'max' => 100,
						],
					],
					'selectors'          => [
						'body:not(.rtl) {{WRAPPER}} .coherence-core-nav-menu__layout-horizontal .coherence-core-nav-menu > li.menu-item' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
					'condition'          => [
						'layout' => 'horizontal',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'menu_top_space',
				[
					'label'              => __( 'Menu Item Top Spacing', 'coherence-core' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px', '%' ],
					'range'              => [
						'px' => [
							'max' => 100,
						],
					],
					'selectors'          => [
						'{{WRAPPER}} .coherence-core-flyout-wrapper .coherence-core-nav-menu > li.menu-item:first-child' => 'margin-top: {{SIZE}}{{UNIT}}',
					],
					'condition'          => [
						'layout' => 'flyout',
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'bg_color_flyout',
				[
					'label'     => __( 'Background Color', 'coherence-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#FFFFFF',
					'selectors' => [
						'{{WRAPPER}} .coherence-core-flyout-content' => 'background-color: {{VALUE}}',
					],
					'condition' => [
						'layout' => 'flyout',
					],
				]
			);

			$this->add_control(
				'pointer',
				[
					'label'     => __( 'Link Hover Effect', 'coherence-core' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'none',
					'options'   => [
						'none'        => __( 'None', 'coherence-core' ),
						'underline'   => __( 'Underline', 'coherence-core' ),
						'overline'    => __( 'Overline', 'coherence-core' ),
						'double-line' => __( 'Double Line', 'coherence-core' ),
						'framed'      => __( 'Framed', 'coherence-core' ),
						'text'        => __( 'Text', 'coherence-core' ),
					],
					'condition' => [
						'layout' => [ 'horizontal' ],
					],
				]
			);

		$this->add_control(
			'animation_line',
			[
				'label'     => __( 'Animation', 'coherence-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'fade',
				'options'   => [
					'fade'     => 'Fade',
					'slide'    => 'Slide',
					'grow'     => 'Grow',
					'drop-in'  => 'Drop In',
					'drop-out' => 'Drop Out',
					'none'     => 'None',
				],
				'condition' => [
					'layout'  => [ 'horizontal' ],
					'pointer' => [ 'underline', 'overline', 'double-line' ],
				],
			]
		);

		$this->add_control(
			'animation_framed',
			[
				'label'     => __( 'Frame Animation', 'coherence-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'fade',
				'options'   => [
					'fade'    => 'Fade',
					'grow'    => 'Grow',
					'shrink'  => 'Shrink',
					'draw'    => 'Draw',
					'corners' => 'Corners',
					'none'    => 'None',
				],
				'condition' => [
					'layout'  => [ 'horizontal' ],
					'pointer' => 'framed',
				],
			]
		);

		$this->add_control(
			'animation_text',
			[
				'label'     => __( 'Animation', 'coherence-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'grow',
				'options'   => [
					'grow'   => 'Grow',
					'shrink' => 'Shrink',
					'sink'   => 'Sink',
					'float'  => 'Float',
					'skew'   => 'Skew',
					'rotate' => 'Rotate',
					'none'   => 'None',
				],
				'condition' => [
					'layout'  => [ 'horizontal' ],
					'pointer' => 'text',
				],
			]
		);

		$this->add_control(
			'style_divider',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'menu_typography',
				'global'    => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} a.coherence-core-menu-item, {{WRAPPER}} a.coherence-core-sub-menu-item',
			]
		);

		$this->start_controls_tabs( 'tabs_menu_item_style' );

				$this->start_controls_tab(
					'tab_menu_item_normal',
					[
						'label' => __( 'Normal', 'coherence-core' ),
					]
				);

					$this->add_control(
						'color_menu_item',
						[
							'label'     => __( 'Text Color', 'coherence-core' ),
							'type'      => Controls_Manager::COLOR,
							'global'    => [
								'default' => Global_Colors::COLOR_TEXT,
							],
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-item a.coherence-core-menu-item, {{WRAPPER}} .sub-menu a.coherence-core-sub-menu-item' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'bg_color_menu_item',
						[
							'label'     => __( 'Background Color', 'coherence-core' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-item a.coherence-core-menu-item, {{WRAPPER}} .sub-menu, {{WRAPPER}} nav.coherence-core-dropdown, {{WRAPPER}} .coherence-core-dropdown-expandible' => 'background-color: {{VALUE}}',
							],
							'condition' => [
								'layout!' => 'flyout',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_menu_item_hover',
					[
						'label' => __( 'Hover', 'coherence-core' ),
					]
				);

					$this->add_control(
						'color_menu_item_hover',
						[
							'label'     => __( 'Text Color', 'coherence-core' ),
							'type'      => Controls_Manager::COLOR,
							'global'    => [
								'default' => Global_Colors::COLOR_ACCENT,
							],
							'selectors' => [
								'{{WRAPPER}} .menu-item a.coherence-core-menu-item:hover,
								{{WRAPPER}} .sub-menu a.coherence-core-sub-menu-item:hover,
								{{WRAPPER}} .menu-item.current-menu-item a.coherence-core-menu-item,
								{{WRAPPER}} .menu-item a.coherence-core-menu-item.highlighted,
								{{WRAPPER}} .menu-item a.coherence-core-menu-item:focus' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'bg_color_menu_item_hover',
						[
							'label'     => __( 'Background Color', 'coherence-core' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .menu-item a.coherence-core-menu-item:hover,
								{{WRAPPER}} .sub-menu a.coherence-core-sub-menu-item:hover,
								{{WRAPPER}} .menu-item.current-menu-item a.coherence-core-menu-item,
								{{WRAPPER}} .menu-item a.coherence-core-menu-item.highlighted,
								{{WRAPPER}} .menu-item a.coherence-core-menu-item:focus' => 'background-color: {{VALUE}}',
							],
							'condition' => [
								'layout!' => 'flyout',
							],
						]
					);

					$this->add_control(
						'pointer_color_menu_item_hover',
						[
							'label'     => __( 'Link Hover Effect Color', 'coherence-core' ),
							'type'      => Controls_Manager::COLOR,
							'global'    => [
								'default' => Global_Colors::COLOR_ACCENT,
							],
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .coherence-core-nav-menu-layout:not(.coherence-core-pointer__framed) .menu-item.parent a.coherence-core-menu-item:before,
								{{WRAPPER}} .coherence-core-nav-menu-layout:not(.coherence-core-pointer__framed) .menu-item.parent a.coherence-core-menu-item:after' => 'background-color: {{VALUE}}',
								'{{WRAPPER}} .coherence-core-nav-menu-layout:not(.coherence-core-pointer__framed) .menu-item.parent .sub-menu .coherence-core-has-submenu-container a:after' => 'background-color: unset',
								'{{WRAPPER}} .coherence-core-pointer__framed .menu-item.parent a.coherence-core-menu-item:before,
								{{WRAPPER}} .coherence-core-pointer__framed .menu-item.parent a.coherence-core-menu-item:after' => 'border-color: {{VALUE}}',
							],
							'condition' => [
								'pointer!' => [ 'none', 'text' ],
								'layout!'  => 'flyout',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_menu_item_active',
					[
						'label' => __( 'Active', 'coherence-core' ),
					]
				);

					$this->add_control(
						'color_menu_item_active',
						[
							'label'     => __( 'Text Color', 'coherence-core' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-item.current-menu-item a.coherence-core-menu-item,
								{{WRAPPER}} .menu-item.current-menu-ancestor a.coherence-core-menu-item' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'bg_color_menu_item_active',
						[
							'label'     => __( 'Background Color', 'coherence-core' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-item.current-menu-item a.coherence-core-menu-item,
								{{WRAPPER}} .menu-item.current-menu-ancestor a.coherence-core-menu-item' => 'background-color: {{VALUE}}',
							],
							'condition' => [
								'layout!' => 'flyout',
							],
						]
					);

					$this->add_control(
						'pointer_color_menu_item_active',
						[
							'label'     => __( 'Link Hover Effect Color', 'coherence-core' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .coherence-core-nav-menu-layout:not(.coherence-core-pointer__framed) .menu-item.parent.current-menu-item a.coherence-core-menu-item:before,
								{{WRAPPER}} .coherence-core-nav-menu-layout:not(.coherence-core-pointer__framed) .menu-item.parent.current-menu-item a.coherence-core-menu-item:after' => 'background-color: {{VALUE}}',
								'{{WRAPPER}} .coherence-core-nav-menu:not(.coherence-core-pointer__framed) .menu-item.parent .sub-menu .coherence-core-has-submenu-container a.current-menu-item:after' => 'background-color: unset',
								'{{WRAPPER}} .coherence-core-pointer__framed .menu-item.parent.current-menu-item a.coherence-core-menu-item:before,
								{{WRAPPER}} .coherence-core-pointer__framed .menu-item.parent.current-menu-item a.coherence-core-menu-item:after' => 'border-color: {{VALUE}}',
							],
							'condition' => [
								'pointer!' => [ 'none', 'text' ],
								'layout!'  => 'flyout',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_dropdown_content_controls() {

		$this->start_controls_section(
			'section_style_dropdown',
			[
				'label' => __( 'Dropdown', 'coherence-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'dropdown_description',
				[
					'raw'             => __( '<b>Note:</b> On desktop, below style options will apply to the submenu. On mobile, this will apply to the entire menu.', 'coherence-core' ),
					'type'            => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-descriptor',
					'condition'       => [
						'layout!' => [
							'expandible',
							'flyout',
						],
					],
				]
			);

			$this->start_controls_tabs( 'tabs_dropdown_item_style' );

				$this->start_controls_tab(
					'tab_dropdown_item_normal',
					[
						'label' => __( 'Normal', 'coherence-core' ),
					]
				);

					$this->add_control(
						'color_dropdown_item',
						[
							'label'     => __( 'Text Color', 'coherence-core' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .sub-menu a.coherence-core-sub-menu-item, 
								{{WRAPPER}} .elementor-menu-toggle,
								{{WRAPPER}} nav.coherence-core-dropdown li a.coherence-core-menu-item,
								{{WRAPPER}} nav.coherence-core-dropdown li a.coherence-core-sub-menu-item,
								{{WRAPPER}} nav.coherence-core-dropdown-expandible li a.coherence-core-menu-item,
								{{WRAPPER}} nav.coherence-core-dropdown-expandible li a.coherence-core-sub-menu-item' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'background_color_dropdown_item',
						[
							'label'     => __( 'Background Color', 'coherence-core' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '#fff',
							'selectors' => [
								'{{WRAPPER}} .sub-menu,
								{{WRAPPER}} nav.coherence-core-dropdown,
								{{WRAPPER}} nav.coherence-core-dropdown-expandible,
								{{WRAPPER}} nav.coherence-core-dropdown .menu-item a.coherence-core-menu-item,
								{{WRAPPER}} nav.coherence-core-dropdown .menu-item a.coherence-core-sub-menu-item' => 'background-color: {{VALUE}}',
							],
							'separator' => 'after',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_dropdown_item_hover',
					[
						'label' => __( 'Hover', 'coherence-core' ),
					]
				);

					$this->add_control(
						'color_dropdown_item_hover',
						[
							'label'     => __( 'Text Color', 'coherence-core' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .sub-menu a.coherence-core-sub-menu-item:hover, 
								{{WRAPPER}} .elementor-menu-toggle:hover,
								{{WRAPPER}} nav.coherence-core-dropdown li a.coherence-core-menu-item:hover,
								{{WRAPPER}} nav.coherence-core-dropdown li a.coherence-core-sub-menu-item:hover,
								{{WRAPPER}} nav.coherence-core-dropdown-expandible li a.coherence-core-menu-item:hover,
								{{WRAPPER}} nav.coherence-core-dropdown-expandible li a.coherence-core-sub-menu-item:hover' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'background_color_dropdown_item_hover',
						[
							'label'     => __( 'Background Color', 'coherence-core' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .sub-menu a.coherence-core-sub-menu-item:hover,
								{{WRAPPER}} nav.coherence-core-dropdown li a.coherence-core-menu-item:hover,
								{{WRAPPER}} nav.coherence-core-dropdown li a.coherence-core-sub-menu-item:hover,
								{{WRAPPER}} nav.coherence-core-dropdown-expandible li a.coherence-core-menu-item:hover,
								{{WRAPPER}} nav.coherence-core-dropdown-expandible li a.coherence-core-sub-menu-item:hover' => 'background-color: {{VALUE}}',
							],
							'separator' => 'after',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_dropdown_item_active',
					[
						'label' => __( 'Active', 'coherence-core' ),
					]
				);

				$this->add_control(
					'color_dropdown_item_active',
					[
						'label'     => __( 'Text Color', 'coherence-core' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .sub-menu .menu-item.current-menu-item a.coherence-core-sub-menu-item.coherence-core-sub-menu-item-active,	
							{{WRAPPER}} nav.coherence-core-dropdown .menu-item.current-menu-item a.coherence-core-menu-item,
							{{WRAPPER}} nav.coherence-core-dropdown .menu-item.current-menu-ancestor a.coherence-core-menu-item,
							{{WRAPPER}} nav.coherence-core-dropdown .sub-menu .menu-item.current-menu-item a.coherence-core-sub-menu-item.coherence-core-sub-menu-item-active
							' => 'color: {{VALUE}}',

						],
					]
				);

				$this->add_control(
					'background_color_dropdown_item_active',
					[
						'label'     => __( 'Background Color', 'coherence-core' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .sub-menu .menu-item.current-menu-item a.coherence-core-sub-menu-item.coherence-core-sub-menu-item-active,	
							{{WRAPPER}} nav.coherence-core-dropdown .menu-item.current-menu-item a.coherence-core-menu-item,
							{{WRAPPER}} nav.coherence-core-dropdown .menu-item.current-menu-ancestor a.coherence-core-menu-item,
							{{WRAPPER}} nav.coherence-core-dropdown .sub-menu .menu-item.current-menu-item a.coherence-core-sub-menu-item.coherence-core-sub-menu-item-active' => 'background-color: {{VALUE}}',
						],
						'separator' => 'after',
					]
				);

				$this->end_controls_tabs();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'dropdown_typography',
					'global'    => [
						'default' => Global_Typography::TYPOGRAPHY_ACCENT,
					],
					'separator' => 'before',
					'selector'  => '
							{{WRAPPER}} .sub-menu li a.coherence-core-sub-menu-item,
							{{WRAPPER}} nav.coherence-core-dropdown li a.coherence-core-sub-menu-item,
							{{WRAPPER}} nav.coherence-core-dropdown li a.coherence-core-menu-item,
							{{WRAPPER}} nav.coherence-core-dropdown-expandible li a.coherence-core-menu-item,
							{{WRAPPER}} nav.coherence-core-dropdown-expandible li a.coherence-core-sub-menu-item',
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'dropdown_border',
					'selector' => '{{WRAPPER}} nav.coherence-core-nav-menu__layout-horizontal .sub-menu, 
							{{WRAPPER}} nav:not(.coherence-core-nav-menu__layout-horizontal) .sub-menu.sub-menu-open,
							{{WRAPPER}} nav.coherence-core-dropdown .coherence-core-nav-menu,
						 	{{WRAPPER}} nav.coherence-core-dropdown-expandible .coherence-core-nav-menu',
				]
			);

			$this->add_responsive_control(
				'dropdown_border_radius',
				[
					'label'              => __( 'Border Radius', 'coherence-core' ),
					'type'               => Controls_Manager::DIMENSIONS,
					'size_units'         => [ 'px', '%' ],
					'selectors'          => [
						'{{WRAPPER}} .sub-menu'        => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .sub-menu li.menu-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};overflow:hidden;',
						'{{WRAPPER}} .sub-menu li.menu-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};overflow:hidden',
						'{{WRAPPER}} nav.coherence-core-dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} nav.coherence-core-dropdown li.menu-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};overflow:hidden',
						'{{WRAPPER}} nav.coherence-core-dropdown li.menu-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};overflow:hidden',
						'{{WRAPPER}} nav.coherence-core-dropdown-expandible' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} nav.coherence-core-dropdown-expandible li.menu-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};overflow:hidden',
						'{{WRAPPER}} nav.coherence-core-dropdown-expandible li.menu-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};overflow:hidden',
					],
					'frontend_available' => true,
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'      => 'dropdown_box_shadow',
					'exclude'   => [
						'box_shadow_position',
					],
					'selector'  => '{{WRAPPER}} .coherence-core-nav-menu .sub-menu,
								{{WRAPPER}} nav.coherence-core-dropdown,
						 		{{WRAPPER}} nav.coherence-core-dropdown-expandible',
					'separator' => 'after',
				]
			);

			$this->add_responsive_control(
				'width_dropdown_item',
				[
					'label'              => __( 'Dropdown Width (px)', 'coherence-core' ),
					'type'               => Controls_Manager::SLIDER,
					'range'              => [
						'px' => [
							'min' => 0,
							'max' => 500,
						],
					],
					'default'            => [
						'size' => '220',
						'unit' => 'px',
					],
					'selectors'          => [
						'{{WRAPPER}} ul.sub-menu' => 'width: {{SIZE}}{{UNIT}}',
					],
					'condition'          => [
						'layout' => 'horizontal',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'padding_horizontal_dropdown_item',
				[
					'label'              => __( 'Horizontal Padding', 'coherence-core' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'selectors'          => [
						'{{WRAPPER}} .sub-menu li a.coherence-core-sub-menu-item,
						{{WRAPPER}} nav.coherence-core-dropdown li a.coherence-core-menu-item,
						{{WRAPPER}} nav.coherence-core-dropdown-expandible li a.coherence-core-menu-item' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} nav.coherence-core-dropdown-expandible a.coherence-core-sub-menu-item,
						{{WRAPPER}} nav.coherence-core-dropdown li a.coherence-core-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 20px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .coherence-core-dropdown .menu-item ul ul a.coherence-core-sub-menu-item,
						{{WRAPPER}} .coherence-core-dropdown-expandible .menu-item ul ul a.coherence-core-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 40px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .coherence-core-dropdown .menu-item ul ul ul a.coherence-core-sub-menu-item,
						{{WRAPPER}} .coherence-core-dropdown-expandible .menu-item ul ul ul a.coherence-core-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 60px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .coherence-core-dropdown .menu-item ul ul ul ul a.coherence-core-sub-menu-item,
						{{WRAPPER}} .coherence-core-dropdown-expandible .menu-item ul ul ul ul a.coherence-core-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 80px );padding-right: {{SIZE}}{{UNIT}};',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'padding_vertical_dropdown_item',
				[
					'label'              => __( 'Vertical Padding', 'coherence-core' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'default'            => [
						'size' => 15,
						'unit' => 'px',
					],
					'range'              => [
						'px' => [
							'max' => 50,
						],
					],
					'selectors'          => [
						'{{WRAPPER}} .sub-menu a.coherence-core-sub-menu-item,
						 {{WRAPPER}} nav.coherence-core-dropdown li a.coherence-core-menu-item,
						 {{WRAPPER}} nav.coherence-core-dropdown li a.coherence-core-sub-menu-item,
						 {{WRAPPER}} nav.coherence-core-dropdown-expandible li a.coherence-core-menu-item,
						 {{WRAPPER}} nav.coherence-core-dropdown-expandible li a.coherence-core-sub-menu-item' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'distance_from_menu',
				[
					'label'              => __( 'Top Distance', 'coherence-core' ),
					'type'               => Controls_Manager::SLIDER,
					'range'              => [
						'px' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'selectors'          => [
						'{{WRAPPER}} nav.coherence-core-nav-menu__layout-horizontal:not(.coherence-core-dropdown) ul.sub-menu, {{WRAPPER}} nav.coherence-core-nav-menu__layout-expandible.menu-is-active, {{WRAPPER}} nav.coherence-core-nav-menu__layout-vertical:not(.coherence-core-dropdown) ul.sub-menu' => 'margin-top: {{SIZE}}px;',
						'{{WRAPPER}} .coherence-core-dropdown.menu-is-active' => 'margin-top: {{SIZE}}px;',
					],
					'condition'          => [
						'layout' => [ 'horizontal', 'vertical', 'expandible' ],
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'heading_dropdown_divider',
				[
					'label'     => __( 'Divider', 'coherence-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'dropdown_divider_border',
				[
					'label'       => __( 'Border Style', 'coherence-core' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'solid',
					'label_block' => false,
					'options'     => [
						'none'   => __( 'None', 'coherence-core' ),
						'solid'  => __( 'Solid', 'coherence-core' ),
						'double' => __( 'Double', 'coherence-core' ),
						'dotted' => __( 'Dotted', 'coherence-core' ),
						'dashed' => __( 'Dashed', 'coherence-core' ),
					],
					'selectors'   => [
						'{{WRAPPER}} .sub-menu li.menu-item:not(:last-child), 
						{{WRAPPER}} nav.coherence-core-dropdown li.menu-item:not(:last-child),
						{{WRAPPER}} nav.coherence-core-dropdown-expandible li.menu-item:not(:last-child)' => 'border-bottom-style: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'divider_border_color',
				[
					'label'     => __( 'Border Color', 'coherence-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#c4c4c4',
					'selectors' => [
						'{{WRAPPER}} .sub-menu li.menu-item:not(:last-child), 
						{{WRAPPER}} nav.coherence-core-dropdown li.menu-item:not(:last-child),
						{{WRAPPER}} nav.coherence-core-dropdown-expandible li.menu-item:not(:last-child)' => 'border-bottom-color: {{VALUE}};',
					],
					'condition' => [
						'dropdown_divider_border!' => 'none',
					],
				]
			);

			$this->add_control(
				'dropdown_divider_width',
				[
					'label'     => __( 'Border Width', 'coherence-core' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'max' => 50,
						],
					],
					'default'   => [
						'size' => '1',
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sub-menu li.menu-item:not(:last-child), 
						{{WRAPPER}} nav.coherence-core-dropdown li.menu-item:not(:last-child),
						{{WRAPPER}} nav.coherence-core-dropdown-expandible li.menu-item:not(:last-child)' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'dropdown_divider_border!' => 'none',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_toggle',
			[
				'label' => __( 'Menu Trigger & Close Icon', 'coherence-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_toggle_style' );

		$this->start_controls_tab(
			'toggle_style_normal',
			[
				'label' => __( 'Normal', 'coherence-core' ),
			]
		);

		$this->add_control(
			'toggle_color',
			[
				'label'     => __( 'Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} div.coherence-core-nav-menu-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} div.coherence-core-nav-menu-icon svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'toggle_background_color',
			[
				'label'     => __( 'Background Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .coherence-core-nav-menu-icon' => 'background-color: {{VALUE}}; padding: 0.35em;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'toggle_hover',
			[
				'label' => __( 'Hover', 'coherence-core' ),
			]
		);

		$this->add_control(
			'toggle_hover_color',
			[
				'label'     => __( 'Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} div.coherence-core-nav-menu-icon:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} div.coherence-core-nav-menu-icon:hover svg' => 'fill: {{VALUE}}',

				],
			]
		);

		$this->add_control(
			'toggle_hover_background_color',
			[
				'label'     => __( 'Background Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .coherence-core-nav-menu-icon:hover' => 'background-color: {{VALUE}}; padding: 0.35em;',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'toggle_size',
			[
				'label'              => __( 'Icon Size', 'coherence-core' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'min' => 15,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .coherence-core-nav-menu-icon'     => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .coherence-core-nav-menu-icon svg' => 'font-size: {{SIZE}}px;line-height: {{SIZE}}px;height: {{SIZE}}px;width: {{SIZE}}px;',
				],
				'frontend_available' => true,
				'separator'          => 'before',
			]
		);

		$this->add_responsive_control(
			'toggle_border_width',
			[
				'label'              => __( 'Border Width', 'coherence-core' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'max' => 10,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .coherence-core-nav-menu-icon' => 'border-width: {{SIZE}}{{UNIT}}; padding: 0.35em;',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'toggle_border_radius',
			[
				'label'              => __( 'Border Radius', 'coherence-core' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => [ 'px', '%' ],
				'selectors'          => [
					'{{WRAPPER}} .coherence-core-nav-menu-icon' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'close_color_flyout',
			[
				'label'     => __( 'Close Icon Color', 'coherence-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#7A7A7A',
				'selectors' => [
					'{{WRAPPER}} .coherence-core-flyout-close'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .coherence-core-flyout-close svg' => 'fill: {{VALUE}}',

				],
				'condition' => [
					'layout' => 'flyout',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'close_flyout_size',
			[
				'label'              => __( 'Close Icon Size', 'coherence-core' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'min' => 15,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .coherence-core-flyout-close,
					{{WRAPPER}} .coherence-core-flyout-close svg' => 'height: {{SIZE}}px; width: {{SIZE}}px; font-size: {{SIZE}}px; line-height: {{SIZE}}px;',
				],
				'condition'          => [
					'layout' => 'flyout',
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'style_button',
			[
				'label'     => __( 'Button', 'coherence-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'menu_last_item' => 'cta',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'all_typography',
					'label'    => __( 'Typography', 'coherence-core' ),
					'global'   => [
						'default' => Global_Typography::TYPOGRAPHY_ACCENT,
					],
					'selector' => '{{WRAPPER}} .menu-item a.coherence-core-menu-item.elementor-button',
				]
			);
			$this->add_responsive_control(
				'padding',
				[
					'label'              => __( 'Padding', 'coherence-core' ),
					'type'               => Controls_Manager::DIMENSIONS,
					'size_units'         => [ 'px', 'em', '%' ],
					'selectors'          => [
						'{{WRAPPER}} .menu-item a.coherence-core-menu-item.elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'frontend_available' => true,
				]
			);

			$this->start_controls_tabs( '_button_style' );

				$this->start_controls_tab(
					'_button_normal',
					[
						'label' => __( 'Normal', 'coherence-core' ),
					]
				);

					$this->add_control(
						'all_text_color',
						[
							'label'     => __( 'Text Color', 'coherence-core' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-item a.coherence-core-menu-item.elementor-button' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'           => 'all_background_color',
							'label'          => __( 'Background Color', 'coherence-core' ),
							'types'          => [ 'classic', 'gradient' ],
							'selector'       => '{{WRAPPER}} .menu-item a.coherence-core-menu-item.elementor-button',
							'fields_options' => [
								'color' => [
									'global' => [
										'default' => Global_Colors::COLOR_ACCENT,
									],
								],
							],
						]
					);

					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'     => 'all_border',
							'label'    => __( 'Border', 'coherence-core' ),
							'selector' => '{{WRAPPER}} .menu-item a.coherence-core-menu-item.elementor-button',
						]
					);

					$this->add_control(
						'all_border_radius',
						[
							'label'      => __( 'Border Radius', 'coherence-core' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%' ],
							'selectors'  => [
								'{{WRAPPER}} .menu-item a.coherence-core-menu-item.elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'     => 'all_button_box_shadow',
							'selector' => '{{WRAPPER}} .menu-item a.coherence-core-menu-item.elementor-button',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'all_button_hover',
					[
						'label' => __( 'Hover', 'coherence-core' ),
					]
				);

					$this->add_control(
						'all_hover_color',
						[
							'label'     => __( 'Text Color', 'coherence-core' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .menu-item a.coherence-core-menu-item.elementor-button:hover' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'           => 'all_background_hover_color',
							'label'          => __( 'Background Color', 'coherence-core' ),
							'types'          => [ 'classic', 'gradient' ],
							'selector'       => '{{WRAPPER}} .menu-item a.coherence-core-menu-item.elementor-button:hover',
							'fields_options' => [
								'color' => [
									'global' => [
										'default' => Global_Colors::COLOR_ACCENT,
									],
								],
							],
						]
					);

					$this->add_control(
						'all_border_hover_color',
						[
							'label'     => __( 'Border Hover Color', 'coherence-core' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-item a.coherence-core-menu-item.elementor-button:hover' => 'border-color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'      => 'all_button_hover_box_shadow',
							'selector'  => '{{WRAPPER}} .menu-item a.coherence-core-menu-item.elementor-button:hover',
							'separator' => 'after',
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Add itemprop for Navigation Schema.
	 *
	 * @since 1.5.2
	 * @param string $atts link attributes.
	 * @access public
	 */
	public function handle_link_attrs( $atts ) {

		$atts .= ' itemprop="url"';
		return $atts;
	}

	/**
	 * Add itemprop to the li tag of Navigation Schema.
	 *
	 * @since 1.6.0
	 * @param string $value link attributes.
	 * @access public
	 */
	public function handle_li_values( $value ) {

		$value .= ' itemprop="name"';
		return $value;
	}

	/**
	 * Get the menu and close icon HTML.
	 *
	 * @since 1.5.2
	 * @param array $settings Widget settings array.
	 * @access public
	 */
	public function get_menu_close_icon( $settings ) {
		$menu_icon     = '';
		$close_icon    = '';
		$icons         = [];
		$icon_settings = [
			$settings['dropdown_icon'],
			$settings['dropdown_close_icon'],
		];

		foreach ( $icon_settings as $icon ) {
			if ( $this->is_elementor_updated() ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon(
					$icon,
					[
						'aria-hidden' => 'true',
						'tabindex'    => '0',
					]
				);
				$menu_icon = ob_get_clean();
			} else {
				$menu_icon = '<i class="' . esc_attr( $icon ) . '" aria-hidden="true" tabindex="0"></i>';
			}

			array_push( $icons, $menu_icon );
		}

		return $icons;
	}

	/**
	 * Render Nav Menu output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function render() {
		$menus = $this->get_available_menus();
        include_once(COHERENCE_CORE_LIB . '/walker/class-menu-walker.php');

		if ( empty( $menus ) ) {
			return false;
		}

		$settings = $this->get_settings_for_display();

		$menu_close_icons = [];
		$menu_close_icons = $this->get_menu_close_icon( $settings );

		$args = [
			'echo'        => false,
			'menu'        => $settings['menu'],
			'menu_class'  => 'coherence-core-nav-menu',
			'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
			'fallback_cb' => '__return_empty_string',
			'container'   => '',
			'walker'      => new \Menu_Walker(),
		];

		if ( 'yes' === $settings['schema_support'] ) {
			$this->add_render_attribute( 'coherence-core-nav-menu', 'itemscope', 'itemscope' );
			$this->add_render_attribute( 'coherence-core-nav-menu', 'itemtype', 'http://schema.org/SiteNavigationElement' );

			add_filter( 'coherence_core_nav_menu_attrs', [ $this, 'handle_link_attrs' ] );
			add_filter( 'nav_menu_li_values', [ $this, 'handle_li_values' ] );
		}

		$menu_html = wp_nav_menu( $args );

		if ( 'flyout' === $settings['layout'] ) {

			$this->add_render_attribute( 'coherence-core-flyout', 'class', 'coherence-core-flyout-wrapper' );
			if ( 'cta' === $settings['menu_last_item'] ) {

				$this->add_render_attribute( 'coherence-core-flyout', 'data-last-item', $settings['menu_last_item'] );
			}

			?>
			<div class="coherence-core-nav-menu__toggle elementor-clickable coherence-core-flyout-trigger" tabindex="0">
					<div class="coherence-core-nav-menu-icon">
						<?php echo isset( $menu_close_icons[0] ) ? $menu_close_icons[0] : ''; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> 
					</div>
				</div>
			<div <?php echo wp_kses_post( $this->get_render_attribute_string( 'coherence-core-flyout' ) ); ?> >
				<div class="coherence-core-flyout-overlay elementor-clickable"></div>
				<div class="coherence-core-flyout-container">
					<div id="coherence-core-flyout-content-id-<?php echo esc_attr( $this->get_id() ); ?>" class="coherence-core-side coherence-core-flyout-<?php echo esc_attr( $settings['flyout_layout'] ); ?> coherence-core-flyout-open" data-layout="<?php echo wp_kses_post( $settings['flyout_layout'] ); ?>" data-flyout-type="<?php echo wp_kses_post( $settings['flyout_type'] ); ?>">
						<div class="coherence-core-flyout-content push">						
							<nav <?php echo wp_kses_post( $this->get_render_attribute_string( 'coherence-core-nav-menu' ) ); ?>><?php echo $menu_html; ?></nav>
							<div class="elementor-clickable coherence-core-flyout-close" tabindex="0">
								<?php echo isset( $menu_close_icons[1] ) ? $menu_close_icons[1] : ''; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
						</div>
					</div>
				</div>
			</div>				
			<?php
		} else {
			$this->add_render_attribute(
				'coherence-core-main-menu',
				'class',
				[
					'coherence-core-nav-menu',
					'coherence-core-layout-' . $settings['layout'],
				]
			);

			$this->add_render_attribute( 'coherence-core-main-menu', 'class', 'coherence-core-nav-menu-layout' );

			$this->add_render_attribute( 'coherence-core-main-menu', 'class', $settings['layout'] );

			$this->add_render_attribute( 'coherence-core-main-menu', 'data-layout', $settings['layout'] );

			if ( 'cta' === $settings['menu_last_item'] ) {

				$this->add_render_attribute( 'coherence-core-main-menu', 'data-last-item', $settings['menu_last_item'] );
			}

			if ( $settings['pointer'] ) {
				if ( 'horizontal' === $settings['layout'] || 'vertical' === $settings['layout'] ) {
					$this->add_render_attribute( 'coherence-core-main-menu', 'class', 'coherence-core-pointer__' . $settings['pointer'] );

					if ( in_array( $settings['pointer'], [ 'double-line', 'underline', 'overline' ], true ) ) {
						$key = 'animation_line';
						$this->add_render_attribute( 'coherence-core-main-menu', 'class', 'coherence-core-animation__' . $settings[ $key ] );
					} elseif ( 'framed' === $settings['pointer'] || 'text' === $settings['pointer'] ) {
						$key = 'animation_' . $settings['pointer'];
						$this->add_render_attribute( 'coherence-core-main-menu', 'class', 'coherence-core-animation__' . $settings[ $key ] );
					}
				}
			}

			if ( 'expandible' === $settings['layout'] ) {
				$this->add_render_attribute( 'coherence-core-nav-menu', 'class', 'coherence-core-dropdown-expandible' );
			}

			$this->add_render_attribute(
				'coherence-core-nav-menu',
				'class',
				[
					'coherence-core-nav-menu__layout-' . $settings['layout'],
					'coherence-core-nav-menu__submenu-' . $settings['submenu_icon'],
				]
			);

			$this->add_render_attribute( 'coherence-core-nav-menu', 'data-toggle-icon', $menu_close_icons[0] );

			$this->add_render_attribute( 'coherence-core-nav-menu', 'data-close-icon', $menu_close_icons[1] );

			$this->add_render_attribute( 'coherence-core-nav-menu', 'data-full-width', $settings['full_width_dropdown'] );

			?>
			<div <?php echo $this->get_render_attribute_string( 'coherence-core-main-menu' ); ?>>
				<div class="coherence-core-nav-menu__toggle elementor-clickable">
					<div class="coherence-core-nav-menu-icon">
						<?php echo isset( $menu_close_icons[0] ) ? $menu_close_icons[0] : ''; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				</div>
				<nav <?php echo $this->get_render_attribute_string( 'coherence-core-nav-menu' ); ?>><?php echo $menu_html; ?></nav>              
			</div>
			<?php
		}
	}
}

Plugin::instance()->widgets_manager->register(new Coherence_Menu_Widget());