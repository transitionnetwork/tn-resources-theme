<main>
  <?php get_template_part('templates/partials/hero-banner'); ?>
  <?php get_template_part('templates/partials/browse-categories'); ?>
  <?php get_template_part('templates/partials/local-resources'); ?>
  <?php get_template_part('templates/partials/resources-grid-wrapper'); ?>
   
  <?php get_template_part('templates/flexible-content/intro'); ?>
  
  <?php if(have_rows('flexible_content')) {?>

    <?php while(have_rows('flexible_content') ) : the_row();  ?>
      <?php //var_dump(get_row_layout()); ?>
      <?php get_template_part('templates/flexible-content/' . get_row_layout()); ?>
    <?php endwhile; ?>

  <?php } ?>

</main>

