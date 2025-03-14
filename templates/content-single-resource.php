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
        <div class="content mt-8 child-links-blank">
          <?php the_content(); ?>
        </div>
      <?php } ?>

      <?php $files = get_field('files'); ?>
      <?php if($files) { ?>
        <div class="space-y-4">
          <?php foreach($files as $file) { ?>
            <div class="card p-4">
              <?php $file_url = wp_get_attachment_url($file['file']); ?>
              <?php if($file_url) { ?>
                <a href="<?php echo $file_url; ?>" class="flex items-center no-underline p-4" target="_blank">
                  <?php echo svg(['sprite' => 'document', 'class' => 'w-8 h-8']); ?>
                  <span>
                    Download <?php echo wp_check_filetype( $file_url)['ext']; ?> file
                  </span>
                </a>
                <hr/>
              <?php } ?>
              <?php $description = $file['description']; ?>
              <?php if($description) { ?>
                <div class="accordion">
                  <div class="accordion-header p-4">
                    <div class="content">
                      <?php echo wp_trim_words(strip_tags($description), 20); ?>
                    </div>
                    <?php if(substr_count(strip_tags($description), ' ') > 19) { ?>
                      <div class="flex pt-4">
                        <div>
                          <a class="font-bold btn btn-secondary space-x-2">
                            <span>Read More</span>
                            <span class="transition-all duration-300">
                              <?php echo svg(array(
                                'sprite' => 'chevron-down',
                                'class' =>  'w-6 h-6'
                              )); ?>
                            </span>
                          </a>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                  <div class="accordion-detail h-0 overflow-hidden transition-all duration-300">
                    <div class="p-6 content child-links-blank">
                      <?php echo $description; ?>
                    </div>
                  </div>
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
          1 => '<a href="https://creativecommons.org/licenses/by/4.0/deed.en" target="_blank">CC-BY</a>',
          2 => '<a href="https://creativecommons.org/licenses/by/4.0/deed.en" target="_blank">CC-BY-NC</a>',
          3 => 'All rights reserved'
        ); ?>
        <div>
          <?php echo '<em>License: ' . $license_map[$license] . '</em>';  ?>
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

      <?php $image_sources = get_field('image_source'); ?>
      <?php if($image_sources) { ?>
        <div class="flex space-x-2">
          <span>Image by</span>
          <?php foreach($image_sources as $source) { ?>
            <?php if($source['source_link']) { ?>
              <a href="<?php echo $source['source_link']; ?>" target="_blank">
            <?php } ?>
              <?php echo $source['source_name']; ?>
            <?php if($source['source_link']) { ?>
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
