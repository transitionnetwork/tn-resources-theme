<div class="col-span-12 lg:col-span-4 flex">
  <div class="tn-card items-stretch flex flex-col">
    <?php $image = get_field('picture', $post); ?>
    <?php $embed = get_field('embed', $post); ?>
    <div class="h-0 pt-[66.667%] relative">
      <a href="<?php the_permalink(); ?>">
        <?php if($image) { ?>
          <?php echo wp_get_attachment_image( $image['id'], 'full', false, array('class' => 'w-full h-full object-cover absolute inset-0 z-0') ); ?>
        <?php } else if($embed && is_array($embed)) { ?>
          <?php
          preg_match('/src="(.+?)"/', $embed[0]['embed'], $matches);
          $src = $matches[1] ?? '';
          $youtube_id = null;
          if ($src && strpos($src, 'youtube.com') !== false) {
            preg_match('#/embed/([A-Za-z0-9_-]{11})#', $src, $yt);
            $youtube_id = $yt[1] ?? null;
          }
          ?>
          <?php if ($youtube_id) { ?>
            <img src="https://img.youtube.com/vi/<?php echo esc_attr($youtube_id); ?>/hqdefault.jpg" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover absolute inset-0 z-0" />
          <?php } else { ?>
            <div class="absolute inset-0 bg-gray-300"></div>
          <?php } ?>
        <?php } else { ?>
          <div class="absolute inset-0 bg-gray-300"></div>
        <?php } ?>
      </a>
    </div>
    <div class="p-6 space-y-6 flex flex-col justify-between grow">
      <div class="space-y-4">
        <?php get_template_part('templates/partials/content-types'); ?>
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <div>
          <?php echo xinc_preview_content($post); ?>
        </div>
      </div>
      <a class="tn-btn tn-btn-brand-v3 block text-center" href="<?php the_permalink(); ?>">Read</a>
    </div>
  </div>
</div>
