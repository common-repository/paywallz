<?php
/*
Plugin name: Paywallz
Plugin URL: http://www.paywallz.com
Description: Paywallz is the best way to charge for access to content on your WordPress site. Go to http://www.paywallz.com/wordpress and follow the installation instructions to create a Paywallz account and configure the Paywallz plugin for your WordPress site.
Version: 0.0.1
Author: Paywallz
Author URL: http://www.paywallz.com
License: GPL-2.0+
*/

  if ( !defined( 'ABSPATH' ) ) {
      exit;
  }

  if( ! defined('WP_PLUGIN_DIR')) {
    die('This Wordpress Plugin is not supported by your system.');
  }

  // Make sure we don't expose any info if called directly
  if ( !function_exists( 'add_action' ) ) {
  	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
  	exit;
  }


  define('PAYWALLZ_PLUGIN_FILE_PATH', plugin_dir_path(__FILE__) . "/paywallz.php");
  define('PAYWALLZ_IMAGE_DIR', plugin_dir_url(__FILE__) . 'assets/images/');
  define('PAYWALL_FAVICON', plugin_dir_url(__FILE__) . 'assets/images/icon.png');
  define('PAYWALLZ_OPTION_KEY', 'pwlz-site-key');
  define('PAYWALLZ_PLUGIN_URL', 'https://api.paywallz.com/comma/v1/init.js?key='.get_option(PAYWALLZ_OPTION_KEY));

  //setup
  if (is_admin()) {
  	require_once dirname(__FILE__) . '/paywallz-admin.php';
  }

  register_activation_hook(__FILE__, 'pwlz_activate');

  register_deactivation_hook(__FILE__, 'pwlz_deactivate');

  add_filter('wp_footer', 'pwlz_get_footer');

  function pwlz_get_footer() {
    if(strlen(trim(get_option(PAYWALLZ_OPTION_KEY))) > 0) {
      pwlz_get_assets();
    }
  }

  function pwlz_get_assets() {
    wp_register_script('pw_init', PAYWALLZ_PLUGIN_URL, null, null, true);
    wp_enqueue_script('pw_init');
  }
 ?>
