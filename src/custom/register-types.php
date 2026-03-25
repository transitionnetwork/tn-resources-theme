<?php

add_action('acf/init', function() {
  if( function_exists('acf_add_options_page') ) {
    acf_add_options_page('Featured Resources');
  }
} );
