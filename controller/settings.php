<?php 

session_start();  

if(!isset($_SESSION['accountNumber']) && !isset($_SESSION['id']) && !isset($_SESSION['timeout']) ) : header("location: logout.inc.php"); ?>

    <?php elseif ((time() - $_SESSION['timeout']) > 900) : header("location: logout.inc.php"); ?>

    <?php elseif ($_SESSION['verified'] == 0) : header("location: logout.inc.php"); ?>



    <?php elseif ($_SESSION['accountNumber'] == false) : header("location: logout.inc.php"); ?>


     <?php else: ?>

     <?php endif;
     
error_reporting(0);
?>