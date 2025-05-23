<?php
/**
 * Load CSS and JS files
 *
 * @package Tofino
 * @since 1.0.0
 */

namespace Tofino\Assets;

/**
 * Load styles
 *
 * Register and enqueue the main stylesheet.
 * Filemtime added as a querystring to ensure correct version is sent to the client.
 * Called using call_css() function.
 *
 * @see call_css()
 * @since 1.0.0
 * @return void
 */
function styles() {
  $dir = 'dist';
  $file_location = 'css/styles.css';

  $main_css = mix($file_location, $dir);

  wp_register_style('tofino', $main_css, array(), filemtime(get_template_directory() . '/' . $dir . '/' . $file_location));

  wp_enqueue_style('tofino');
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\styles');


/**
 * Load admin styles
 *
 * Register and enqueue the stylesheet used in the admin area.
 * Filemtime added as a querystring to ensure correct version is sent to the client.
 * Function added to both the login_head (Login page) and admin_head (Admin pages)
 *
 * @since 1.0.0
 * @return void
 */
function admin_styles() {
  $admin_css = mix('dist/css/wp-admin.css', './');
  wp_register_style('tofino/css/admin', $admin_css);
  wp_enqueue_style('tofino/css/admin');
}
add_action('login_head', __NAMESPACE__ . '\\admin_styles');
add_action('admin_head', __NAMESPACE__ . '\\admin_styles');


/**
 * Main JS script
 *
 * Register and enqueue the mains js used in front end.
 * Filemtime added as a querystring to ensure correct version is sent to the client.
 *
 * @since 1.1.0
 * @return void
 */
function main_script() {
  if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
    $manifest_js = mix('js/manifest.js', 'dist');
    wp_register_script('tofino/manifest', $manifest_js, [], false, true);
    wp_enqueue_script('tofino/manifest');

    $vendor_js = mix('js/vendor.js', 'dist');
    wp_register_script('tofino/vendor', $vendor_js, [], false, true);
    wp_enqueue_script('tofino/vendor');

    $main_js = mix('js/app.js', 'dist');
    wp_register_script('tofino', $main_js, 'tofino/vendor', false, true);
    wp_enqueue_script('tofino');
  }
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\main_script');


/**
 * Localize script
 *
 * Make data available to JS scripts via global JS variables.
 *
 * @link https://codex.wordpress.org/Function_Reference/wp_localize_script
 * @since 1.1.0
 * @return void
 */
function localize_scripts() {
  if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
    wp_localize_script('tofino', 'tofinoJS', [
      'ajaxUrl'        => admin_url('admin-ajax.php'),
      'nextNonce'      => wp_create_nonce('next_nonce'),
      'cookieExpires'  => (get_theme_mod('notification_expires') ? get_theme_mod('notification_expires'): 999),
      'themeUrl'       => get_template_directory_uri(),
      'notificationJS' => (get_theme_mod('notification_use_js') ? 'true' : 'false'),
      'siteURL'        => site_url(),
      'userID'         => wp_get_current_user(  )->ID
    ]);
  }
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\localize_scripts');


/**
 * Load admin scripts
 *
 * Register and enqueue the scripts used in the admin area.
 * Filemtime added as a querystring to ensure correct version is sent to the client.
 *
 * @since 1.0.0
 * @return void
 */
function admin_scripts() {
  $admin_js = mix('dist/js/wp-admin.js', './');
  wp_register_script('tofino/js/admin', $admin_js);
  wp_enqueue_script('tofino/js/admin');
}
add_action('admin_enqueue_scripts', __NAMESPACE__ . '\\admin_scripts');


/**
 * Correct Image Sizes
 *
 * Set the images sizes to ones we really use.
 *
 * @since 3.2.0
 * @return void
 */
function correct_image_sizes() {
  remove_image_size('thumbnail');
  remove_image_size('medium_large');
  remove_image_size('large');
  remove_image_size('1536x1536');

  update_option('thumbnail_size_h', 0);
  update_option('thumbnail_size_w', 0);

  update_option('medium_size_h', 0);
  update_option('medium_size_w', 565);

  update_option('medium_large_size_h', 0);
  update_option('medium_large_size_w', 0);

  update_option('large_size_h', 0);
  update_option('large_size_w', 1152);

  update_option('1536x1536_size_h', 0);
  update_option('1536x1536_size_w', 0);

  update_option('2048x2048_size_h', 0);
  update_option('2048x2048_size_w', 2048);
}
add_action('init', __NAMESPACE__ . '\\correct_image_sizes');
