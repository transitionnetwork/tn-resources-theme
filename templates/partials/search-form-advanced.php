<form class="space-y-6" action="<?php echo home_url(); ?>">
  <input type="hidden" name="post_type" value="resource" />
  
  <div class="field-wrapper w-full">
    <label for="advanced-search">Search</label>
    <input type="text" name="s" id="advanced-search" class="field w-full" placeholder="Search resources..." value="<?php echo get_query_var('s'); ?>">
    <?php echo svg(['sprite' => 'icon-search', 'class' => 'pointer-events-none col-start-1 row-start-1 ml-3 size-5 self-center text-gray-400 sm:size-4']); ?> 
  </div>

  
  <?php $resource_types = get_terms(array(
    'taxonomy' => 'resource-type'
  )); ?>
  
  <?php if($resource_types) { ?>
    <div class="field-wrapper select w-full space-y-1">
      <label for="resource-type">Resource Type</label>
      <div class="mt-2 grid grid-cols-1">
        <select name="resource-type" id="resource-type">
          <option value="">Search All</option>
          <?php foreach($resource_types as $resource_type) { ?>
            <option value="<?php echo $resource_type->slug; ?>"><?php echo $resource_type->name; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
  <?php } ?>
    
  <?php $project_types = get_terms(array(
    'taxonomy' => 'project-type'
  )); ?>

  <?php if($project_types) { ?>
    <div class="field-wrapper select w-full space-y-1">
      <label for="project-type">Project Type</label>
      <div class="mt-2 grid grid-cols-1">
        <select name="project-type" id="project-type">
          <option value="">Search All</option>
          <?php foreach($project_types as $project_type) { ?>
            <option value="<?php echo $project_type->slug; ?>"><?php echo $project_type->name; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
  <?php } ?>

  <input type="submit" value="Search" class="btn btn-primary"/>

</form>
