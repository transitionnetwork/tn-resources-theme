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

  if($posts) {
    $output = array();  
    
    foreach($posts as $key => $post) {
      $output[$key] = array(
        'title' => get_the_title($post),
        'permalink' => get_the_permalink($post),
        'excerpt' => xinc_preview_content($post),
      );

      $terms = get_the_terms($post, 'content-type');
      if($terms) {
        $terms_output = array();
        foreach($terms as $term) {
          $terms_output[] = array(
            'name' => $term->name,
            'link' => get_term_link($term),
            'image' => get_field('term_icon', 'term_' . $term->term_id)['sizes']['thumbnail']
          );
        }

        $output[$key]['terms'] = $terms_output;
      } else {
        $output[$key]['terms'] = false;
      }
    }
  }

  echo json_encode($output);
  die();
}

add_action('wp_ajax_nopriv_getPopularResources', 'xinc_get_popular_resources');
add_action('wp_ajax_getPopularResources', 'xinc_get_popular_resources');
