  <?php $nav_items = xinc_get_embed_nav_items(); ?>

  <form class="flex justify-center my-6">
    <select name="" id="" onChange="window.open(this.value, '_blank')">
      <option value="">Main Menu</option>
      <?php foreach($nav_items as $key => $item) { ?>
        <option value="<?php echo home_url($key); ?>"><?php echo $item; ?></option>
      <?php } ?>
    </select>
  </form>
