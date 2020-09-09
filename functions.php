<?php

function pageBanner($args = NULL){
    // php logic will live here
    if(!$args['title']){
        $args['title'] = get_the_title();
    }
    if(!$args['subtitle']){
        $pageBanner = get_post_meta( get_the_ID(), '_page_banner_meta_key', true );
        if($pageBanner){
            $args['subtitle'] = get_post_meta( get_the_ID(), '_page_banner_meta_key', true );
        }
        // if(get_field('page_banner_subtitle')){
        //     $args['subtitle'] = get_field('page_banner_subtitle');
        // }
        else{
            $args['subtitle'] = 'When you enter this loving University, consider yourself one of the special member of an extraordinary family.';
        }
    }
    if(!$args['photo']){
        // if(get_field('page_banner_background_image')){
        //     $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
        // }else{
            $args['photo'] = 'https://source.unsplash.com/1500x350/?study';
            // $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
        // }
    }

?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>);"></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
      <div class="page-banner__intro">
        <p> <?php echo $args['subtitle']; ?></p>
      </div>
    </div>  
</div>

<?php
}

function university_files(){
    wp_enqueue_script('main-js-file', get_theme_file_uri( '/js/scripts-bundled.js' ), NULL, microtime(), true);
    wp_enqueue_style( 'custom-google-font', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style( 'my-theme-style', get_stylesheet_uri(),array(),'1.1');
}
add_action('wp_head', 'university_files');

function university_feature(){
    register_nav_menu( 'headerMenuLocation','Header Menu Location');
    register_nav_menu( 'footerLocationOne','Footer Location One');
    register_nav_menu( 'footerLocationTwo','Footer Location Two'); 
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('professorLandscape',400, 260, true);
    add_image_size('professorPortrait',480, 650, true);
    add_image_size('pageBanner',1500, 350, true);
}

//add custom title to every page
add_action('after_setup_theme', 'university_feature'); 

function university_event_menu(){
    //Event Post Type
    // register_post_type('event', array(
    //     'supports' => array('title','editor','excerpt'),
    //     'rewrite' => array('slug' => 'events'),
    //     'has_archive' => true,
    //     'public' => true,
    //     'menu_icon' => 'dashicons-megaphone',
    //     'labels' => array(
    //         'name' => 'Events',
    //         'add_new_item' => 'Add New Event',
    //         'edit_item' => 'Edit Event',
    //         'all_items' => 'All Events',
    //         'singular_name' => 'Event'
    //     )
    // ));
    // Program Post Type 
    // register_post_type('program', array(
    //     'supports' => array('title','editor'),
    //     'rewrite' => array('slug' => 'programs'),
    //     'has_archive' => true,
    //     'public' => true,
    //     'menu_icon' => 'dashicons-welcome-learn-more',
    //     'labels' => array(
    //         'name' => 'Programs',
    //         'add_new_item' => 'Add New Program',
    //         'edit_item' => 'Edit Program',
    //         'all_items' => 'All Programs',
    //         'singular_name' => 'Program',
    //         'search_items' => 'Search Program',
    //         'not_found' => 'No Subject Found'
    //     )
    // ));

     // Professor Post Type 
    //  register_post_type('professor', array(
    //     'supports' => array('title','editor', 'thumbnail'),
    //     'public' => true,
    //     'menu_icon' => 'dashicons-businessperson',
    //     'labels' => array(
    //         'name' => 'Professors',
    //         'add_new_item' => 'Add New Professor',
    //         'edit_item' => 'Edit Professor',
    //         'all_items' => 'All Professors',
    //         'singular_name' => 'Professor',
    //         'search_items' => 'Search Professor',
    //         'not_found' => 'No Professor Found'
    //     )
    // ));

}

add_theme_support( 'post-thumbnails' );
add_action('init','university_event_menu');


function theme_adjust_query($query){
    if(!is_admin() AND is_post_type_archive( 'program' ) AND $query->is_main_query()){
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }
    if(!is_admin() AND is_post_type_archive( 'event' ) AND $query->is_main_query()){
        $future = date('Ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(array(
            'key' => 'event_date',
            'compare' => '>=',
            'value' => $future,
            'type' => 'numeric'
          )));
    }
}



add_action('pre_get_posts', 'theme_adjust_query');

//WP login page error message
function no_wordpress_errors(){
    return 'Are you Umair????';
    }
add_filter( 'login_errors', 'no_wordpress_errors' );


add_filter( 'registration_redirect', 'my_redirect_home' );
function my_redirect_home( $registration_redirect ) {
    return home_url();
}
// add_filter('wp_login', 'login_redirect');
// function login_redirect($redirect_to) {
//     wp_redirect( home_url() );
//     exit();
// }
// if(isset($_POST['username'])){
//     global $wpdb;
//     $data_array = array(
//         'user_Name' => $_POST['username'],
//         'email' => $_POST['email'],
//         'password' => $_POST['password'],
//         'password_check' => $_POST['password2']
//     );
//     $table_name = 'wp_users';
//     $rowResult =  $wpdb->insert($table_name, $data_array, $format=NULL);

//     if($rowResult == 1){
//         echo json_encode(array('message'=> '<h3>Form Submitted Successfully</h3>', 'status' => 1));
//     }else{
//         echo json_encode(array('message'=> '<h3>Error in form submission</h3>', 'status' => 0));

//         // echo '<h3>Error in form submission</h3>';
//     }
// }

add_action('wp_ajax_register_applicant','form_submit_callback');
add_action('wp_ajax_nopriv_register_applicant','form_submit_callback');
function form_submit_callback(){
    // print_r($_POST['form_data']);
    // $_POST['form_data'].unserialize();
    
    // print_r($_POST['form_data']);
    // echo $_POST['username'];
    // $username = $_POST['form_data'];
    // $newData = array();
    // // $userArray = array();
    // // $userData = parse_str( $_POST['form_data'], $userData[] );
    // $userData = explode('=', $username);
    // $userData = explode('&', $username);
    // foreach($userData as $data){
    //     $separated = explode( "=", $data );
    //     array_push( $newData, array(
    //         'username' => $separated[0],
    //         'email'  => $separated[1],
    //         'password' => $separated[2]
    //     ) );
        
    // }
    
    // var_dump($newData);
    
    // var_dump($newData);
    // $json = file_get_contents('php://input');
    // $my_post = json_decode($json);
    // $my_value = $my_post['username'];
    // wp_insert_user( $_POST['form_data']);
    // wp_create_user
    // echo $_POST['form_data']['username'] . "\n";
    // echo $_POST['form_data']
  


        // check_ajax_referer( 'ajax-register-nonce', 'security' );
		
    // // Nonce is checked, get the POST data and sign user on
    // $info = array();
  	// $info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user($_POST['username']) ;
    // $info['user_pass'] = sanitize_text_field($_POST['password']);
	// $info['user_email'] = sanitize_email( $_POST['email']);
	
	// // Register the user
    // $user_register = wp_insert_user( $info );
 	// if ( is_wp_error($user_register) ){	
	// 	$error  = $user_register->get_error_codes()	;
		
	// 	if(in_array('empty_user_login', $error))
	// 		echo json_encode(array('loggedin'=>false, 'message'=>__($user_register->get_error_message('empty_user_login'))));
	// 	elseif(in_array('existing_user_login',$error))
	// 		echo json_encode(array('loggedin'=>false, 'message'=>__('This username is already registered.')));
	// 	elseif(in_array('existing_user_email',$error))
    //     echo json_encode(array('loggedin'=>false, 'message'=>__('This email address is already registered.')));
    // } else {
	//   auth_user_login($info['nickname'], $info['user_pass'], 'Registration');       
    // }
 
    // die();

    if ( ! isset( $_POST['name_of_nonce_field'] ) || ! wp_verify_nonce( $_POST['name_of_nonce_field'], 'register_applicant_nonce') 
    ) {
        exit('The form is not valid');
    }



global $wpdb;
 if($_POST){
    $firstName = $wpdb->escape($_POST['first_name']);
    $lastName = $wpdb->escape($_POST['last_name']);
    $email = $wpdb->escape($_POST['email']);
    $password = $wpdb->escape($_POST['password']);
    $confPassword = $wpdb->escape($_POST['password2']);


        // wp_insert_user( $userName, $password, $email );
        // wp_insert_user( $_POST['data']);
        $userdata = array(
            'user_login'    =>  $firstName,
            'user_email'    =>  $email,
            'user_pass'     =>  $password,
            'first_name'    =>  $firstName,
            'last_name'     =>  $lastName,
            'nickname'      =>  $firstName
            );
            // $user = wp_insert_user( $userdata );
            if(wp_insert_user( $userdata )){
                echo 'User register successfully'; 
                
                
            }else{
                echo ' Error in form submission ';
                print_r($error);
            }
        
}

// $info = array();
// $info['username'] = $_POST['username'];
// $info['email'] = $_POST['email'];
// $info['password'] = $_POST['password'];
// var_dump($info);
// $user_signon = wp_signon( $info, false );
// if ( is_wp_error($user_signon) ){
// echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
// } else {
// echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...')));
// }

die();
// add_action('wp_enqueue_scripts', 'enqueue_jquery_form');
// function enqueue_jquery_form(){
//     wp_enqueue_script('jquery-form');
// }
// add_action('wp_ajax_register_applicant', 'register_applicant');
// function register_applicant(){
//     // wp_send_json_success($_POST);
//     // print_r($_POST['data']);
//     // echo $_POST['data']['username'] . "\n";
//     // // wp_insert_user( $_POST['data']);
//     // die();


// //     global $wpdb;

// // $userName = sanitize_text_field($_POST["username"]);
// // $email = sanitize_text_field($_POST["email"]);
// // $password = md5($_POST["password"]);


// $info = array();
// $info['username'] = $_POST['username'];
// $info['email'] = $_POST['email'];
// $info['password'] = $_POST['password'];

// $user_signon = wp_signon( $info, false );
// if ( is_wp_error($user_signon) ){
// echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
// } else {
// echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...')));
// }
}//form_submit_callback function end her


// add_action('wp_ajax_login_applicant','login_submit_callback');
// add_action('wp_ajax_nopriv_login_applicant','login_submit_callback');
// function login_submit_callback(){
//     if ( ! isset( $_POST['name_of_nonce_field'] ) || ! wp_verify_nonce( $_POST['name_of_nonce_field'], 'login_applicant_nonce') 
//     ) {
//         exit('The form is not valid');
//     }
//     // check_ajax_referer(  'login_applicant_nonce', 'name_of_nonce_field'  );
//     // var_dump($_POST);
//     $info = array();
//     $info['user_login'] = $_POST['user_name'];
//     $info['user_password'] = $_POST['password'];
//     $info['remember'] = true;

// $user_signon = wp_signon( $info, false );
// if ( is_wp_error( $user_signon )) {
//     echo 'User login successfull!';
//     echo json_encode( array( 'loggedin'=>false, 'message'=>__( 'Wrong username or password!' )));
// } else {
//     echo json_encode( array( 'loggedin'=>true, 'message'=>__('Login successful, redirecting...' )));
// }

// die();
// }
    // global $wpdb;
    // if($_POST){
    //     $email = $wpdb->escape($_POST['email']);
    //     $password = $wpdb->escape($_POST['password']);
    //     if(wp_login($email, $password)){
    //         echo 'User login successfull!';
    //         echo json_encode(array('loggedin'=>true, 'message'=>__('User login successfull!, redirecting...')));
    //         // $url = site_url('/home');
    //         // wp_redirect( $url );
    //         // // wp_redirect("http://localhost/module_2/");

    //     }else{
            
    //         echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
    //     }
        
    // }

add_action("wp_ajax_custom_login", "custom_login");
add_action("wp_ajax_nopriv_custom_login","custom_login");
function custom_login(){
   $param = isset($_REQUEST['param']) ? trim($_REQUEST['param']):"";
    check_ajax_referer(  'login_applicant_nonce', 'name_of_nonce_field'  );
   if($param =="login_test"){     
    $info = array();
        $info['user_login'] = trim($_POST['user_login']);
        $info['user_password'] =trim( $_POST['password']);
    
        $user_signon = wp_signon( $info, false);
    // print_r($info);
        if ( is_wp_error( $user_signon )) {
        $errorMsg = "Something went wrong!";
        echo json_encode( array("status" => 0 , "msg" => $errorMsg));
        // echo "Something went wrong";
       
    } else {
        $successMsg = "User login successful";
        echo json_encode( array( "status" => 1 , "msg" => $successMsg));
        // echo "User login successfull";
    }

   }
   wp_die();
}


//Disable wordpress builtin header
add_action('after_setup_theme', 'remove_admin_bar');
 
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}




