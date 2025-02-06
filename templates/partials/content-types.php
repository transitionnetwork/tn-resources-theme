<div class="flex items-center flex-wrap">
  <?php $terms = get_the_terms($post, 'resource-type'); ?>
  <?php foreach($terms as $term) { ?>
    <div class="pr-2">
      <a class="no-underline flex items-center space-x-1 text-sm" href="<?php echo get_term_link($term); ?>">
        <?php if(get_field('term_icon', 'term_' .   $term->term_id)) { ?>
          <img src="<?php echo get_field('term_icon', 'term_' . $term->term_id)['sizes']['thumbnail']; ?>" class="h-3 w-auto">
        <?php } ?>
        <span><?php echo $term->name; ?></span>
      </a>
    </div>
  <?php } ?>
  
  <?php $terms = get_the_terms($post, 'project-type'); ?>
  <?php foreach($terms as $term) { ?>
    <div class="pr-2">
      <a class="no-underline flex items-center space-x-1 text-sm" href="<?php echo get_term_link($term); ?>">
        <?php if(get_field('term_icon', 'term_' .   $term->term_id)) { ?>
          <img src="<?php echo get_field('term_icon', 'term_' .   $term->term_id)['sizes']['thumbnail']; ?>" class="h-3 w-auto">
        <?php } ?>
        <span><?php echo $term->name; ?></span>
      </a>
    </div>
  <?php } ?>

  <?php $countries = get_the_terms($post, 'country'); ?>
  <?php if($countries) { ?>
    <?php foreach($countries as $country) { ?>
      <div>
        <a class="no-underline flex items-center space-x-1 text-sm" href="<?php echo get_term_link($country); ?>">
          <?php if(get_field('term_icon', 'term_' .   $term->term_id)) { ?>
            <img src="https://flagsapi.com/<?php echo strtoupper($country->slug); ?>/flat/64.png" class="h-3 w-auto">
          <?php } ?>
          <span><?php echo $country->name; ?></span>
        </a>
      </div>
    <?php } ?>
  <?php } ?>
</div>
