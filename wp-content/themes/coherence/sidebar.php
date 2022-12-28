<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Thème_Cohérence_communication
 */
$coherence_layout = coherence_page_layout_options('single_page');
if (!is_active_sidebar($coherence_layout['sidebar'])) {
	return;
}

?>

<aside id="secondary" class="widget-area td-sidebar">
	<?php
	//$sideBars = esc_attr(coherence_get_option('sidebar1'));
	//dynamic_sidebar($sideBars); 
	?>
	<?php

	//var_dump($coherence_layout);
	//echo esc_attr($coherence_layout['sidebar']); 
	?>
	<?php dynamic_sidebar($coherence_layout['sidebar']);
	?>
</aside><!-- #secondary -->