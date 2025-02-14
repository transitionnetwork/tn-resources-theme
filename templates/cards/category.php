<div class="col-span-6 md:col-span-4 xl:col-span-2">
  <div class="relative pt-2/3">
    <a href="<?php echo get_term_link($args->term_id); ?>" class="card text-center p-6 no-underline text-gray-700 space-y-2 hover:bg-gray-50 hover:underline absolute inset-0 flex items-center justify-center flex-col">
      <?php $image = get_field('term_icon', 'term_' . $args->term_id); ?>
      <?php echo wp_get_attachment_image( $image['id'], 'thumbnail', null, array('class' => 'max-h-8 w-auto mx-auto block')); ?>
      <span class="block">
        <?php echo $args->name; ?><br/>
        <em class="text-sm">(<?php echo $args->count; ?>)</em>
      </span>
    </a>
  </div>
</div>
