<?php $args['post_type'] = 'resource'; ?>

<?php $posts = get_posts($args); ?>

<?php if($posts) { ?>
  <div class="bg-gray-200 py-12">
    <div class="container">
      <h2 class="h3">Featured Resources</h2>
      <div class="grid grid-cols-12 gap-6 my-12">
        <?php foreach($posts as $post) { ?>
          <?php setup_postdata( $post ); ?>
          <?php get_template_part('templates/cards/resource'); ?>
        <?php } ?>
        <?php wp_reset_postdata(  ); ?>
      </div>
    </div>
  </div>
<?php } ?>
