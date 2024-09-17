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
  <nav class="w-full justify-between flex my-4 lg:my-0">
    <div class="flex-shrink-0 flex items-center mx-6">
      <a href="<?php echo home_url(); ?>">
        <?php echo svg(array('sprite' => 'logo', 'class' => 'w-24 h-8')); ?>
      </a>
    </div>

    <button class="flex items-center lg:hidden js-menu-toggle z-50 mx-6" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <!-- Hamburger Icon -->
      <span class="w-6 h-6">
        <?php echo svg(['sprite' => 'icon-hamburger', 'class' => 'w-full h-full toggle-icons']); ?>
        <?php echo svg(['sprite' => 'icon-close', 'class' => 'w-full h-full hidden toggle-icons']); ?>
      </span>
      <span class="sr-only"><?php _e('Toggle Navigation Button', 'tofino'); ?></span>

    </button>

    <div class="fixed inset-0 hidden w-full h-screen bg-white lg:h-auto lg:relative lg:w-auto lg:flex lg:items-center z-20" id="main-menu">
      <div class="whitespace-nowrap mr-12 hidden lg:block">
        <span class="text-sm">tel:</span>
        <span class="font-bold text-lg"><?php echo get_field('phone_number', 'options'); ?></span>
      </div>
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
  </nav>
</header>

<?php if (get_theme_mod('footer_sticky') === 'enabled') : ?>
  <div class="wrapper">
<?php endif; ?>
