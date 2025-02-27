<?php
//love this. so useful
add_action( 'init',  function() {
    //location
    add_rewrite_rule( 'location/([a-z0-9-]+)[/]?$', 'index.php?location=$matches[1]', 'top' );
    
    //location pagination
    add_rewrite_rule( 'location/([a-z0-9-]+)/page/([0-9]{1,})/?', 'index.php?location=$matches[1]&paged=$matches[2]', 'top' );

    //embed location
    add_rewrite_rule( 'embed-resources/location/([a-z0-9-]+)[/]?$', 'index.php?location=$matches[1]', 'top' );

    //embed location pagination
    add_rewrite_rule( 'embed-resources/location/([a-z0-9-]+)/page/([0-9]{1,})/?', 'index.php?location=$matches[1]&paged=$matches[2]', 'top' );

    //embed project-type
    add_rewrite_rule( 'embed-resources/project-type/([a-z0-9-]+)[/]?$', 'index.php?project-type=$matches[1]', 'top' );

    //embed location pagination
    add_rewrite_rule( 'embed-resources/project-type/([a-z0-9-]+)/page/([0-9]{1,})/?', 'index.php?project-type=$matches[1]&paged=$matches[2]', 'top' );
} );

add_filter('query_vars', 'foo_my_query_vars');
function foo_my_query_vars($vars){
    $vars[] = 'location';
    return $vars;
}

add_action( 'template_include', function( $template ) {
  global $wp;
  $request = home_url( $wp->request );

  //dynamic page templates
  
  if(str_contains( $request, 'embed-resources/project-type/' )) {
    return get_template_directory() . '/templates/content-page-embed-project-type.php';
  }

  if(str_contains( $request, 'embed-resources/location/' )) {
    return get_template_directory() . '/templates/content-page-embed-location.php';
  }
  
  if(str_contains( $request, '/location/' )) {
    return get_template_directory() . '/templates/content-page-dynamic-location.php';
  }

  return $template;

} );
