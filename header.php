<?php
use \Tofino\ThemeOptions\Menu as m;
use \Tofino\ThemeOptions\Notifications as n; ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>

  <?php get_template_part('/templates/partials/favicon'); ?>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<?php n\notification('top'); ?>

<header class="bg-white <?php echo m\menu_sticky(); ?>">
  <nav class="w-full flex flex-wrap justify-between lg:my-0 px-4">

    <div class="flex space-x-0 lg:space-x-6">
      <div class="flex-shrink-0 flex items-center text-xl py-4 font-extrabold">
        <a href="<?php echo home_url(); ?>" class="no-underline">
          Transition Resources
        </a>
      </div>

      <div class="fixed inset-0 hidden w-full h-screen bg-white lg:h-auto lg:relative lg:w-auto lg:flex lg:items-center z-20" id="main-menu">
        <?php
        if (has_nav_menu('header_navigation')) :
          wp_nav_menu([
            'menu'            => 'nav_menu',
            'theme_location'  => 'header_navigation',
            'depth'           => 3,
            'container'       => '',
            'container_class' => '',
            'container_id'    => '',
            'menu_class'      => 'navbar-nav flex justify-center items-center w-full h-full lg:space-x-6 flex-col lg:flex-row text-center px-4 md:px-0',
            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
          ]);
        endif; ?>
      </div>
    </div>

    <button class="flex items-center lg:hidden js-menu-toggle z-50" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <!-- Hamburger Icon -->
      <span class="size-6">
      <?php echo svg(['sprite' => 'icon-hamburger', 'class' => 'w-full h-full toggle-icons']); ?>
      <?php echo svg(['sprite' => 'icon-close', 'class' => 'w-full h-full hidden toggle-icons']); ?>
      </span>
      <span class="sr-only"><?php _e('Toggle Navigation Button', 'tofino'); ?></span>
    </button>

    <div class="flex space-x-2 w-full lg:w-auto py-2">
      <div class="flex items-center">
        <a href="<?php echo get_the_permalink( 37 ); ?>" class="btn btn-primary space-x-1">
          <?php echo svg(['sprite' => 'icon-plus', 'class' => 'text-white w-5 h-5']); ?>
          <span>Submit Resource</span>
        </a>
      </div>
      <div class="hidden md:flex items-center">
        <label for="email" class="hidden text-sm/6 font-medium text-gray-900">Search</label>
        <form class="field-wrapper" action="<?php echo home_url(); ?>">
          <input type="text" name="s" id="search" class="field" placeholder="resources" value="<?php echo get_query_var('s'); ?>">
          <input type="hidden" name="post_type" value="resource" />
          
          <?php echo svg(['sprite' => 'icon-search', 'class' => 'pointer-events-none col-start-1 row-start-1 ml-3 size-5 self-center text-gray-400 sm:size-4']); ?>
        </form>
      </div>
      <div class="flex items-center">
        <?php if(!is_user_logged_in(  )) { ?>
          <a href="<?php echo do_shortcode('[openid_connect_generic_auth_url]'); ?>" class="btn btn-secondary space-x-1">
            <?php echo svg(['sprite' => 'icon-arrow-right', 'class' => 'text-white size-4']); ?>
            <span>Login with Transition ID</span>
          </a>
        <?php } else { ?>
          <a href="<?php echo wp_logout_url(); ?>" class="btn btn-secondary space-x-1">
            <?php echo svg(['sprite' => 'icon-arrow-right', 'class' => 'text-white size-4 rotate-180']); ?>
            <span>Logout</span>
          </a>
        <?php } ?>
      </div>
    </div>

  </nav>
</header>

<?php if (get_theme_mod('footer_sticky') === 'enabled') : ?>
  <div class="wrapper">
<?php endif; ?>
