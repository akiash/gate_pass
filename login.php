<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta charset="UTF-8">
	<title></title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel="stylesheet" href="style.css">
</head>
<body>

	  <div class="sidenav">
         <div class="login-main-text">
            <h2>Application<br> Login Page</h2>
            <p>Login from here to access.</p>
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
               <form>
                  <div class="form-group">
                     <label>Email</label>
                     <input type="email" id="email" class="form-control" placeholder="Email">
					 <span class="error_field" id="email_error"></span>
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" id="password" class="form-control" placeholder="Password">
					 <span class="error_field" id="password_error"></span>
                  </div>
                  <button type="button" class="btn btn-black" onclick="login()">Login</button>
               </form>
			   
			   <style>
				.error_field{
					color:red;
				}
			   </style>
            </div>
			<div class="text-danger" id="msg"></div>
         </div>
      </div>
	  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	  <script>
		function login(){
			var email = jQuery('#email').val();
			var password = jQuery('#password').val();
				
			jQuery('.error_field').html('');
			var is_error = '';
			if(email==''){
					jQuery('#email_error').html('Please Enter ur Email');
					is_error='yes';
			}
			if(password==''){
					jQuery('#password_error').html('Please Enter ur Password');
					is_error='yes';
			}
			jQuery.ajax({
				url:'login_submit.php',
				type:'post',
				data:'email='+email+'&password='+password,
				success:function(result){
					if(result=='done'){
						//jQuery('#result').html(data);
						window.location.href = 'index.php';
					}
					if(result=='not done'){
					//swal("Good job!", "You clicked the button!", "alert");
					//jQuery('#msg').html('Please Enter correct credentials....');
						Swal.fire({
						  icon: 'error',
						  title: 'Oops...',
						  text: 'Login With Correct Credetials  !!!!',
						 // footer: '<a href>Why do I have this issue?</a>'
						});
					}
				}
			});
		
		}
	  </script>