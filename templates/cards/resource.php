<div class="col-span-12 md:col-span-4">
  <div class="card">
    <div class="h-0 pt-2/3 relative">
      <div class="absolute inset-0 bg-gray-300"></div>
    </div>
    <div class="p-3 space-y-2">
      <?php get_template_part('templates/partials/content-types'); ?>
      <h3 class="h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <div>
        <?php echo xinc_preview_content($post); ?>
      </div>
      <a class="btn btn-tertiary block text-center" href="<?php the_permalink(); ?>">Read Guide</a>
    </div>
  </div>
</div>
