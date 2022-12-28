<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package coherence
 */
if (1 == coherence_get_option('footer_widgets', 0)) :
    $coherence_page_meta = get_post_meta(get_queried_object_id(), 'coherence_page_meta', true);

    $coherence_footer_builder_id = (!empty($coherence_page_meta['footer-builder-id']) ? $coherence_page_meta['footer-builder-id'] : coherence_get_option('footer-builder-id'));
?>

    <div class="coherence-footer-builder">
        <?php

        $coherence_footer_builder = \Elementor\Plugin::instance();
        $coherence_footer_builder_content = $coherence_footer_builder->frontend->get_builder_content($coherence_footer_builder_id);
        echo sprintf(__('%s', 'coherence'), $coherence_footer_builder_content); // phpcs:ignore WordPress.WP.I18n.NoEmptyStrings
        ?>
    </div>
<?php endif; ?>