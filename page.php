<?php
/**
 *
 * Page template
 *
 * Checks pagename in WP query_var.
 * Looks for template based on pagename.
 * Looks for original languages pagename template if WPML plugin installed.
 * Falls back to standard get_template_part.
 *
 * @package Tofino
 * @since 1.0.0
 */

use \Tofino\Helpers as h;

get_header();

$template = h\get_page_name();
$post_parent = get_post_parent(get_the_ID());

if (is_front_page()) {
  get_template_part('templates/content-page-front');
} else if ($post_parent && locate_template('templates/content-parent-page-' . $post_parent->post_name . '.php')) {
  get_template_part('templates/content-parent-page', $post_parent->post_name);
} else if (locate_template('templates/content-page-' . $template . '.php') != '') {
  get_template_part('templates/content-page', $template); // e.g. templates/content-page-members.php
} else {
  if (function_exists('icl_object_id')) { //WPML installed
    $original_page_id = apply_filters('wpml_object_id', get_the_ID(), 'page', false, 'en'); //Assumes english is the primary language.
    if ($original_page_id) {
      $template = h\get_page_name($original_page_id);
    }
  }
  get_template_part('templates/content-page', $template);
}

get_footer(); ?>
