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
    $coherence_group_meta = 'coherence_project_meta';
    CSF::createMetabox($coherence_group_meta, array(
        'title'     => esc_html__('Project Meta', 'coherence-core'),
        'post_type' => 'project',
    ));

    //
    // Create a section
    CSF::createSection($coherence_group_meta, array(
        'fields' => array(
            array(
                'id'         => 'project_info',
                'type'       => 'repeater',
                'title'      => esc_html__('Project Info', 'coherence-core'),
                'fields'     => array(
                    array(
                        'id'    => 'title',
                        'type'  => 'text',
                        'title' => esc_html__('Info Title', 'coherence-core'),
                        'default' => esc_html__('Project', 'coherence-core')
                    ),
                    array(
                        'id'    => 'content',
                        'type'  => 'text',
                        'title' => esc_html__('Info Content', 'coherence-core'),
                        'default' => esc_html__('It Solution Service', 'coherence-core')
                    ),
                ),
            ),
        )
    ));
}//endif