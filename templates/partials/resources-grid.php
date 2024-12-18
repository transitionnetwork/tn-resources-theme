<?php $args['post_type'] = 'resource'; ?>

<?php $posts = get_posts($args); ?>

<?php if($posts) { ?>
  <div class="grid grid-cols-12 gap-6 my-12">
    <?php foreach($posts as $post) { ?>
      <?php setup_postdata( $post ); ?>
      <?php get_template_part('templates/cards/resource'); ?>
    <?php } ?>
    <?php wp_reset_postdata(  ); ?>
  </div>
<?php } ?>
