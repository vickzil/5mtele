<?php

require 'register.inc.php';

 ?>
<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>Saturn Tech | Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="./assets/js/require.min.js"></script>
    <script>
    requirejs.config({
    baseUrl: '.'
    });
    </script>
    <!-- Dashboard Core -->
    <link href="./assets/css/dashboard.css" rel="stylesheet" />
    <script src="./assets/js/dashboard.js"></script>
    <!-- c3.js Charts Plugin -->
    <link href="./assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="./assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/maps-google/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="./assets/plugins/input-mask/plugin.js"></script>
    <style>
    body {
        background: #fff!important;
      }

    #btn-loading,
    #eye_hide,
    #eye_c_hide {
      display: none;
    }
    </style>
  </head>
  <body>
    <div class="overlay-login"></div>
    <div class="page">
      <div class="page-single">
        <div class="container">
          
          <div class="row">
            <div class="col-md-7 mx-auto">
               <div class="text-center mb-6">
                <a href="./">
                  <img src="./demo/brand/saturn.png" class="h-8" alt="Saturn Tech logo">
                </a>
              </div>
              
              <form class="card" action="register.inc.php" method="post">
                <div class="card-body p-6">
                  <?php 

                if (isset($_SESSION['message'])) : ?>

                <div class=" alert alert-<?PHP echo $_SESSION['msgtype']; ?> text-center mb-6">
                   <?php echo $_SESSION['message'];

                  unset($_SESSION['message']);

                  ?>
                </div>

              <?php endif ?>
                  <div class="h3"><b>Create new account</b></div>
                  <br>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label class="form-label">Fullname: <span class="form-required">*</span></label>
                      <input type="text" class="form-control" value="<?php echo  $fullname; ?>" name="fullname" placeholder="Enter name">
                    </div>
                    <div class="form-group col-md-6">
                      <label class="form-label">Email: <span class="form-required">*</span></label>
                      <input type="email" name="email" class="form-control" value="<?php echo  $email; ?>" placeholder="Enter email">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label class="form-label">Username: <span class="form-required">*</span></label>
                      <input type="text" class="form-control" value="<?php echo  $username; ?>" name="username" placeholder="Username">
                    </div>
                    <div class="form-group col-md-6">
                      <label class="form-label">Phone: <span class="form-required">*</span></label>
                      <input type="tel" class="form-control" value="<?php echo  $phone; ?>" name="phone" placeholder="Phone Number">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label class="form-label">Password: <span class="form-required">*</span></label>
                      <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        <span class="input-group-append">
                          <button id="show_password" class="btn btn-secondary" type="button"> <i class="fe fe-eye text-dark" id="eye_show"></i> <i class="fe fe-eye-off text-dark" id="eye_hide"></i> </button>
                        </span>
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="form-label">Confirm Paswword: <span class="form-required">*</span></label>
                      <div class="input-group">
                        <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm Password">
                        <span class="input-group-append">
                          <button id="show_cpassword" class="btn btn-secondary" type="button"> <i class="fe fe-eye text-dark" id="eye_c_show"></i> <i class="fe fe-eye-off text-dark" id="eye_c_hide"></i> </button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-footer">
                    <button type="submit" id="btn-not-loading" name="registerUser" class="btn btn-primary btn-block font-weight-bold">Create Account</button>
                    <button type="button" id="btn-loading" class="btn btn-primary btn-loading btn-block">Loading...</button>
                  </div>
                </div>
              </form>
              <div class="text-center text-muted">
                Already have an account? <a href="login">Sign in</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script>
  
  $(document).ready(function(){

    $('#btn-not-loading').click(function(){
      $(this).hide()
      $('#btn-loading').show();
    });

    // Show password

    $('#show_password').on('click', function(){

      var passwordField = $('#password');
      var passwordFieldType = passwordField.attr('type');

      if (passwordFieldType == 'password') {

         passwordField.attr('type', 'text');

         $('#eye_hide').show();
         $('#eye_show').hide();

      } else {

         passwordField.attr('type', 'password');

         $('#eye_hide').hide();
         $('#eye_show').show();
      }
      



    });

     // Show password

    $('#show_cpassword').on('click', function(){

      var passwordField = $('#cpassword');
      var passwordFieldType = passwordField.attr('type');

      if (passwordFieldType == 'password') {

         passwordField.attr('type', 'text');

         $('#eye_c_hide').show();
         $('#eye_c_show').hide();

      } else {

         passwordField.attr('type', 'password');

         $('#eye_c_hide').hide();
         $('#eye_c_show').show();
      }
      



    });

  });
</script>
  </body>
</html>