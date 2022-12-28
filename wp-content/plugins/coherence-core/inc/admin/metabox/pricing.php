<?php
/*
 * Theme Metabox Options
 * @package coherence
 * @since 1.0.0
 * */

if (!defined('ABSPATH')) {
    exit(); // exit if access directly
}

if (class_exists('CSF')) {


    /*-------------------------------------
	   price Options
   -------------------------------------*/
    $coherence_group_meta = 'coherence_pricing_meta';
    CSF::createMetabox($coherence_group_meta, array(
        'title'     => esc_html__('Pricing Meta', 'coherence-core'),
        'post_type' => 'pricing',
    ));

    //
    // Create a section
    CSF::createSection($coherence_group_meta, array(
        'title'  => esc_html__('Pricing Info', 'coherence-core'),
        'fields' => array(
            array(
                'id'          => 'select_style',
                'type'        => 'select',
                'title'       => esc_html__('Style', 'coherence-core'),
                'options'     => array(
                    'style-one'  => 'Style One',
                    'style-two'  => 'Style Two',
                ),
                'default'     => 'style-one'
            ),
            array(
                'id'         => 'renewal_fee',
                'title'      => esc_html__('Renewal Fee ', 'coherence-core'),
                'type'       => 'text',
                'default'    => 40,
            ),
            array(
                'id'         => 'currency',
                'title'      => esc_html__(' Currency', 'coherence-core'),
                'type'       => 'text',
                'default'    => '$'
            ),
            array(
                'id'         => 'price_plan',
                'title'      => esc_html__(' Price Plan', 'coherence-core'),
                'type'       => 'text',
                'default'    => esc_html__('/ Mo', 'coherence-core'),
                'dependency' => array('select_style', '==', 'style-two'),
            ),
            array(
                'id'    => 'price_icon',
                'type'  => 'icon',
                'title' => esc_html__('Price Icon', 'coherence-core'),
            ),
            array(
                'id'         => 'tag_line',
                'title'      => esc_html__('Tag Line', 'coherence-core'),
                'type'       => 'text',
                'default'    => false,
                'default'    => esc_html__('per month billed annually', 'coherence-core'),
                'dependency' => array('select_style', '==', 'style-one'),
            ),
            array(
                'id'         => 'features',
                'type'       => 'repeater',
                'title'      => esc_html__('Features', 'coherence-core'),
                'fields'     => array(
                    array(
                        'id'    => 'features',
                        'type'  => 'text',
                        'title' => esc_html__('Add Features', 'coherence-core'),
                        'default' => esc_html__('30 Days Trial Features', 'coherence-core')
                    ),
                    array(
                        'id'    => 'activity',
                        'type'  => 'switcher',
                        'title' => esc_html__('Availability', 'coherence-core'),
                        'default' => true
                    ),

                ),
            ),
            array(
                'id'         => 'button_label',
                'title'      => esc_html__('Button Label', 'coherence-core'),
                'type'       => 'text',
                'default'    => false,
                'default'    => esc_html__('Get Started', 'coherence-core')
            ),
            array(
                'id'         => 'button_url',
                'title'      => esc_html__('Button Url', 'coherence-core'),
                'type'       => 'text',
                'default'    => false,
                'default'    => '#'
            ),
        )
    ));
}//endif