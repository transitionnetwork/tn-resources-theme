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
 * @since 1.0.0
 * @return void
 */
function styles() {
  $css_file = get_template_directory() . '/dist/css/app.css';

  if (file_exists($css_file)) {
    wp_register_style('tofino', get_template_directory_uri() . '/dist/css/app.css', [], filemtime($css_file));
    wp_enqueue_style('tofino');
  }
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\styles');


/**
 * Load admin styles
 *
 * @since 1.0.0
 * @return void
 */
function admin_styles() {
  $css_file = get_template_directory() . '/dist/css/wp-admin.css';

  if (file_exists($css_file)) {
    wp_register_style('tofino/css/admin', get_template_directory_uri() . '/dist/css/wp-admin.css', [], filemtime($css_file));
    wp_enqueue_style('tofino/css/admin');
  }
}
add_action('login_head', __NAMESPACE__ . '\\admin_styles');
add_action('admin_head', __NAMESPACE__ . '\\admin_styles');


/**
 * Main JS script
 *
 * @since 1.1.0
 * @return void
 */
function main_script() {
  if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
    $js_file = get_template_directory() . '/dist/js/app.js';

    if (file_exists($js_file)) {
      wp_register_script('tofino', get_template_directory_uri() . '/dist/js/app.js', [], filemtime($js_file), true);
      wp_enqueue_script('tofino');
    }
  }
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\main_script');


/**
 * Localize script
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
      'userID'         => wp_get_current_user()->ID
    ]);
  }
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\localize_scripts');


/**
 * Load admin scripts
 *
 * @since 1.0.0
 * @return void
 */
function admin_scripts() {
  $js_file = get_template_directory() . '/dist/js/wp-admin.js';

  if (file_exists($js_file)) {
    wp_register_script('tofino/js/admin', get_template_directory_uri() . '/dist/js/wp-admin.js', [], filemtime($js_file), true);
    wp_enqueue_script('tofino/js/admin');
  }
}
add_action('admin_enqueue_scripts', __NAMESPACE__ . '\\admin_scripts');


/**
 * Correct Image Sizes
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
