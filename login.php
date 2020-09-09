<?php
/* 
Template Name: Login
*/
?>
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

    <div class="container">
	 <div class="header">
	 	<h2>Login here</h2> 	
	 </div>

     <div id="form-messages"></div>

 <form class="form" id="login_form" method="POST" name="login_form" >
 <div class="form-control error">
 		<label>User Name</label>
 		<input type="text"  placeholder="User Name" name="user_login" id="user_login">
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
<!-- <input type="hidden" name="action" value="login_applicant"> -->
<?php  wp_nonce_field( 'login_applicant_nonce', 'name_of_nonce_field' ); ?>
<a class="lost" href="<?php echo wp_lostpassword_url(); ?>">Lost your password?</a>

<span>Don't have an account?  </span><a href="<?php echo site_url('sign-up'); ?>">Go to sign up page</a><br>
<button id="submitBtn">Login</button>

</form>
</div>



<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
  
<script>

jQuery(function(){
    jQuery("#submitBtn").on("click", function(){
        event.preventDefault();
        var formData = jQuery("#login_form").serialize();
        var formMessages = jQuery('#form-messages');

        formData += "&action=custom_login&param=login_test";
        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: formData,
            type: "POST",
            success: function(response){
                var data = jQuery.parseJSON(response);
                if(data.status == 1){
                    window.location = "<?php echo site_url('home');?>";
                }else{
                    jQuery(formMessages).text(response);
                }
            },
        });
    });

});



const form = document.getElementById('login_form');
const userName = document.getElementById('user_login');
const password = document.getElementById('password');


// form.addEventListener('submit', (e) => {
//     e.preventDefault();

    
   
// });

function checkInput() {
   
    const userNameValue = userName.value.trim();
    const passwordValue = password.value.trim();
    if (userNameValue === '') {
        //Show Error
        //Add Error class
        SetErrorFor(userName, 'User Name cannot be blank');
        return false;
    }else if(passwordValue == ''){
        SetErrorFor(password, 'Password cannot be blank');
        return false;
    }
    else{
       
        SetSuccessFor(userName);
        SetSuccessFor(password);  
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

</script>
</body>
  </html> 

