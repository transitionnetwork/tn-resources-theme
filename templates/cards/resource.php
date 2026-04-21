<div class="col-span-12 lg:col-span-4 flex">
  <div class="tn-card items-stretch flex flex-col">
    <?php $image_url = xinc_get_resource_image_url($post); ?>
    <div class="h-0 pt-[66.667%] relative">
      <a href="<?php the_permalink(); ?>">
        <?php if ($image_url) { ?>
          <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover absolute inset-0 z-0" />
        <?php } else { ?>
          <div class="absolute inset-0 bg-gray-300"></div>
        <?php } ?>
      </a>
    </div>
    <div class="p-6 space-y-6 flex flex-col justify-between grow">
      <div class="space-y-4">
        <?php get_template_part('templates/partials/content-types'); ?>
        <h3 class="h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <div>
          <?php echo xinc_preview_content($post); ?>
        </div>
      </div>
      <a class="tn-btn tn-btn-brand-v3 block text-center" href="<?php the_permalink(); ?>">Read</a>
    </div>
  </div>
</div>
