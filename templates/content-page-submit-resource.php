<main class="content container mt-12 space-y-12">
   
  <h1 class="h2 text-center"><?php echo \Tofino\Helpers\title(); ?></h1>

  <?php if(is_user_logged_in()) { ?>
    <div class="max-w-4xl rounded-md bg-white mx-auto p-12">
      <?php acfe_form('submit-resource'); ?>
    </div>
  <?php } else { ?>
    <?php _e('Please <a href="' . get_the_permalink(39) . '">login</a>'); ?>
  <?php } ?>
</main>
