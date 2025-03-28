<div class="bg-brand-white py-12">
  <div class="container">
    <h2 class="h3">Featured Resources</h2>
    <?php get_template_part('templates/partials/resources-grid', null, array('posts_per_page'  => 3) ); ?>
    <div class="text-center">
      <a href="<?php echo home_url('resources'); ?>" class="text-center inline-flex space-x-2 items-center justify-center btn btn-primary">
        <span>View all resources</span>
        <span>
          <?php echo svg(['sprite' => 'icon-arrow-right', 'class' => 'text-white size-4']); ?>
        </span>
      </a>
    </div>
  </div>
</div>
