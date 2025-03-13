<?php 
//add custom fields to REST API
add_action( 'rest_api_init', 'add_custom_fields' );

function add_custom_fields() {
  register_rest_field(
    'resource', 
    'picture', //New Field Name in JSON RESPONSEs
    array(
      'get_callback'    => 'get_custom_fields', // custom function name 
      'update_callback' => null,
      'schema'          => null,
     )
  );
}

function get_custom_fields( $object, $field_name, $request ) {
  //your code goes here
  $customfieldvalue = get_field('picture');
  return $customfieldvalue;
}
