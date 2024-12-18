<div class="bg-gray-200 py-24">
  <div class="container">
    <div class="max-w-3xl space-y-8">
      <h1 class="h2">
        <?php echo get_field('hero_title'); ?>
      </h1>
      <div class="content">
        <?php echo get_field('hero_content'); ?>
      </div>
      <form class="flex space-x-2">
        <div class="field-wrapper w-full">
          <input type="text" name="search" id="search" class="field w-full" placeholder="Search resources...">
          
          <?php echo svg(['sprite' => 'icon-search', 'class' => 'pointer-events-none col-start-1 row-start-1 ml-3 size-5 self-center text-gray-400 sm:size-4']); ?>
        </div>

        <input type="submit" value="Browse All" class="btn btn-primary"/>

      </form>
    </div>
  </div>
</div>
