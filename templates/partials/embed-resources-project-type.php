<main class="container space-y-8 my-12">

  <?php $category = get_term_by( 'slug', get_query_var('project-type'), 'project-type'); ?>
  <h1 class="h2"><?php echo $category->name; ?> Resources</h2>

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

</main>
