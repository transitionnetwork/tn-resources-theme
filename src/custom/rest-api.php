<?php
add_action('rest_api_init', function () {
  register_rest_field('resource', 'picture', [
    'get_callback' => function ($object) {
      return get_field('picture', $object['id']);
    },
    'schema' => null,
  ]);

  register_rest_field('resource', 'image_url', [
    'get_callback' => function ($object) {
      return xinc_get_resource_image_url($object['id']);
    },
    'schema' => [
      'description' => 'Usable image URL: picture attachment, YouTube thumb, or null.',
      'type'        => ['string', 'null'],
      'context'     => ['view', 'edit'],
    ],
  ]);
});
