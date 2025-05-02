<?php
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page('Featured Resources');
}

// function create_post_types() {
//   register_post_type( 'partners',
//     array(
//       'labels' => array(
//         'name' => __( 'Partners' ),
//         'singular_name' => __( 'Partner' ),
//       ),
//       'public' => true,
//       'has_archive' => false,
// 			'supports' => array('title', 'editor', 'thumbnail')
//     )
//   );
// }
// add_action( 'init', 'create_post_types' );

// function create_custom_tax() {
//   register_taxonomy(
//     'partner_type',
//     'partners',
//     array(
//       'label' => __( 'Partner Type' ),
//       'hierarchical' => true,
//     )
//   );
// }
// add_action( 'init', 'create_custom_tax' );


// function custom_query_vars_filter($vars) {
//   $vars[] .= 'url';
//   return $vars;
// }
// add_filter( 'query_vars', 'custom_query_vars_filter' );

// function my_acf_init() {
//   acf_update_setting('google_api_key', get_field('google_maps_api', 'options'));
// }

// add_action('acf/init', 'my_acf_init');
