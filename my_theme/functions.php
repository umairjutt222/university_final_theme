<?php
function university_files(){
    wp_enqueue_script('main-js-file', get_theme_file_uri( '/js/scripts-bundled.js' ), NULL, microtime(), true);
    wp_enqueue_style( 'custom-google-font', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style( 'my-theme-style', get_stylesheet_uri(),array(),'1.1');
}
add_action('wp_head', 'university_files');

function university_feature(){
    // register_nav_menu( 'headerMenuLocation','Header Menu Location');
    // register_nav_menu( 'footerLocationOne','Footer Location One');
    // register_nav_menu( 'footerLocationTwo','Footer Location Two'); 

    add_theme_support('title-tag');
}

//add custom title to every page
add_action('after_setup_theme', 'university_feature'); 

function university_event_menu(){
    register_post_type( 'event', array(
        'supports' => array('title', 'editor', 'excerpt'),
        'rewrite' => array('slug' => 'events'),
        'has_archive' => true,
        'public' => true,
        'menu_icon' => 'dashicons-megaphone',
        'labels' => array(
            'name'=> 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event'
        )
    ) );
}

add_action('init','university_event_menu');

//WP login page error message
function no_wordpress_errors(){
    return 'Something went wrong!';
    }
add_filter( 'login_errors', 'no_wordpress_errors' );