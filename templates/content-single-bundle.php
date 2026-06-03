<?php while (have_posts()) : the_post(); ?>
  <main class="container py-12">
    <div class="max-w-5xl space-y-6">
      <?php $image = get_field('picture'); ?>
      <?php if($image) { ?>
        <div class="h-0 pt-[33.333%] relative">
          <?php echo wp_get_attachment_image( $image['id'], 'full', false, array('class' => 'w-full h-full object-cover absolute inset-0 z-0 rounded-md') ); ?>
        </div>
      <?php } ?>
      <h1 class="h2"><?php echo \Tofino\Helpers\title(); ?> Bundle</h1>

      <?php $intro = get_field('bundle_intro_content'); ?>
      <?php if($intro) { ?>
        <div class="rich-text text-lg child-links-blank">
          <?php echo $intro; ?>
        </div>
      <?php } ?>
    </div>

    <?php get_template_part('templates/partials/bundle/flexible-content'); ?>
  </main>
<?php endwhile; ?>
