<?php $terms = get_terms(array(
  'taxonomy' => 'project-type',
  'hide_empty' => false
)); ?>

<?php if($terms) { ?>
  <div class="py-12">
    <div class="container">
      <h2 class="h3">Categories</h2>
      <div class="grid grid-cols-12 gap-6 my-12">
        <?php $count = 0; ?>
        <?php foreach($terms as $key => $term) { ?>
          <?php if(get_field('project_type_icon', 'term_' . $term->term_id) && $count < 6) { ?>
            <div class="col-span-6 sm:col-span-4 lg:col-span-2">
              <?php get_template_part('templates/cards/category', null, $term); ?>
              <?php $count ++; ?>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
      <a href="#" class="no-underline hover:underline text-center flex space-x-2 items-center justify-center">
        <span>View all categories</span>
        <span>
          <?php echo svg(['sprite' => 'icon-arrow-right', 'class' => 'text-black size-4']); ?>
        </span>
      </a>
    </div>
  </div>
<?php } ?>


