<?php get_header(); ?>
<?php $location = get_query_var('location'); ?>
<?php $locale = Locale::getDisplayRegion('-' . $location, 'en'); ?>

<main class="container space-y-8 my-12">
  <?php if($locale) { ?>
    <h1 class="h2">Local Resources for <?php echo $locale; ?></h2>
    <?php get_template_part('templates/partials/resources-grid', null, array('posts_per_page'  => 12, 'location' => $locale) ); ?>
  <?php } ?>
</main>

<?php get_footer(); ?>
