<div class="col-span-12 md:col-span-4">
  <div class="card">
    <div class="h-0 pt-2/3 relative">
      <div class="absolute inset-0 bg-gray-300"></div>
    </div>
    <div class="p-3">
      <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
      <p><?php the_excerpt(); ?></p>
      <a class="btn btn-tertiary block text-center" href="<?php the_permalink(); ?>">Read Guide</a>
    </div>
  </div>
</div>
