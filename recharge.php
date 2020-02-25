<?php   
require 'dbconfig.php';
require 'controller/settings.php';
?>

<!doctype html>
<html lang="en" dir="ltr">
  <?php $GLOBALS['title'] = "Recharge | Saturn Tech Portal"; include 'components/head.php'; ?>

        <?php $page = 'recharge'; include 'components/navbar.php'; ?>

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
              <i class="fe fe-credit-card mr-2"></i> RECHARGE
              </h1>
            </div>
            <div class="row row-cards recharge-row">
              <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                  <div class="card-body p-5">
                    <div class="row">
                      <div class="col-md-12 d-flex justify-content-center align-items-center">
                        <div><b class="h4">Your ST Account:</b> <span class="ml-4 tag tag-warning text-dark font-weight-bold"> <?php echo $user['accountNumber']; ?></span>
                       </div>
                      </div>
                      <div class="col-md-12 mt-4 d-flex justify-content-center align-items-center">
                          <?php if ($user['currentplan'] == null){ ?>
                            <div><b class="h4">Current Plan:</b> <span class="ml-4 tag tag-gray"> No Plan Yet</span>
                            </div>

                          <?php } else { ?>
                            <div><b class="h4">Current Plan:</b> <span class="ml-4 tag tag-success" style="background: #17174a;"> <?php echo $user['currentplan']; ?></span>
                            </div>
                          <?php } ?>
                       </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                <h2 class=" text-muted text-center" style="margin-top: 60px;margin-bottom: 60px;"><b>Our flexible MetroFi Plans</b></h2>
                
                <div class="row recharge-row-all">
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body text-center">
                        <h4 class="text-success">MetroFi Lite</h4>
                        <div class="h1 my-4"><span>&#8358;</span>120<sub>/Hr</sub></div>
                        <ul class="list-unstyled leading-loose">
                          <li class="h4 my-4"><strong>Hourly payments Subscription</strong></li>
                          <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> An Hour Access</li>
                          <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> Premium Speed at 3/1mbps</li>
                          <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> No Downtime</li>
                        </ul>
                        <div class="text-center mt-6">
                          <form>
                            <script src="https://js.paystack.co/v1/inline.js"></script>
                            <button type="button" class="btn btn-green btn-block" onclick="payMetroLite()"> Recharge <i class="fe fe-arrow-right-circle ml-1"></i> </button> 
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body text-center">
                        <h4 class="text-success">MetroFi Push</h4>
                        <div class="h1 my-4"><span>&#8358;</span>500<sub>/12Hr</sub></div>
                        <ul class="list-unstyled leading-loose">
                          <li class="h4 my-4"><strong>12 Hours payments Subscription</strong></li>
                          <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> An Hour Access</li>
                          <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> Premium Speed at 3/1mbps</li>
                          <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> No Downtime</li>
                        </ul>
                        <div class="text-center mt-6">
                          <form>
                            <script src="https://js.paystack.co/v1/inline.js"></script>
                            <button type="button" class="btn btn-green btn-block" onclick="payMetroPush()"> Recharge <i class="fe fe-arrow-right-circle ml-1"></i> </button> 
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body text-center">
                        <h4 class="text-success">MetroFi Blast</h4>
                        <div class="h1 my-4"><span>&#8358;</span>800<sub>/Day</sub></div>
                        <ul class="list-unstyled leading-loose">
                          <li class="h4 my-4"><strong>Daily payments Subscription</strong></li>
                          <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> Daily Access</li>
                          <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> Premium Speed at 3/1mbps</li>
                          <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> No Downtime</li>
                        </ul>
                        <div class="text-center mt-6">
                          <form>
                            <script src="https://js.paystack.co/v1/inline.js"></script>
                            <button type="button" class="btn btn-green btn-block" onclick="payMetroBlast()"> Recharge <i class="fe fe-arrow-right-circle ml-1"></i> </button> 
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="row recharge-row-all">
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body text-center">
                        <h4 class="text-success">MetroFi Boost</h4>
                        <div class="h1 my-4 recharge-row-heading"><span>&#8358;</span>3000<small><sub>/week</sub></small></div>
                        <ul class="list-unstyled leading-loose">
                          <li class="h4 my-4"><strong>Weekly payments Subscription</strong></li>
                          <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> Weekly Access</li>
                          <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> Premium Speed at 3/1mbps</li>
                          <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> No Downtime</li>
                        </ul>
                        <div class="text-center mt-6">
                          <form>
                            <script src="https://js.paystack.co/v1/inline.js"></script>
                            <button type="button" class="btn btn-green btn-block" onclick="payMetroBoost()"> Recharge <i class="fe fe-arrow-right-circle ml-1"></i> </button> 
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body text-center">
                        <h4 class="text-success">MetroFi Essential</h4>
                        <div class="h1 my-4"><span>&#8358;</span>7,200<small><sub>/monthly</sub></small></div>
                        <ul class="list-unstyled leading-loose">
                          <li class="h4 my-4"><strong>Monthly payments Subscription</strong></li>
                          <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> Monthly Access</li>
                          <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> Premium Speed at 3/1mbps</li>
                          <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> No Downtime</li>
                        </ul>
                        <div class="text-center mt-6">
                          <form>
                            <script src="https://js.paystack.co/v1/inline.js"></script>
                            <button type="button" class="btn btn-green btn-block" onclick="payMetroEssential()"> Recharge <i class="fe fe-arrow-right-circle ml-1"></i> </button> 
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body text-center">
                        <h4 class="text-success">MetroFi Business</h4>
                        <div class="h1 my-4"><span>&#8358;</span>12,000<small><sub>/monthly</sub></small></div>
                        <ul class="list-unstyled leading-loose">
                          <li class="h4 my-4"><strong>Monthly payments Subscription</strong></li>
                          <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> Monthly Access</li>
                          <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> Premium Speed at 5/2mbps</li>
                          <li><i class="fe fe-check text-success mr-2" aria-hidden="true"></i> No Downtime</li>
                        </ul>
                        <div class="text-center mt-6">
                          <form>
                            <script src="https://js.paystack.co/v1/inline.js"></script>
                            <button type="button" class="btn btn-green btn-block" onclick="payMetroBusiness()"> Recharge <i class="fe fe-arrow-right-circle ml-1"></i> </button> 
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div> 
            </div>
          </div>
        </div>

<!-- Visit this file to setup paystck transaction Details -->
<?php require 'paystack-payment.php'; ?>

      <?php include 'components/footer.php'; ?>
</html>