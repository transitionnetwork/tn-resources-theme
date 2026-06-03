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

/**
 * Permalink for a resource, tagging it with the source context when relevant.
 *
 * When a resource card is rendered inside a single bundle, the link carries
 * ?source=bundle&source_id=<bundle ID> so the single resource can show a
 * "back to bundle" nav. Anywhere else it returns the plain permalink.
 */
function xinc_get_resource_permalink($post = null) {
  $permalink = get_permalink($post);

  if (is_singular('bundle')) {
    $permalink = add_query_arg([
      'source'    => 'bundle',
      // queried object, not get_the_ID(): the bundle loop reassigns the global
      // $post to each resource, so get_the_ID() would return the resource here.
      'source_id' => get_queried_object_id(), // the bundle currently being viewed
    ], $permalink);
  }

  return $permalink;
}

/**
 * Resolve the bundle a single resource was opened from, validating the
 * ?source / ?source_id query vars. Returns null when there is no valid
 * bundle context (so callers can simply skip the nav).
 *
 * @return array|null { bundle: WP_Post, prev: WP_Post|null, next: WP_Post|null }
 */
function xinc_get_bundle_source_context() {
  if (get_query_var('source') !== 'bundle') {
    return null;
  }

  $bundle_id = (int) get_query_var('source_id');
  if (!$bundle_id) {
    return null;
  }

  $bundle = get_post($bundle_id);
  if (!$bundle || $bundle->post_type !== 'bundle' || $bundle->post_status !== 'publish') {
    return null;
  }

  // Sibling resources within the bundle, for prev/next navigation.
  $resources = get_field('included_resources', $bundle_id);
  $resources = is_array($resources) ? array_values(array_filter($resources)) : [];

  $current_id = get_the_ID();
  $ids = array_map(function ($r) {
    return is_object($r) ? $r->ID : (int) $r;
  }, $resources);

  $index = array_search($current_id, $ids, true);

  $prev = null;
  $next = null;
  if ($index !== false) {
    if ($index > 0) {
      $prev = $resources[$index - 1];
    }
    if ($index < count($resources) - 1) {
      $next = $resources[$index + 1];
    }
  }

  return [
    'bundle' => $bundle,
    'prev'   => is_object($prev) ? $prev : ($prev ? get_post($prev) : null),
    'next'   => is_object($next) ? $next : ($next ? get_post($next) : null),
  ];
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
