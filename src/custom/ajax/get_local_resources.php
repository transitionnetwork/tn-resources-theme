<?php
/**
 * Local Resources — Server-side rendering with transient caching
 *
 * Detects visitor country via Cloudflare CF-IPCountry header,
 * queries resources by country taxonomy, caches rendered HTML
 * as a WordPress transient. No AJAX needed — content is in the
 * initial HTML response for SEO / Google Ads landing pages.
 */

/**
 * Get the visitor's ISO country code from Cloudflare header.
 *
 * @return string|false Lowercase ISO code (e.g. 'gb') or false.
 */
function xinc_get_country_code() {
  if (!empty($_SERVER['HTTP_CF_IPCOUNTRY'])) {
    $code = strtolower(sanitize_text_field($_SERVER['HTTP_CF_IPCOUNTRY']));
    // CF returns 'xx' for unknown / Tor
    return ($code !== 'xx' && $code !== 't1') ? $code : false;
  }
  return false;
}

/**
 * Get a human-readable country name from an ISO code.
 *
 * @param string $iso_code Lowercase ISO 3166-1 alpha-2.
 * @return string Country name or empty string.
 */
function xinc_get_country_name($iso_code) {
  if (function_exists('locale_get_display_region')) {
    $name = locale_get_display_region('-' . strtoupper($iso_code), 'en');
    if ($name && $name !== strtoupper($iso_code)) {
      return $name;
    }
  }
  return '';
}

/**
 * Return cached local resources HTML for a given country code.
 *
 * On cache miss: runs WP_Query, renders card partials, stores
 * the result as a transient keyed by country code.
 *
 * @param string $country_code Lowercase ISO code or 'global'.
 * @return array { html: string, is_global: bool }
 */
function xinc_get_cached_local_resources($country_code) {
  $cache_key = 'xinc_local_res_' . $country_code;
  $cached = get_transient($cache_key);

  if ($cached !== false) {
    return $cached;
  }

  $args = [
    'post_type'      => 'resource',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'tax_query'      => [[
      'taxonomy' => 'country',
      'field'    => 'slug',
      'terms'    => $country_code,
    ]],
  ];

  $the_query = new WP_Query($args);
  $is_global = false;

  // Fall back to global resources if none found for country
  if (!$the_query->have_posts()) {
    $args['tax_query'][0]['terms'] = 'global';
    $the_query = new WP_Query($args);
    $is_global = true;
  }

  $html = '';
  if ($the_query->have_posts()) {
    while ($the_query->have_posts()) {
      $the_query->the_post();
      ob_start();
      get_template_part('templates/cards/resource');
      $html .= ob_get_clean();
    }
    wp_reset_postdata();
  }

  $result = [
    'html'      => $html,
    'is_global' => $is_global,
  ];

  set_transient($cache_key, $result, HOUR_IN_SECONDS);

  return $result;
}
