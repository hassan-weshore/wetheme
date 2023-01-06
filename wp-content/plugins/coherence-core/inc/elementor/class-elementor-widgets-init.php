<?php

/**
 * All Elementor widget init
 * @package COHERENCE
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit(); // exit if access directly
}


if (!class_exists('Coherence_Elementor_Widget_Init')) {

	class Coherence_Elementor_Widget_Init
	{
		/*
			* $instance
			* @since 1.0.0
			* */
		private static $instance;
		/*
		* construct()
		* @since 1.0.0
		* */
		public function __construct()
		{
			add_action('elementor/elements/categories_registered', array($this, '_widget_categories'), 2);
			//elementor widget registered
			add_action('elementor/widgets/widgets_registered', array($this, '_widget_registered'));
			// elementor editor css
			add_filter('elementor/icons_manager/additional_tabs', array($this, 'elementor_custom_icons'));
		}
		
		/**
		* Include Widgets files
		*
		* Load widgets files
		*
		* @since 1.2.0
		* @access public
		*/
		public function include_widgets_files() {
			$js_files = $this->get_widget_script();
			// Enqueue the widgets script.
			if ( ! empty( $js_files ) ) {
				foreach ( $js_files as $handle => $data ) {
					wp_enqueue_script( $handle, COHERENCE_CORE_JS . $data['path'], $data['dep'], 1.6 , $data['in_footer'] );
				}
			}
			// Enqueue the widgets style.
			wp_enqueue_style( 'coherence-frontend-style', COHERENCE_CORE_CSS . '/frontend.css', []);
		}

		/**
		* Returns Script array.
		*
		* @return array()
		* @since 1.3.0
		*/
		public function get_widget_script() {
			$js_files = [
				'coherence-frontend-js' => [
					'path'      => '/frontend.js',
					'dep'       => [ 'jquery' ],
					'in_footer' => true,
				],
			];
			return $js_files;
		}

		/*
		* getInstance()
		* @since 1.0.0
		* */
		public static function getInstance()
		{
			if (null == self::$instance) {
				self::$instance = new self();
			}
			return self::$instance;
		}
		/**
		 * _widget_categories()
		 * @since 1.0.0
		 * */
		public function _widget_categories($elements_manager)
		{

			$categories = [];
			$categories['coherence_widgets'] =
				[
					'title' => sprintf(__('%s - Widgets', 'coherence-core'), '<strong>COHERENCE</strong>'),
					'icon'  => 'eicon-font'
				];

			$old_categories = $elements_manager->get_categories();
			$categories = array_merge($categories, $old_categories);

			$set_categories = function ($categories) {
				$this->categories = $categories;
			};

			$set_categories->call($elements_manager, $categories);
		}

		/**
		 * _widget_registered()
		 * @since 1.0.0
		 * */
		public function _widget_registered()
		{
			if (!class_exists('Elementor\Widget_Base')) {
				return;
			}
			$elementor_widgets = array(
				'button',
				'header',
				'menu',
				'logo',
				'banner',
				'about',
				'service',
				'funfact',
				'iconbox',
				'info-box',
				'how-it-work',
				'testimonial',
				'case-study',
				'skill',
				'video',
				'contact-form',
				'news-letter',
				'pricing',
				'sponsor',
				'event',
				'faq',
				'gallery',
				'blog',
				'team',
				'course',
				'call-to-action',
				'section-header',
				'footer-about',
				'footer-nav',
				'footer-subscribe',
				'copyright',
				'heading',
				'contentbox',
			);
			$elementor_widgets = apply_filters('coherence_elementor_widget', $elementor_widgets);

			if (is_array($elementor_widgets) && !empty($elementor_widgets)) {
				foreach ($elementor_widgets as $widget) {
					$widget_file = 'plugins/elementor/widget/' . $widget . '.php';
					$template_file = locate_template($widget_file);
					if (!$template_file || !is_readable($template_file)) {
						$template_file = COHERENCE_CORE_ELEMENTOR . '/widgets/class-' . $widget . '-widget.php';
					}
					if ($template_file && is_readable($template_file)) {
						include_once $template_file;
					}
				}
			}
			// Its is now safe to include Widgets files.
			$this->include_widgets_files();
		}

		public function elementor_custom_icons($array)
		{
			return array(
				'coherence-icon' => array(
					'name'          => 'coherence-icon',
					'label'         => 'coherence Icon',
					'url'           => '',
					'enqueue'       => array(
						COHERENCE_CORE_CSS . '/custom-icon.css',
					),
					'prefix'        => '',
					'displayPrefix' => '',
					'labelIcon'     => 'icon-video',
					'ver'           => '1.0',
					'fetchJson'     => COHERENCE_CORE_CSS . '/coherence-icon.json',
					'native'        => 1,
				),
			);
		}
	}

	if (class_exists('Coherence_Elementor_Widget_Init')) {
		Coherence_Elementor_Widget_Init::getInstance();
	}
} //end if
