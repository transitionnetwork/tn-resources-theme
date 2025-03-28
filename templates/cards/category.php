<div class="col-span-6 md:col-span-4 xl:col-span-2 flex items-stretch">
  <a href="<?php echo get_term_link($args->term_id); ?>" class="card text-center p-6 no-underline text-gray-700 space-y-2 hover:bg-gray-50 hover:underline flex items-center justify-center flex-col">
    <?php $image = get_field('term_icon', 'term_' . $args->term_id); ?>
    <?php echo wp_get_attachment_image( $image['id'], 'thumbnail', null, array('class' => 'max-h-8 w-auto mx-auto block')); ?>
    <span class="blockleading-snug">
      <span class="font-display text-lg block"><?php echo $args->name; ?></span>
      <em class="text-sm font-sans block">(<?php echo $args->count; ?>)</em>
    </span>
  </a>
</div>
