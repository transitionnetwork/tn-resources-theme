<?php 
function xinc_write_location_to_user() {
  if (!isset($_POST['value'])) {
    die();
  }
  
  $params = $_POST['value'];

  if(!get_user_meta($params['userID'], 'country_iso')) {
    add_user_meta($params['userID'], 'country_iso', $params['location']);
  }

  echo json_encode($params);
  die();
}

add_action('wp_ajax_nopriv_writeLocationToUser', 'xinc_write_location_to_user');
add_action('wp_ajax_writeLocationToUser', 'xinc_write_location_to_user');
