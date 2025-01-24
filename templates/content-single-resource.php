<?php while (have_posts()) : the_post(); ?>
  <main class="container py-12">
    <h1 class="h2 mb-2"><?php echo \Tofino\Helpers\title(); ?></h1>
    <?php get_template_part('templates/partials/post-meta'); ?>

    <?php while(have_rows('flexible_content') ) : the_row();  ?>
      <?php //var_dump(get_row_layout()); ?>
      <?php get_template_part('templates/flexible-content/' . get_row_layout()); ?>
    <?php endwhile; ?>
  </main>

<?php endwhile; ?>
