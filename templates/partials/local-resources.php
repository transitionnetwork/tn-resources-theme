<?php
/**
 * Local Resources — Server-side rendered, cached per country.
 *
 * Uses Cloudflare CF-IPCountry header to detect visitor location,
 * then renders resources from the matching country taxonomy term.
 * Falls back to 'global' resources if no country match.
 */

$country_code = xinc_get_country_code();
$resources    = false;
$country_name = '';
$is_global    = true;

if ($country_code) {
  $resources    = xinc_get_cached_local_resources($country_code);
  $country_name = xinc_get_country_name($country_code);
  $is_global    = $resources['is_global'] ?? true;
}

// No country detected (local dev, no CF) — fall back to global
if (!$resources || empty($resources['html'])) {
  $resources = xinc_get_cached_local_resources('global');
  $is_global = true;
}

// Nothing to show at all — hide the section
if (empty($resources['html'])) {
  return;
}

$label        = $is_global ? 'Worldwide Resources' : 'Resources from ' . $country_name;
$location_url = ($country_code && !$is_global) ? site_url('/location/' . $country_code) : '';
?>

<div class="py-12 bg-brand-white">
  <div class="container">
    <h2 class="h3"><?php echo esc_html($label); ?></h2>

    <div class="grid grid-cols-12 gap-6 my-12">
      <?php echo $resources['html']; ?>
    </div>

    <?php if ($location_url) : ?>
    <div class="text-center">
      <a href="<?php echo esc_url($location_url); ?>" class="inline-flex space-x-2 items-center justify-center btn btn-primary">
        <span><?php echo esc_html($label); ?></span>
        <span>
          <?php echo svg(['sprite' => 'icon-arrow-right', 'class' => 'text-white size-4']); ?>
        </span>
      </a>
    </div>
    <?php endif; ?>
  </div>
</div>
