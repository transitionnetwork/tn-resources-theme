<div id="geolocated-content" class="py-12" data-target="<?php echo $_GET['target']; ?>">
  <div class="container">
    <h2 class="h3"><span class="location-name"></span></h2>

    <div id="loader-container" class="flex items-center justify-center p-6">
      <div class="loader"></div>
    </div>
    
    <div id="local-resources-grid" class="grid grid-cols-12 gap-6 my-12">
    </div>

    <?php if(has_nav_menu('header_navigation')) { ?>
      <?php $menu_name = wp_get_nav_menu_name('header_navigation'); ?>
      <?php $nav_items = wp_get_nav_menu_items($menu_name); ?>

      <form class="flex justify-center my-6">
        <select name="" id="" onChange="window.open(this.value, '_blank')">
          <option value="">Main Menu</option>
          <?php foreach($nav_items as $item) { ?>
            <option value="<?php echo $item->url; ?>"><?php echo $item->title; ?></option>
          <?php } ?>
        </select>
      </form>
    <?php } ?>

      <a href="" class="location-link flex space-x-2 items-center justify-center no-underline hover:underline">
        <div><span class="location-name"></span></div>
        <span>
          <?php echo svg(['sprite' => 'icon-arrow-right', 'class' => 'text-black size-4']); ?>
        </span>
      </a>
  </div>
</div>
