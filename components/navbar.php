<?php 

function excerpt($str, $startPos =0, $maxLength=100) {

    if (strlen($str) > $maxLength) {

        $excerpt = substr($str, $startPos, $maxLength-3);
        $lastSpace = strrpos($excerpt, ' ');
        $excerpt = substr($excerpt, 0, $lastSpace);
        $excerpt .= '...';
    } else {

        $excerpt = $str;
    }

    return $excerpt;

    
}

?>


<div class="header py-4">
  <div class="container">
    <div class="d-flex">
      <a class="header-brand" href="./">
        <img src="./demo/brand/saturn.png" class="header-brand-img" alt="tabler logo" style="width: 100px;">
      </a>

      <?php 

        $userid = $_SESSION['accountNumber'];

          $query="SELECT * FROM users WHERE accountNumber='$userid'";

          $result = mysqli_query($con,$query); 

          $user = mysqli_fetch_array($result);


          ?>




      <div class="d-flex order-lg-2 ml-auto">
        <?php
          if (!empty($user['authoritycode'])) { ?>
        <div class="dropdown d-none d-md-flex">
          <a class="nav-link icon" data-toggle="dropdown">
             <?php 

             // Get All Notifications from comment table and display

            $Query="SELECT * FROM comments WHERE comment_status=0 ";

            $Result=mysqli_query($con,$Query);

            $commentRaw = mysqli_num_rows($Result);

            $Row = mysqli_fetch_array($Result);

              if ($Row['comment_status'] == '0') :?>
                  <span class="nav-unread"></span>
              <?php endif ?>
              <i class="fe fe-bell"></i>
          </a>

          <?php

            $commentQuery="SELECT * FROM comments ORDER BY comment_status ASC, comment_date DESC  LIMIT 3";

            $commentResult=mysqli_query($con,$commentQuery);

            $commentRow = mysqli_num_rows($commentResult);


             if($commentRow > 0) { ?>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

            <?php while($commentRow=mysqli_fetch_array($commentResult)) :  ?>

            <?php if ($commentRow['comment_status'] == '0'): ?>
            <a href="read-notification?read=<?php echo $commentRow['comment_id']; ?>" class="dropdown-item d-flex">

              <?php 

              if ($commentRow['comment_image']) { ?>
              <span class="avatar mr-3 align-self-center" style="background-image: url(uploads/<?php echo $commentRow['comment_image']; ?>)"></span>

              <?php } else { ?>
                 <span class="avatar mr-3 align-self-center" style="background-image: url(uploads/profile2.png)"></span>

              <?php } ?>
              <div class="font-weight-bold text-dark">
                <?php echo excerpt($commentRow['comment_subject'], 0, '50'); ?>
                <div class="small text-dark"><?php echo date('M d Y H:ia', strtotime($commentRow['comment_date'])); ?></div>
              </div>
            </a>

            <?php else : ?>

              <a href="read-notification?read=<?php echo $commentRow['comment_id']; ?>" class="dropdown-item d-flex">

              <?php 

              if ($commentRow['comment_image']) { ?>
              <span class="avatar mr-3 align-self-center" style="background-image: url(uploads/<?php echo $commentRow['comment_image']; ?>)"></span>

              <?php } else { ?>
                 <span class="avatar mr-3 align-self-center" style="background-image: url(uploads/profile2.png)"></span>

              <?php } ?>
              <div>
                <?php echo excerpt($commentRow['comment_subject'], 0, '50'); ?>
                <div class="small text-dark"><?php echo date('M d Y H:ia', strtotime($commentRow['comment_date'])); ?></div>
              </div>
            </a>

            <?php endif; ?>

            <?php endwhile ?>



            <div class="dropdown-divider"></div>
            <a href="view-all-notication" class="dropdown-item text-center text-muted-dark">View Notifications</a>
          </div>

          <?php } else { ?>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                <div class="text-center ">No Notifications found</div>
            </div>

            <?php } ?>




        </div>
      <?php } ?>

        <div class="dropdown">
            <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
              <?php if ($user['profileimage'] == 0) { ?>
                  <span class="avatar" style="background-image: url(uploads/profile2.png)"></span>
               <?php } else { ?>

                <span class="avatar" style="background-image: url(uploads/<?php echo $user['profileimage']; ?>)"></span>

              <?php } ?>

              <span class="ml-2 d-none d-lg-block">
                <span class="text-default font-weight-bold ml-2"><?php echo $user['fullname'];?></span>
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" id="dropdown">
              <a class="dropdown-item" href="profile">
                <i class="dropdown-icon fe fe-user"></i> Profile
              </a>
              <a class="dropdown-item" href="edit-user-profile">
                <i class="dropdown-icon fe fe-settings"></i> Settings
              </a>
              <a class="dropdown-item" href="reset-profile-password">
                <i class="dropdown-icon fa fa-key"></i> Reset Password
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="help">
                <i class="dropdown-icon fe fe-help-circle"></i> Need help?
              </a>
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="dropdown-icon fe fe-log-out"></i> Sign out
              </a>
            </div>
          </div>
      </div>

      <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
        <span class="header-toggler-icon"></span>
      </a>
      
    </div>
  </div>
</div>
<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse" style="background: #17174a;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-2 ml-auto">
        <a class="text-light font-weight-bold" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fe fe-log-out text-warning"></i> Sign out
        </a>
      </div>
      <div class="col-lg order-lg-first">
        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
          <li class="nav-item">
            <a href="./" class=" nav-link font-weight-bold <?php 
                if($page=='home'){
                  echo 'active text-warning font-weight-bold';
                } else {
                  echo 'text-light';
                } ?>"><i class="fa fa-tachometer font-weight-bold"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a href="recharge" class="nav-link font-weight-bold <?php 
                if($page=='recharge'){
                  echo 'active text-warning';
                } else {
                  echo 'text-light';
                } ?>">
              <i class="fe fe-credit-card font-weight-bold"></i>  Recharge
            </a>
          </li>
          <li class="nav-item">
            <a href="transaction-history" class="nav-link font-weight-bold <?php 
                if($page=='transaction'){
                  echo 'active text-warning font-weight-bold';
                } else {
                  echo 'text-light';
                } ?>">
              <i class="fa fa-clock-o font-weight-bold"></i> Transaction History
            </a>
          </li>
          <li class="nav-item">
            <a href="help" class="nav-link font-weight-bold <?php 
                if($page=='help'){
                  echo 'active text-warning font-weight-bold';
                } else {
                  echo 'text-light';
                } ?>">
              <i class="fe fe-help-circle font-weight-bold"></i> Help
            </a>
          </li>
          <?php
          if (!empty($user['authoritycode'])) { ?>
          <li class="nav-item">
            <a href="admin-control" class="nav-link font-weight-bold <?php 
                if($page=='admincontrol'){
                  echo 'active text-warning font-weight-bold';
                } else {
                  echo 'text-light';
                } ?>">
              <i class="fe fe-help-circle font-weight-bold"></i> Admin
            </a>
          </li>
          <?php } ?>
          <span class="<?php 
                if($page=='profile'){
                  echo 'active';
                } else {
                  echo 'text-light';
                } ?>">
            
          </span>
        </ul>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-lablledby="logoutModalLable" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-light" style="background: #17174a;">
        <h3 class="text-light">Logout</h3>
        <button data-dismiss="modal" class="close text-light"></button>
      </div>
      <div class="modal-body">
        <p>
          <b style="text-transform: capitalize;"><?php echo $_SESSION['fullname'];?></b> !! Are you sure you want to logout?
        </p>
        <div class="btn-list">
          <a href="logout.inc.php" class="btn btn-dark" style="background: #17174a;">Yes</a>
          <button class="btn btn-secondary" data-dismiss="modal" type="button">No, thanks</button>
        </div>
      </div>
    </div>
  </div>
</div>
