<div class="col-span-6 sm:col-span-4 lg:col-span-2">
  <a href="<?php echo get_term_link($args->term_id); ?>" class="card block text-center p-6 no-underline text-gray-700 space-y-2 hover:bg-gray-50">
    <?php $image = get_field('project_type_icon', 'term_' . $args->term_id); ?>
    <?php echo wp_get_attachment_image( $image['id'], 'thumbnail', null, array('class' => 'max-h-8 w-auto mx-auto block')); ?>
    <span class="block">
      <?php echo $args->name; ?>
    </span>
  </a>
</div>
