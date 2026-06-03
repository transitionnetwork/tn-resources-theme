<?php
/**
 * Bundle layout: Image.
 */
$row     = $args['row'] ?? [];
$title   = $row['title'] ?? '';
$image   = $row['image'] ?? null;
$buttons = $row['buttons'] ?? [];
?>
<section class="max-w-5xl space-y-6">
  <?php if ($title) { ?>
    <h2 class="h3"><?php echo esc_html($title); ?></h2>
  <?php } ?>
  <?php if (is_array($image) && !empty($image['ID'])) { ?>
    <div>
      <?php echo wp_get_attachment_image($image['ID'], 'large', false, ['class' => 'w-full h-auto rounded-md']); ?>
    </div>
  <?php } ?>
  <?php get_template_part('templates/partials/bundle/buttons', null, ['buttons' => $buttons]); ?>
</section>
