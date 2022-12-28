<?php
// Control core classes for avoid errors
if (class_exists('CSF')) {

  //
  // Recent widget
  //
  CSF::createWidget('coherence_hotline_widget', array(
    'title'       => esc_html__('Coherence Hotline Widget', 'coherence-core'),
    'classname'   => 'widget widget_catagory',
    'description' => esc_html__('Add Hotline Widget', 'coherence-core'),
    'fields'      => array(
      array(
        'id'      => 'title', //title
        'type'    => 'text',
        'title'   => esc_html__('Title', 'coherence-core'),
        'default' => esc_html__('Hot Line', 'coherence-core')
      ),
      array(
        'id'      => 'phone_number', //title
        'type'    => 'text',
        'title'   => esc_html__('Phone Number', 'coherence-core'),
        'default' => esc_html__('000 - 9999 - 8888', 'coherence-core')
      ),
      array(
        'id'    => 'bg_img',
        'type'  => 'upload',
        'title' => esc_html__('Background Image', 'coherence-core'),
      ),

    )
  ));

  //
  // Front-end display of widget example 1
  // Attention: This function named considering above widget base id.
  //
  if (!function_exists('coherence_hotline_widget')) {
    function coherence_hotline_widget($args, $instance)
    {
      echo $args['before_widget'];
?>
      <div class="widget widget_call_to_action bg-overlay-base" style="background-image: url(<?php echo esc_url($instance['bg_img']); ?>);">
        <div class="widget-inner text-center">
          <i class="icomoon-client"></i>
          <h5><?php echo esc_html($instance['title']); ?></h5>
          <h3><?php echo esc_html($instance['phone_number']); ?></h3>
        </div>
      </div>
<?php
      echo $args['after_widget'];
    }
  }
}
