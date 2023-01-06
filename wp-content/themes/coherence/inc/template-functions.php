<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Thème_Cohérence_communication
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

if (!function_exists('coherence_body_classes')) :
	function coherence_body_classes($classes)
	{
		// Adds a class of hfeed to non-singular pages.
		if (!is_singular()) {
			$classes[] = 'hfeed';
		}

		// Adds a class of no-sidebar when there is no sidebar present.
		if (!is_active_sidebar('sidebar-1')) {
			$classes[] = 'no-sidebar';
		}

		return $classes;
	}

endif;

add_filter('body_class', 'coherence_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
if (!function_exists('coherence_pingback_header')) :
	function coherence_pingback_header()
	{
		if (is_singular() && pings_open()) {
			printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
		}
	}
endif;
add_action('wp_head', 'coherence_pingback_header');



/*
* Pages Links
*
* @since 1.0.0
*/
if (!function_exists('coherence_link_pages')) :
	function coherence_link_pages()
	{
		$defaults = array(
			'before'         => '<div class="wp-link-pages"><span>' . esc_html__('Pages:', 'coherence') . '</span>',
			'after'          => '</div>',
			'link_before'    => '',
			'link_after'     => '',
			'next_or_number' => 'number',
			'separator'      => ' ',
			'pagelink'       => '%',
			'echo'           => 1
		);
		wp_link_pages($defaults);
	}

endif;


if (!function_exists('coherence_excerpt')) :
	// Post excerpt
	function coherence_excerpt($get_limit_value = 40, $echo = true)
	{
		$opt = $get_limit_value;
		$excerpt_limit = !empty($opt) ? $opt : 40;
		$excerpt = wp_trim_words(get_the_content(), $excerpt_limit, '');
		if ($echo == true) {
			echo esc_html($excerpt);
		} else {
			return esc_html($excerpt);
		}
	}
endif;









// custom kses allowed html
if (!function_exists('coherence_core_allowed_tags')) :
	function coherence_core_allowed_tags($tags, $context)
	{
		switch ($context) {
			case 'coherence_core_allowed_tags':
				$tags = array(
					'a' => array('href' => array(), 'class' => array()),
					'b' => array(),
					'br' => array(),
					'span' => array('class' => array(), 'data-count' => array()),
					'img' => array('class' => array()),
					'i' => array('class' => array()),
					'p' => array('class' => array()),
					'ul' => array('class' => array()),
					'li' => array('class' => array()),
					'div' => array('class' => array()),
					'strong' => array()
				);
				return $tags;
			default:
				return $tags;
		}
	}

	add_filter('wp_kses_allowed_html', 'coherence_core_allowed_tags', 10, 2);

endif;


/**
 * coherence layout options
 * @since 1.0.0
 * */


if (!function_exists('coherence_pagination')) :
	function coherence_pagination()
	{
		global $wp_query;
		$links = paginate_links(array(
			'current'   => max(1, get_query_var('paged')),
			'total'     => $wp_query->max_num_pages,
			'prev_text' => '<i class="fa fa-angle-left"></i>',
			'next_text' => '<i class="fa fa-angle-right"></i>',
		));
		echo wp_kses($links, 'coherence_core_allowed_tags');
	}
endif;

/*
*header
*
* @since 1.0.0
* */

if (!function_exists('coherence_get_option_page')) :
	function coherence_get_option_page($withOption)
	{
		$coherence_page_option = get_post_meta(get_queried_object_id(), 'coherence_page_meta', true); // only for page
		if (is_page() && isset($coherence_page_option) && !empty($coherence_page_option)) {
			if (isset($coherence_page_option[$withOption]) && true == $coherence_page_option[$withOption]) {
				return true;
			} else {
				return false;
			}
		}
	}

endif;


if (!function_exists('coherence_get_header')) :
	function coherence_get_header()
	{

		$coherence_header_style = get_post_meta(get_queried_object_id(), 'coherence_page_meta', true); // only for page

		if (is_page() && isset($coherence_header_style) && !empty($coherence_header_style)) {
			if (isset($coherence_header_style['enable_header_builder']) && true == $coherence_header_style['enable_header_builder']) {
				get_template_part('template-parts/header/header-builder');
			} else {
				get_template_part('template-parts/header/default-header');
			}
		} else {
			if (true == coherence_get_option('enable_header_builder')) {
				get_template_part('template-parts/header/header-builder');
			} else {
				get_template_part('template-parts/header/default-header');
			}
		}
	}

endif;


if (!function_exists('coherence_get_footer')) :
	function coherence_get_footer()
	{

		$coherence_footer_style = get_post_meta(get_queried_object_id(), 'coherence_page_meta', true); // only for page

		if (is_page() && isset($coherence_footer_style) && !empty($coherence_footer_style)) {
			if (isset($coherence_footer_style['enable_footer_builder']) && true == $coherence_footer_style['enable_footer_builder']) {
				get_template_part('template-parts/footer/footer-builder');
			} else {
				get_template_part('template-parts/footer/default-footer');
			}
		} else {
			if (true == coherence_get_option('enable_footer_builder')) {
				get_template_part('template-parts/footer/footer-builder');
			} else {
				get_template_part('template-parts/footer/default-footer');
			}
		}
	}

endif;

/*
*  header builder
*/
if (!function_exists('coherence_get_header_builder_library')) :
	function coherence_get_header_builder_library()
	{

		$pageslist = get_posts(array(
			'post_type'      => 'header-builder',
			'posts_per_page' => -1
		));

		$pagearray = array();
		if (!empty($pageslist)) {
			foreach ($pageslist as $page) {
				$pagearray[$page->ID] = $page->post_title;
			}
		}

		return $pagearray;
	}

endif;

/*
*  Footer builder
*/
if (!function_exists('coherence_get_footer_builder_library')) :
	function coherence_get_footer_builder_library()
	{

		$pageslist = get_posts(array(
			'post_type'      => 'footer-builder',
			'posts_per_page' => -1
		));

		$pagearray = array();
		if (!empty($pageslist)) {
			foreach ($pageslist as $page) {
				$pagearray[$page->ID] = $page->post_title;
			}
		}

		return $pagearray;
	}
endif;

/*
* meta query
* @since 1.0.0
* */
if (!function_exists('coherence_meta_query')) :
	function coherence_meta_query($prefix, $id)
	{
		global $post;
		$meta = '';
		if (!empty($post->ID)) {
			$meta = get_post_meta($post->ID, $prefix, true);
			$meta = (isset($meta[$id]) && !empty($meta[$id])) ? $meta[$id] : '';
		}

		return $meta;
	}

endif;

if (!function_exists('coherence_entry_footer')) :
	function coherence_entry_footer()
	{
		if (has_tag()) :
?>
			<div class="tag-and-share">
				<div class="row">
					<div class="<?php echo esc_attr((class_exists('Coherence_Core_Init') ? 'col-sm-7' : 'col-sm-12')); ?>">
						<?php
						$tags_list = get_the_tag_list('', ' ');
						if ($tags_list) {
							/* translators: 1: list of tags. */
							printf('<div class="tags d-inline-block"><span>' . esc_html__('Tags: ', 'coherence') . '</span> %1$s </div>', '' . $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}
						?>
					</div>
					<?php do_action('coherence_beside_tags'); ?>
				</div>
			</div>
			<?php do_action('coherence_after_tags'); ?>
<?php endif;
	}
endif;

/**
 * Coherence layout options
 * @since 1.0.0
 * */
if (!function_exists('coherence_page_layout_options')) :
	function coherence_page_layout_options($arg)
	{
		$return_var = [];
		$sidebar = is_active_sidebar('sidebar_' . $arg) ? true : false;
		$default_sidebar = $sidebar ? 'right-sidebar' : '';
		$return_var['layout'] = coherence_get_option('coherence_' . $arg . '_layout') ? coherence_get_option('coherence_' . $arg . '_layout')  : $default_sidebar;
		$return_var['sidebar_enable'] = ('left-sidebar' == $return_var['layout'] || 'right-sidebar' == $return_var['layout']) ? true : false;
		$return_var['main_content_class'] = ('left-sidebar' == $return_var['layout'] || 'right-sidebar' == $return_var['layout'])  ? 'col-lg-8' : 'col-lg-12';
		$return_var['sidebar_class'] = ('left-sidebar' == $return_var['layout'] || 'right-sidebar' == $return_var['layout'])  ? 'col-lg-4' : 'col-lg-4';
		$return_var['sidebar_class'] = 'left-sidebar' == $return_var['layout'] ? 'col-lg-4 order-first' : $return_var['sidebar_class'];
		$return_var['sidebar_class'] = (isset($_GET['sidebar']) && $_GET['sidebar'] == 'left-align') ? 'col-lg-4 order-first' : $return_var['sidebar_class'];
		$return_var['sidebar'] = coherence_get_option('sidebar_' . $arg);

		return $return_var;
	}

endif;

/*
add_filter('comment_form_fields', 'coherence_move_comment_field_to_bottom', 99, 1);
function coherence_move_comment_field_to_bottom($fields)
{
	$comment_field   = $fields['comment'];
	$comment_cookies = $fields['cookies'];
	unset($fields['comment']);
	unset($fields['cookies']);
	$fields['comment'] = $comment_field;
	$fields['cookies'] = $comment_cookies;

	return $fields;
}
*/




if (!function_exists('hook_phoneNumber')) :
	function hook_phoneNumber()

	{

		echo "<script>

        jQuery(document).ready(function() {

            var globalheader_number='" . coherence_get_option('header_number') . "';
            var globalPhoneNumber1='" . coherence_get_option('telephone_1') . "';

            var globalPhoneNumber2='" . coherence_get_option('telephone_2') . "';

            var globalAdresseMail='" . coherence_get_option('Adresse_mail') . "';

            var globalAdressePhysique='" . coherence_get_option('Adresse_physique') . "';

            var globalHoraireTravail='" . coherence_get_option('Horaire_travail') . "';

            var globalMapIframe='" . coherence_get_option('Map_iframe') . "';

            var globalSiteName='" . get_bloginfo('name') . "';

            var globalSiteUrl='" . get_bloginfo('url') . "';

            

            jQuery(\".header_number\").html(\"<a href='tel:\"+globalheader_number+\"' class='dib link_phone1'>\"+globalheader_number+\"</a>\" );
            jQuery(\".phoneNumber1\").html(\"<a href='tel:\"+globalPhoneNumber1+\"' class='dib link_phone1'>\"+globalPhoneNumber1+\"</a>\" );

            jQuery(\".phoneNumber2\").html(\"<a href='tel:\"+globalPhoneNumber2+\"' class='dib link_phone2'>\"+globalPhoneNumber2+\"</a>\" );

            jQuery(\".AdresseMail\").html( \"<a href='mailto:\"+globalAdresseMail+\"' class='dib link_mail'>\"+globalAdresseMail+\"</a>\" );

            jQuery(\".AdressePhysique\").html(globalAdressePhysique );

            jQuery(\".HoraireTravail\").html(globalHoraireTravail);

            jQuery(\".MapIframe\").html(globalMapIframe);

            jQuery(\".SiteName\").html(globalSiteName);

            jQuery(\".SiteUrl\").html(globalSiteUrl);

        });

    </script>";
	}
endif;
if (!function_exists('shortcode_header_number')) :
	function shortcode_header_number()
	{
		return "<a href='tel:" . coherence_get_option('header_number') . "' class='dib link_phone1'>" . coherence_get_option('header_number') . "</a>";
	}
endif;
if (!function_exists('shortcode_phoneNumber1')) :
	function shortcode_phoneNumber1()
	{
		return "<a href='tel:" . coherence_get_option('telephone_1') . "' class='dib link_phone1'>" . coherence_get_option('telephone_1') . "</a>";
	}
endif;
if (!function_exists('shortcode_phoneNumber2')) :
	function shortcode_phoneNumber2()

	{

		return "<a href='tel:" . coherence_get_option('telephone_2') . "' class='dib link_phone2'>" . coherence_get_option('telephone_2') . "</a>";
	}
endif;
if (!function_exists('shortcode_AdresseMail')) :
	function shortcode_AdresseMail()

	{

		return "<a href='mailto:" . coherence_get_option('header_email') . "'>" . coherence_get_option('header_email') . "</a>";
	}
endif;
if (!function_exists('shortcode_AdressePhysique')) :
	function shortcode_AdressePhysique()

	{

		return coherence_get_option('Adresse_physique');
	}
endif;
if (!function_exists('shortcode_HoraireTravail')) :
	function shortcode_HoraireTravail()

	{

		return coherence_get_option('Horaire_travail');
	}
endif;
if (!function_exists('shortcode_MapIframe')) :
	function shortcode_MapIframe()

	{

		return coherence_get_option('Map_iframe');
	}
endif;
if (!function_exists('shortcode_SiteName')) :
	function shortcode_SiteName()

	{

		return get_bloginfo('name');
	}
endif;
if (!function_exists('shortcode_SiteUrl')) :
	function shortcode_SiteUrl()
	{

		return get_bloginfo('url');
	}
endif;

add_action('wp_head', 'hook_phoneNumber');

add_shortcode('header_number', 'shortcode_header_number');
add_shortcode('phoneNumber1', 'shortcode_phoneNumber1');

add_shortcode('phoneNumber2', 'shortcode_phoneNumber2');

add_shortcode('AdresseMail', 'shortcode_AdresseMail');

add_shortcode('AdressePhysique', 'shortcode_AdressePhysique');

add_shortcode('HoraireTravail', 'shortcode_HoraireTravail');

add_shortcode('MapIframe', 'shortcode_MapIframe');

add_shortcode('SiteName', 'shortcode_SiteName');

add_shortcode('SiteUrl', 'shortcode_SiteUrl');
