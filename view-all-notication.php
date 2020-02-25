<?php   
require 'dbconfig.php';
require 'controller/settings.php';

$userid = $_SESSION['accountNumber'];

$select = "SELECT * FROM users WHERE accountNumber='$userid'";
$execute = mysqli_query($con, $select);

$extract = mysqli_fetch_assoc($execute);

$otCode = $extract['authoritycode'];

if (!empty($otCode)) { 

   
  } else {

    header("Location: ./");
}

?>


<!doctype html>
<html lang="en" dir="ltr">
  <?php $GLOBALS['title'] = "Reset Password | Saturn Tech Portal"; include 'components/head.php'; ?>

  <style>

    
    
    </style>

        <?php $page = 'profile'; include 'components/navbar.php'; ?>

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

            <h2 class=" text-muted text-center" style="margin-top: 60px;margin-bottom: 60px;"><b>Notifications</b></h2>


            <div class="row mt-5">
              <div class="col-lg-12">
                <?php

                  $commentQuery="SELECT * FROM comments ORDER BY comment_status ASC, comment_date";

                  $commentResult=mysqli_query($con,$commentQuery);

                  $commentRow = mysqli_num_rows($commentResult); ?>



                <div class="card mt-5">
                  <ul class="list-group card-list-group">
                    <?php while($commentRow=mysqli_fetch_array($commentResult)) :  ?>
                    <li class="list-group-item py-5">
                      <div class="media">
                        <div class="media-object avatar avatar-md mr-4" style="background-image: url(uploads/profile2.png)"></div>
                        <div class="media-body">
                          <div class="media-heading">
                            <small class="float-right text-muted"><?php echo date('M d Y H:ia', strtotime($commentRow['comment_date'])); ?> <a href="delete-noti?deleteadmin=<?php echo $commentRow['comment_id'];?>"
                                      aria-expanded="false" class="ml-2">
                                      <i class="fa fa-trash"></i>
                                  </a></small>
                            <a href="read-notification?read=<?php echo $commentRow['comment_id']; ?>">
                              <h5><?php echo $commentRow['comment_subject']; ?></h5>
                            </a>
                          </div>
                          <div>
                            <?php echo excerpt($commentRow['comment_text'], 0, '550'); ?>
                          </div>
                        </div>
                      </div>
                    </li>
                    <?php endwhile ?>
                  </ul>
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