<?php
/**
 * Bundle layout: Linked Resources.
 *
 * Renders the relationship of resources as a grid of resource cards.
 * Replaces the old `included_resources` block.
 */
$row       = $args['row'] ?? [];
$resources = $row['resource'] ?? [];
if (!$resources) {
  return;
}
?>
<section>
  <div class="grid grid-cols-12 gap-6">
    <?php global $post; foreach ($resources as $post) { setup_postdata($post); ?>
      <?php get_template_part('templates/cards/resource'); ?>
    <?php } wp_reset_postdata(); ?>
  </div>
</section>
