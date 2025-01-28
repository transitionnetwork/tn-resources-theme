<div class="bg-gray-200 py-12">
  <div class="container">
    <h2 class="h3">Featured Resources</h2>
    <?php get_template_part('templates/partials/resources-grid', null, array('posts_per_page'  => 3) ); ?>
    <div>
      <a href="<?php echo home_url('resources'); ?>" class="no-underline hover:underline text-center flex space-x-2 items-center justify-center">
        <span>View all resources</span>
        <span>
          <?php echo svg(['sprite' => 'icon-arrow-right', 'class' => 'text-black size-4']); ?>
        </span>
      </a>
    </div>
  </div>
</div>
