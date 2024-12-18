<main class="container space-y-8 my-12">
  <h1 class="h2 mb-2"><?php echo \Tofino\Helpers\title(); ?></h1>
  <?php if(have_posts()) { ?>
    <?php while (have_posts()) : the_post(); ?>
      <div class="grid grid-cols-12 gap-6">
        <?php foreach($posts as $post) { ?>
          <?php setup_postdata( $post ); ?>
          <?php get_template_part('templates/cards/resource'); ?>
        <?php } ?>
        <?php wp_reset_postdata(  ); ?>
      </div>
      # PAGINATION #
    <?php endwhile; ?>
  <?php } else { ?>
    <p class="mt-4">
      There are no resources found.
    </p>
  <?php } ?>
</main>
