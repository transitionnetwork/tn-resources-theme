<?php
// Function to get the user IP address

function xinc_convert_youtube_url($string) {
  return preg_replace(
      "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
      "<iframe src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
      $string
  );
}

function xinc_preview_content($post = null, $words = 30) {
  if(get_post_field('post_content', $post)) {
    $content = strip_tags(get_post_field('post_content', $post)) . '&hellip;';
    return wp_trim_words($content, $words);
  }

  return;
}
