<div id="geolocated-content" class="py-12" data-target="<?php echo $_GET['target']; ?>">
  <div class="container">
    <h2 class="h3"><span class="location-name"></span></h2>

    <div id="loader-container" class="flex items-center justify-center p-6">
      <div class="loader"></div>
    </div>
    
    <div id="local-resources-grid" class="grid grid-cols-12 gap-6 my-12">
    </div>

    <?php get_template_part('templates/partials/embed-resources-nav'); ?>

      <a href="" class="location-link flex space-x-2 items-center justify-center no-underline hover:underline">
        <div><span class="location-name"></span></div>
        <span>
          <?php echo svg(['sprite' => 'icon-arrow-right', 'class' => 'text-black size-4']); ?>
        </span>
      </a>
  </div>
</div>
