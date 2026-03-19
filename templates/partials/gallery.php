<?php $gallery = get_field('gallery'); ?>
<?php if($gallery) { ?>
  <div class="container">
    <div class="flex flex-wrap my-12">
      <?php foreach($gallery as $item) { ?>
        <div class="w-full md:w-1/2 lg:w-1/4">
          <a href="<?php echo $item['url']; ?>" data-fancybox="gallery" class="block relative m-3 h-0 pt-[100%] shadow-md rounded-lg overflow-hidden">
            <img src="<?php echo $item['sizes']['thumbnail']; ?>" alt="<?php echo $item['alt']; ?>" title="<?php echo $item['title']; ?>" class="absolute object-cover inset-0 w-full h-full">
            <div class="absolute inset-0 bg-brand/0 hover:bg-brand/40 transition duration-100"></div>
          </a>
        </div>
      <?php } ?>
    </div>
  </div>
<?php } ?>
