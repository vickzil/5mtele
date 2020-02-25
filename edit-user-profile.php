<?php   
require 'dbconfig.php';
require 'controller/settings.php';

?>


<!doctype html>
<html lang="en" dir="ltr">
  <?php $GLOBALS['title'] = "Welcome to Saturn Tech Portal"; include 'components/head.php'; ?>

  <style>

    #file_btn {
      display: none;
    }
    
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
            <form action="edit.inc.php" method="POST">
            <div class="page-header">
              <h1 class="page-title text-default font-weight-bold">
              <i class="fa fa-user-plus"></i> EDIT PROFILE
              </h1>
              <div class="ml-auto text-right">
                <button type="submit" class="btn btn-dark" name="update_profile" style="background: #17174a;">Update Profile</button>
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
                                <img src="uploads/profile2.png" class="img-fluid img-thumbnail">
                              </center>
                           <?php } else { ?>
                            <center>
                              <img src="uploads/<?php echo $user['profileimage']; ?>" class="img-fluid img-thumbnail">
                            </center>
                          <?php } ?>
                        </div>
                        <div class="col-md-9" id="mobile_profile_top">
                                <div class="form-group">
                                  <label class="form-label text-dark mr-3">FULLNAME: </label>
                                  <input type="text" name="user_fullname" value="<?php echo $user['fullname']; ?>" class="form-control form-control-md" style="text-transform: capitalize;">
                                </div>

                                <div class="form-group">
                                  <label class="form-label text-dark mr-3">USERNAME: </label>
                                  <input type="text" name="user_username" value="<?php echo $user['username']; ?>" class="form-control form-control-md" style="text-transform: capitalize;">
                                </div>              
                        </div>
                      </div>

                        <div class="col-md-12 mt-3">
                                <div class="form-group mb-4">
                                  <label class="form-label text-dark">E-MAIL: </label>
                                  <input type="text" name="user_email" value="<?php echo $user['email']; ?>" class="form-control form-control-md">
                                </div>

                                <div class="form-group">
                                  <label class="form-label text-dark mr-3">PHONE: </label>
                                  <input type="text" name="user_phone" value="<?php echo $user['phone']; ?>" class="form-control form-control-md">
                                </div>

                                <div class="form-group">
                                  <label class="form-label text-dark mr-3">5M ACCOUNT NO: </label>
                                  <input type="text" value="<?php echo $user['accountNumber']; ?>" class="form-control form-control-sm font-weight-bold"  disabled="">
                                </div>

                                <div class="form-group">
                                  <label class="form-label text-dark mr-3">BALANCE: </label>
                                  <input type="text" value="&#8358;<?php echo $user['balance']; ?>" class="form-control form-control-sm font-weight-bold"  disabled="">
                                </div>
                        </div>
                  </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12"> 
              <div class="card">
                <div class="card-body">
                    <label class="form-label mb-4 text-dark">BIO:</label>
                    <div class="form-group mb-3">
                      <textarea rows="10" name="user_bio"class="form-control" placeholder="Here can be your description" value="<?php echo $user['bio']; ?>"><?php echo $user['bio']; ?></textarea>
                    </div>
                </div>
              </div>
            </div>
          </div>
          </form>
        </div>
      </div>
    <?php include 'components/footer.php'; ?>

      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script>
  
  $(document).ready(function(){
    $('#file_input').mouseleave(function(){

      fileInput = $(this).val();

      if (fileInput.length == 0) {

        $('#file_btn').hide();

      } else {
        $('#file_btn').show();
      }
    });

  });
</script>

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