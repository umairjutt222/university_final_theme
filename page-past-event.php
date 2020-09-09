<?php
get_header();
pageBanner(array(
  'title' => 'Past Events',
  'subtitle' => 'A recape of our past events.'
))
?>


<div class="container container--narrow page-section">
<h2>Past Events</h2>
  <?php

$pastEvents = new WP_Query(array(
  'paged' => get_query_var( 'paged', 1),
  'post_type' => 'event',
  'meta_key' => '_event_date_meta_key',
  // 'meta_value' => '',
  'orderby' => 'meta_value_num',
  'order' => 'ASC',
  'meta_query' => array(array(
    'key' => '_event_date_meta_key',
    'compare' => '<',
    'value' => date('Y-m-d'),
  ))
));

// $future = date('Ymd');
// $pastEvents = new WP_Query(array(
//     'paged' => get_query_var( 'paged', 1),
// //   'posts_per_page' => 1,
//   'post_type' => 'event',
//   'meta_key' => 'event_date',
//   'orderby' => 'meta_value_num',
//   'order' => 'ASC',
//   'meta_query' => array(array(
//     'key' => 'event_date',
//     'compare' => '<',
//     'value' => $future,
//     'type' => 'numeric'
//   ))
// ));

  while($pastEvents->have_posts()):
    $pastEvents->the_post();
    get_template_part('template-parts/content-event');

  endwhile;
  echo paginate_links(array(
    'total' => $pastEvents->max_num_pages
));
?>
</div>

<?php
get_footer();
?>