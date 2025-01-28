<?php
function xinc_get_popular_resources() {
  if (!isset($_POST['value'])) {
    die();
  }

  $params = $_POST['value'];

  $args = array(
    'post_type' => 'resource',
    'posts_per_page' => 3
  );

  $the_query = new WP_Query($args);

  if($the_query->have_posts()) {
    $output = array();

    $key = 0;
    while ( $the_query->have_posts() ) : $the_query->the_post();
      ob_start();
      get_template_part('templates/cards/resource');
      $output[$key]['html'] = ob_get_contents();
      ob_end_clean();

      $key ++;
    endwhile;
  }

  echo json_encode($output);
  die();
}

add_action('wp_ajax_nopriv_getPopularResources', 'xinc_get_popular_resources');
add_action('wp_ajax_getPopularResources', 'xinc_get_popular_resources');
