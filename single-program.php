<?php
get_header();
while(have_posts(  )){
    the_post();
    
    pageBanner();
    ?>



    <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program');?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs </a> <span class="metabox__main"><?php the_title(); ?></p>
      
    </div>

    <div class="generic-content">
     <?php the_content(); ?>
      <?php
      $professors =   get_post_meta(get_the_ID(), '_related_professor_meta_key', true);
     

      // var_dump($professors);
          //   $relatedProfessor = new WP_Query(array(
          //   'posts_per_page' => -1,
          //   'post_type' => 'professor',
          //   'orderby' => 'title',
          //   'order' => 'ASC',
          //   'meta_query' => array(array(
          //       'key' => 'related_programs',
          //       'compare' => 'LIKE',
          //       'value' => '"'. get_the_ID() .'"'
          //   ))
          // ));

          //  if($relatedProfessor->have_posts()){
            if($professors){
            echo '<hr class="section-break">';
            echo '<h3 class="headline headline--medium "> '. get_the_title() .' Professors</h3>';
            echo '<ul class="link-list min-list">';


            echo '<ul class="professor-cards">';
            foreach($professors as $professor):
            // while($relatedProfessor->have_posts()) :
            //     $relatedProfessor->the_post(); 
            
            ?>

           
            <li><a href="<?php echo get_the_permalink( $professor);?>"><?php echo get_the_title($professor); ?></a></li>
            
             
                <?php endforeach;
                // echo '</ul>';
                echo '</ul>';
            }
           } 
           
        wp_reset_postdata();
        $future = date('Ymd');
          $myEvents = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => 'event',
            'meta_key' => 'event_date',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(array(
              'key' => 'event_date',
              'compare' => '>=',
              'value' => $future,
              'type' => 'numeric'
            ),array(
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => '"'. get_the_ID() .'"'
            ))
          ));

           if($myEvents->have_posts()){
            echo '<hr class="section-break">';
            echo '<h3 class="headline headline--medium"> Upcoming '. get_the_title() .' Events</h3>';
            while($myEvents->have_posts()) :
              $myEvents->the_post(); 
            get_template_part('template-parts/content-event');
            endwhile;
           } 
           ?>
        </div>
  </div>

<?php   

get_footer(  );
?>