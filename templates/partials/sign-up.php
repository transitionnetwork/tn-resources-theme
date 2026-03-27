<?php $sign_up = get_field('email_signup', 'options'); ?>
<?php if ($sign_up && $sign_up['title']) : ?>
  <div class="bg-brand py-16 relative overflow-hidden" id="subscribe">
    <div class="absolute right-30 -bottom-20">
      <img src="<?php echo get_template_directory_uri() . '/dist/img/yellow-fern.png'; ?>" alt="Yellow Fern" class="max-w-64">
    </div>
    <div class="container space-y-8 text-center relative">
      <h2 class="h1 text-brand-white"><?php echo $sign_up['title']; ?></h2>
      <div class="space-y-8 text-brand-white rich-text">
        <?php if ($sign_up['content']) : ?>
          <div class="text-xl"><?php echo $sign_up['content']; ?></div>
        <?php endif; ?>
        <?php if ($sign_up['form_code']) : ?>
          <div><?php echo $sign_up['form_code']; ?></div>
        <?php endif; ?>
        <?php if ($sign_up['subtext']) : ?>
          <div><?php echo $sign_up['subtext']; ?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <script>
  (function() {
    var signupRoot = document.querySelector('.gh-signup-root');
    if (!signupRoot) return;
    var previousHeight = 0;
    var conversionFired = false;
    var observer = new ResizeObserver(function() {
      if (conversionFired) return;
      var iframe = signupRoot.querySelector('iframe');
      if (!iframe) return;
      var newHeight = iframe.offsetHeight;
      if (newHeight > 50 && previousHeight <= 50) {
        conversionFired = true;
        gtag('event', 'conversion', {'send_to': 'AW-934395512/cC-CCM7UhI4cEPj8xr0D'});
      }
      previousHeight = newHeight;
    });
    observer.observe(signupRoot);
  })();
  </script>

<?php endif; ?>
