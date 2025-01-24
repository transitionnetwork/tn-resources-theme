<?php $args['post_type'] = 'resource'; ?>
<?php $args['paged'] = ( get_query_var('paged') ? get_query_var('paged') : 1 ); ?>

<?php $the_query = new WP_Query($args); ?>

<?php if($the_query->have_posts()) { ?>
  <div class="grid grid-cols-12 gap-6 my-12">
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
      <?php get_template_part('templates/cards/resource'); ?>
    <?php endwhile; ?>
  </div>
<?php } ?>
