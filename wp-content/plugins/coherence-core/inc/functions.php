<?php

/**
 *
 * @package coherence
 */
if (!defined('ABSPATH')) {
  exit(); //exit if access directly
}



if (!function_exists('coherence_core_post_query')) {
  function coherence_core_post_query($post_type)
  {
    $post_list = get_posts(array(
      'post_type' => $post_type,
      'showposts' => -1,
    ));
    $posts = array();

    if (!empty($post_list) && !is_wp_error($post_list)) {
      foreach ($post_list as $post) {
        $options[$post->ID] = $post->post_title;
      }
      return $options;
    }
  }
}

/**
 *  Taxonomy List
 * @return array
 */
function coherence_core_taxonomy_list($taxonomy = 'category')
{
  $terms = get_terms(array(
    'taxonomy' => $taxonomy,
    'hide_empty' => true,
  ));
  if (!empty($terms) && !is_wp_error($terms)) {
    foreach ($terms as $term) {
      $options[$term->slug] = $term->name;
    }
    return $options;
  }
}



function coherence_core_get_project_cat_name($slug)
{
  $term = get_term_by('slug', $slug, 'project_cat');
  $name = $term->name;
  return $name;
}


//select tag
function coherence_core_post_tag()
{

  $terms = get_terms(array(
    'taxonomy'       => 'post_tag',
    'hide_empty'     => false,
    'posts_per_page' => -1,
  ));

  $tag_list = [];
  foreach ($terms as $post) {
    $tag_list[$post->term_id] = [$post->name];
  }

  return $tag_list;
}

function coherence_core_nav_menu()
{
  $menu_list = get_terms(array(
    'taxonomy' => 'nav_menu',
    'hide_empty' => true,
  ));
  $options = [];
  if (!empty($menu_list) && !is_wp_error($menu_list)) {
    foreach ($menu_list as $menu) {
      $options[$menu->term_id] = $menu->name;
    }
    return $options;
  }
}

function coherence_core_get_thumbnail_alt($thumbnail_id)
{
  return get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
}




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


if (!function_exists('coherence_get_template')) :
  function coherence_get_template($template_name = null)
  {
    $template_path = apply_filters('coherence-elementor/template-path', 'elementor-templates/');
    $template = locate_template($template_path . $template_name);
    if (!$template) {
      $template = COHERENCE_CORE_ELEMENTOR  . '/templates/' . $template_name;
    }
    if (file_exists($template)) {
      return $template;
    } else {
      return false;
    }
  }
endif;



add_action('coherence_after_tags', 'coherence_core_next_prev_post');
function coherence_core_next_prev_post()
{ ?>
  <div class="prev-next-post">
    <div class="row">
      <?php
      $coherence_prev_post = get_previous_post();
      if (!empty($coherence_prev_post)) :
      ?>
        <div class="col-6">
          <a class="btn btn-base" href="<?php echo esc_url(get_permalink($coherence_prev_post->ID)); ?>">
            <?php esc_html_e('Prev post', 'coherence'); ?></a>
        </div>
      <?php endif; ?>
      <?php
      $coherence_next_post = get_next_post();
      if (!empty($coherence_next_post)) :
      ?>
        <div class="text-end <?php echo esc_attr((!empty($coherence_prev_post) ? 'col-6' : 'col-12')); ?>">
          <a class="btn btn-base" href="<?php echo esc_url(get_permalink($coherence_next_post->ID)); ?>"> <?php esc_html_e('Next post', 'coherence'); ?></a>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <?php
}


add_action('coherence_beside_tags', 'coherence_core_social_icon');
function coherence_core_social_icon()

{
  if (coherence_get_option('social_share', false) == 1) :
    global $post;
    //get current page url
    $coherence_url = urlencode_deep(get_permalink());
    //get current page title
    $coherence_title = str_replace(' ', '%20', get_the_title($post->ID));
    //get post thumbnail for pinterest
    $coherence_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

    //all social share link generate
    $facebook_share_link = 'https://www.facebook.com/sharer/sharer.php?u=' . $coherence_url;
    $twitter_share_link = 'https://twitter.com/intent/tweet?text=' . $coherence_title . '&amp;url=' . $coherence_url . '&amp;via=Crunchify';
    $linkedin_share_link = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $coherence_url . '&amp;title=' . $coherence_title;
    $pinterest_share_link = 'https://pinterest.com/pin/create/button/?url=' . $coherence_url . '&amp;media=' . $coherence_thumbnail[0] . '&amp;description=' . $coherence_title;

  ?>
    <div class="col-sm-5 mt-3 mt-sm-0 text-sm-end align-self-center">
      <div class="blog-share">
        <ul>
          <li><a target="_blank" href="<?php echo esc_url($facebook_share_link); ?>"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
          <li><a target="_blank" href="<?php echo esc_url($twitter_share_link); ?>"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
          <li><a target="_blank" href="<?php echo esc_url($pinterest_share_link); ?>"><i class="fab fa-pinterest" aria-hidden="true"></i></a></li>
          <li><a target="_blank" href="<?php echo esc_url($linkedin_share_link); ?>"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
        </ul>
      </div>
    </div>
  <?php
  endif;
}

if (!function_exists('coherence_core__blog_addon_social_icon')) :
  function coherence_core__blog_addon_social_icon()
  {
    global $post;
    //get current page url
    $coherence_url = urlencode_deep(get_permalink());
    //get current page title
    $coherence_title = str_replace(' ', '%20', get_the_title($post->ID));
    //get post thumbnail for pinterest
    $coherence_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
    //all social share link generate
    $facebook_share_link = 'https://www.facebook.com/sharer/sharer.php?u=' . $coherence_url;
    $twitter_share_link = 'https://twitter.com/intent/tweet?text=' . $coherence_title . '&amp;url=' . $coherence_url . '&amp;via=Crunchify';
    $pinterest_share_link = 'https://pinterest.com/pin/create/button/?url=' . $coherence_url . '&amp;media=' . $coherence_thumbnail[0] . '&amp;description=' . $coherence_title;
  ?>
    <div class="share-hover-icons">
      <ul>
        <li><a target="_blank" href="<?php echo esc_url($facebook_share_link); ?>"><i class="fab fa-facebook-f"></i></a></li>
        <li><a target="_blank" href="<?php echo esc_url($twitter_share_link); ?>"><i class="fab fa-twitter"></i></a></li>
        <li><a target="_blank" href="<?php echo esc_url($pinterest_share_link); ?>"><i class="fab fa-pinterest"></i></a></li>
      </ul>
    </div>
<?php
  }
endif;

/*
function add_custom_css_rule_to_the_css_file()
{

  $stylesheet_obj = new Stylesheet();

  $breakpoints = Responsive::get_breakpoints();
  $post_css_file->get_stylesheet()->add_rules(
    '.my-selector',
    [
      'width' => '50px',
      'height' => '50px',
    ]
  );


  $stylesheet_obj
    ->add_device('mobile', 0)
    ->add_device('tablet', $breakpoints['md'])
    ->add_device('desktop', $breakpoints['lg'])
    ->add_device('width480', $breakpoints['width480'])
    ->add_device('width540', $breakpoints['width540'])
    ->add_device('width640', $breakpoints['width640'])
    ->add_device('width700', $breakpoints['width700'])
    ->add_device('width750', $breakpoints['width750'])
    ->add_device('width800', $breakpoints['width800'])
    ->add_device('width840', $breakpoints['width840'])
    ->add_device('width900', $breakpoints['width900'])
    ->add_device('width940', $breakpoints['width940']);
}
add_action('elementor/element/parse_css', 'add_custom_css_rule_to_the_css_file', 10, 2);



*/








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
*  footer builder
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

if (!function_exists('coherence_posted_by')) :
  /**
   * Prints HTML with meta information for the current author.
   */
  function coherence_posted_by()
  {
    $byline = sprintf(
      /* translators: %s: post author. */
      esc_html_x('%s', 'post author', 'coherence'), // phpcs:ignore WordPress.WP.I18n.NoEmptyStrings
      '<span class="author vcard"><i aria-hidden="true" class=" icomoon-user-2"></i><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
    );

    echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

  }
endif;


if (!function_exists('coherence_posted_on')) :
  /**
   * Prints HTML with meta information for the current post-date/time.
   */
  function coherence_posted_on()
  {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if (get_the_time('U') !== get_the_modified_time('U')) {
      $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf(
      $time_string,
      esc_attr(get_the_date(DATE_W3C)),
      esc_html(get_the_date()),
      esc_attr(get_the_modified_date(DATE_W3C)),
      esc_html(get_the_modified_date())
    );

    $posted_on = sprintf(
      /* translators: %s: post date. */
      esc_html_x('%s', 'post date', 'coherence'),
      '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
    );

    echo '<span class="date"><i aria-hidden="true" class=" icomoon-calendar-2"></i> ' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

  }
endif;

add_filter('pt-ocdi/plugin_page_setup', 'coherence_core_import_page_setup');
function coherence_core_import_page_setup($default_settings)
{
  $default_settings['parent_slug'] = 'coherence-theme-option';
  $default_settings['page_title']  = esc_html__('Demo import', 'coherence-core');
  $default_settings['menu_title']  = esc_html__('Demo import', 'coherence-core');
  $default_settings['capability']  = 'import';
  $default_settings['menu_slug']   = 'demo';

  return $default_settings;
}


add_filter('body_class',  'coherence_core_body_classes');
/**
 * coherence_core_body_classes
 * @since 1.0.0
 * */
if (!function_exists('coherence_core_body_classes')) :
  function coherence_core_body_classes($classes)
  {

    $classes[] = 'coherence-core';


    return $classes;
  }
endif;



if (!function_exists('coherence_core_typo_and_color_options')) :
  function coherence_core_typo_and_color_options($agrs, $label, $selector, $condition, $style = 'color', $typo = true, $color = true)
  {

    if (false != $typo) :
      //title typography
      $agrs->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
          'name'           =>  str_replace(' ', '_', $label) . '_typo',
          'label'          => esc_html__($label . ' Typography', 'coherence-core'),
          'selector'       => $selector,
          'condition' => [
            'layout_type' => $condition
          ]
        ]
      );

    endif;
    if (false != $color) :
      $agrs->add_control(
        str_replace(' ', '_', $label) . '_color',
        [
          'label' => __($label . ' Color', 'coherence_core'),
          'type' => \Elementor\Controls_Manager::COLOR,
          'selectors' => [
            $selector => $style . ': {{VALUE}}',
          ],
          'condition' => [
            'layout_type' => $condition
          ]
        ]
      );
    endif;
  }
endif;
