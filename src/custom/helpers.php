<?php
// Function to get the user IP address
function getUserIP() {
  $info = file_get_contents('http://api.hostip.info/get_html.php');

  if (preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/', $info, $ip_match)) {
   return $ip_match[0];
  }

  return false;
}

function xinc_convert_youtube_url($string) {
  return preg_replace(
      "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
      "<iframe src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
      $string
  );
}

function after_login( $user_login, $user ) {
  if(!get_user_meta($user->ID, 'first_login')) {
    add_user_meta($user->ID, 'first_login', date('Y-m-d H:i:s'));
    wp_redirect(home_url('welcome'));
    exit;
  }
}
add_action('wp_login', 'after_login', 10, 2);
