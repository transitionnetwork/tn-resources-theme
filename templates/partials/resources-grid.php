<?php $args['post_type'] = 'resource'; ?>
<?php $args['paged'] = ( get_query_var('paged') ? get_query_var('paged') : 1 ); ?>

<?php $wp_query = new WP_Query($args); ?>

<?php if($wp_query->have_posts()) { ?>
  <div class="grid grid-cols-12 gap-6 my-12">
    <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
      <?php get_template_part('templates/cards/resource'); ?>
    <?php endwhile; ?>

  </div>
  <?php
  $total_pages = $wp_query->max_num_pages;
  if ($total_pages > 1) {
    $current_page = max(1, get_query_var('paged'));
    
    // URL base depends on permalink settings.
    $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

    $pagination = get_the_posts_pagination( array(
      'base' => get_pagenum_link(1) . '%_%',
      'format' => $format,
      'current' => $current_page,
      'total' => $total_pages,
      'mid_size' => 2,
      'prev_text' => __( '<', 'textdomain' ),
      'next_text' => __( '>', 'textdomain' ),
    ) ); 
    echo $pagination;
  }  ?>
<?php } ?>
