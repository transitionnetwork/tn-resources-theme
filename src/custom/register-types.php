<?php

add_action('acf/init', function() {
  if( function_exists('acf_add_options_page') ) {
    acf_add_options_page('Featured Resources');
  }
} );

/**
 * Register Custom Post Types
 */
add_action('init', function () {

  // Resource
  register_post_type('resource', [
    'labels' => [
      'name'               => 'Resources',
      'singular_name'      => 'Resource',
      'add_new'            => 'Add New',
      'add_new_item'       => 'Add New Resource',
      'edit_item'          => 'Edit Resource',
      'new_item'           => 'New Resource',
      'view_item'          => 'View Resource',
      'search_items'       => 'Search Resources',
      'not_found'          => 'No resources found',
      'not_found_in_trash' => 'No resources found in Trash',
      'all_items'          => 'All Resources',
      'menu_name'          => 'Resources',
    ],
    'public'             => true,
    'has_archive'        => 'resources',
    'rewrite'            => ['slug' => 'resource', 'with_front' => false],
    'menu_icon'          => 'dashicons-media-document',
    'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
    'show_in_rest'       => true,
  ]);

  // Bundle
  register_post_type('bundle', [
    'labels' => [
      'name'               => 'Bundles',
      'singular_name'      => 'Bundle',
      'add_new'            => 'Add New',
      'add_new_item'       => 'Add New Bundle',
      'edit_item'          => 'Edit Bundle',
      'new_item'           => 'New Bundle',
      'view_item'          => 'View Bundle',
      'search_items'       => 'Search Bundles',
      'not_found'          => 'No bundles found',
      'not_found_in_trash' => 'No bundles found in Trash',
      'all_items'          => 'All Bundles',
      'menu_name'          => 'Bundles',
    ],
    'public'             => true,
    'has_archive'        => 'bundles',
    'rewrite'            => ['slug' => 'bundle', 'with_front' => false],
    'menu_icon'          => 'dashicons-portfolio',
    'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
    'show_in_rest'       => true,
  ]);

});

/**
 * Register Custom Taxonomies
 */
add_action('init', function () {

  $post_types = ['resource', 'bundle'];

  // Resource Type
  register_taxonomy('resource-type', $post_types, [
    'labels' => [
      'name'              => 'Resource Types',
      'singular_name'     => 'Resource Type',
      'search_items'      => 'Search Resource Types',
      'all_items'         => 'All Resource Types',
      'edit_item'         => 'Edit Resource Type',
      'update_item'       => 'Update Resource Type',
      'add_new_item'      => 'Add New Resource Type',
      'new_item_name'     => 'New Resource Type Name',
      'menu_name'         => 'Resource Types',
    ],
    'public'            => true,
    'hierarchical'      => true,
    'show_in_rest'      => true,
    'rewrite'           => ['slug' => 'resource-type', 'with_front' => false],
    'show_admin_column' => true,
  ]);

  // Project Type
  register_taxonomy('project-type', $post_types, [
    'labels' => [
      'name'              => 'Project Types',
      'singular_name'     => 'Project Type',
      'search_items'      => 'Search Project Types',
      'all_items'         => 'All Project Types',
      'edit_item'         => 'Edit Project Type',
      'update_item'       => 'Update Project Type',
      'add_new_item'      => 'Add New Project Type',
      'new_item_name'     => 'New Project Type Name',
      'menu_name'         => 'Project Types',
    ],
    'public'            => true,
    'hierarchical'      => true,
    'show_in_rest'      => true,
    'rewrite'           => ['slug' => 'project-type', 'with_front' => false],
    'show_admin_column' => true,
  ]);

  // Country
  register_taxonomy('country', $post_types, [
    'labels' => [
      'name'              => 'Countries',
      'singular_name'     => 'Country',
      'search_items'      => 'Search Countries',
      'all_items'         => 'All Countries',
      'edit_item'         => 'Edit Country',
      'update_item'       => 'Update Country',
      'add_new_item'      => 'Add New Country',
      'new_item_name'     => 'New Country Name',
      'menu_name'         => 'Countries',
    ],
    'public'            => true,
    'hierarchical'      => true,
    'show_in_rest'      => true,
    'rewrite'           => ['slug' => 'country', 'with_front' => false],
    'show_admin_column' => true,
  ]);

  // Learning Method
  register_taxonomy('method', $post_types, [
    'labels' => [
      'name'              => 'Learning Methods',
      'singular_name'     => 'Learning Method',
      'search_items'      => 'Search Learning Methods',
      'all_items'         => 'All Learning Methods',
      'edit_item'         => 'Edit Learning Method',
      'update_item'       => 'Update Learning Method',
      'add_new_item'      => 'Add New Learning Method',
      'new_item_name'     => 'New Learning Method Name',
      'menu_name'         => 'Learning Methods',
    ],
    'public'            => true,
    'hierarchical'      => true,
    'show_in_rest'      => true,
    'rewrite'           => ['slug' => 'method', 'with_front' => false],
    'show_admin_column' => true,
  ]);

  // Resource Tag (non-hierarchical, like post tags)
  register_taxonomy('resource-tag', $post_types, [
    'labels' => [
      'name'              => 'Resource Tags',
      'singular_name'     => 'Resource Tag',
      'search_items'      => 'Search Resource Tags',
      'all_items'         => 'All Resource Tags',
      'edit_item'         => 'Edit Resource Tag',
      'update_item'       => 'Update Resource Tag',
      'add_new_item'      => 'Add New Resource Tag',
      'new_item_name'     => 'New Resource Tag Name',
      'menu_name'         => 'Resource Tags',
    ],
    'public'            => true,
    'hierarchical'      => false,
    'show_in_rest'      => true,
    'rewrite'           => ['slug' => 'resource-tag', 'with_front' => false],
    'show_admin_column' => true,
  ]);

});
