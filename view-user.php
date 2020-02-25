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

if (isset($_GET['viewprofile'])) {

  $id = $_GET['viewprofile'];

  $commentUser = "SELECT * FROM users WHERE fullname='$id'";

  $executeComment = mysqli_query($con, $commentUser);

  $extractUser = mysqli_fetch_assoc($executeComment);

  $userSub = $extractUser['fullname'];

} else {

    header("Location: ./");
}

}

?>


<!doctype html>
<html lang="en" dir="ltr">
  <?php $GLOBALS['title'] = "View User | Saturn Tech Portal"; include 'components/head.php'; ?>

  <style>

    
    
    </style>

        <?php $page = 'admincontrol'; include 'components/navbar.php'; ?>

        <div class="my-3 my-md-5">
          <div class="container">
            <div class="page-header">
              <h1 class="page-title text-default font-weight-bold">
              <i class=" fa fa-users"></i>Admin
              </h1>
              <div class="ml-auto text-right">
                <a class="btn btn-dark text-light " href="javascript:window.history.back();" style="background: #17174a;">
                  <i class="fa fa-arrow-left"></i> Back
                </a>
              </div>
            </div>

            <h2 class=" text-muted text-center" style="margin-top: 60px;margin-bottom: 60px;"><b>Notifications</b></h2>


            <div class="row mt-5">
              <div class="col-md-8">
                <div class="card">
                  <div class="card-body">
                      <div class="my-profile row mt-3">
                        <div class="col-md-3">

                           <?php if ($extractUser['profileimage'] == 0) { ?>
                                <center>
                                  <img src="uploads/profile2.png" class="img-fluid img-thumbnail">
                                </center>
                           <?php } else { ?>
                              <center>
                                <img src="uploads/<?php echo $extractUser['profileimage']; ?>" class="img-fluid img-thumbnail">
                              </center>
                          <?php } ?>
                        </div>
                        <div class="col-md-9" id="mobile_profile_top">
                          <div class="form-group">
                            <label class="form-label text-dark">FULLNAME: </label>
                            <input type="text" value="<?php echo $extractUser['fullname']; ?>" class="form-control form-control-md" style="text-transform: capitalize;" disabled>
                          </div>

                          <div class="form-group">
                            <label class="form-label text-dark">USERNAME: </label>
                            <input type="text" value="<?php echo $extractUser['username']; ?>" class="form-control form-control-md" disabled>
                          </div>              
                        </div>
                      </div>

                        <div class="col mt-5">
                          <div class="form-group">
                            <label class="form-label text-dark">E-MAIL: </label>
                            <input type="text" value="<?php echo $extractUser['email']; ?>" class="form-control form-control-md" disabled>
                          </div>

                          <div class="form-group">
                            <label class="form-label text-dark">PHONE: </label>
                            <input type="text" value="<?php echo $extractUser['phone']; ?>" class="form-control form-control-md" style="text-transform: capitalize;" disabled>
                          </div>

                          <div class="form-group">
                            <label class="form-label text-dark">ST ACCOUNT NO: </label>
                            <input type="text" value="<?php echo $extractUser['accountNumber']; ?>" class="form-control form-control-md" disabled>
                          </div>

                          <div class="form-group">
                            <label class="form-label text-dark">BALANCE: </label>
                            <input type="text" value="&#8358;<?php echo $extractUser['balance']; ?>" class="form-control form-control-md" style="text-transform: capitalize;" disabled>
                          </div>

                          <?php

                          $userDate = $extractUser['datecreated'];
                          $userDate = strtotime($userDate);
                          $userDate = date('M d Y m:ia', $userDate);


                          ?>

                          <div class="form-group">
                            <label class="form-label text-dark">REGISTRATION DATE: </label>
                            <input type="text" value="<?php echo $userDate;  ?>" class="form-control form-control-md" style="text-transform: capitalize;" disabled>
                          </div>

                          <div class="form-group">
                            <label class="form-label text-dark">LOGIN-TIME: </label>
                            <input type="text" value="<?php echo $extractUser['lastlogin']; ?>" class="form-control form-control-md" style="text-transform: capitalize;" disabled>
                          </div>

                          <div class="form-group">
                            <label class="form-label text-dark">LOGOUT-TIME: </label>
                            <input type="text" value="<?php echo $extractUser['lastlogoff']; ?>" class="form-control form-control-md" style="text-transform: capitalize;" disabled>
                          </div>

                          <div class="form-group">
                            <label class="form-label text-dark">VERIFY: </label>
                            <input type="text" value="<?php echo $extractUser['verified']; ?>" class="form-control form-control-md" style="text-transform: capitalize;" disabled>
                          </div>
                        </div>
                  </div>
                </div>
              </div>


              <div class="col-md-4 col-sm-12"> 
              <div class="card">
                <div class="card-body">

                  <label class="form-label mb-4 text-dark">BIO:</label>

                  <?php if ($extractUser['bio'] == Null) { ?>
                      <p class="lead">You don't have any Bio Yet! Please click on edit profile to add your Bio</p>
                   <?php } else { ?>
                    <p><?php echo nl2br($extractUser['bio']); ?></p>
                  <?php } ?>
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
</html>