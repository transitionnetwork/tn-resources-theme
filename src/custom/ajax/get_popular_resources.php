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

  $posts = get_posts($args);

  echo json_encode($posts);
  die();
}

add_action('wp_ajax_nopriv_getPopularResources', 'xinc_get_popular_resources');
add_action('wp_ajax_getPopularResources', 'xinc_get_popular_resources');
