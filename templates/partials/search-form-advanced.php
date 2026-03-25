<form class="space-y-6" action="<?php echo home_url(); ?>">
  <input type="hidden" name="post_type" value="resource" />

  <fieldset class="fieldset w-full">
    <legend class="fieldset-legend">Search</legend>
    <input type="text" name="s" id="advanced-search" class="input w-full" placeholder="Search resources..." value="<?php echo get_query_var('s'); ?>">
  </fieldset>


  <?php $resource_types = get_terms(array(
    'taxonomy' => 'resource-type'
  )); ?>

  <?php if($resource_types) { ?>
    <fieldset class="fieldset w-full">
      <legend class="fieldset-legend">Resource Type</legend>
      <select name="resource-type" id="resource-type" class="select w-full">
        <option value="">Search All</option>
        <?php foreach($resource_types as $resource_type) { ?>
          <option value="<?php echo $resource_type->slug; ?>"><?php echo $resource_type->name; ?></option>
        <?php } ?>
      </select>
    </fieldset>
  <?php } ?>

  <?php $project_types = get_terms(array(
    'taxonomy' => 'project-type'
  )); ?>

  <?php if($project_types) { ?>
    <fieldset class="fieldset w-full">
      <legend class="fieldset-legend">Project Type</legend>
      <select name="project-type" id="project-type" class="select w-full">
        <option value="">Search All</option>
        <?php foreach($project_types as $project_type) { ?>
          <option value="<?php echo $project_type->slug; ?>"><?php echo $project_type->name; ?></option>
        <?php } ?>
      </select>
    </fieldset>
  <?php } ?>

  <input type="submit" value="Search" class="tn-btn tn-btn-primary"/>

</form>
