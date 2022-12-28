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
	   Page Options
   -------------------------------------*/
    $coherence_group_meta = 'coherence_service_meta';
    CSF::createMetabox($coherence_group_meta, array(
        'title'     => esc_html__('Service Meta', 'coherence-core'),
        'post_type' => 'service',
    ));

    //
    // Create a section
    CSF::createSection($coherence_group_meta, array(
        'title'  => esc_html__('Service Info', 'coherence-core'),
        'fields' => array(
            array(
                'id'    => 'icon',
                'type'  => 'icon',
                'title' => esc_html__('Service Icon', 'coherence-core'),
            ),
            array(
                'id'         => 'features_section_title',
                'title'      => esc_html__('Features Section Title', 'coherence-core'),
                'type'       => 'text',
                'default'    => esc_html__('My Experiences', 'coherence-core'),
            ),
            array(
                'id'         => 'features',
                'type'       => 'repeater',
                'title'      => esc_html__('Features', 'coherence-core'),
                'fields'     => array(
                    array(
                        'id'    => 'icon',
                        'type'  => 'icon',
                        'title' => esc_html__('Icon', 'coherence-core'),
                    ),
                    array(
                        'id'    => 'title',
                        'type'  => 'text',
                        'title' => esc_html__('Title', 'coherence-core'),
                        'default' => esc_html__('Flexible Solutions', 'coherence-core')
                    ),
                    array(
                        'id'    => 'content',
                        'type'  => 'text',
                        'title' => esc_html__('Content', 'coherence-core'),
                        'default' => esc_html__('Maecenas tempus, tellus eget condime honcus sem quam semper', 'coherence-core')
                    ),
                ),
            ),

        )
    ));

    //
    // FAQ
    CSF::createSection($coherence_group_meta, array(
        'title'  => esc_html__('Faq', 'coherence-core'),
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => esc_html__('FAQ', 'coherence-core'),
            ),
            array(
                'id'         => 'faq_header',
                'title'      => esc_html__(' FAQ Header', 'coherence-core'),
                'type'       => 'text',
                'default'    => esc_html__('More information', 'coherence-core'),
            ),
            array(
                'id'         => 'faq_item',
                'type'       => 'repeater',
                'title'      => esc_html__('FAQ', 'coherence-core'),
                'fields'     => array(
                    array(
                        'id'    => 'question',
                        'type'  => 'text',
                        'title' => esc_html__('Question', 'coherence-core'),
                        'default' => esc_html__('Default Title', 'coherence-core')
                    ),
                    array(
                        'id'    => 'answer',
                        'type'  => 'textarea',
                        'title' => esc_html__('Default Answer', 'coherence-core'),
                        'default' => esc_html__('Default Answer', 'coherence-core')
                    ),

                ),
            ),
            array(
                'id'    => 'image',
                'type'  => 'upload',
                'title' => esc_html__('Image', 'coherence-core'),
            ),

        )
    ));
}//endif