<?php
get_header();
pageBanner(array(
    'title' => 'All Programs',
    'subtitle' => 'There is somethig for everyone. Have a look around.'
))
?>



<div class="container container--narrow page-section">
<h2>All Programs</h2>
<ul class="link-list min-list">
    <?php
    while(have_posts()):
    the_post();?>

    <li><a href="<?php the_permalink(  ) ?>"><?php the_title() ?></a></li>

    <?php  
    endwhile;
echo paginate_links(); 
?>
</ul>


<?php
get_footer();
?>