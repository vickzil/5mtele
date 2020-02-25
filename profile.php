<?php   
require 'dbconfig.php';
require 'controller/settings.php';

?>


<!doctype html>
<html lang="en" dir="ltr">
  <?php $GLOBALS['title'] = "Welcome to 5Mtelecom Portal"; include 'components/head.php'; ?>

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
              <i class=" fe fe-user"></i> My Profile
              </h1>
              <div class="ml-auto text-right">
                <a class="btn btn-dark text-light " href="edit-user-profile" style="background: #17174a;">
                  <i class="fa fa-pencil-square-o"></i> Edit Profile
                </a>
              </div>
            </div>
            <div class="row row-cards mt-5">
              <div class="col-md-8 col-sm-12">
                <div class="card">
                  <div class="card-body">
                    

                      <div class="my-profile row mt-3">
                        <div class="col-md-3">

                           <?php if ($user['profileimage'] == 0) { ?>
                                <center>
                                  <img src="uploads/profile2.png" onclick="triggerClick()" class="img-fluid img-thumbnail" style="cursor: pointer;" id="profileDisplay">
                                </center>
                           <?php } else { ?>
                              <center>
                                <img src="uploads/<?php echo $user['profileimage']; ?>" onclick="triggerClick()" class="img-fluid img-thumbnail" id="profileDisplay" style="cursor: pointer;">
                              </center>
                          <?php } ?>
                          <center><small class="text-muted d-block mt-1">click on the image to upload photo</small></center>
                          <form action="form.php" method="POST" id="form_image" class="form-inline mt-4 text-center" enctype="multipart/form-data">
                              <div class=" form-group text-center">
                                <input name="Profilefile" onchange="displayImage(this)" type="file" id="file_input" class="btn btn-outline-dark btn-sm" required style="display: none;">
                              </div>
                              <div class=" form-group m-auto">
                                <button type="submit" id="" name="uploadProfileImage" class="btn btn-success btn-sm file_btn"> Upload</button>
                              </div>
                          </form>
                        </div>
                        <div class="col-md-9" id="mobile_profile_top">
                          <div class="form-group">
                            <label class="form-label text-dark">FULLNAME: </label>
                            <input type="text" value="<?php echo $user['fullname']; ?>" class="form-control form-control-md" style="text-transform: capitalize;" disabled>
                          </div>

                          <div class="form-group">
                            <label class="form-label text-dark">USERNAME: </label>
                            <input type="text" value="<?php echo $user['username']; ?>" class="form-control form-control-md" disabled>
                          </div>              
                        </div>
                      </div>

                        <div class="col mt-5">
                          <div class="form-group">
                            <label class="form-label text-dark">E-MAIL: </label>
                            <input type="text" value="<?php echo $user['email']; ?>" class="form-control form-control-md" disabled>
                          </div>

                          <div class="form-group">
                            <label class="form-label text-dark">PHONE: </label>
                            <input type="text" value="<?php echo $user['phone']; ?>" class="form-control form-control-md" style="text-transform: capitalize;" disabled>
                          </div>

                          <div class="form-group">
                            <label class="form-label text-dark">5M ACCOUNT NO: </label>
                            <input type="text" value="<?php echo $user['accountNumber']; ?>" class="form-control form-control-md" disabled>
                          </div>

                          <div class="form-group">
                            <label class="form-label text-dark">BALANCE: </label>
                            <input type="text" value="&#8358;<?php echo $user['balance']; ?>" class="form-control form-control-md" style="text-transform: capitalize;" disabled>
                          </div>

                          <?php

                          $userDate = $user['datecreated'];
                          $userDate = strtotime($userDate);
                          $userDate = date('M d Y m:ia', $userDate);


                          ?>

                          <div class="form-group">
                            <label class="form-label text-dark">REGISTRATION DATE: </label>
                            <input type="text" value="<?php echo $userDate;  ?>" class="form-control form-control-md" style="text-transform: capitalize;" disabled>
                          </div>
                        </div>
                  </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12"> 
              <div class="card">
                <div class="card-body">

                  <label class="form-label mb-4 text-dark">BIO:</label>

                  <?php if ($user['bio'] == Null) { ?>
                      <p class="lead">You don't have any Bio Yet! Please click on edit profile to add your Bio</p>
                   <?php } else { ?>
                    <p><?php echo nl2br($user['bio']); ?></p>
                  <?php } ?>
                </div>
              </div>
            </div>

            
          </div>
        </div>
      </div>
    <?php include 'components/footer.php'; ?>

    <script>

   const fileBtn = document.querySelector('.file_btn');
   const formImage = document.querySelector('#form_image');

  function triggerClick() {

    document.querySelector('#file_input').click();


  }

  function displayImage(e) {
    if (e.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
      }

      reader.readAsDataURL(e.files[0]);

      formImage.submit();
    }
  }
</script>

      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
 <!--  <script>
  
  $(document).ready(function(){
    $('#file_input').mouseleave(function(){

      fileInput = $(this).val();

      if (fileInput.length == 0) {

        $('#file_btn').hide();

      } else {

        $('#file_btn').show();
      }
    });

    $('#file_input').html('Upload photo');

  });
</script> -->

<?php 
  if (isset($_SESSION['message'])) : ?>
  <div class="alert_div">
    <div class=" alert alert-<?PHP echo $_SESSION['msgtype']; ?> alert-dismissible text-center mb-6">
      <button data-dismiss="alert" class="close"></button>
       <?php echo $_SESSION['message'];

        unset($_SESSION['message']);

        ?>
    </div>
  </div>

  <?php endif ?>
</html>