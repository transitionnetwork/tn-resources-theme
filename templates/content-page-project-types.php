<?php $terms = get_terms(array(
  'taxonomy' => 'project-type',
  'hide_empty' => false
)); ?>

<main class="content container mt-12">
  <div class="">
    <h1 class="h2"><?php echo \Tofino\Helpers\title(); ?></h1>
    
    <div class="grid grid-cols-12 gap-6 my-12">
    <?php foreach($terms as $key => $term) { ?>
      <?php get_template_part('templates/cards/category', null, $term); ?>
    <?php } ?>
  </div>
</main>

