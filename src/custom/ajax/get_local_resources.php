<?php
function xinc_get_local_resources() {
  if (!isset($_POST['value'])) {
    die();
  }

  $params = $_POST['value'];

  $args = array(
    'post_type' => 'resource',
    'posts_per_page' => 3,
    'tax_query' => array(
        array(
          'taxonomy' => 'country',
          'field' => 'slug',
          'terms' => $params
        )
      ),
  );

  $the_query = new WP_Query($args);

  if(!$the_query->have_posts()) {
    $args['tax_query'][0]['terms'] = array('location' => 'global');
    $the_query = new WP_Query($args);
  }

  if($the_query->have_posts()) {
    $resources = array();

    $key = 0;
    while ( $the_query->have_posts() ) : $the_query->the_post();
      ob_start();
      get_template_part('templates/cards/resource');
      $resources[$key]['html'] = ob_get_contents();
      ob_end_clean();

      $key ++;
    endwhile;
  }

  echo json_encode(array(
    'resources' => $resources,
    'country' => $args['tax_query'][0]['terms']
  ));
  die();
}

add_action('wp_ajax_nopriv_getLocalResources', 'xinc_get_local_resources');
add_action('wp_ajax_getLocalResources', 'xinc_get_local_resources');
