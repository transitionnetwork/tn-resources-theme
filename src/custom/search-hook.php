<?php 
function replace_search( $query_object )
{
  if( $query_object->is_search() ) {
    if(get_query_var('resource-type') !== '') {
      $resource_type_query = array(
        'taxonomy' => 'resource-type',
        'field' => 'slug',
        'terms' => get_query_var('resource-type')
      ); 
    } else {
      $resource_type_query = null;
    }

    if(get_query_var('project-type') !== '') {
      $resource_type_query = array(
        'taxonomy' => 'project-type',
        'field' => 'slug',
        'terms' => get_query_var('project-type')
      ); 
    } else {
      $project_type_query = null;
    }

    $query_object->set('tax_query', array(
      'relation' => 'AND',
      $resource_type_query,
      $project_type_query
    ));
  }
}

add_action( 'parse_query', 'replace_search' );
