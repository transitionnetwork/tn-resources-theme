<?php get_header(); ?>

<div class="container py-12 space-y-8">
  <h1>404</h1>
  <div>
    <?php _e('Sorry, but the page you were trying to view does not exist.', 'tofino'); ?>
  </div>
  <div>
    <a class="btn btn-primary" href="<?php echo home_url(); ?>">Return Home</a>
  </div>
</div>

<?php get_footer(); ?>
