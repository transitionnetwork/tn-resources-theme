<div class="col-span-12 md:col-span-4">
  <div class="card">
    <?php $image = get_field('picture', $post); ?>
    <div class="h-0 pt-2/3 relative">
      <a href="<?php the_permalink(); ?>">
        <?php if($image) { ?>
          <?php echo wp_get_attachment_image( $image['id'], 'full', false, array('class' => 'w-full h-full object-cover absolute inset-0 z-0') ); ?>
        <?php } else { ?>
          <div class="absolute inset-0 bg-gray-300"></div>
        <?php } ?>
      </a>
    </div>
    <div class="p-6 space-y-3">
      <?php get_template_part('templates/partials/content-types'); ?>
      <h3 class="h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <div>
        <?php echo xinc_preview_content($post); ?>
      </div>
      <a class="btn btn-tertiary block text-center" href="<?php the_permalink(); ?>">Read</a>
    </div>
  </div>
</div>
