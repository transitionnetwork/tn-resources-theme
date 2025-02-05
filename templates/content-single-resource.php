<?php while (have_posts()) : the_post(); ?>
  <main class="container py-12">
    <div class="max-w-5xl space-y-6">
      <?php $image = get_field('picture'); ?>
      <?php if($image) { ?>
        <div class="h-0 pt-1/3 relative">
          <?php echo wp_get_attachment_image( $image['id'], 'full', false, array('class' => 'w-full h-full object-cover absolute inset-0 z-0 rounded-md') ); ?>
        </div>
      <?php } ?>
      <h1 class="h2 mb-2"><?php echo \Tofino\Helpers\title(); ?></h1>
      <div class="mt-4">
        <?php get_template_part('templates/partials/content-types'); ?>
      </div>
  
      <?php if(get_post_field('post_content', $post)) { ?>
        <div class="content mt-8">
          <?php the_content(); ?>
        </div>
      <?php } ?>

      <?php $files = get_field('files'); ?>
      <?php if($files) { ?>
        <div class="space-y-4">
          <?php foreach($files as $file) { ?>
            <div class="card p-4 space-y-4">
              <?php $file_url = wp_get_attachment_url($file['file']); ?>
              <?php if($file_url) { ?>
                <a href="<?php echo $file_url; ?>" class="flex items-center no-underline" target="_blank">
                  <?php echo svg(['sprite' => 'document', 'class' => 'w-8 h-8']); ?>
                  <span>
                    Download <?php echo wp_check_filetype( $file_url)['ext']; ?> file
                  </span>
                </a>
                <hr/>
              <?php } ?>
              <?php $description = $file['description']; ?>
              <?php if($description) { ?>
                <div class="content">
                  <?php echo $description; ?>
                </div>
              <?php } ?>
            </div>
          <?php } ?>
        </div>
      <?php } ?>

      <?php $embed = get_field('embed'); ?>
      <?php if($embed) { ?>
        <div class="space-y-12">
          <?php foreach($embed as $item) { ?>
            <div class="embed-item">
              <?php echo $item['embed'] ?>
            </div>
          <?php } ?>
        </div>
      <?php } ?>

      <?php $license = get_field('license'); ?>
      <?php if($license) { ?>
        <?php $license_map = array(
          1 => 'CC-BY',
          2 => 'CC-BY-NC',
          3 => 'All rights reserved'
        ); ?>
        <div>
          <?php echo '<em>License: ' . $license_map[$license] . '</em>';  ?>
        </div>
      <?php } ?>
      
      <?php $identify_author = get_field('author_select'); ?>
      <?php if($identify_author) { ?>
        <?php $author_map = array(
          1 => 'I wrote this',
          2 => 'Someone else wrote this'
        ); ?>
        <div>
          <?php echo $author_map[$identify_author] ?>
        </div>
      <?php } ?>

      <?php $authors = get_field('authors'); ?>
      <?php if($authors) { ?>
        <div class="flex space-x-2">
          <span>Written by</span>
          <?php foreach($authors as $author) { ?>
            <?php if($author['author_link']) { ?>
              <a href="<?php echo $author['author_link']; ?>" target="_blank">
            <?php } ?>
              <?php echo $author['author_name']; ?>
            <?php if($author['author_link']) { ?>
              </a>
            <?php } ?>
          <?php } ?>
        </div>
      <?php } ?>

      <?php $locale = get_the_terms( $post, 'country' ); ?>

      <?php $related = get_field('related'); ?>
      <?php if($related) { ?>
        <div>
          <h2 class="h3">Related Resources</h2>
          <div class="grid grid-cols-12 gap-6 my-6">
            <?php foreach($related as $post) { ?>
              <?php setup_postdata( $post ); ?>
              <?php get_template_part('templates/cards/resource'); ?>
            <?php } ?>
            <?php wp_reset_postdata(); ?>
          <?php ?>
        </div>
      <?php } ?>

    </div>
  </main>

<?php endwhile; ?>
