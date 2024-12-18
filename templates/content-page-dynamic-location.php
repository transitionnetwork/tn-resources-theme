<?php get_header(); ?>
<?php $location = get_query_var('location'); ?>
<?php $locale = Locale::getDisplayRegion('-' . $location, 'en'); ?>

<div class="container mt-12">
  <?php if($locale) { ?>
    <h1 class="h2">Local Resources for <?php echo $locale; ?></h2>
    <?php get_template_part('templates/partials/resources-grid', null, array('posts_per_page'  => -1, 'location' => $locale) ); ?>
    #PAGINATION#
  <?php } ?>
</div>


<?php get_footer(); ?>
