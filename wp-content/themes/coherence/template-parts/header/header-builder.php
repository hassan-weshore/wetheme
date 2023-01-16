<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package coherence
 */

$coherence_page_meta = get_post_meta(get_queried_object_id(), 'coherence_page_meta', true);

$coherence_header_builder_id = (!empty($coherence_page_meta['header-builder-id']) ? $coherence_page_meta['header-builder-id'] : coherence_get_option('header-builder-id'));
?>
<div class="coherence-header-builder">
    <?php

    $coherence_header_builder = \Elementor\Plugin::instance();
    $coherence_header_builder_content = $coherence_header_builder->frontend->get_builder_content($coherence_header_builder_id, true);

    echo sprintf(__('%s', 'coherence'), $coherence_header_builder_content); // phpcs:ignore WordPress.WP.I18n.NoEmptyStrings
    ?>
</div>