<div class="col-span-6 sm:col-span-4 lg:col-span-2">
  <div class="card text-center p-6">
    <?php $image = get_field('project_type_icon', 'term_' . $args->term_id); ?>
    <a href="<?php echo get_term_link($args->term_id); ?>" class="no-underline hover:underline text-gray-700 space-y-2">
      <?php echo wp_get_attachment_image( $image['id'], 'thumbnail', null, array('class' => 'max-h-8 w-auto mx-auto')); ?>
      <div>
        <?php echo $args->name; ?>
      </div>
    </a>
  </div>
</div>
