<div class="text-sm">
  <time class="uppercase tracking-widest" datetime="<?= get_the_time('c'); ?>"><?=  get_the_date(); ?></time>
  <p class="byline author vcard"><?= __('By', 'sage'); ?> <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?= get_the_author(); ?></a></p>
</div>
