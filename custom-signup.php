<!DOCTYPE html>
  <html <?php language_attributes() ?>>
    <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo get_theme_file_uri('font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_file_uri('css/modules/signup.css'); ?>">
    <?php wp_head();?>
    </head>
    <body <?php body_class(); ?>>



<?php
/* 
Template Name: Custom SignUp Form
*/


 
// pageBanner(array(
//     'title' => 'Registration Form',
//     'subtitle' => 'Register your account here.'
// ));
// global $wpdb;
// if($_POST){
//     $userName = $wpdb->escape($_POST['username']);
//     $email = $wpdb->escape($_POST['email']);
//     $password = $wpdb->escape($_POST['password']);
//     $confPassword = $wpdb->escape($_POST['password2']);

//     $error = array();
//     if(strpos($userName, ' ') !==FALSE){
//         $error['user_space_error'] = "Remove the spaces between username";
//     }
//     if(empty($userName)){
//         $error['empty_username'] = "UserName cannot be empty";
//     }
//     if(username_exists($userName)){
//         $error['userName_exists'] = "User is already exists";
//     }
//     if(!is_email( $email)){
//         $error['invalid_email'] = "Email is invalid";
//     }
//     if(email_exists( $email )){
//         $error['email_exists'] = "Email is already exists";
//     }
//     if(strcmp($password, $confPassword) !== 0){
//         $error['password_match'] = "Password does not match";
//     }
//     if(count($error) == 0){
//         wp_create_user( $userName, $password, $email );
//         echo '<p>User created successfully</p>'; 
//         echo '<p>Thank you for sign up.</p>'; ?>
<!-- //         <a class="btn btn--large btn--blue" href="<?php echo site_url('/home'); ?>">Go to Home</a> -->
        <?php
//         $url = site_url('/home');
//         print_r($url);
//         wp_redirect($url);
//         die();

//         // wp_redirect( home_url() );
//         // $link = get_post_type_archive_link( 'http://localhost/module_2/');
     
//         // wp_redirect( get_page_uri(  ) );
//         // die();
//         // wp_safe_redirect('http://localhost/module_2/' );
//         // echo site_url('/about-us' );
//         // exit();
//     }else{
      
//     }

// }

// wp_redirect( '/about-us' );
?>

<div class="container">
	 <div class="header">
	 	<h2>Create Account</h2> 	
	 </div>
 
     <div id="form-messages"></div>
 <form class="form" id="wp_form" method="POST" name="wp_form" >
 
 	<div class="form-control success">
 		<label>First Name</label>
 		<input type="text" placeholder="First Name" name="first_name" id="first_name" >
 		<i class="fa fa-check-circle-o"></i>
 		<i class="fa fa-exclamation-circle"></i>
 		<small>Error Message</small>
 	</div>
     <div class="form-control success">
 		<label>Last Name</label>
 		<input type="text" placeholder="Last Name" name="last_name" id="last_name">
 		<i class="fa fa-check-circle-o"></i>
 		<i class="fa fa-exclamation-circle"></i>
 		<small>Error Message</small>
 	</div>

 	<div class="form-control error">
 		<label>Email</label>
 		<input type="email"  placeholder="hello@gmail.com" name="email" id="email">
 		<i class="fa fa-check-circle-o"></i>
 		<i class="fa fa-exclamation-circle"></i>
 		<small>Error Message</small>
 	</div>

 	<div class="form-control">
 		<label>Password</label>
 		<input type="password"  placeholder="Password" name="password" id="password">
 		<i class="fa fa-check-circle-o"></i>
 		<i class="fa fa-exclamation-circle"></i>
 		<small>Error Message</small>
 	</div>

 	<div class="form-control">
 		<label>Password check</label>
 		<input type="password"  placeholder="Confirm Password" name="password2" id="password2">
 		<i class="fa fa-check-circle-o"></i>
 		<i class="fa fa-exclamation-circle"></i>
 		<small>Error Message</small>
 	</div>

<input type="hidden" name="action" value="register_applicant">
<?php wp_nonce_field( 'register_applicant_nonce', 'name_of_nonce_field' ); ?>
<span>Already have an account?  </span><a href="<?php echo site_url('login'); ?>">Login</a><br>
<button>Register</button>

</form>
</div>

</body>
  </html> 



<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script>


        // jQuery(document).ready(function($){
        // $('#wp_form').ajaxForm({
        //     success: function(response){
        //         console.log(response);
        //     },
        //     error: function(response){
        //         console.log(response);
        //     },
        //     uploadProgress(event, position, total, percentComplete){
        //         console.log(percentComplete);
        //     },
        //     resetForm: true
        // });
        // });
// jQuery(function(){
//     jQuery("#wp_form").submit(function(event){
//         event.preventDefault();
        
//         jQuery.ajax({
//             datatype: "json",
//             type: "POST",
//             resetForm: true,
//             data: jQuery("#wp_form").serialize(),
//             url: '<?php echo admin_url('admin-ajax.php'); ?>',
//             success: function(data){
//                 window.location = "http://localhost/module_2/";
//                 // alert('From Submit Successfully. Thank You');
//                 // jQuery('.messageDiv').html(data.message)
//             },
//             error: function(response){
//                 console.log(response);
//             },
//             uploadProgress(event, position, total, percentComplete){
//                 console.log(percentComplete);
//             },
            
//         });

//     });

// });

 
jQuery(function(){
        jQuery("#wp_form").submit(function(event){
            event.preventDefault();




            var formMessages = jQuery('#form-messages');
            var form = jQuery('#wp_form');
           
            if(checkInput()){
                
            jQuery.ajax({
                datatype: "json",
                type: "POST",
                resetForm: true,
                data: jQuery("#wp_form").serialize(),
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                success: function(response){ //data
                alert('Sign up Successfull. Thank You');
                jQuery(formMessages).removeClass('register-error');
                jQuery(formMessages).addClass('register-success');

                // Set the message text
                jQuery(formMessages).text(response);

                // Clear form
                jQuery('#first_name').val('');
                jQuery('#last_name').val('');
                jQuery('#email').val('');
                jQuery('#password').val('');
                jQuery('#password2').val(''); 
                window.location = "<?php echo site_url('login');?>";
             },
                error: function(data){
                    jQuery(formMessages).removeClass('register-success');
                jQuery(formMessages).addClass('register-error');

                // Set the message text
                if(data.responseText !== '') {
                jQuery(formMessages).text(data.responseText);
                
                }else{
            jQuery(formMessages).text('Oops! An error occurred and your request was not sent.');
            }
            },
                uploadProgress(event, position, total, percentComplete){
                    console.log(percentComplete);
            },
                
                
            })

            }
                
            });
        
    });




const form = document.getElementById('wp_form');
const userName = document.getElementById('first_name');
const email = document.getElementById('email');
const password = document.getElementById('password');
const passwordCheck = document.getElementById('password2');

// form.addEventListener('submit', (e) => {
//     e.preventDefault();

    
   
// });

function checkInput() {
    const userNameValue = userName.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const passwordCheckValue = passwordCheck.value.trim();


    if (userNameValue === '') {
        //Show Error
        //Add Error class
        SetErrorFor(userName, 'User Name cannot be blank');
        return false;
    } else if(emailValue === ''){
        SetErrorFor(email, 'Email cannot be blank');
        return false;
    }else if(!isEmail(emailValue)){
        SetErrorFor(email, 'Email is not Valid');
        return false;
    }else if(passwordValue == ''){
        SetErrorFor(password, 'Password cannot be blank');
        return false;
    }else if(passwordCheckValue == ''){
        SetErrorFor(passwordCheck, 'Password cannot be blank');
        return false;
    }else if(passwordValue != passwordCheckValue){
        SetErrorFor(passwordCheck, 'Password does not Match');
        return false;
    }else{
        SetSuccessFor(userName);
        SetSuccessFor(email);
        SetSuccessFor(password);
        SetSuccessFor(passwordCheck);
        
    }
    return true;
}

function SetErrorFor(input, message) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');

    //adding error message in small
    small.innerText = message;
    //adding error class
    formControl.className = 'form-control error';
}
function SetSuccessFor(input) {
    const formControl = input.parentElement;
    formControl.className = 'form-control success';
}
function isEmail(email) {
    return /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/.test(email);
}




// $("wp_form").submit(function (e) {
//             e.preventDefault();
//             var formMessages = jQuery('#form-messages');
//             var _loader = '<i class="fa fa-refresh ajax-loader fa-spin"></i>',
//                 _btn = $(".update-user-password-btn"),
//                 form_data = new FormData(this),
//                 URL = $("input[name=update-password-route]").val();

//             $.ajax({
//                 type: 'POST',
//                 url: URL,
//                 data: form_data,
//                 contentType: false,
//                 cache: false,
//                 processData: false,
//                 datatype: 'json',
//                 beforeSend: function () {
//                     _btn.attr('disabled');
//                     _btn.after(_loader);
//                 },
//                 success: function (msg) {

                   
                    
//                 }
//             });
//         })









</script>

