<?php
$user = wp_get_current_user(  );
$locale = get_user_meta( $user->ID, 'country_iso', true); 
?>

<main class="content container mt-12 space-y-12" data-geo="<?php echo ($locale) ? $locale : null; ?>">
   
  <h1 class="h2 text-center"><?php echo \Tofino\Helpers\title(); ?></h1>

  <?php if(is_user_logged_in()) { ?>
    <div class="max-w-4xl rounded-md bg-white mx-auto p-12">
      <?php acfe_form('submit-resource'); ?>
    </div>
  <?php } else { ?>
    Please
    <a href="<?php echo do_shortcode('[openid_connect_generic_auth_url]'); ?>">
     login
    </a>
  <?php } ?>
</main>

