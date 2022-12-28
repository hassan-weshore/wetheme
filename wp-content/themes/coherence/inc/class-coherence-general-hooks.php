<?php

/**
 * theme Hook class
 * */
if (!defined('ABSPATH')) {
	exit(); //exit if access directly
}

if (!class_exists('Coherence_General_Hook')) {

	class Coherence_General_Hook
	{

		private static $instance;

		public function __construct()
		{
			//Ajouter Recherche Nav bar

			add_action('coherence_before_site_content', array($this, 'preloader')); //preloader

			add_action('wp_footer', array($this, 'search')); //search

			add_action('coherence_before_site_content', array($this, 'breadcrumb')); //breadcrumb

			add_action('coherence_before_footer', array($this, 'back_to_top')); //back 
			//add_action('wp_footer', 'df_disable_comments_post_types_support');
		}


		/**
		 * getInstance();
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
		 * search popup;
		 * @since 1.0.0
		 *
		 */
		public function breadcrumb()
		{
			coherence_breadcrumb();
			if (0 == coherence_get_option('comments_pages', 0)) :
				foreach (get_post_types() as $post_type) {
					if (post_type_supports($post_type, 'comments')) {
						remove_post_type_support($post_type, 'comments');
						remove_post_type_support($post_type, 'trackbacks');
					}
				}
				add_filter('comments_open', '__return_false', 20, 2);
				add_filter('pings_open', '__return_false', 20, 2);
				add_filter('comments_array', '__return_empty_array', 10, 2);
			endif;
		}










		/**
		 * back to top
		 * @since 1.0.0
		 * */
		public function back_to_top()
		{
			if (coherence_switcher_option('back_top_enable') == 1) :

?>
				<!-- back to top area start -->
				<div class="back-to-top">
					<span class="back-top"><i class="fa fa-angle-up"></i></span>
				</div>
				<!-- back to top area end -->

			<?php
			endif;
		}

		/**
		 * pre loadaer
		 * @since 1.0.0
		 * */
		public function preloader()
		{
			if (coherence_switcher_option('preloader_enable') == 1) :

			?>
				<!-- preloader area start -->
				<div class="preloader" id="preloader">
					<div class="preloader-inner">
						<div class="spinner">
							<div class="dot1"></div>
							<div class="dot2"></div>
						</div>
					</div>
				</div>
				<!-- preloader area end -->
			<?php
			endif;
		}

		/**
		 *  search
		 * @since 1.0.0
		 * */
		public function search()
		{

			?>
			<div class="td-search-popup" id="td-search-popup">
				<form action="<?php echo esc_url(home_url('/')); ?>" class="search-form">
					<div class="form-group">
						<input type="text" name="s" class="form-control" placeholder="<?php echo esc_attr__('Search.....', 'coherence'); ?>" value="<?php get_search_query() ?>">
					</div>
					<button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
				</form>
			</div>
			<div class="body-overlay" id="body-overlay"></div>
<?php
		}


		/**
		 * Single page content buttom
		 * @since 1.0.0
		 *
		 */
	} //end class

	Coherence_General_Hook::getInstance();
} //endif