<div class="py-12">
  <div class="container">

    <h2 class="h3">Resources</h2>
    <?php get_template_part('templates/partials/resources-grid', null, array('posts_per_page'  => 3) ); ?>
    
    <?php get_template_part('templates/partials/embed-resources-nav'); ?>

    <a href="" class="location-link flex space-x-2 items-center justify-center no-underline hover:underline">
      <div><span class="location-name"></span></div>
      <span>
        <?php echo svg(['sprite' => 'icon-arrow-right', 'class' => 'text-black size-4']); ?>
      </span>
    </a>
  </div>
</div>
