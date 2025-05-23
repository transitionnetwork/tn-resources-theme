<?php $location = get_query_var('location'); ?>
<?php $locale = Locale::getDisplayRegion('-' . $location, 'en'); ?>

<main class="container space-y-8 my-12">
  <?php if($location) { ?>

    <?php if($locale) { ?>
      <h1 class="h3">Resources from <?php echo $locale; ?></h1>
    <?php } ?>
    
    <?php if($location === 'global') { ?>
      <h1 class="h3">Global Resources</32>
    <?php } ?>

    <?php $args = array(
      'posts_per_page'  => 3,
      'tax_query' => array(
        array(
          'taxonomy' => 'country',
          'field' => 'slug',
          'terms' => $location
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

  <?php } ?>
</main>
