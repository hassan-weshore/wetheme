<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Thème_Cohérence_communication
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<?php
	if (coherence_switcher_option('responsive') == 1) : ?>
		<meta name="viewport" content="width=device-width, initial-scale=1" <?php if (coherence_switcher_option('mobilezoom') == 0) : ?> user-scalable=no <?php endif; ?>>
	<?php endif; ?>

	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php if (function_exists('wp_body_open')) {
		wp_body_open();
	} else {
		do_action('wp_body_open');
	}
	?>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'coherence'); ?></a>

		<?php coherence_get_header(); //main header  
		?>

		<div id="content" class="site-content">

			<?php do_action('coherence_before_site_content'); ?>