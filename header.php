<!DOCTYPE html>
  <html <?php language_attributes() ?>>
    <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php wp_head();?>
    </head>
    <body <?php body_class(); ?>>

    <header class="site-header">
      <div class="container">
        <h1 class="school-logo-text float-left">
          <a href="<?php echo site_url(); ?>"><strong><?php bloginfo( 'name' ) ?></strong> University</a>
        </h1>
        <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
        <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
        <div class="site-header__menu group">
          <nav class="main-navigation">
          <?php 
          // wp_nav_menu(array(
          //   'theme_location' => 'headerMenuLocation'
          // ));
?> 
            <ul>
              <li <?php if(is_page('about-us') OR wp_get_post_parent_id(0) == 22) echo 'class="current-menu-item"'; ?>><a href="<?php echo site_url('/about-us' ); ?>">About Us</a></li>
              <li <?php if(get_post_type() == 'program') echo 'class="current-menu-item"'; ?>><a href="<?php echo get_post_type_archive_link('program'); ?>">Programs</a></li>
              <li <?php if(get_post_type()=='event' OR is_page('past-event')) echo 'class="current-menu-item"'; ?>><a href="<?php echo get_post_type_archive_link( 'event'); ?>">Events</a></li>
              <li><a href="#">Campuses</a></li>
              <li <?php if(get_post_type() == 'post') echo 'class="current-menu-item"'; ?>><a href="<?php echo site_url('/blog'); ?>">Blog</a></li>
            </ul>
          </nav>
<?php          if ( is_user_logged_in() ){ ?>
            <div class="site-header__util">
            <a href="<?php echo site_url('/profile'); ?>" class="btn btn--small btn--orange float-left push-right">My Account</a>
            <a href="<?php echo site_url('/edit-profile'); ?>" class="btn btn--small btn--dark-orange float-left">Edit Profile</a>
            </div>
<?php          } else{ ?>
            <div class="site-header__util">
            <a href="<?php echo site_url('/login'); ?>" class="btn btn--small btn--orange float-left push-right ">Login</a>
            <a href="<?php echo site_url('/sign-up'); ?>" class="btn btn--small btn--dark-orange float-left">Sign Up</a>
            <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
          </div>
<?php          } ?>
          
        </div>
      </div>
    </header>


    


