<?php   
require 'dbconfig.php';
require 'controller/settings.php';

?>


<!doctype html>
<html lang="en" dir="ltr">
  <?php $GLOBALS['title'] = "Welcome to Saturn Tech Portal"; include 'components/head.php'; ?>

  <style>

    
    
    </style>

        <?php $page = 'profile'; include 'components/navbar.php'; ?>

        <?php 

          $userid = $_SESSION['accountNumber'];

          $query="SELECT * FROM users WHERE accountNumber='$userid'";

          $result = mysqli_query($con,$query); 

          $user = mysqli_fetch_array($result);


          ?>

        <div class="my-3 my-md-5">
          <div class="container">
            <div class="page-header">
              <h1 class="page-title text-default font-weight-bold">
              <i class=" fa fa-key"></i> Reset Password
              </h1>
            </div>

            <div class="row row-cards mt-5">
              <div class="col-md-6 m-auto">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title lead">Please Reset your Password</div>
                      <form action="reset-profile-password.inc.php" method="post">
                        <div class="form-group">
                          <label class="form-label">Old Password: <span class="form-required">*</span></label>
                          <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Old Password">
                            <span class="input-group-append">
                              <button id="show_password" class="btn btn-secondary" type="button"> <i class="fe fe-eye text-dark" id="eye_show"></i> <i class="fe fe-eye-off text-dark" id="eye_hide"></i> </button>
                            </span>
                          </div>
                         </div>

                         <div class="form-group">
                          <label class="form-label">New Password: <span class="form-required">*</span></label>
                          <div class="input-group">
                            <input type="password" name="npassword" id="npassword" class="form-control" placeholder="New Password" >
                            <span class="input-group-append">
                              <button id="show_npassword" class="btn btn-secondary" type="button"> <i class="fe fe-eye text-dark" id="eye_n_show"></i> <i class="fe fe-eye-off text-dark" id="eye_n_hide"></i> </button>
                            </span>
                          </div>
                         </div>

                        <div class="form-group">
                          <label class="form-label">Confirm New Paswword: <span class="form-required">*</span></label>
                          <div class="input-group">
                            <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm Password">
                            <span class="input-group-append">
                              <button id="show_cpassword" class="btn btn-secondary" type="button"> <i class="fe fe-eye text-dark" id="eye_c_show"></i> <i class="fe fe-eye-off text-dark" id="eye_c_hide"></i> </button>
                            </span>
                          </div>
                        </div>

                        <div class="form-footer text-right">

                          <button type="submit" id="btn-not-loading" name="resetProfilePwd" class="btn btn-dark" style="background: #17174a;">Change Password</button>

                          <button type="button" id="btn-loading" class="btn btn-dark btn-loading" style="background: #17174a;">Loading...</button>
                        </div>
                      </form>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    <?php include 'components/footer.php'; ?>



<?php 
  if (isset($_SESSION['message'])) : ?>
  <div class="alert_div">
    <div class=" alert alert-<?PHP echo $_SESSION['msgtype']; ?> alert-dismissible text-center py-4">
      <button data-dismiss="alert" class="close"></button>
       <?php echo $_SESSION['message'];

        unset($_SESSION['message']);

        ?>
    </div>
  </div>

  <?php endif ?>

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

     // Show New password

    $('#show_npassword').on('click', function(){

      var passwordField = $('#npassword');
      var passwordFieldType = passwordField.attr('type');

      if (passwordFieldType == 'password') {

         passwordField.attr('type', 'text');

         $('#eye_n_hide').show();
         $('#eye_n_show').hide();

      } else {

         passwordField.attr('type', 'password');

         $('#eye_n_hide').hide();
         $('#eye_n_show').show();
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
</html>