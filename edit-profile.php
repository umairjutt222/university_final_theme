<?php
/* 
* Template Name: Edit Profile
*
* Allow users to update their profiles from Frontend.
*/



global $current_user, $wp_roles, $wpdb;
// echo '<pre>';
// var_dump($current_user);
// echo '</pre>';

//get_currentuserinfo(); //deprecated since 3.1

/* Load the registration file. */
//require_once( ABSPATH . WPINC . '/registration.php' ); //deprecated since 3.1
$error = array();    
/* If profile was saved, update profile. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

    /* Update user password. */
    if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
        if ( $_POST['pass1'] == $_POST['pass2'] )
            wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
        else
            $error[] = __('The passwords you entered do not match.  Your password was not updated.', 'profile');
    }

    /* Update user information. */
    // if ( !empty( $_POST['url'] ) )
    //     wp_update_user( array( 'ID' => $current_user->ID, 'user_url' => esc_url( $_POST['url'] ) ) );
    if ( !empty( $_POST['email'] ) ){
        if (!is_email(esc_attr( $_POST['email'] ))){
          $error[] = __('The Email you entered is not valid.  please try again.', 'profile');
        }
        else{
            wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
        }
        // elseif(email_exists(esc_attr( $_POST['email'] )) != $current_user->id )
        //     $error[] = __('This email is already used by another user.  try a different one.', 'profile');
    }

    if ( !empty( $_POST['first-name'] ) )
        update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
    if ( !empty( $_POST['last-name'] ) )
        update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
        if ( !empty( $_POST['nick-name'] ) ){
          // $wpdb->update($wpdb->users, array('user_login' => esc_attr( $_POST['nick-name'] )), array('ID' => $current_user->ID));
          $userdata = array(
            'ID' => $current_user->ID,
            'display_name' => esc_attr( $_POST['nick-name'] ),
        );
        wp_update_user( $userdata );
        }
        // update_user_meta( $current_user->ID, $current_user->user_nicename, esc_attr( $_POST['nick-name'] ) );
        // $wpdb->update($wpdb->users, array('user_login' => esc_attr( $_POST['nick-name'] )), array('ID' => $current_user->ID));
    if ( !empty( $_POST['description'] ) )
        update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );
    if ( !empty( $_POST['bdate'] ) )
        update_user_meta( $current_user->ID, 'date_of_birth', esc_attr( $_POST['bdate'] ) );

        if ( !empty( $_POST['phone'] ) )
        update_user_meta( $current_user->ID, 'user_phone_no', esc_attr( $_POST['phone'] ) );
        

        if ( !empty( $_POST['gender'] ) )
        update_user_meta( $current_user->ID, 'user_gender', esc_attr( $_POST['gender'] ) );

        if ( !empty( $_POST['language'] ) )
        update_user_meta( $current_user->ID, 'user_language', esc_attr( $_POST['language'] ) );

        if ( !empty( $_POST['street_address'] ) )
        update_user_meta( $current_user->ID, 'user_street_address', esc_attr( $_POST['street_address'] ) );

        if ( !empty( $_POST['city'] ) )
        update_user_meta( $current_user->ID, 'user_city', esc_attr( $_POST['city'] ) );

        if ( !empty( $_POST['region'] ) )
        update_user_meta( $current_user->ID, 'user_region', esc_attr( $_POST['region'] ) );

        if ( !empty( $_POST['zip_code'] ) )
        update_user_meta( $current_user->ID, 'user_zip_code', esc_attr( $_POST['zip_code'] ) );

        if ( !empty( $_POST['country'] ) )
        update_user_meta( $current_user->ID, 'user_country', esc_attr( $_POST['country'] ) );

       

        if ( !empty( $_POST['facebook'] ) )
        update_user_meta( $current_user->ID, 'user_facebook_url', esc_attr( $_POST['facebook'] ) );

        if ( !empty( $_POST['twitter'] ) )
        update_user_meta( $current_user->ID, 'user_twitter_url', esc_attr( $_POST['twitter'] ) );

        if ( !empty( $_POST['linkdin'] ) )
        update_user_meta( $current_user->ID, 'user_linkdin_url', esc_attr( $_POST['linkdin'] ) );

        if ( !empty( $_POST['google'] ) )
        update_user_meta( $current_user->ID, 'user_google_url', esc_attr( $_POST['google'] ) );

        if ( !empty( $_POST['addition'] ) )
        update_user_meta( $current_user->ID, 'additional_msg', esc_attr( $_POST['addition'] ) );

        
    /* Redirect so the page will show updated info.*/

    if ( count($error) == 0 ) {
        //action hook for plugins and extra fields saving
        do_action('edit_user_profile_update', $current_user->ID);
        wp_redirect( get_permalink() );
        exit;
    }
}

?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>

<head>
	<title>My Account</title>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="<?php echo get_theme_file_uri('web/css/edit.css'); ?>" rel="stylesheet"> 
	<link href="<?php echo get_theme_file_uri('web/css/edit.css'); ?>" rel="stylesheet" type="text/css" media="all"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta name="keywords" content="Profile Widget Responsive" />
	<?php wp_head();?>
</head>

<?php 

$user = wp_get_current_user();
// if ( $user->exists() ) { // is_user_logged_in() is a wrapper for this line
//     $userdata = get_user_meta( $user->data->ID );
//     echo '<pre>';
// var_dump($userdata);
// echo '</pre>';
// }
?>
<body <?php body_class(); ?>>
<div style="background-color:black;"><?php get_header();?></div>
<div style="height:50px;"></div>
<div class="testbox">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div id="post-<?php the_ID(); ?>">
        <div class="entry-content entry">
            <?php the_content(); ?>
            <?php if ( !is_user_logged_in() ) : ?>
                    <p class="warning">
                        <?php _e('You must be logged in to edit your profile.', 'profile'); ?>
                    </p><!-- .warning -->
            <?php else : ?>
                <?php if ( count($error) > 0 ) echo '<p class="error">' . implode("<br />", $error) . '</p>'; ?>
      <form method="post" id="adduser" action="<?php the_permalink(); ?>">
        <div class="banner">
          <h1>Edit Profile Information</h1>
        </div>
        <div class="item">
          <p>First Name</p>
          <div class="item">
            <input type="text" name="first-name" placeholder="First Name" <?php if($user->first_name) echo 'value='.$user->first_name; else {echo 'value='; } ?>  />
           
          </div>
        </div>
        <div class="item">
          <p>Last Name</p>
          <div class="item">
         
            <input type="text" name="last-name" placeholder="Last Name" <?php if($user->last_name) echo 'value='.$user->last_name; else {echo 'value='; } ?>  />
            
          </div>
        </div>
        <div class="item">
          <p>Display Name</p>
          <div class="item">
           
            <input type="text" name="nick-name" placeholder="Nick Name" <?php if($user->user_login) echo 'value='.$user->user_login; else {echo 'value='; } ?>  />
          </div>
        </div>
        <div class="item">
          <p>Email</p>
          <input type="email" name="email" <?php if($user->user_email) echo 'value='.$user->user_email; else {echo 'value='; } ?> >
         </div>
         <div class="item">
          <p>Select Date of Birth</p>
          <?php 
          $date = $user->date_of_birth; 
          $newDate = date("d-m-Y", strtotime($date));  
          
          
          ?>
          <input type="text" name="bdate" <?php if($date ) echo 'value='.$newDate; else {echo 'value='; } ?>>
          <i class="fas fa-calendar-alt"></i>
          
        </div>
        <div class="item">
          <p>Phone</p>
          <input type="text" name="phone" placeholder="#### ### ####" <?php if($user->user_phone_no) echo 'value='.$user->user_phone_no; else {echo 'value='; } ?>>
        </div>
        <div class="question">
          <p>Gender</p>
          <div class="question-answer">
            <div>
              <input type="radio" value="Male" id="radio_1" name="gender"/>
              <label for="radio_1" class="radio"><span>Male</span></label>
            </div>
            <div>
              <input type="radio" value="Female" id="radio_2" name="gender"/>
              <label for="radio_2" class="radio"><span>Female</span></label>
            </div>
            <div>
              <input type="radio" value="Other" id="radio_3" name="gender"/>
              <label for="radio_3" class="radio"><span>Other</span></label>
            </div>
          </div>
        </div>
          <div class="item">
            <p>Language</p>
            <input type="text" name="language" <?php if($user->user_language) echo 'value='.$user->user_language; else {echo 'value='; } ?> >
          </div>
        <div class="item">
          <p>Address</p>
          <input type="text" name="street_address" placeholder="Street address" <?php if($user->user_street_address) echo 'value='.$user->user_street_address; else {echo 'value='; } ?>>
          <!-- <input type="text" name="name" placeholder="Street address line 2" /> -->
          <div class="city-item">
            <input type="text" name="city" placeholder="City"  <?php if($user->user_city) echo 'value='.$user->user_city; else {echo 'value='; } ?>>
            <input type="text" name="region" placeholder="Region" <?php if($user->user_region) echo 'value='.$user->user_region; else {echo 'value='; } ?>>
            <input type="text" name="zip_code" placeholder="Postal / Zip code" <?php if($user->user_zip_code) echo 'value='.$user->user_zip_code; else {echo 'value='; } ?>>
            <select  name = "country" <?php if($user->user_country) echo 'value='.$user->user_country; else {echo 'value='; } ?>>
              <option value="">Country</option>
              <option value="Pakistan">Pakistan</option>
              <option value="Germany">Germany</option>
              <option value="China">China</option>
              <option value="Armenia">Armenia</option>
              <option value="USA">USA</option>
            </select>
          </div>
        </div>
        <div class="item">
          <p>Facebook URL</p>
          <input type="text" name="facebook" <?php if($user->user_facebook_url) echo 'value='.$user->user_facebook_url; else {echo 'value='; } ?>>
        </div>
        <div class="item">
          <p>Twitter URL</p>
          <input type="text" name="twitter" <?php if($user->user_twitter_url) echo 'value='.$user->user_twitter_url; else {echo 'value='; } ?>>
        </div>
        <div class="item">
          <p>LinkdIn URL</p>
          <input type="text" name="linkdin" <?php if($user->user_linkdin_url) echo 'value='.$user->user_linkdin_url; else {echo 'value='; } ?>>
        </div>
        <div class="item">
          <p>Google+ URL</p>
          <input type="text" name="google" <?php if($user->user_google_url) echo 'value='.$user->user_google_url; else {echo 'value='; } ?>>
        </div>
        <div class="item">
          <p>Biography</p>
          <textarea name="description" id="description" rows="3" cols="50"><?php the_author_meta( 'description', $current_user->ID ); ?></textarea>
        </div>
        
        <div class="item">
          <p>Additional Message</p>
          <textarea name="addition" id="addition" rows="3" cols="50"><?php the_author_meta( 'additional_msg', $current_user->ID ); ?></textarea>
        </div>

        <div class="item">
        <p>Password</p>
        <input class="text-input" name="pass1" type="password" id="pass1" />
        </div>
        <div class="item">
        <p>Repeat Password</p>
        <input class="text-input" name="pass2" type="password" id="pass2" />
        </div>
        <div class="btn-block">
        <p class="form-submit">
                        <?php echo $referer; ?>
                        <input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Update', 'profile'); ?>" />
                        <?php wp_nonce_field( 'update-user' ) ?>
                        <input name="action" type="hidden" id="action" value="update-user" />
        </p>
        
        </div>
      </form>
    </div>
    
    <?php endif; ?>
        </div><!-- .entry-content -->
    </div><!-- .hentry .post -->
    <?php endwhile; ?>
<?php else: ?>
    <p class="no-data">
        <?php _e('Sorry, no page matched your criteria.', 'profile'); ?>
    </p><!-- .no-data -->
<?php endif; ?>
<?php   



get_footer();
?>