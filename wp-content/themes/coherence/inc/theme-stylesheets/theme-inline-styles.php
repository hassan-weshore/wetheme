<?php
if (!function_exists('coherence_check_exist_bgimage')) {

	function coherence_check_exist_bgimage($attr_style, $get_option_valuee)
	{
		$function_attr = (isset($get_option_valuee) && !empty($get_option_valuee)) ? $attr_style . ":url('" . $get_option_valuee . "');" : "";
		return $function_attr;
	}
}


if (!function_exists('coherence_check_exist_value')) {

	function coherence_check_exist_value($attr_style, $get_option_value, $default = null)
	{
		if (!isset($default)) {
			$function_attr = (isset($get_option_value) && !empty($get_option_value) && ($get_option_value != "px") && ($get_option_value != " !important") && ($get_option_value != null)) ? $attr_style . ":" . $get_option_value . ";" : "";
		} else {
			$function_attr = (isset($get_option_value) && !empty($get_option_value) && ($get_option_value != "px") && ($get_option_value != " !important") && ($get_option_value != null)) ? $attr_style . ":" . $get_option_value . ";" : $attr_style . ":" . $default . ";";
		}

		return $function_attr;
	}
}

if (!function_exists('coherence_font_style')) {

	function coherence_font_style($selector_to_style = null, $get_option_value = null)
	{
		//
		$return = coherence_check_exist_value("font-size", esc_attr(coherence_get_option($get_option_value)['font-size']) . "px") .
			coherence_check_exist_value("line-height", esc_attr(coherence_get_option($get_option_value)['line-height']) . "px") .
			coherence_check_exist_value("letter-spacing", esc_attr(coherence_get_option($get_option_value)['letter-spacing']) . "px") .
			coherence_check_exist_value("font-family", esc_attr(coherence_get_option($get_option_value)['font-family'])) .
			coherence_check_exist_value("subset", esc_attr(coherence_get_option($get_option_value)['subset'])) .
			coherence_check_exist_value("text-align", esc_attr(coherence_get_option($get_option_value)['text-align'])) .
			coherence_check_exist_value("text-transform", esc_attr(coherence_get_option($get_option_value)['text-transform'])) .
			coherence_check_exist_value("color", esc_attr(coherence_get_option($get_option_value)['color'])) .
			coherence_check_exist_value("font-weight", esc_attr(coherence_get_option($get_option_value)['font-weight'])) .
			coherence_check_exist_value("font-style", esc_attr(coherence_get_option($get_option_value)['font-style']));
		if (isset($selector_to_style) && !empty($selector_to_style)) {
			echo $selector_to_style . "{" . $return . "}";
		} else {
			echo $return;
		}
	}
}
if (!function_exists('coherence_padding_style')) {

	function coherence_padding_style($selector_to_style = null, $get_option_value)
	{

		$unite = esc_attr(coherence_get_option($get_option_value)['unit']);

		$return = coherence_check_exist_value("padding-top", esc_attr(coherence_get_option($get_option_value)['top'] . $unite)) .
			coherence_check_exist_value("padding-right", esc_attr(coherence_get_option($get_option_value)['right'] . $unite)) .
			coherence_check_exist_value("padding-bottom", esc_attr(coherence_get_option($get_option_value)['bottom'] . $unite)) .
			coherence_check_exist_value("padding-left", esc_attr(coherence_get_option($get_option_value)['left'] . $unite));
		if (isset($selector_to_style) && !empty($selector_to_style)) {
			echo $selector_to_style . "{" . $return . "}";
		} else {
			echo $return;
		}
	}
}

if (!function_exists('coherence_dimention_style')) {

	function coherence_dimention_style($selector_to_style = null, $get_option_value)
	{

		$unite = esc_attr(coherence_get_option($get_option_value)['unit']);

		$return = coherence_check_exist_value("max-width", esc_attr(coherence_get_option($get_option_value)['width'] . $unite)) .
			coherence_check_exist_value("height", esc_attr(coherence_get_option($get_option_value)['height'] . $unite));
		if (isset($selector_to_style) && !empty($selector_to_style)) {
			echo $selector_to_style . "{" . $return . "}";
		} else {
			echo $return;
		}
	}
}

if (!function_exists('coherence_margin_style')) {

	function coherence_margin_style($selector_to_style = null, $get_option_value)
	{

		$unite = esc_attr(coherence_get_option($get_option_value)['unit']);
		$return = coherence_check_exist_value("margin-top", esc_attr(coherence_get_option($get_option_value)['top'] . $unite))  .
			coherence_check_exist_value("margin-right", esc_attr(coherence_get_option($get_option_value)['right'] . $unite))  .
			coherence_check_exist_value("margin-bottom", esc_attr(coherence_get_option($get_option_value)['bottom'] . $unite))  .
			coherence_check_exist_value("margin-left", esc_attr(coherence_get_option($get_option_value)['left'] . $unite . " !important"));
		if (isset($selector_to_style) && !empty($selector_to_style)) {
			echo $selector_to_style . "{" . $return . "}";
		} else {
			echo $return;
		}
	}
}

if (!function_exists('coherence_border_style')) {

	function coherence_border_style($selector_to_style = null, $get_option_value)
	{

		$unite = "px";
		$important = " !important";
		$return = coherence_check_exist_value("border-top", esc_attr(coherence_get_option($get_option_value)['top']) . $unite . " " . esc_attr(coherence_get_option($get_option_value)['color']) . " " . esc_attr(coherence_get_option($get_option_value)['style']) . $important)  .
			coherence_check_exist_value("border-right", esc_attr(coherence_get_option($get_option_value)['right']) . $unite . " " . esc_attr(coherence_get_option($get_option_value)['color']) . " " . esc_attr(coherence_get_option($get_option_value)['style']) . $important)  .
			coherence_check_exist_value("border-bottom", esc_attr(coherence_get_option($get_option_value)['bottom']) . $unite . " " . esc_attr(coherence_get_option($get_option_value)['color']) . " " . esc_attr(coherence_get_option($get_option_value)['style']) . $important)  .
			coherence_check_exist_value("border-left", esc_attr(coherence_get_option($get_option_value)['left']) . $unite . " " . esc_attr(coherence_get_option($get_option_value)['color']) . " " . esc_attr(coherence_get_option($get_option_value)['style']) . $important);
		if (isset($selector_to_style) && !empty($selector_to_style)) {
			echo $selector_to_style . "{" . $return . "}";
		} else {
			echo $return;
		}
	}
}


if (!function_exists('coherence_background_style')) {

	function coherence_background_style($selector_to_style = null, $get_option_value)
	{
		$return =  coherence_check_exist_value("background-color", esc_attr(coherence_get_option($get_option_value)['background-color'])) .
			coherence_check_exist_bgimage("background-image", esc_attr(coherence_get_option($get_option_value)['background-image']['url'])) .
			coherence_check_exist_value("background-position", esc_attr(coherence_get_option($get_option_value)['background-position'])) .
			coherence_check_exist_value("background-repeat", esc_attr(coherence_get_option($get_option_value)['background-repeat'])) .
			coherence_check_exist_value("background-size", esc_attr(coherence_get_option($get_option_value)['background-size'])) .
			coherence_check_exist_value("background-attachment", esc_attr(coherence_get_option($get_option_value)['background-attachment']));

		if (isset($selector_to_style) && !empty($selector_to_style)) {
			echo $selector_to_style . "{" . $return . "}";
		} else {
			echo $return;
		}
	}
}


if (!function_exists('coherence_check_exist_values')) {

	function coherence_check_exist_values($selector, $attr_style, $get_option_value)
	{
		$attributs = "";
		foreach ($get_option_value as $option) {
			$attributs .= (isset($option) && !empty($option)) ? $attr_style . ":" . $option . ";" : "";
		}

		$function_attr = (isset($attributs) && !empty($attributs)) ? $attr_style . ":" . $get_option_value . ";" : "";
		echo $selector . ":{" . $function_attr . "}";
	}
}

if (!function_exists('coherence_dynamic_styles')) {

	function coherence_dynamic_styles()
	{
		ob_start();

		/*------------------------------------------------------------------------------------
		 * body font
		------------------------------------------------------------------------------------ */
		//endif;

		if (coherence_get_option_page('enable_header_builder') == false || (0 == coherence_get_option('enable_header_builder', 0) && coherence_get_option_page('enable_header_builder') == false)) : ?>
			<?php coherence_font_style(".navbar-area .nav-container .navbar-collapse .navbar-nav li a", "nav_typography"); ?>
			.navbar-area, .navbar-area .nav-container, .navbar-area .nav-container.navbar-bg:after{
			<?php echo coherence_check_exist_value("background-color", esc_attr(coherence_get_option('header_background_color'))); ?>
			}
			.navbar-area .nav-container .navbar-collapse .navbar-nav li a:hover,.navbar-area .nav-container .navbar-collapse .navbar-nav li.current-menu-item a{
			<?php echo coherence_check_exist_value("color", esc_attr(coherence_get_option('menu_hover_color')) . " !important"); ?>
			}
			<?php coherence_margin_style(".navbar-area .nav-container .logo", "logo_margin"); ?>

		<?php endif;

		if (coherence_get_option('layout') == "boxed") :
			$body_width = isset(coherence_get_option('site_width')['width']) ? coherence_get_option('site_width')['width'] : "100%";
		?>
			body{
			width:<?php echo esc_attr($body_width); ?><?php echo esc_attr(coherence_get_option('site_width')['unit']); ?>;
			margin: auto;
			<?php coherence_background_style("", "bg_image"); ?>
			}

		<?php endif; ?>
		<?php coherence_font_style("body", "coherence_body_font"); ?>
		<?php coherence_font_style("h1", "h1_typography"); ?>
		<?php coherence_font_style("h2", "h2_typography"); ?>
		<?php coherence_font_style("h3", "h3_typography"); ?>
		<?php coherence_font_style("h4", "h4_typography"); ?>
		<?php coherence_font_style("h5", "h5_typography"); ?>
		<?php coherence_font_style("h6", "h6_typography"); ?>
		a{<?php echo coherence_check_exist_value("color", esc_attr(coherence_get_option('link_color')['color']), ""); ?>}
		a:hover{<?php echo coherence_check_exist_value("color", esc_attr(coherence_get_option('link_color')['hover']), ""); ?>}
		a:focus{<?php echo coherence_check_exist_value("color", esc_attr(coherence_get_option('link_color')['focus']), ""); ?>}
		a:active{<?php echo coherence_check_exist_value("color", esc_attr(coherence_get_option('link_color')['active']), ""); ?>}
		a:visited{<?php echo coherence_check_exist_value("color", esc_attr(coherence_get_option('link_color')['visited']), ""); ?>}
		.navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li a{
		<?php coherence_font_style("", "menu_hover_first_color"); ?>
		}
		.navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li a:hover{
		<?php echo coherence_check_exist_value("color", esc_attr(coherence_get_option('sub_menu_hover_color')) . " !important"); ?>
		}

		<?php echo coherence_padding_style(".sub-menu li", "mainmenu_dropdown_vertical_padding"); ?>
		.sub-menu li{
		<?php echo coherence_check_exist_value("background-color", esc_attr(coherence_get_option('menu_sub_bg_color')), ""); ?>
		<?php echo coherence_border_style("", "mainmenu_dropdown_divider_border"); ?>
		}
		.sub-menu li:hover{
		<?php echo coherence_check_exist_value("background", esc_attr(coherence_get_option('menu_bg_hover_color')) . " !important", ""); ?>
		}
		.header-contenair{
		position: relative;
		<?php coherence_margin_style("", "header_margin"); ?>
		<?php coherence_padding_style("", "header_padding"); ?>
		}
		<?php coherence_dimention_style(".navbar-area .nav-container .logo a img", "logo_principale_dimention"); ?>
		<?php coherence_dimention_style(".navbar-area.sticky-active .nav-container .logo a img", "logo_principale_dimention_sticky"); ?>
		#page{
		<?php coherence_background_style("", "content_background_color"); ?>
		margin: auto;}
		<?php coherence_font_style("p", "coherence_body_font"); ?>
		<?php
		/********** TITLE BAR Settings *******/

		if (!empty(coherence_get_option('header_background_image')['background-image'])) :
		?>

		<?php endif; ?>

		<?php coherence_margin_style(".navbar-area .nav-container .navbar-collapse .navbar-nav>li", "nav_menu_margin"); ?>
		.td-sidebar{
		<?php coherence_padding_style("", "sidebar_padding"); ?>
		<?php echo coherence_check_exist_value("background-color", esc_attr(coherence_get_option('sidebar_bg_color'))); ?>
		}
		.td-sidebar h2{
		<?php echo coherence_check_exist_value("color", esc_attr(coherence_get_option('sidebar_heading_color')) . " !important"); ?>
		}


		.navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu{
		<?php echo coherence_check_exist_value("min-width", esc_attr(coherence_get_option('dropdown_menu_width')) . 'px'); ?>
		}
		<?php if (1 == coherence_get_option('header_100_width', 0)) : ?>
			.navbar>.container{max-width: 100% !important; }
		<?php endif; ?>
		<?php if (0 == coherence_get_option('sticky_header', 0)) : ?>
			.sticky-active{position: relative !important; }
		<?php endif; ?>
		.breadcrumb-area .page-list li:after{
		<?php echo coherence_check_exist_value("content", '"' . esc_attr(coherence_get_option('breadcrumb_separator')) . '" !important'); ?>
		}
		<?php if (1 == coherence_get_option('breadcrumb_enable', 0)) { ?>
			.breadcrumb-area ul li{display: none;}
			.breadcrumb-area .page-list li:after{
			<?php echo coherence_check_exist_value("content", '"' . esc_attr(coherence_get_option('breadcrumb_separator')) . '" !important'); ?>
			}
			.breadcrumb-area .page-list li a{
			<?php echo coherence_check_exist_value("color", esc_attr(coherence_get_option('breadcrumbs_text_color')) . ' !important'); ?>
			}
			.breadcrumb-area .page-list li a:hover{
			<?php echo coherence_check_exist_value("color", esc_attr(coherence_get_option('breadcrumbs_text_hover_color')) . ' !important'); ?>
			}
			.breadcrumb-area .page-list li:after{
			<?php echo coherence_check_exist_value("color", esc_attr(coherence_get_option('breadcrumbs_text_hover_color')) . ' !important'); ?>
			}
		<?php }



		/*------------------------------------------------------------------------------------
		 * body font
		------------------------------------------------------------------------------------ */

		if (1 == coherence_get_option('heading_font_enable', 0)) :

			$coherence_heading_font = coherence_get_option('heading_font');
			$font_weight = isset($coherence_heading_font['font-weight']) ? $coherence_heading_font['font-weight'] : "normal";
		?>

			h1,h2,h3,h4,h5,h6{
			font-family:<?php echo esc_attr($coherence_heading_font['font-family']); ?>;
			font-weight:<?php echo esc_attr($font_weight); ?>;
			}

		<?php
		endif;

		/*------------------------------------------------------------------------------------
		  blog page spacing
		 ------------------------------------------------------------------------------------ */

		if (1 == coherence_get_option('blog_spacing_enable', 0)) : ?>

			.coherence-blog-page{
			margin-top:<?php echo esc_attr(coherence_get_option('blog_top_padding')); ?>px;
			margin-bottom:<?php echo esc_attr(coherence_get_option('blog_bottom_padding')); ?>px;
			}
		<?php endif;
		if (0 == coherence_get_option('main_nav_search_icon', 0)) :

		?>
			.search-bar-btn{display:none;}

		<?php

		endif;
		if (0 == coherence_get_option('show_top_bar', 0)) :

		?>
			.navbar-top{display:none;}

		<?php

		endif;
		if (1 == coherence_get_option('preloader_enable', 0)) : ?>
			.preloader-inner{<?php echo coherence_check_exist_value("background-color", esc_attr(coherence_get_option('preloader_background')), ""); ?>}
			.dot1, .dot2{<?php echo coherence_check_exist_value("background-color", esc_attr(coherence_get_option('preloader_color')), ""); ?>;}

		<?php endif;

		if (1 == coherence_get_option('back_top_enable', 0)) : ?>
			.back-to-top{<?php echo coherence_check_exist_value("background-color", esc_attr(coherence_get_option('back_top_background')), ""); ?>
			<?php echo coherence_check_exist_value("color", esc_attr(coherence_get_option('back_top_color')), ""); ?>
			};
		<?php endif;
		/*------------------------------------------------------------------------------------
		 blog details page spacing
		------------------------------------------------------------------------------------ */

		if (1 == coherence_get_option('blog_details_spacing_enable', 0)) :

		?>

			.coherence-blog-details{
			margin-top:<?php echo esc_attr(coherence_get_option('single_top_padding')); ?>px;
			margin-bottom:<?php echo esc_attr(coherence_get_option('single_bottom_padding')); ?>px;
			}

		<?php

		endif;


		/*------------------------------------------------------------------------------------
		  archive page spacing
		 ------------------------------------------------------------------------------------ */

		if (1 == coherence_get_option('archive_page_spacing_enable', 0)) :

		?>

			.coherence-archive-page{
			margin-top:<?php echo esc_attr(coherence_get_option('archive_top_padding')); ?>px;
			margin-bottom:<?php echo esc_attr(coherence_get_option('archive_bottom_padding')); ?>px;
			}

		<?php

		endif;

		/*------------------------------------------------------------------------------------
		 search page spacing
		------------------------------------------------------------------------------------ */

		if (1 == coherence_get_option('search_page_spacing_enable', 0)) :

		?>

			.coherence-search-page{
			margin-top:<?php echo esc_attr(coherence_get_option('search_top_padding')); ?>px;
			margin-bottom:<?php echo esc_attr(coherence_get_option('search_bottom_padding')); ?>px;
			}

		<?php

		endif;

		/*------------------------------------------------------------------------------------
		  footer top spacing
		------------------------------------------------------------------------------------ */

		if (1 == coherence_get_option('footer_spacing', 0)) :

		?>

			.coherence-footer-top{
			margin-top:<?php echo esc_attr(coherence_get_option('footer_top_spacing')); ?>px;
			margin-bottom:<?php echo esc_attr(coherence_get_option('footer_bottom_spacing')); ?>px;
			}

		<?php

		endif;

		/*------------------------------------------------------------------------------------
		  footer bottom spacing
		------------------------------------------------------------------------------------ */

		if (1 == coherence_get_option('copyright_area_spacing', 0)) :

		?>
			.footer-bottom{
			padding-top:<?php echo esc_attr(coherence_get_option('copyright_area_top_spacing')); ?>px;
			padding-bottom:<?php echo esc_attr(coherence_get_option('copyright_area_bottom_spacing')); ?>px;
			}

		<?php

		endif;
		if (coherence_get_option('title_bar_enable', 1) == 1) {
		?>
			.breadcrumb-area{
			<?php coherence_background_style("", "title_bar_bg_color"); ?>
			<?php coherence_padding_style("", "title_bar_padding"); ?>
			}

			<?php coherence_font_style(".breadcrumb-area .page-title", "title_bar_header_font"); ?>
			<?php coherence_font_style(".breadcrumb-area .page-list li", "title_bar_text_color"); ?>

		<?php }
		/*------------------------------------------------------------------------------------
		  From customizer
	   ------------------------------------------------------------------------------------ */

		//primary color
		/*
		if (!empty(coherence_get_customize_option('main_color'))) :
		?>
			:root {
			--main-color: <?php echo esc_attr(coherence_get_customize_option('main_color')); ?>;
			}
		<?php endif;
*/
		/*------------------------------------------------------------------------------------
		  Mobile
	   ------------------------------------------------------------------------------------ */
		if (1 == coherence_get_option('footer_widgets', 0)) :
		?>
			.footer-bottom{
			<?php echo coherence_check_exist_value("background-color", esc_attr(coherence_get_option('copyright_background_color')), ""); ?>
			<?php echo coherence_check_exist_value("color", esc_attr(coherence_get_option('copyright_tex_tcolor')), "!important"); ?>
			<?php coherence_padding_style("", "default_footer_padding"); ?>
			}
		<?php coherence_font_style(".footer-bottom p", "copyright_text_typo");
		endif;
		?>

		@media (max-width: 799px){
		<?php coherence_font_style(".navbar-area .nav-container .navbar-collapse .navbar-nav li a", "mobile_menu_typography"); ?>
		}

<?php
		$output = ob_get_clean();

		return $output;
	} //end  coherence_dynamic_styles

} //endif

function coherence_style_method()
{

	$custom_css = coherence_dynamic_styles();

	wp_add_inline_style('coherence-style', $custom_css);
}

add_action('wp_enqueue_scripts', 'coherence_style_method');
