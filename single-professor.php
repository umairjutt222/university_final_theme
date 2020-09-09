<?php
get_header();
while(have_posts(  )){
    the_post(  );
    
    // function for page Banner
    pageBanner();
    ?>



<div class="container container--narrow page-section">
    <div class="generic-content">
        <div class="row group">
          <div class="one-third">
            <?php the_post_thumbnail('professorPortrait'); ?>
          </div>
          <div class="two-third">
            <?php the_content(); ?>
          </div>
        </div>
    </div>
    <?php  

$related_Subject =   get_post_meta(get_the_ID(), '_related_subject_meta_key', true);
if($related_Subject){
  echo '<hr class="section-break">';
  echo '<h3 class="headline headline--medium">Related Program(s)</h3>';
  echo '<ul class="link-list min-list">';
  foreach($related_Subject as $program): ?>
   <li><a href="<?php 
   echo get_the_permalink( $program);
   ?>"><?php echo get_the_title($program); ?></a></li>
   <?php endforeach; 
  echo '</ul>';
}
  ?>
</div>
<?php   
}
get_footer();
?>