<div class="bg-gray-200 py-24 relative">
  <?php $background_image = get_field('background_image'); ?>
  <?php if($background_image) { ?>
    <?php echo wp_get_attachment_image( $background_image['id'], 'full', false, array('class' => 'w-full h-full object-cover absolute inset-0 z-1') ); ?>
  <?php } ?>
  
  <div class="container relative">
    <div class="max-w-3xl">
      <div class="bg-white rounded-md outline-gray-300 outline-1 p-12 space-y-8">
        <h1 class="h2">
          <?php echo get_field('hero_title'); ?>
        </h1>
        <div class="content">
          <?php echo get_field('hero_content'); ?>
        </div>
        <form class="flex space-x-2">
          <div class="field-wrapper w-full">
            <label for="search" class="hidden text-sm/6 font-medium text-gray-900">Search</label>
            <input type="text" name="s" id="search" class="field w-full" placeholder="Search resources..." value="<?php echo get_query_var('s'); ?>">
            <input type="hidden" name="post_type" value="resource" />
            
            <?php echo svg(['sprite' => 'icon-search', 'class' => 'pointer-events-none col-start-1 row-start-1 ml-3 size-5 self-center text-gray-400 sm:size-4']); ?>
          </div>
  
          <input type="submit" value="Browse All" class="btn btn-primary"/>
  
        </form>
      </div>
    </div>
  </div>
</div>
