<?php while (have_posts()) : the_post(); ?>
  <main class="container py-12">
    <div class="max-w-5xl space-y-6">
      <?php $image = get_field('picture'); ?>
      <?php if($image) { ?>
        <div class="h-0 pt-[33.333%] relative">
          <?php echo wp_get_attachment_image( $image['id'], 'full', false, array('class' => 'w-full h-full object-cover absolute inset-0 z-0 rounded-md') ); ?>
        </div>
      <?php } ?>
      <h1 class="h2">Bundle: <?php echo \Tofino\Helpers\title(); ?></h1>

      <?php if(get_post_field('post_content', $post)) { ?>
        <div class="rich-text mt-8 child-links-blank">
          <?php the_content(); ?>
        </div>
      <?php } ?>
    </div>

    <?php $resources = get_field('included_resources'); ?>
    <?php if($resources) { ?>
      <h2 class="h3 mt-12">Included Resources</h2>
      <div class="grid grid-cols-12 gap-6 my-6">
        <?php foreach($resources as $post) { ?>
          <?php get_template_part('templates/cards/resource'); ?>
        <?php } ?>
      </div>
    <?php } ?>
  </main>
<?php endwhile; ?>
