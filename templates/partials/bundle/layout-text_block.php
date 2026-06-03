<?php
/**
 * Bundle layout: Text Block.
 */
$row     = $args['row'] ?? [];
$title   = $row['title'] ?? '';
$text    = $row['text'] ?? '';
$buttons = $row['buttons'] ?? [];
?>
<section class="max-w-5xl space-y-6">
  <?php if ($title) { ?>
    <h2 class="h3"><?php echo esc_html($title); ?></h2>
  <?php } ?>
  <?php if ($text) { ?>
    <div class="rich-text child-links-blank"><?php echo $text; ?></div>
  <?php } ?>
  <?php get_template_part('templates/partials/bundle/buttons', null, ['buttons' => $buttons]); ?>
</section>
