<?php
use \Tofino\ThemeOptions\Notifications as n;

if (get_theme_mod('footer_sticky') === 'enabled') : ?>
  </div>
<?php endif; ?>

<footer>
  <div class="container py-5 text-center">
    <?php if(get_field('footer_text', 'options')) { ?>
      <?php $content = str_replace('#year#', date('Y'), get_field('footer_text', 'options')); ?>
      <?php echo $content; ?>
    <?php } ?>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

<?php wp_footer(); ?>

<?php n\notification('bottom'); ?>

</body>
</html>
