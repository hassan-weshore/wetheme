<?php
/*
 * @package coherence-core
 * @since 1.0.0
*/
if (!class_exists('Coherence_Post_Type_Team')) {
    class Coherence_Post_Type_Team
    {

        private static $instance;

        /**
         * @var string
         *
         * Set post type params
         */
        private $type               = 'team';
        private $slug               = 'team';
        private $name               = 'Teams';
        private $singular_name      = 'Team';
        private $icon               = 'dashicons-carrot';

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

            $slug = $this->slug;
            $labels = array(
                'name'                  => esc_html_x('Teams', 'Post Type General Name', 'coherence-core'),
                'singular_name'         => esc_html_x('Team', 'Post Type Singular Name', 'coherence-core'),
                'add_new'               => esc_html__('Add New', 'coherence-core'),
                'add_new_item'          => esc_html__('Add New ', 'coherence-core') . $this->singular_name,
                'edit_item'             => esc_html__('Edit ', 'coherence-core') . $this->singular_name,
                'new_item'              => esc_html__('New ', 'coherence-core') . $this->singular_name,
                'all_items'             => esc_html__('All ', 'coherence-core')  . $this->name,
                'view_item'             => esc_html__('View ', 'coherence-core') . $this->singular_name,
                'view_items'            => esc_html__('View ', 'coherence-core') . $this->name,
                'search_items'          => esc_html__('Search ', 'coherence-core') . $this->name,
                'not_found'             => esc_html__('No ', 'coherence-core') . strtolower($this->name) . esc_html__(' found', 'coherence-core'),
                'not_found_in_trash'    => esc_html__('No ', 'coherence-core') . strtolower($this->name) .  esc_html__(' found in Trash', 'coherence-core'),
                'parent_item_colon'     => '',
                'menu_name'             => $this->name,
            );

            $args = array(
                'labels'                => $labels,
                'public'                => true,
                'publicly_queryable'    => true,
                'show_ui'               => true,
                'show_in_menu'          => false,
                'query_var'             => true,
                'rewrite'               => array('slug' => $slug),
                'capability_type'       => 'post',
                'has_archive'           => false,
                'hierarchical'          => true,
                'menu_position'         => 8,
                'supports'              => array('title', 'thumbnail'),
                'yarpp_support'         => true,
                'menu_icon'             => $this->icon,
                'show_in_admin_bar' => true,
            );

            register_post_type($this->type, $args);
        }
    } // end class

    Coherence_Post_Type_Team::getInstance();
} //endif 