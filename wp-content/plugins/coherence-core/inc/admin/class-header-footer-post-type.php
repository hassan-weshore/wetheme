<?php
/*
 * @package coherence-core
 * @since 1.0.0
*/
if (!class_exists('Coherence_Header_Footer_Post_Type')) {
    class Coherence_Header_Footer_Post_Type
    {

        private static $instance;

        function __construct()
        {

            add_action('init', array($this, 'create_post_type'));
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

        function create_post_type()
        {

            $labels = array(
                'name'                  => esc_html_x('Header Builder', 'Post Type General Name', 'coherence-core'),
                'singular_name'         => esc_html_x('Header Builder', 'Post Type Singular Name', 'coherence-core'),
                'menu_name'             => esc_html__('Header Builder', 'coherence-core'),
                'name_admin_bar'        => esc_html__('Header Builder', 'coherence-core'),
                'add_new'            => esc_html_x('Add New header', 'coherence-core'),
                'add_new_item'       => esc_html__('Add New header', 'coherence-core'),
                'new_item'           => esc_html__('New header', 'coherence-core'),
                'edit_item'          => esc_html__('Edit header', 'coherence-core'),
                'view_item'          => esc_html__('View header', 'coherence-core'),
                'all_items'          => esc_html__('All Header', 'coherence-core'),
                'search_items'       => esc_html__('Search Header', 'coherence-core'),
                'parent_item_colon'  => esc_html__('Parent : header', 'coherence-core'),
                'not_found'          => esc_html__('No header found.', 'coherence-core'),
                'not_found_in_trash' => esc_html__('No header found in Trash.', 'coherence-core')

            );

            register_post_type(
                'header-builder',
                array(
                    'labels'             => $labels,
                    'public'             => true,
                    'supports'            => array('title', 'editor'),
                    'hierarchical'       => false,
                    'rewrite'            => false,
                    'menu_icon'          => 'dashicons-carrot',
                    'has_archive' => false,
                    'show_in_menu' => 'edit.php?post_type=header-builder',
                    'exclude_from_search' => true,
                    'show_in_admin_bar'   => false,
                    'show_in_nav_menus'   => false,
                    'query_var'           => false
                )
            );

            $labels = array(
                'name'                  => esc_html_x('Footer Builder', 'Post Type General Name', 'coherence-core'),
                'singular_name'         => esc_html_x('Footer Builder', 'Post Type Singular Name', 'coherence-core'),
                'menu_name'             => esc_html__('Footer Builder', 'coherence-core'),
                'name_admin_bar'        => esc_html__('Footer Builder', 'coherence-core'),
                'add_new'            => esc_html_x('Add New footer', 'coherence-core'),
                'add_new_item'       => esc_html__('Add New footer', 'coherence-core'),
                'new_item'           => esc_html__('New footer', 'coherence-core'),
                'edit_item'          => esc_html__('Edit footer', 'coherence-core'),
                'view_item'          => esc_html__('View footer', 'coherence-core'),
                'all_items'          => esc_html__('All Footer', 'coherence-core'),
                'search_items'       => esc_html__('Search Footer', 'coherence-core'),
                'parent_item_colon'  => esc_html__('Parent : footer', 'coherence-core'),
                'not_found'          => esc_html__('No footer found.', 'coherence-core'),
                'not_found_in_trash' => esc_html__('No footer found in Trash.', 'coherence-core')

            );

            register_post_type(
                'footer-builder',
                array(
                    'labels'             => $labels,
                    'public'             => true,
                    'supports'            => array('title', 'editor'),
                    'hierarchical'       => false,
                    'rewrite'            => false,
                    'menu_icon'          => 'dashicons-carrot',
                    'has_archive' => false,
                    'show_in_menu' => 'edit.php?post_type=footer-builder',
                    'exclude_from_search' => true,
                    'show_in_admin_bar'   => false,
                    'show_in_nav_menus'   => false,
                    'query_var'           => false
                )
            );
        }
    } // end class

    Coherence_Header_Footer_Post_Type::getInstance();
} //endif 