<?php   
require 'dbconfig.php';
require 'controller/settings.php';

?>

      <!-- plugin css -->
<link href="assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="assets/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />  
       <!-- Vendor js -->
<script src="assets/js/vendor.min.js"></script>
<!-- datatable js -->
<script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
<script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>
<script src="assets/libs/datatables/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/datatables/buttons.html5.min.js"></script>
<script src="assets/libs/datatables/buttons.flash.min.js"></script>
<script src="assets/libs/datatables/buttons.print.min.js"></script>
<script src="assets/libs/datatables/dataTables.keyTable.min.js"></script>
<script src="assets/libs/datatables/dataTables.select.min.js"></script>
<!-- Datatables init -->
<script src="assets/js/pages/datatables.init.js"></script>
<!-- App js -->
<script src="assets/js/app.min.js"></script>
<!doctype html>
<html lang="en" dir="ltr">
 
  <?php $GLOBALS['title'] = "Transaction | Saturn Tech Portal"; include 'components/head.php'; ?>


        <?php $page = 'transaction'; include 'components/navbar.php'; ?>

        <?php 

            $userid = $_SESSION['accountNumber'];

          $query="SELECT * FROM transactions WHERE transactionid='{$userid}'";

          $resultRun = mysqli_query($con,$query); 

          $transactionum = mysqli_num_rows($resultRun);


          ?>

        <div class="my-3 my-md-5">
          <div class="container">
            <div class="page-header">
              <h1 class="page-title text-default font-weight-bold">
              <i class="fa fa-clock-o"></i> MY TRANSACTION HISTORY
              </h1>
            </div>
            <div class="row row-cards">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h2 class="card-title text-success"><b>All Transaction Details</b></h2>
                    <p class="sub-header">
                      You can search by Name, Date, Data plan, Card serial Number or Balance.
                    </p>
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
                      <thead class="text-center">
                        <tr>
                          <th class="text-success">S/N</th>
                          <th class="text-success">Transaction ID</th>
                          <th class="text-success">Date Purchased</th>
                          <th class="text-success">Transaction Plan</th>
                          <th class="text-success">Amount Cost</th>
                        </tr>
                      </thead>
                      
                      
                      <tbody class="text-center">

                        <?php 

                        if($transactionum > 0) {

                          $i = 0;


                       while ($transaction = mysqli_fetch_assoc($resultRun)) {
                        $i++;
                        $transactionid = $transaction['transactionid'];
                        $transactionref = $transaction['transactionref'];
                        $transactiondate = $transaction['transactiondate']; 
                        $transactionplan = $transaction['transactionplan']; 
                        $transactionamount = $transaction['transactionamount'];
                        

                        ?>
                        <tr>
                          <td><?php echo $i ; ?></td>
                          <td><?php echo $transactionref ; ?></td>
                          <td>
                            <?php echo $transactiondate ; ?>
                          </td>
                          <td>
                            <?php echo $transactionplan ; ?>
                          </td>
                          <td>
                            <?php echo $transactionamount ; ?>
                          </td>
                        </tr>

                        <?php } ?>

                        <?php } else { ?>

                          <tr>
                            <td></td>
                            <td></td>
                            <td>
                              <center>No Transaction Made</center>
                            </td>
                            <td></td>
                            <td></td>
                          </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div> <!-- end card body-->
                </div> <!-- end card -->
              </div><!-- end col-->
            </div>
          <!-- end row-->
          </div>
        </div>
      <?php include 'components/footer.php'; ?>
                                                          
</html>