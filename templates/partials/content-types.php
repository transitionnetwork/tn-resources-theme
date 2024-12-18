<?php $terms = get_the_terms($post, 'content-type'); ?>
<?php if($terms) { ?>
  <div class="flex space-x-3 items-center">
    <?php foreach($terms as $term) { ?>
      <div><a class="no-underline flex items-center space-x-1 text-sm" href="<?php echo get_term_link($term); ?>"><img src="<?php echo get_field('term_icon', 'term_' . $term->term_id)['sizes']['thumbnail']; ?>" class="h-3 w-auto"><span><?php echo $term->name; ?></span></a></div>
    <?php } ?>
  </div>
<?php } ?>
