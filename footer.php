<?php
use \Tofino\ThemeOptions\Notifications as n;

if (get_theme_mod('footer_sticky') === 'enabled') : ?>
  </div>
<?php endif; ?>

<footer class="bg-black pb-6">
  <div class="bg-container py-5 text-center text-white space-y-2">
    <div class="flex justify-center space-x-2">
      <div>
        <?php $address = get_field('address', 'options'); ?>
        <?php $address = str_replace('<br />',', ', $address);  ?>
        <?php echo $address; ?>
      </div>
      <div>
        <?php echo get_field('phone_number', 'options'); ?>
      </div>
    </div>
    <?php if(get_field('footer_text', 'options')) { ?>
      <?php $content = str_replace('#year#', date('Y'), get_field('footer_text', 'options')); ?>
      <div>
        <?php echo $content; ?>
      </div>
    <?php } ?>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

<?php wp_footer(); ?>

<?php n\notification('bottom'); ?>

</body>
</html>
