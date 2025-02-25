<main class="container space-y-8 my-12">

  <?php $category = get_term_by( 'slug', get_query_var('project-type'), 'project-type'); ?>
  <h1 class="h3"><?php echo $category->name; ?> Resources</h1>

  <?php $args = array(
    'posts_per_page'  => 3,
    'tax_query' => array(
      array(
        'taxonomy' => 'project-type',
        'field' => 'slug',
        'terms' => $category
      )
    ),
  ); ?>

  <?php get_template_part('templates/partials/resources-grid', null, $args ); ?>

  <?php get_template_part('templates/partials/embed-resources-nav'); ?>

  <a href="<?php echo home_url('resources'); ?>" class="location-link flex space-x-2 items-center justify-center no-underline hover:underline" target="_blank">
    <div>All Resources</div>
    <span>
      <?php echo svg(['sprite' => 'icon-arrow-right', 'class' => 'text-black size-4']); ?>
    </span>
  </a>

</main>
