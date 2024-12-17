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
      <h2 class="h3">Local Resources</h2>

      Your Location is <span class="location-name"></span><br/>
      Your IP is <span class="location-ip"></span>

    
    </div>
  </div>
<?php } ?>
