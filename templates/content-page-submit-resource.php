<?php
$user = wp_get_current_user(  );
$locale = get_user_meta( $user->ID, 'country_iso', true);
?>

<main class="rich-text container my-12 pb-12 space-y-12" data-geo="<?php echo ($locale) ? $locale : null; ?>">

  <h1 class="h2 text-center"><?php echo \Tofino\Helpers\title(); ?></h1>

  <?php if(is_user_logged_in()) { ?>
    <div class="max-w-4xl rounded-md bg-white mx-auto p-12">
      <?php
      acf_form([
        'id'                    => 'submit-resource',
        'post_id'               => 'new_post',
        'new_post'              => [
          'post_type'   => 'resource',
          'post_status' => 'draft',
          'post_author' => get_current_user_id(),
        ],
        'field_groups'          => ['group_resource'],
        'fields'                => false,
        'post_title'            => true,
        'post_content'          => false,
        'form'                  => true,
        'form_attributes'       => [
          'id'      => 'submit-resource-form',
          'class'   => 'space-y-6',
          'action'  => '',
          'method'  => 'post',
        ],
        'html_before_fields'    => '',
        'html_after_fields'     => '',
        'submit_value'          => __('Submit Resource', 'tofino'),
        'updated_message'       => __('Resource submitted successfully. Our team will review it shortly.', 'tofino'),
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'field_el'              => 'div',
        'uploader'              => 'basic',
        'honeypot'              => true,
        'html_updated_message'  => '<div id="message" class="updated"><p>%s</p></div>',
        'html_submit_button'    => '<input type="submit" class="tn-btn tn-btn-brand-v3" value="%s" />',
        'html_submit_spinner'   => '<span class="acf-spinner"></span>',
        'return'                => add_query_arg('submitted', 'true', get_permalink()),
        'kses'                  => true,
      ]);
      ?>
    </div>
  <?php } else { ?>
    <div class="space-y-6">
      <div class="rich-text">
        In order to submit a resource, please
      </div>
      <div>
        <a class="tn-btn tn-btn-brand-v3 space-x-2" href="<?php echo do_shortcode('[openid_connect_generic_auth_url]'); ?>">
         <?php echo svg(['sprite' => 'icon-arrow-right', 'class' => 'text-white size-4']); ?>
          <span>Login with Transition ID</span>
        </a>
      </div>
    </div>
  <?php } ?>
</main>

