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
    $coherence_group_meta = 'coherence_team_meta';
    CSF::createMetabox($coherence_group_meta, array(
        'title'     => esc_html__('Team Meta', 'coherence-core'),
        'post_type' => 'team',
    ));

    //
    // Create a section
    CSF::createSection($coherence_group_meta, array(
        'title'  => esc_html__('Team Member Info', 'coherence-core'),
        'fields' => array(
            array(
                'id'         => 'designation',
                'title'      => esc_html__('Designation', 'coherence-core'),
                'type'       => 'text',
                'default'    => false,
            ),
            array(
                'id'         => 'about',
                'title'      => esc_html__(' About', 'coherence-core'),
                'type'       => 'textarea',
                'default'    => false,
            ),
            array(
                'id'         => 'more_info',
                'type'       => 'repeater',
                'title'      => esc_html__('More Info', 'coherence-core'),
                'fields'     => array(
                    array(
                        'id'    => 'title',
                        'type'  => 'text',
                        'title' => esc_html__('Info Title', 'coherence-core'),
                        'default' => esc_html__('Phone :', 'coherence-core')
                    ),
                    array(
                        'id'    => 'content',
                        'type'  => 'text',
                        'title' => esc_html__('Info Content', 'coherence-core'),
                        'default' => esc_html__('123 - 456 - 789 ', 'coherence-core')
                    ),
                ),
            ),
            array(
                'id'         => 'social_profile',
                'type'       => 'repeater',
                'title'      => esc_html__('Social Profile', 'coherence-core'),
                'fields'     => array(
                    array(
                        'id'    => 'icon',
                        'type'  => 'icon',
                        'title' => esc_html__('Pick Up Your Icon', 'coherence-core'),
                    ),
                    array(
                        'id'    => 'link',
                        'type'  => 'text',
                        'title' => esc_html__('Enter Social Url', 'coherence-core'),
                    ),
                    array(
                        'id'    => 'color',
                        'type'  => 'color',
                        'title' => esc_html__('Color', 'coherence-core'),
                    ),
                ),
            ),
        )
    ));

    //
    // Experience
    CSF::createSection($coherence_group_meta, array(
        'title'  => esc_html__('Experience', 'coherence-core'),
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => esc_html__('Experience', 'coherence-core'),
            ),
            array(
                'id'         => 'experience_header',
                'title'      => esc_html__('Experience Header', 'coherence-core'),
                'type'       => 'text',
                'default'    => esc_html__('My Experiences', 'coherence-core'),
            ),
            array(
                'id'         => 'experience_content',
                'type'       => 'repeater',
                'title'      => esc_html__('Experience Content', 'coherence-core'),
                'fields'     => array(
                    array(
                        'id'         => 'title',
                        'title'      => esc_html__('Experience Title', 'coherence-core'),
                        'type'       => 'text',
                        'default'    => esc_html__('IT Expert', 'coherence-core'),
                    ),
                    array(
                        'id'         => 'year',
                        'title'      => esc_html__('Experience Year', 'coherence-core'),
                        'type'       => 'text',
                        'default'    => esc_html__('Softten (2015 - 2018)', 'coherence-core'),
                    ),
                    array(
                        'id'         => 'content',
                        'title'      => esc_html__('Experience Content', 'coherence-core'),
                        'type'       => 'textarea',
                    ),

                ),
            )
        )
    ));

    //
    // skill
    CSF::createSection($coherence_group_meta, array(
        'title'  => esc_html__('Skill', 'coherence-core'),
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => esc_html__('Skill', 'coherence-core'),
            ),
            array(
                'id'         => 'skill_title',
                'title'      => esc_html__('Skill Title', 'coherence-core'),
                'type'       => 'text',
                'default'    => esc_html__('My Professional', 'coherence-core'),
            ),
            array(
                'id'         => 'skill_item',
                'type'       => 'repeater',
                'title'      => esc_html__('Add Skill Item', 'coherence-core'),
                'fields'     => array(
                    array(
                        'id'         => 'title',
                        'title'      => esc_html__('Skill Title', 'coherence-core'),
                        'type'       => 'text',
                        'default'    => esc_html__('Web development', 'coherence-core'),
                    ),
                    array(
                        'id'      => 'percentage',
                        'type'    => 'slider',
                        'title'   => esc_html__('Percentage', 'coherence-core'),
                        'min'     => 0,
                        'max'     => 100,
                        'step'    => 1,
                        'default' => 70,
                    ),

                ),
            )

        )

    ));
}//endif