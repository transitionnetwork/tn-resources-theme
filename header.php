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

<?php
$locations = get_nav_menu_locations();
$menu = get_term( $locations['primary_navigation'], 'nav_menu' );
$menu_items = wp_get_nav_menu_items($menu);
$this_item = dx_get_current_nav_item();
?>

<header class="bg-white <?php echo m\menu_sticky(); ?>">
  <nav class="w-full flex justify-between lg:my-0 space-x-4 px-4">

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

    <div class="hidden space-x-2 lg:flex">
      <div class="flex items-center">
        <a href="<?php echo get_the_permalink( 37 ); ?>" class="btn btn-primary space-x-1">
          <?php echo svg(['sprite' => 'icon-plus', 'class' => 'text-white w-5 h-5']); ?>
          <span>Submit Resource</span>
        </a>
      </div>
      <div class="flex items-center">
        <label for="email" class="hidden text-sm/6 font-medium text-gray-900">Search</label>
        <div class="grid grid-cols-1">
          <input type="text" name="search" id="search" class="col-start-1 row-start-1 block w-full rounded-md bg-white py-2 pl-10 pr-3 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-brand sm:pl-9 sm:text-sm/6" placeholder="resources">
          
          <?php echo svg(['sprite' => 'icon-search', 'class' => 'pointer-events-none col-start-1 row-start-1 ml-3 size-5 self-center text-gray-400 sm:size-4']); ?>
        </div>
      </div>
      <div class="flex items-center">
        <a href="<?php echo get_the_permalink( 39 ); ?>" class="btn btn-secondary space-x-1">
          <?php echo svg(['sprite' => 'icon-arrow-right', 'class' => 'text-white size-5']); ?>
          <span>Login</span>
        </a>
      </div>
    </div>

    <button class="flex items-center lg:hidden js-menu-toggle z-50 mx-6" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <!-- Hamburger Icon -->
      <span class="size-6">
      <?php echo svg(['sprite' => 'icon-hamburger', 'class' => 'w-full h-full toggle-icons']); ?>
      <?php echo svg(['sprite' => 'icon-close', 'class' => 'w-full h-full hidden toggle-icons']); ?>
      </span>
      <span class="sr-only"><?php _e('Toggle Navigation Button', 'tofino'); ?></span>
    </button>


  </nav>
</header>

<?php if (get_theme_mod('footer_sticky') === 'enabled') : ?>
  <div class="wrapper">
<?php endif; ?>
