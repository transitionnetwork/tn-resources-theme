<?php
/**
 * Copyright Shortcode
 *
 * @since 1.0.0
 * @return string HTML output copyright string.
 */
function copyright() {
  return '&copy; ' . gmdate('Y');
}
add_shortcode('copyright', 'copyright');
