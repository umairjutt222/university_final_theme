<?php
/*
Plugin Name: My Complete Plugin
Description: Welcome to my first plugin and I hope you will enjoy
Plugin URI: https://www,umairiqbal.com/
Author: Umair Iqbal
Version: 1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gplv2.txt

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 
2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
with this program. If not, visit: https://www.gnu.org/licenses/
*/


// Display Program custom post
function register_program_type_post(){
    register_post_type('program', array(
        'supports' => array('title','editor'),
        'rewrite' => array('slug' => 'programs'),
        'has_archive' => true,
        'public' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'labels' => array(
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Programs',
            'singular_name' => 'Program',
            'search_items' => 'Search Program',
            'not_found' => 'No Subject Found'
        )
    ));
}
add_action('init', 'register_program_type_post');

//Display Professor Custom Post
function register_professor_event(){
    register_post_type('professor', array(
        'supports' => array('title','editor', 'thumbnail'),
        'public' => true,
        'menu_icon' => 'dashicons-businessperson',
        'labels' => array(
            'name' => 'Professors',
            'add_new_item' => 'Add New Professor',
            'edit_item' => 'Edit Professor',
            'all_items' => 'All Professors',
            'singular_name' => 'Professor',
            'search_items' => 'Search Professor',
            'not_found' => 'No Professor Found'
        )
    ));
}
add_action('init', 'register_professor_event');

//Display Event Custom Post
function register_event_post(){
    $argument = array(
        'supports' => array('title','editor','excerpt'),
        'rewrite' => array('slug' => 'events'),
        'has_archive' => true,
        'public' => true,
        'menu_icon' => 'dashicons-megaphone',
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event'
        )
        );
    register_post_type('event', $argument);

}
add_action('init', 'register_event_post');

// register meta box
function myplugin_add_meta_box() {
	$post_types = array( 'post', 'page', 'event', 'professor', 'program' );
	foreach ( $post_types as $post_type ) {
		add_meta_box(
			'myplugin_meta_box',         // Unique ID of meta box
			'My MetaBox',         // Title of meta box
			'myplugin_display_meta_box', // Callback function
			$post_type                   // Post type
		);
	}
}
add_action( 'add_meta_boxes', 'myplugin_add_meta_box' );


// display meta box
function myplugin_display_meta_box( $post ) {
	$value = get_post_meta( $post->ID, '_myplugin_meta_key', true );
	wp_nonce_field( basename( __FILE__ ), 'myplugin_meta_box_nonce' );
	$current_mood = get_post_meta( get_the_ID(), '_myplugin_meta_key', true );

	?>

	<!-- <label for="myplugin-meta-box">This post belong to</label> -->
	<label for="my_meta_box_text">This post belong to</label>
    <input style="   width: 80%;
    padding: 15px 22px;
    color: white;
    box-sizing: border-box;
    border: 4px solid #ccc;
    border-radius: 5px;
    background: #00c6ff; /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #00c6ff, #0072ff); /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #00c6ff, #0072ff);
    resize: none; " type="text" name="my_meta_box_text" id="my_meta_box_text" value="<?php echo $current_mood; ?>">
	
	<!-- <select id="my_meta_box" >
		<option value="">Select option...</option>
		<option value="Professors" <?php selected( $value, 'option-1' ); ?>>Professors</option>
		<option value="Admin" <?php selected( $value, 'option-2' ); ?>>Admin</option>
		<option value="Students" <?php selected( $value, 'option-3' ); ?>>Students</option>
	</select> -->
	
<?php
}

// save meta box
function myplugin_save_meta_box( $post_id ) {
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = false;
	if ( isset( $_POST[ 'myplugin_meta_box_nonce' ] ) ) {
		if ( wp_verify_nonce( $_POST[ 'myplugin_meta_box_nonce' ], basename( __FILE__ ) ) ) {
			$is_valid_nonce = true;
		}
	}
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) return;
	if ( array_key_exists( 'my_meta_box_text', $_POST ) ) {
		update_post_meta(
			$post_id,                                            // Post ID
			'_myplugin_meta_key',                                // Meta key
			sanitize_text_field( $_POST[ 'my_meta_box_text' ] ) // Meta value
		);
	}
}
add_action( 'save_post', 'myplugin_save_meta_box' );


// display all custom fields for each post
// function myplugin_display_all_custom_fields( $content ) {

// 	/*
// 		get_post_custom(
// 			int $post_id
// 		)
// 	*/
// 	$custom_fields = '<h3>Custom Fields</h3>';

//     $all_custom_fields = get_post_custom();
//     // var_dump($all_custom_fields);


// 	// foreach ( $all_custom_fields as $key => $array ) {

// 	// 	foreach ( $array as $value ) {

// 	// 		// if ( '_' !== substr( $key, 0, 1 ) )

// 	// 		$custom_fields .= '<div>'. $key .' => '. $value .'</div>';

// 	// 	}

//     // }
//     $custom_fields = $all_custom_fields['_myplugin_meta_key'][0];

// 	return $content . $custom_fields;

// }
// add_filter( 'the_content', 'myplugin_display_all_custom_fields' );

// display specific custom field for each post
function myplugin_display_specific_custom_field( $content ) {
	/*
		get_post_meta(
			int $post_id,
			string $key = '',
			bool $single = false
		)
	*/
	$current_mood = get_post_meta( get_the_ID(), '_myplugin_meta_key', true );
	if($current_mood ){
		// $current_mood = get_post_meta( get_the_ID(), '_myplugin_meta_key', true );
		$append_output  = '<div style=" background: #fe921f; color: #ffffff; display: inline-block; font-family: "Lato", sans-serif; font-size: 12px; font-weight: bold; line-height: 12px; letter-spacing: 1px; margin: 0 0 30px; padding: 10px 15px 8px; text-transform: uppercase; align-content: end;" class="metabox__main">';
		$append_output .= esc_html__( 'This post belong to: ' );
		$append_output .= sanitize_text_field( $current_mood );
		$append_output .= '</div>';
	
		return $append_output. $content ;
	}else{
		return $content ;
	}
}
add_filter( 'the_content', 'myplugin_display_specific_custom_field' );



//Metabox for page Banner
function page_banner_add_meta_box() {
	$post_types = array( 'post', 'page', 'event', 'professor', 'program' );
	foreach ( $post_types as $post_type ) {
		add_meta_box(
			'PageBanner_meta_box',         // Unique ID of meta box
			'Page Banner Meta Box',         // Title of meta box
			'page_Banner_display_meta_box', // Callback function
			$post_type                   // Post type
		);
	}
}
add_action( 'add_meta_boxes', 'page_banner_add_meta_box' );

//Display Page Banner Meta Box
function page_Banner_display_meta_box( $post ) {
	$value = get_post_meta( $post->ID, '_page_banner_meta_key', true );
	wp_nonce_field( basename( __FILE__ ), 'page_banner_meta_box_nonce' );
	$current_mood = get_post_meta( get_the_ID(), '_page_banner_meta_key', true );

	?>

	<!-- <label for="myplugin-meta-box">This post belong to</label> -->
	<label for="page_meta_box_text">Page Banner Subtitile</label>
    <input style=" width: 80%;
    padding: 15px 22px;
    color: white;
    box-sizing: border-box;
    border: 4px solid #ccc;
    border-radius: 5px;
    background: #00c6ff; /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #00c6ff, #0072ff); /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #00c6ff, #0072ff);
    resize: none;" type="text" name="page_meta_box_text" id="page_meta_box_text" value="<?php echo $current_mood; ?>">
	
<?php
}

//Save Page Banner MetaBox
function page_banner_save_meta_box( $post_id ) {
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = false;
	if ( isset( $_POST[ 'page_banner_meta_box_nonce' ] ) ) {
		if ( wp_verify_nonce( $_POST[ 'page_banner_meta_box_nonce' ], basename( __FILE__ ) ) ) {
			$is_valid_nonce = true;
		}
	}
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) return;
	if ( array_key_exists( 'page_meta_box_text', $_POST ) ) {
		update_post_meta(
			$post_id,                                            // Post ID
			'_page_banner_meta_key',                                // Meta key
			sanitize_text_field( $_POST[ 'page_meta_box_text' ] ) // Meta value
		);
	}
}
add_action( 'save_post', 'page_banner_save_meta_box' );

//Front-end Display meta box
// function Page_banner_display_specific_custom_field( $content ) {
// 	/*
// 		get_post_meta(
// 			int $post_id,
// 			string $key = '',
// 			bool $single = false
// 		)
// 	*/
// 	$current_mood = get_post_meta( get_the_ID(), '_page_banner_meta_key', true );
// 	if($current_mood ){
// 		// $current_mood = get_post_meta( get_the_ID(), '_myplugin_meta_key', true );
// 		$append_output  = '<div style=" background: #fe921f; color: #ffffff; display: inline-block; font-family: "Lato", sans-serif; font-size: 12px; font-weight: bold; line-height: 12px; letter-spacing: 1px; margin: 0 0 30px; padding: 10px 15px 8px; text-transform: uppercase; align-content: end;" class="metabox__main">';
// 		$append_output .= esc_html__( 'Page Banner: ' );
// 		$append_output .= sanitize_text_field( $current_mood );
// 		$append_output .= '</div>';
	
// 		return $append_output. $content ;
// 	}else{
// 		return $content ;
// 	}
// }
// add_filter( 'the_content', 'page_banner_display_specific_custom_field' );


//Meta Box for Event Date
function event_date_add_meta_box() {
	$post_types = array( 'post', 'page', 'event', 'professor', 'program' );
	foreach ( $post_types as $post_type ) {
		add_meta_box(
			'Event_date_meta_box',         // Unique ID of meta box
			'Event Date Meta Box',         // Title of meta box
			'event_date_display_meta_box', // Callback function
			$post_type                   // Post type
		);
	}
}
add_action( 'add_meta_boxes', 'event_date_add_meta_box' );

//Display event data meta box
function event_date_display_meta_box( $post ) {
	$value = get_post_meta( $post->ID, '_event_date_meta_key', true );
	wp_nonce_field( basename( __FILE__ ), 'event_date_meta_box_nonce' );
	$current_mood = get_post_meta( get_the_ID(), '_event_date_meta_key', true );

	?>

	<!-- <label for="myplugin-meta-box">This post belong to</label> -->
	<label for="hcf_published_date">Published Date</label>
        <input style= "width: 80%;
    padding: 15px 22px;
    color: white;
    box-sizing: border-box;
    border: 4px solid #ccc;
    border-radius: 5px;
    background: #00c6ff; /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #00c6ff, #0072ff); /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #00c6ff, #0072ff);
    resize: none;"  id="hcf_published_date"
            type="date"
            name="hcf_published_date"
           value="<?php echo $current_mood; ?>">
<?php
}

//save event date meta box
function event_date_save_meta_box( $post_id ) {
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = false;
	if ( isset( $_POST[ 'event_date_meta_box_nonce' ] ) ) {
		if ( wp_verify_nonce( $_POST[ 'event_date_meta_box_nonce' ], basename( __FILE__ ) ) ) {
			$is_valid_nonce = true;
		}
	}
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) return;
	if ( array_key_exists( 'hcf_published_date', $_POST ) ) {
		update_post_meta(
			$post_id,                                            // Post ID
			'_event_date_meta_key',                                // Meta key
			sanitize_text_field( $_POST[ 'hcf_published_date' ] ) // Meta value
		);
	}
}
add_action( 'save_post', 'event_date_save_meta_box' );


// Front-end Display meta box
function event_date_display_specific_custom_field( $content ) {
	/*
		get_post_meta(
			int $post_id,
			string $key = '',
			bool $single = false
		)
	*/
	$current_time = get_post_meta( get_the_ID(), '_event_date_meta_key', true );
	if($current_time ){
        $newDate = date("d M, Y", strtotime($current_time));
		// $current_mood = get_post_meta( get_the_ID(), '_myplugin_meta_key', true );
		$append_output  = '<div style="width: 22.15%; background: #fe921f; color: #ffffff;  font-family: "Lato", sans-serif; font-size: 12px; font-weight: bold; line-height: 12px; letter-spacing: 1px; margin: 0 0 30px; padding: 10px 15px 8px; text-transform: uppercase; align-content: end;" class="metabox__main">';
		$append_output .= esc_html__( 'Event Date: ' );
		$append_output .= sanitize_text_field( $newDate );
		$append_output .= '</div>';
		return $append_output. $content;
	}else{
		return $content;
	}
}
add_filter( 'the_content', 'event_date_display_specific_custom_field' );













function include_all_files() {
    wp_enqueue_style( 'choosenCss', plugin_dir_url( __FILE__ ) . '/css/chosen.css' );
    wp_enqueue_script( 'my_custom_jquery', plugin_dir_url( __FILE__ ) . '/js/jquerymin.js' );
    wp_enqueue_script( 'chosen_jquery', plugin_dir_url( __FILE__ ) . '/js/chosenjquerymin.js' );

}
add_action( 'admin_enqueue_scripts', 'include_all_files' );

//Meta Box for Related Subject
function related_subject_add_meta_box() {
	$post_types = array( 'post', 'page', 'event', 'professor');
	foreach ( $post_types as $post_type ) {
		add_meta_box(
			'related_subject_meta_box',         // Unique ID of meta box
			'Related Subject',         // Title of meta box
			'related_subject_display_meta_box', // Callback function
			$post_type                   // Post type
		);
	}
}
add_action( 'add_meta_boxes', 'related_subject_add_meta_box' );

//Display event data meta box
function related_subject_display_meta_box( $post ) {
	$value = get_post_meta( $post->ID, '_related_subject_meta_key', true );
	wp_nonce_field( basename( __FILE__ ), 'related_subject_meta_box_nonce' );
	$related_subject = get_post_meta( $post->ID, '_related_subject_meta_key', true );

?>

<label for="related_subject">Related Subject</label>
<!-- <select class="chosen" multiple="true" style="width:400px;" id="my_meta_box" name="my_meta_box[]"  value="<?php echo $related_subject; ?>"   style="width: 50%;">             -->

	<?php
// query for your Subject Post
$subject_query  = new WP_Query(  
	array (  
		'post_type'      => 'program',  
		'posts_per_page' => -1  
	)  
  );   
  //Array for subjects
	$subjects_array = $subject_query->posts;   
	$subjects = wp_list_pluck( $subjects_array, 'post_title', 'ID' );
   ?>
      
<select class="chosen" multiple="true" style="width:400px;" id="my_meta_box" name="my_meta_box[]"  value="<?php echo $subjects ?>"   style="width: 50%;">            
     <?php 
	 foreach ($subjects as $subjectid => $subject_value) { ?>
            <option  value="<?php echo  $subjectid ?>" <?php echo in_array($subjectid , $related_subject) ? 'selected': ''; ?> ><?php echo $subject_value?></option>
<?php
    }
    echo "</select>";
    wp_reset_postdata();
    if(  'post' == $post->post_type || 'event' == $post->post_type || 'program' == $post->post_type || 'professor' == $post->post_type ) {
        echo '
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			jQuery(".chosen").data("placeholder","Select Frameworks...").chosen();
		});
		</script>
			';
    }
}

//save event date meta box
function related_subject_save_meta_box( $post_id ) {
	 
    
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = false;
	if ( isset( $_POST[ 'related_subject_meta_box_nonce' ] ) ) {
		if ( wp_verify_nonce( $_POST[ 'related_subject_meta_box_nonce' ], basename( __FILE__ ) ) ) {
			$is_valid_nonce = true;
		}
	}
	// if(isset($_POST["related_subject_meta_box_nonce"])) :
	// update_post_meta($post->ID, '_related_subject_meta_key', $_POST["_diwp_select_field"]);

	if ( $is_autosave || $is_revision || !$is_valid_nonce ) return;
	if ( array_key_exists( 'my_meta_box', $_POST ) ) {
		update_post_meta(
			$post_id,                                            // Post ID
			'_related_subject_meta_key',                                // Meta key
            $_POST[ 'my_meta_box' ]   // Meta value
		);
	}
}
add_action( 'save_post', 'related_subject_save_meta_box' );









//Meta Box for Related Professor
function related_professor_add_meta_box() {
	$post_types = array( 'post', 'page', 'program' );
	foreach ( $post_types as $post_type ) {
		add_meta_box(
			'related_professor_meta_box',         // Unique ID of meta box
			'Related Professor',         // Title of meta box
			'related_professor_display_meta_box', // Callback function
			$post_type                   // Post type
		);
	}
}
add_action( 'add_meta_boxes', 'related_professor_add_meta_box' );

//Display event data meta box
function related_professor_display_meta_box( $post ) {
	$value = get_post_meta( $post->ID, '_related_professor_meta_key', true );
	wp_nonce_field( basename( __FILE__ ), 'related_professor_meta_box_nonce' );
	$related_professor = get_post_meta( $post->ID, '_related_professor_meta_key', true );
	// var_dump($related_professor );
?>

<label for="related_professor_id">Related Professors</label>
	<?php
// query for your Subject Post
$subject_query  = new WP_Query(  
	array (  
		'post_type'      => 'professor',  
		'posts_per_page' => -1  
	)  
  );   
  //Array for subjects
	$professors_array = $subject_query->posts;   
	$professors = wp_list_pluck( $professors_array, 'post_title', 'ID' );
	// var_dump($professors);
   ?>
      
<select class="chosen_professor" multiple="true" id="related_professor_id" name="related_professor[]"  value="<?php echo $professors ?>"   style="width: 50%;">            
     <?php 
	 foreach ($professors as $professorId => $professor_value) { ?>
        <option  value="<?php echo $professorId ?>" <?php echo in_array($professorId,$related_professor) ? 'selected': ''; ?> ><?php echo $professor_value?></option>
<?php
    }
    echo "</select>";
    wp_reset_postdata();
    if(  'post' == $post->post_type || 'event' == $post->post_type || 'program' == $post->post_type || 'professor' == $post->post_type ) {
        echo '
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			jQuery(".chosen_professor").data("placeholder","Select Frameworks...").chosen();
		});
		</script>
			';
    }
}

//save event date meta box
function related_professor_save_meta_box( $post_id ) {
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = false;
	if ( isset( $_POST[ 'related_professor_meta_box_nonce' ] ) ) {
		if ( wp_verify_nonce( $_POST[ 'related_professor_meta_box_nonce' ], basename( __FILE__ ) ) ) {
			$is_valid_nonce = true;
		}
	}
	 // if(isset($_POST["related_subject_meta_box_nonce"])) :
	// update_post_meta($post->ID, '_related_subject_meta_key', $_POST["_diwp_select_field"]);
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) return;
	if ( array_key_exists( 'related_professor', $_POST ) ) {
		update_post_meta(
			$post_id,                                            // Post ID
			'_related_professor_meta_key',                      // Meta key
            $_POST[ 'related_professor' ]                      // Meta value
		);
	}
}
add_action( 'save_post', 'related_professor_save_meta_box');

