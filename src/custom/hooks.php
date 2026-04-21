<?php
function after_login( $user_login, $user ) {
  if(!get_user_meta($user->ID, 'first_login')) {
    add_user_meta($user->ID, 'first_login', date('Y-m-d H:i:s'));
    wp_redirect(home_url('welcome'));
    exit;
  }
}
add_action('wp_login', 'after_login', 10, 2);

add_action('template_redirect', function () {
  if (is_page('submit-resource') && function_exists('acf_form_head')) {
    acf_form_head();
  }
});
