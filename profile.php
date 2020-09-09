<?php
/* 
Template Name: Profile
*/
?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>

<head>
	<title>My Account</title>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
	<link href="<?php echo get_theme_file_uri('web/css/font-awesome.css'); ?>" rel="stylesheet"> 
	<link href="<?php echo get_theme_file_uri('web/css/style.css'); ?>" rel="stylesheet" type="text/css" media="all"/>
	<link href='//fonts.googleapis.com/css?family=Gudea:400,700' rel='stylesheet' type='text/css'>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta name="keywords" content="Profile Widget Responsive" />
	<?php wp_head();?>
</head>
<?php get_header(  );?>

<body <?php body_class(); ?>>

<?php
// global $current_user; get_currentuserinfo();
$user = wp_get_current_user();
// if ( $user->exists() ) { // is_user_logged_in() is a wrapper for this line
//     $userdata = get_user_meta( $user->data->ID );
//     echo '<pre>';
// var_dump($userdata);
// echo '</pre>';
// }


?>

<!--profile start here-->
<h1>User Profile</h1>
<div class="profile">
	<div class="wrap">
		<div class="profile-main">
			<div class="profile-pic wthree">
				<img src="<?php echo get_theme_file_uri('web/images/p1.png');?>" alt="">
				<h3><?php echo 'User Name: '. $user->user_login . "</br>";
      					echo 'Email: ' . $user->user_email . "</br>";
 				?></h3>

				<p><?php  $user_roles = $user->roles;
					$user_role = array_shift($user_roles);
					echo 'User Role: ' .$user_role . "</br>";
	  				?></p>
					  <p><?php echo 'Gender: ' .$user->user_gender;?></p>
			</div>
			<div class="w3-message">
				<h5>About Me</h5>
				<?php if($user->description){
					echo $user->description;
				}else{
				?>	
				<p>User Bioghraphy doesnot exist.</p>

				<?php } ?>
				<div class="wthree_tab_grid_sub">
					<div class="wthree_tab_grid_sub_left">
						<h6>Date of Birth</h6>
						<p><?php echo $user->date_of_birth; ?></p>
					</div>
					<div class="wthree_tab_grid_sub_left">
						<h6>Phone No</h6>
						<p><?php echo $user->user_phone_no; ?></p>
					</div>
					<div class="wthree_tab_grid_sub_left">
						<h6>Address</h6>
						<p><?php echo $user->user_country. "<br>". $user->user_street_address; ?></p>
					</div>
					<div class="clear"> </div>
				</div>
			</div>
			<div class="w3ls-touch">
				<h5>Get In Touch</h5>
				<div class="social">
					<ul>
					<?php if($user->user_facebook_url ){ ?>
						<li><a href="<?php echo $user->user_facebook_url ?>"><i class="fa fa-facebook" aria-hidden="true"></i> <p>Connected To Facebook</p></a></li>
					<?php } if($user->user_twitter_url){?>
						<li><a href="<?php echo $user->user_twitter_url ?>"><i class="fa fa-twitter" aria-hidden="true"></i> <p>Connected To Twitter</p></a></li>
					<?php } if($user->user_linkdin_url){ ?>
						<li><a href="<?php echo $user->user_linkdin_url ?>"><i class="fa fa-linkedin" aria-hidden="true"></i> <p>Connected To Linkedin</p></a></li>
					<?php } if($user->user_google_url){ ?>
						<li><a href="<?php echo $user->user_google_url ?>"><i class="fa fa-google" aria-hidden="true"></i> <p>Connected To Google</p></a></li>
					<?php } ?>
						
					
					</ul>
					
					<div style="background-color: #d3aefe; color: #333; display:inline-block; padding: 10px 20px; margin: 0 180px; ">
						<a  href="<?php echo wp_logout_url( get_home_url() ); ?>" title="Logout">Logout</a>
					</div>

				</div>
			</div>
		</div>
		<div class="wthree_footer_copy">
			<p></p>
		</div>
	</div>
	
</div>


<!--profile end here-->

</body>
</html>