<?php   
require 'dbconfig.php';
require 'controller/settings.php';

$userid = $_SESSION['accountNumber'];

$select = "SELECT * FROM users WHERE accountNumber='$userid'";
$execute = mysqli_query($con, $select);

$extract = mysqli_fetch_assoc($execute);

$otCode = $extract['authoritycode'];

if (empty($otCode)) { 

   header("Location: ./");
   
    } else {


    }

?>


<!doctype html>
<html lang="en" dir="ltr">
  <?php $GLOBALS['title'] = "Reset Password | Saturn Tech Portal"; include 'components/head.php'; ?>

  <style>

    
    
    </style>

        <?php $page = 'admincontrol'; include 'components/navbar.php'; ?>

        <?php 

      

          $query="SELECT * FROM users";

          $result = mysqli_query($con,$query); 

          $user = mysqli_fetch_array($result);

          $userRow = mysqli_num_rows($result);


          ?>

        <div class="my-3 my-md-5">
          <div class="container">
            <div class="page-header">
              <h1 class="page-title text-default font-weight-bold">
              <i class=" fa fa-users"></i>Admin
              </h1>
            </div>

            <h2 class=" text-muted text-center" style="margin-top: 60px;margin-bottom: 60px;"><b>Admin Dashboard</b></h2>
                
            <div class="row recharge-row-all">
              <div class="col-md-4">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="h1 my-4"><?php echo $userRow; ?></div>
                    <ul class="list-unstyled leading-loose">
                      <li class="h4 my-4"><strong>Total Users</strong></li>
                    </ul>
                  </div>
                </div>
              </div>

              <?php


              // inserting new visitors to database

              $visitor_Ip = $_SERVER['REMOTE_ADDR'];


              // select visitors
              $visitorSelect = "SELECT * FROM visitors WHERE ip_address='$visitor_Ip' ";
              $VisitorSqlRun = mysqli_query($con,$visitorSelect);
              if (!$VisitorSqlRun) {
                  die("Retrieving Error".$visitorSelect);
              }

              $Visitorr=mysqli_num_rows($VisitorSqlRun);

              if ($Visitorr < 1) {
                  $visitorSelect = "INSERT INTO visitors(ip_address) VALUES('$visitor_Ip')";
                  $VisitorSqlRun = mysqli_query($con,$visitorSelect);
              }

              $Select = "SELECT * FROM visitors ";
              $VisitorSql = mysqli_query($con,$Select);

              $Visitorrow=mysqli_num_rows($VisitorSql);


              ?>

              <div class="col-md-4">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="h1 my-4"><?php echo $Visitorrow; ?></div>
                    <ul class="list-unstyled leading-loose">
                      <li class="h4 my-4"><strong>Total Visitors</strong></li>
                    </ul>
                  </div>
                </div>
              </div>

              <?php 

              $queryComm = "SELECT * FROM comments";

              $resultComm = mysqli_query($con,$queryComm); 

              $userComm = mysqli_fetch_array($resultComm);

              $CommRow = mysqli_num_rows($resultComm);


              ?>

              <div class="col-md-4">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="h1 my-4"><?php echo $CommRow; ?></div>
                    <ul class="list-unstyled leading-loose">
                      <li class="h4 my-4"><strong>Total Notifications</strong></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>


            <div class="row mt-5">
              <div class="col-xl-12">
                  <div class="card">
                      <div class="card-body pt-2">
                          <h4 class="font-size-16 mb-4 font-weight-bold py-4" id="text-logo">Admin Members</h4>

                          <?php

                          // Get All admin users from Login table and display
                          $userid = $_SESSION['accountNumber'];
                          $ot = 'iyke55555';

                          $queryUserAdmin="SELECT * FROM users ";
                          $resultUserAdmin=mysqli_query($con,$queryUserAdmin);

                          while($rowUserAdmin=mysqli_fetch_array($resultUserAdmin)) :  ?>

                          <div class="media border-top pt-3">

                          <?php if ($rowUserAdmin['profileimage'] == 0) { ?>
                              <img src="uploads/profile2.png" class="avatar rounded mr-3" alt="<?php echo $rowUserAdmin['fullname'];?>" />
                          <?php } else { ?>
                              <img src="uploads/<?php echo $rowUserAdmin['profileimage']; ?>" class="avatar rounded mr-3" alt="<?php echo $rowUserAdmin['fullname'];?>" />

                          <?php } ?>

                              <div class="media-body">
                                  <h6 class="mt-1 mb-0 font-size-15" style="text-transform: capitalize;">
                                    <a href="view-user?viewprofile=<?php echo $rowUserAdmin['fullname'];?>"><?php echo $rowUserAdmin['fullname'];?></a> 
                                  <?php if ($rowUserAdmin['active'] == 1) { ?>
                                      <i class="fa fa-circle ml-1" style="color: #00ff00; font-size: 11px;"></i>
                                  <?php } else { ?>
                                      <i class="fa fa-circle" style="color: #ddd; font-size: 11px;"></i>
                                  <?php } ?>
                                  </h6>
                              </div>
                              <div class="dropdown align-self-center float-right">
                                  <a href="delete-admin?deleteadmin=<?php echo $rowUserAdmin['id'];?>"
                                      aria-expanded="false">
                                      <i class="fa fa-trash"></i>
                                  </a>
                              </div>
                          </div>
                          <?php endwhile ?>
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