<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package coherence
 */

$coherence_footer_builder_id = (!empty($project_footer_meta['footer-builder-id']) ? $project_footer_meta['footer-builder-id'] : coherence_get_option('footer-builder-id'));

?>
<div class="coherence-footer-builder">
    <?php

    $coherence_footer_builder = \Elementor\Plugin::instance();
    $coherence_footer_builder_content = $coherence_footer_builder->frontend->get_builder_content($coherence_footer_builder_id);
    echo sprintf(__('%s', 'coherence'), $coherence_footer_builder_content); // phpcs:ignore WordPress.WP.I18n.NoEmptyStrings
    ?>
</div>

</div><!-- #content -->


<?php do_action('coherence_before_footer'); ?>
</div>

<!-- #page -->

<?php wp_footer(); ?>
</body>

</html>