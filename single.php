<?php
get_header();
while(have_posts(  )){
    the_post(  );
    pageBanner();
    ?>



  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('/blog') ?>"><i class="fa fa-home" aria-hidden="true"></i> Blog Home </a> <span class="metabox__main">Posted by <?php the_author_posts_link(); ?> on  <?php the_time('D, Y/d/m'); ?> <?php the_time('g:iA'); ?> in <?php echo get_the_category_list(', ') ?> Category</span></p>
    </div>
   
    <div class="generic-content">
    <?php 
    // add_image_size( 'single-post-thumbnail', 750, 400);
    // the_post_thumbnail( 'single-post-thumbnail' ); 
    
    // set_post_thumbnail_size( 450, 750);
    // the_post_thumbnail(); ?>
      <?php 
      the_content(); ?>
          </div>

  </div>

<?php   
}
get_footer(  );
?>