<?php 
//THIS NEEDS TO BE AJAX
$args = array(
  'post_type' => 'resource',
  'posts_per_page' => 3,
); ?>

<?php $posts = get_posts($args); ?>

<?php if($posts) { ?>
  <div id="geolocated-content" class="bg-gray-200 py-12">
    <div class="container">
      <h2 class="h3">Local Resources for <span class="location-name"></span></h2>

      <!-- <div>
        Your country is <span class="location-name"></span> in <span class="location-region"></span> in <span class="location-continent"></span>. The main language spoken is <span class="location-lang"></span>. Your IP is <span class="location-ip"></span>
      </div> -->

      <div id="local-resources-grid" class="grid grid-cols-12 gap-6 my-12">
      </div>

      <a href="" class="location-link flex space-x-2 items-center justify-center no-underline hover:underline">
        <div>View all resources for  <span class="location-name"></span></div>
        <span>
          <?php echo svg(['sprite' => 'icon-arrow-right', 'class' => 'text-black size-4']); ?>
        </span>
      </a>
    </div>
  </div>
<?php } ?>
