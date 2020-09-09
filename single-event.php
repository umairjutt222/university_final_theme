<?php
get_header();
while(have_posts()){
    the_post(  );
    pageBanner(array(
      'title' => 'This is a title',
      'subtitle' => 'This is a subtitle'
    ));
    ?>


  <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event');?>"><i class="fa fa-home" aria-hidden="true"></i> Events Home </a> <span class="metabox__main"><?php the_title(); ?></p>
     
    </div>


    <div class="generic-content">
    
      <?php the_content(); ?>
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