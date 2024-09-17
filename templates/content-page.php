<main class="content container mt-24">
   
  <h1 class=""><?php echo \Tofino\Helpers\title(); ?></h1>

   <?php get_template_part('templates/flexible-content/intro'); ?>
  
   <?php if(have_rows('flexible_content')) {?>

    <?php while(have_rows('flexible_content') ) : the_row();  ?>
      <?php //var_dump(get_row_layout()); ?>
      <?php get_template_part('templates/flexible-content/' . get_row_layout()); ?>
    <?php endwhile; ?>

  <?php } ?>
</main>

