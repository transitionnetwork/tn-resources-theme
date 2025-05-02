<div class="bg-brand-white py-12">
  <div class="container">
    <h2 class="h3">Featured Resources</h2>
    <?php $resources = get_field('featured_resources', 'options'); ?>
    <?php if($resources) { ?>
      <div class="grid grid-cols-12 gap-6 my-12">
        <?php foreach($resources as $post) { ?>
          <?php get_template_part('templates/cards/resource'); ?>
        <?php } ?>
      </div>
    <?php } ?>
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
