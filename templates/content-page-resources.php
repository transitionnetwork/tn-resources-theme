<main class="content container mt-12">
   
  <h1 class="h2"><?php echo \Tofino\Helpers\title(); ?></h1>
  <?php get_template_part('templates/partials/resources-grid', null, array('posts_per_page'  => -1) ); ?>
  #PAGINATION#
</main>

