<?php
// Control core classes for avoid errors
if (class_exists('CSF')) {

  //
  // Recent widget
  //
  CSF::createWidget('download_widget', array(
    'title'       => esc_html__('Download Widget', 'coherence-core'),
    'classname'   => 'widget_catagory',
    'description' => esc_html__('Add Download List', 'coherence-core'),
    'fields'      => array(
      array(
        'id'      => 'title', //title
        'type'    => 'text',
        'title'   => esc_html__('Download', 'coherence-core'),
        'default' => esc_html__('Recent News ', 'coherence-core')
      ),
      array(
        'id'         => 'download_item',
        'type'       => 'repeater',
        'title'      => esc_html__('Add Download Item', 'coherence-core'),
        'fields'     => array(
          array(
            'id'         => 'title',
            'title'      => esc_html__(' Title', 'coherence-core'),
            'type'       => 'text',
            'default'    => esc_html__('Download PDF', 'coherence-core'),
          ),
          array(
            'id'         => 'url',
            'title'      => esc_html__('Download Url', 'coherence-core'),
            'type'       => 'text',
            'default'    => '#',
          ),

        ),
      )
    )
  ));

  //
  // Front-end display of widget example 1
  // Attention: This function named considering above widget base id.
  //
  if (!function_exists('download_widget')) {
    function download_widget($args, $instance)
    {

      echo $args['before_widget'];

      if (!empty($instance['title'])) {
        echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
      } ?>
      <ul class="catagory-items">
        <?php
        if (is_array($instance['download_item'])) :
          foreach ($instance['download_item'] as $item) : ?>
            <li><a href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['title']); ?></a></li>
        <?php endforeach;
        endif; ?>
      </ul>
<?php
      echo $args['after_widget'];
    }
  }
}
