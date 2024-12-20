<?php
get_template_part('templates/components/hero');
if (!get_field('hero_turn_full_screen_hero_off')) {
  get_template_part('templates/partials/more/scroll-down');
}
?>

<?php get_template_part('templates/partials/gallery'); ?>

<?php if(have_rows('flexible_content')) {?>

  <main class="text-center">
    <?php while(have_rows('flexible_content') ) : the_row();  ?>
      <?php //var_dump(get_row_layout()); ?>
      <?php get_template_part('templates/flexible-content/' . get_row_layout()); ?>
    <?php endwhile; ?>
  </main>

<?php } ?>
