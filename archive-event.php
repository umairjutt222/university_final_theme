<?php
get_header();
pageBanner(array(
  'title' => 'All Events',
  'subtitle' => 'See what is going on in our world.'
));

?>



<div class="container container--narrow page-section">
<h2>All Upcoming Events </h2>
  <?php

$myEvents = new WP_Query(array(
  'posts_per_page' => -1,
  'post_type' => 'event',
  'meta_key' => '_event_date_meta_key',
  // 'meta_value' => '',
  'orderby' => 'meta_value_num',
  'order' => 'ASC',
  'meta_query' => array(array(
    'key' => '_event_date_meta_key',
    'compare' => '>=',
    'value' => date('Y-m-d'),
  ))
));

  while($myEvents->have_posts()):
    $myEvents->the_post();
    get_template_part('template-parts/content-event');
    
  endwhile;
echo paginate_links(); 
wp_reset_postdata();
?>
<hr class="section-break">
<p>Looking for a recap of past event? <a href="<?php echo site_url('/past-event'); ?>">Check out our past events archive</a>.</p>
</div>

<?php
get_footer();
?>