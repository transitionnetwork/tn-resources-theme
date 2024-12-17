<main class="content container mt-12">
   
  <h1 class="h2"><?php echo \Tofino\Helpers\title(); ?></h1>

  <?php if(is_user_logged_in()) { ?>
    <?php acfe_form('submit-resource'); ?>
  <?php } else { ?>
    <?php _e('Please <a href="' . get_the_permalink(39) . '">login</a>'); ?>
  <?php } ?>
</main>

