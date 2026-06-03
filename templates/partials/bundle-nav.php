<?php
/**
 * Bundle navigation for a single resource.
 *
 * Renders a "back to bundle" link plus prev/next navigation when the resource
 * was reached from a bundle (?source=bundle&source_id=<bundle ID>). Renders
 * nothing when there is no valid bundle context.
 */
$bundle_context = xinc_get_bundle_source_context();
if(!$bundle_context) {
  return;
}
?>
<nav class="max-w-5xl mb-8 flex flex-wrap items-center justify-between gap-4" aria-label="Bundle navigation">
  <a href="<?php echo esc_url(get_permalink($bundle_context['bundle'])); ?>" class="tn-btn tn-btn-secondary inline-flex items-center gap-2 no-underline">
    <?php echo svg(['sprite' => 'icon-arrow-right', 'class' => 'size-5 rotate-180']); ?>
    <span>Return to <?php echo esc_html(get_the_title($bundle_context['bundle'])); ?> Bundle</span>
  </a>
  <div class="flex items-center gap-2">
    <?php if($bundle_context['prev']) { ?>
      <a href="<?php echo esc_url(add_query_arg(['source' => 'bundle', 'source_id' => $bundle_context['bundle']->ID], get_permalink($bundle_context['prev']))); ?>" class="tn-btn tn-btn-brand-v3 inline-flex items-center gap-2 no-underline" rel="prev">
        <?php echo svg(['sprite' => 'icon-arrow-right', 'class' => 'size-5 rotate-180']); ?>
        <span>Previous</span>
      </a>
    <?php } ?>
    <?php if($bundle_context['next']) { ?>
      <a href="<?php echo esc_url(add_query_arg(['source' => 'bundle', 'source_id' => $bundle_context['bundle']->ID], get_permalink($bundle_context['next']))); ?>" class="tn-btn tn-btn-brand-v3 inline-flex items-center gap-2 no-underline" rel="next">
        <span>Next</span>
        <?php echo svg(['sprite' => 'icon-arrow-right', 'class' => 'size-5']); ?>
      </a>
    <?php } ?>
  </div>
</nav>
