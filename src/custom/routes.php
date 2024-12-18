<?php
//love this. so useful
add_action( 'init',  function() {
    add_rewrite_rule( 'location/([a-z0-9-]+)[/]?$', 'index.php?location=$matches[1]', 'top' );
} );

add_filter('query_vars', 'foo_my_query_vars');
function foo_my_query_vars($vars){
    $vars[] = 'location';
    return $vars;
}

add_action( 'template_include', function( $template ) {
  if ( get_query_var( 'location' ) === false || get_query_var( 'location' ) == '' ) {
      return $template;
  }

  return get_template_directory() . '/templates/content-page-dynamic-location.php';
} );
