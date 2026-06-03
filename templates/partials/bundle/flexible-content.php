<?php
/**
 * Bundle flexible content dispatcher.
 *
 * Loops the `bundle_flexible_content` field and renders each row via its
 * matching layout partial: templates/partials/bundle/layout-{layout}.php
 */
$rows = get_field('bundle_flexible_content');
if (!$rows) {
  return;
}
?>
<div class="space-y-12 mt-12">
  <?php foreach ($rows as $row) {
    $layout = $row['acf_fc_layout'] ?? '';
    if (!$layout) {
      continue;
    }
    get_template_part('templates/partials/bundle/layout', $layout, ['row' => $row]);
  } ?>
</div>
