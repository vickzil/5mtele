<?php   
require 'dbconfig.php';
require 'controller/settings.php';

?>

<?php

    $name = '';
    $email = '';
    $phone = '';
    $formSubject = '';
    $message = '';
    $msg = '';
    $msgClass = '';
    $allowedForm = true;

    if (filter_has_var(INPUT_POST, 'contactSubmit')) {
      
      $name = validInput($_POST['name']);
      $email = validInput($_POST['email']);
      $phone = validInput($_POST['phone']);
      $formSubject = validInput($_POST['subject']);
      $message = validInput($_POST['message']);

        if (empty($name)) {
           $msg = 'Name field is required';
           $msgClass = 'alert-danger';
           $allowedForm = false;
        }

        elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {

          $msg = 'Invalid phone number';
          $msgClass = 'alert-danger';
          $allowedForm = false;
        }


        elseif(empty($email)) {

          $msg = 'E-mail field is required';
          $msgClass = 'alert-danger';
          $allowedForm = false;

        }

        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $msg = 'Please use a valid email';
          $msgClass = 'alert-danger';
          $allowedForm = false;

        } 

        elseif(empty($phone)) {

          $msg = 'Phone field is required';
          $msgClass = 'alert-danger';
          $allowedForm = false;

        } 

        elseif (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i", $phone)) {

          $msg = 'Invalid phone number';
          $msgClass = 'alert-danger';
          $allowedForm = false;
        }

        elseif(empty($formSubject)) {

          $msg = 'Please type the subject of this message';
          $msgClass = 'alert-danger';
          $allowedForm = false;

        }

        elseif(empty($message)) {

          $msg = 'Message field is required';
          $msgClass = 'alert-danger';
          $allowedForm = false;

        }

        else{

          $toEmail = 'info@saturntech.com';
          $subject = 'Complain: '.$formSubject;
          $body = '<h2> Contact Request</h2>
                   <h4> Name</h4> <p>'.$name.'</p>
                   <h4> Email</h4> <p>'.$email.'</p>
                   <h4> Phone</h4> <p>'.$phone.'</p>
                   <h4> Message</h4> <p>'.$message.'</p>

          ';

          $headers = "MIME-Version: 1.0" ."\r\n";
          $headers = "Content-Type:text/html;charset=UTF-8" ."\r\n";

          $headers .= "From: " .$name. "<".$email.">". "\r\n";

          if (mail($toEmail, $subject, $body, $headers)) {
               
               $msg = 'Your Email Has Been Sent';
               $msgClass = 'alert-success';
               $allowedForm = true;
          
          }else{
          
          $msg = 'Email Not Sent';
          $msgClass = 'alert-danger';
          $allowedForm = false;

          }

        }

     


    }

 function validInput($data) {

  $data = htmlspecialchars($data);
  $data = stripcslashes($data);
  $data = trim($data);

  return $data;

}
    

?>



<!doctype html>
<html lang="en" dir="ltr">

  <?php $GLOBALS['title'] = "Help | SaturnTech Portal"; include 'components/head.php'; ?>

        <?php $page = 'help'; include 'components/navbar.php'; ?>

        <div class="my-3 my-md-5">
          <div class="container">
            <div class="container">
              <div class="heading text-center help-heading">
                <h3 style="color: #17174a;">We listen to our customers</h3>
                <h1 class="text-warning heading-h1">We serve a wide range of companies</h1>
                <h5 class="lead">Saturn Tech offers premium broadband services, and as such are always willing to serve you better, that's why we want to hear from you always.</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="page-header">
                  <h1 class="page-title">
                  Need our help?
                  </h1>
                </div>
                <h1 class="heading-h1" style="color: #17174a;">Let's discuss your case and how can we help you</h1>
                <p class="lead">Want to give us a try? Skip the queue and send us an email explaining your idea. We'll come back to you with a bespoke demo based on your business needs, free of charge!</p>
              </div>
              <div class="col-md-6">

                <?php

                $userid = $_SESSION['accountNumber'];

                $query="SELECT * FROM users WHERE accountNumber='$userid'";

                $result = mysqli_query($con,$query); 

                $user = mysqli_fetch_array($result);

                $userFullname = $user['fullname'];      
                $userEmail = $user['email'];      
                $userphone = $user['phone'];      



                ?>
                <div class="card">
                  <div class="card-body">
                    <?php if ($msg !=''): ?>
                      <div class="alert my-3 <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
                    <?php endif; ?>
                    <form action="help.php" method="POST">
                      <div class="form-group">
                        <label class="form-label">Name <span class="form-required">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Your Name" value="<?php echo  $userFullname; ?>" />
                      </div>
                      <div class="form-group">
                        <label class="form-label">E-mail <span class="form-required">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="E-mail" value="<?php echo  $userEmail; ?>" />
                      </div>
                      <div class="form-group">
                        <label class="form-label">Phone <span class="form-required">*</span></label>
                        <input type="tel" name="phone" class="form-control" placeholder="Phone Number" value="<?php echo  $userphone; ?>" />
                      </div>
                      <div class="form-group">
                        <label class="form-label">Subject <span class="form-required">*</span></label>
                        <select id="subject_option" name="subject" class="form-control" >
                          <option value="Subscription enquiries" selected>Subscription enquiries</option>
                          <option value="I'm having problem with my site">I'm having problem with my site</option>
                          <option value="I'd like to make suggestion...">I'd like to make suggestion...</option>
                          <option value="I'm having problem with my Account">I'm having problem with my Account</option>
                          <option value="Feedback">Feedback</option>
                          <option value="Other" id="show_form">Other</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="form-label">Message <span class="form-required">*</span></label>
                        <textarea rows="6" name="message"class="form-control" placeholder="Here can be your Message">
                          <?php echo  $message; ?>
                        </textarea>
                      </div>
                      <div class="form-group text-right">
                        <button type="submit" name="contactSubmit" class="btn btn-dark">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php include 'components/footer.php'; ?>
</html>