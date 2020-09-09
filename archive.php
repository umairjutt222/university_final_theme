<?php
get_header();
pageBanner(array(
  'title' => get_the_archive_title(),
  'subtitle' => get_the_archive_description()
))
?>

<div class="container container--narrow page-section">
  <?php
  while(have_posts(  )):
    the_post(  );
    ?>
    <div class="post-item">
        <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <div class="metabox">
        <p>Posted by <?php the_author_posts_link(); ?> on  <?php the_time('D, Y/d/m'); ?> <?php the_time('g:iA'); ?> in <?php echo get_the_category_list(', ') ?> Category</p>
      </div>
      <div class="generic-content">
      <?php the_excerpt(); ?>
        <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Read Full Post &raquo;</a></p>
      </div>

    </div>
<?php  
  endwhile;
echo paginate_links();
?>
</div>

<?php
get_footer();
?>