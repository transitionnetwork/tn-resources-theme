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

      Your country is <span class="location-name"></span><br/>
      Your region is <span class="location-region"></span><br/>
      Your continent is <span class="location-continent"></span><br/>
      The main language spoken is <span class="location-lang"></span><br/>
      Your IP is <span class="location-ip"></span>
    </div>
  </div>
<?php } ?>
