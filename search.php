<?php get_header(); ?>

<main class="container space-y-12 my-12">
  <div class="space-y-8">
    <h1 class="h2 mb-2">Search Results for "<?php echo get_query_var('s'); ?>"</h1>
    <?php if(have_posts()) { ?>
      <div class="grid grid-cols-12 gap-6">
        <?php while (have_posts()) : the_post(); ?>
          <?php get_template_part('templates/cards/resource'); ?>
        <?php endwhile; ?>
      </div>
      <?php $pagination = get_the_posts_pagination( array(
        'mid_size' => 2,
        'prev_text' => __( '<', 'textdomain' ),
        'next_text' => __( '>', 'textdomain' ),
      ) ); ?>
      <?php echo $pagination; ?>
    <?php } else { ?>
      <p class="mt-4">
        There are no resources found.
      </p>
    <?php } ?>
  </div>

  <div class="max-w-3xl">
    <h2>Advanced Search</h2>

    <?php get_template_part('templates/partials/search-form-advanced'); ?>
  </div>
</main>

<?php get_footer(); ?>
