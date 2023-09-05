<main class="mt-12">
  <div class="container">
    <div class="max-w-dirtxl mx-auto">
      <h1 class="text-center"><?php echo \Tofino\Helpers\title(); ?></h1>
      <?php if(have_posts()) { ?>
        <div class="divide-y divide-gray-100">
          <?php while (have_posts()) : the_post();
            get_template_part('templates/previews/post');
          endwhile; ?>
        </div>
      <?php } else { ?>
        <p>There are no posts!</p>
      <?php } ?>
    </div>
  </div>
</main>
