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
