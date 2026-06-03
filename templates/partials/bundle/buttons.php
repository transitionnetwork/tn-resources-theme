<?php
/**
 * Bundle shared buttons renderer.
 *
 * Accepts a `buttons` repeater. Each row may hold an ACF link sub-field
 * (`button`) or be a link array directly. Renders nothing when empty.
 */
$buttons = $args['buttons'] ?? [];
if (!is_array($buttons) || !$buttons) {
  return;
}
?>
<div class="flex flex-wrap gap-4 pt-2">
  <?php foreach ($buttons as $item) {
    if (isset($item['button']) && is_array($item['button'])) {
      $link = $item['button'];
    } elseif (is_array($item) && isset($item['url'])) {
      $link = $item;
    } else {
      continue;
    }

    if (empty($link['url'])) {
      continue;
    }

    $url    = $link['url'];
    $label  = !empty($link['title']) ? $link['title'] : 'Read more';
    $target = !empty($link['target']) ? $link['target'] : '_self';
  ?>
    <a href="<?php echo esc_url($url); ?>" class="tn-btn tn-btn-brand-v3"<?php echo $target === '_blank' ? ' target="_blank" rel="noopener"' : ''; ?>>
      <?php echo esc_html($label); ?>
    </a>
  <?php } ?>
</div>
