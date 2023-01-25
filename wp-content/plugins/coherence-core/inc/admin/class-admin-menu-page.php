<?php
/*
 * @package coherence-core
 * @since 1.0.0
*/
if (!class_exists('Coherence_Core_Admin_Page')) {
  class Coherence_Core_Admin_Page
  {


    public function __construct()
    {

      add_action('admin_menu', array($this, 'coherence_menu_page'));
    }



    /*
    * add page in menu
	* @since 1.0.0
    */

    public function coherence_menu_page()
    {

      add_menu_page('Cohérence Options', 'Cohérence Options', 'manage_options', 'coherence-theme-option', '', COHERENCE_CORE_IMG . '/logo.png');
      add_submenu_page('coherence-theme-option', 'Header Builder', 'Header Builder', 'manage_options', 'edit.php?post_type=header-builder');
      add_submenu_page('coherence-theme-option', 'Footer Builder', 'Footer Builder', 'manage_options', 'edit.php?post_type=footer-builder');
      // add_submenu_page('coherence-theme-option', 'Teams', 'Teams', 'manage_options', 'edit.php?post_type=team');
      // add_submenu_page('coherence-theme-option', 'Service', 'Service', 'manage_options', 'edit.php?post_type=service');
      // add_submenu_page('coherence-theme-option', 'Service Categories', 'Service Categories', 'manage_options', 'edit-tags.php?taxonomy=service_cat');
      // add_submenu_page('coherence-theme-option', 'Project', 'Project', 'manage_options', 'edit.php?post_type=project');
      // add_submenu_page('coherence-theme-option', 'Project Categories', 'Project Categories', 'manage_options', 'edit-tags.php?taxonomy=project_cat');
      // add_submenu_page('coherence-theme-option', 'Pricing', 'Pricing', 'manage_options', 'edit.php?post_type=pricing');
    }
  } //end class


  new Coherence_Core_Admin_Page();
} //endif 