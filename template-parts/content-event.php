<div class="event-summary">
            <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
              <span class="event-summary__month"><?php 
              $meta_time = get_post_meta( get_the_ID(), '_event_date_meta_key', true );
              // $newDate = date("Ymd" ,strtotime($meta_time));
        
              $eventDate = new DateTime($meta_time);
              echo $eventDate->format('M');
              ?></span>
              <span class="event-summary__day"><?php echo $eventDate->format('d'); ?></span>
            </a>
            <div class="event-summary__content">
              <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink( ) ?>"><?php the_title() ?></a></h5>
              <!-- <p><?php //echo get_post_meta($post->ID, 'Mood', true); ?></p> -->
              <p><?php if(has_excerpt()){
                  the_excerpt(  );
                }else{
                  echo wp_trim_words( get_the_content(), 18);
                }
                ?> <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
            </div>
          </div>