<?php   
require 'dbconfig.php';
require 'controller/settings.php';

?>
<!doctype html>
<html lang="en" dir="ltr">
  <?php $GLOBALS['title'] = "Welcome to Saturn Tech Portal"; include 'components/head.php'; ?>

        <?php $page = 'home'; include 'components/navbar.php'; ?>

        <?php 

          $userid = $_SESSION['accountNumber'];

          $query="SELECT * FROM users WHERE accountNumber='$userid'";

          $result = mysqli_query($con,$query); 

          $user = mysqli_fetch_array($result);

          $userEmail = $user['email'];

          $userAccountDuration = $user['accountduration'];

          $userAccountExpire = date("Y-m-d", strtotime(date("Y-m-d", strtotime($userAccountDuration)). " + 40 day"));



          ?>

        <div class="my-3 my-md-5">
          <div class="container">
            <div class="page-header">
              <h1 class="page-title text-default font-weight-bold">
              <i class="fa fa-tachometer"></i> DASHBOARD
              </h1>
            </div>
            <div class="row row-cards">
              <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                  <div class="card-body p-5">
                    <div class="row">
                      <div class="col-md-5 text-center d-flex justify-content-center align-items-center account-title">
                        <div class="h1 m-0 text-muted">Account Details: </div>
                      </div>
                      <div class="col-md-7">
                        <div class="account-boxes">
                          <div class="account-box">
                            <div class="text-success mb-4">Current Amount Recharged</div>
                            <div class="text-success mb-4">Account Status</div>
                            <div class="text-success mb-4">Account Duration</div>
                            <div class="text-success mb-4">Account Expiry</div>
                          </div>
                          <div class="account-box">

                            <div class="text-inherit mb-4 h4"><span>&#8358;</span> 
                              <?php echo $user['balance']; ?>
                            </div>

                              <?php if ($user['balance'] == 0) { ?>
                                <div class="text-light mb-4 h4 badge bg-gray">Not Active</div>
                                <div class="badge bg-warning mb-2" id="exampleModal4">
                                Please Recharge !
                              </div>
                             <?php } else { ?>

                              <div class="text-light mb-4 h4 badge bg-success">Active</div>

                            <?php } ?>

                            <?php if ($user['balance'] == 0) { ?>
                                <div class="text-light mb-4 h4"><span class="tag tag-gray text-light"><?php echo $user['accountduration']; ?></span></div>
                             <?php } else { ?>

                              <div class="text-inherit mb-4 h4"><span class="tag tag-warning text-light" id="response" style="background: #17174a;"></span></div>

                            <?php } ?>

                            <?php if ($user['balance'] == 0) { ?>
                                <div class="text-light mb-4 h4"><span class="tag tag-gray text-light"><?php echo $user['accountexpire']; ?></span></div>
                             <?php } else { ?>

                              <div class="text-inherit mb-4 h4"><span class="tag tag-warning text-light" id="timing" style="background: #17174a;"><?php echo $userAccountExpire; ?></span></div>

                            <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>

            <?php

            if (date("Y-m-d") < $userAccountExpire) {
              echo "Account Is Active";
            } else {

              echo "Account Has Expired";
            }





            ?>

            <div class="text-inherit mb-4 h4">
              <span class="tag tag-warning text-dark"></span>
            </div>

            <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Monthly Average Temperature</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-temperature" style="height: 16rem"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                    $(document).ready(function(){
                      var chart = c3.generate({
                        bindto: '#chart-temperature', // id of chart wrapper
                        data: {
                          columns: [
                              // each columns data
                            ['data1', 7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
                            ['data2', 3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
                          ],
                          labels: true,
                          type: 'line', // default type of chart
                          colors: {
                            'data1': tabler.colors["yellow"],
                            'data2': tabler.colors["blue"]
                          },
                          names: {
                              // name of each serie
                            'data1': 'Abuja',
                            'data2': 'Lagos'
                          }
                        },
                        axis: {
                          x: {
                            type: 'category',
                            // name of each category
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec']
                          },
                        },
                        legend: {
                                  show: false, //hide legend
                        },
                        padding: {
                          bottom: 0,
                          top: 0
                        },
                      });
                    });
                  });
                </script>
            </div>
            
            
            
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h2 class="card-title text-muted"><b>Transactions Made</b></h2>
                  <div class="ml-auto text-right">
                    <a class="btn btn-outline-dark btn-sm" href="transaction-history">
                      <i class="fa fa-eye"></i> View All
                    </a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table card-table table-vcenter text-nowrap">
                    <thead class="text-center">
                      <tr>
                        <th class="text-success">S/N</th>
                        <th class="text-success">Transaction ID</th>
                        <th class="text-success">Date Purchased</th>
                        <th class="text-success">Transaction Plan</th>
                        <th class="text-success">Amount Cost</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php 

                      $sql="SELECT * FROM transactions WHERE transactionid='{$userid}' LIMIT 5";

                      $SqlRun = mysqli_query($con,$sql); 

                      $transactionum = mysqli_num_rows($SqlRun); 

                        if($transactionum > 0) {

                          $i = 0;


                       while ($transaction = mysqli_fetch_assoc($SqlRun)) {
                        $i++;
                        $transactionid = $transaction['transactionid'];
                        $transactionref = $transaction['transactionref'];
                        $transactiondate = $transaction['transactiondate']; 
                        $transactionplan = $transaction['transactionplan']; 
                        $transactionamount = $transaction['transactionamount'];
                        

                        ?>
                        <tr class="text-center">
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
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php include 'components/footer.php'; ?>
    <script>
      setInterval(function(){

        var xmlhttp=new XMLHttpRequest();

        xmlhttp.open("GET", "response.php", false);
        xmlhttp.send(null);

        document.getElementById('response').innerHTML=xmlhttp.responseText;


      },1000);
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