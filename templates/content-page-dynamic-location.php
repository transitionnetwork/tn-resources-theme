<?php get_header(); ?>
<?php $location = get_query_var('location'); ?>
<?php $locale = Locale::getDisplayRegion('-' . $location, 'en'); ?>

<main class="container space-y-8 my-12">
  <?php if($location) { ?>

    <?php if($locale) { ?>
      <h1 class="h3">Resources from <?php echo $locale; ?></h1>
    <?php } ?>

    <?php if($location === 'global') { ?>
      <h1 class="h3">Global Resources</h1>
    <?php } ?>

    <?php $args = array(
      'posts_per_page'  => get_option('posts_per_page'),
      'tax_query' => array(
        array(
          'taxonomy' => 'country',
          'field' => 'slug',
          'terms' => $location
        )
      ),
    ); ?>

    <?php get_template_part('templates/partials/resources-grid', null, $args ); ?>
  <?php } ?>
</main>

<?php get_footer(); ?>
