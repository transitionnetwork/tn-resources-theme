<main class="mt-12 container">
  <div class="mx-auto">
    <h1 class="h2"><?php echo \Tofino\Helpers\title(); ?></h1>
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
</main>
