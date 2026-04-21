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

function xinc_get_embed_nav_items() {
  $nav_items = array(
    'advanced-search' => 'Advanced Search',
    'resources' => 'Resources'
  );

  return $nav_items;
}

add_filter( 'img_caption_shortcode_width', '__return_zero' );

/**
 * Resolve a usable image URL for a resource:
 *   1. ACF `picture` attachment (full size)
 *   2. YouTube thumbnail derived from the first `embed` iframe
 *   3. null if neither is available
 */
function xinc_get_resource_image_url($post = null) {
  $post = get_post($post);
  if (!$post) return null;

  $image = get_field('picture', $post);
  if (is_array($image) && !empty($image['id'])) {
    $url = wp_get_attachment_image_url($image['id'], 'full');
    if ($url) return $url;
  }

  $embed = get_field('embed', $post);
  if (is_array($embed) && !empty($embed[0]['embed'])) {
    if (preg_match('/src="(.+?)"/', $embed[0]['embed'], $matches)) {
      $src = $matches[1];
      if (strpos($src, 'youtube.com') !== false
        && preg_match('#/embed/([A-Za-z0-9_-]{11})#', $src, $yt)) {
        return 'https://img.youtube.com/vi/' . $yt[1] . '/hqdefault.jpg';
      }
    }
  }

  return null;
}
