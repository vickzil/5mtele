<script>
//this function controls paystack payment for MetroLite Plan
  function payMetroLite(){
    <?php 

    $sql="SELECT * FROM plans";

    $queryRun = mysqli_query($con,$sql); 

    $plan = mysqli_fetch_array($queryRun);

    $planAmount = $plan['metrolite'];

    ?>

    <?php

    $query="SELECT * FROM users WHERE accountNumber='$userid'";

    $result = mysqli_query($con,$query); 

    $user = mysqli_fetch_array($result);

    $userEmail = $user['email'];  
    $userFullname = $user['fullname'];  
    $userIdName = $user['username'];  
    $userPhone = $user['phone'];  


    ?>


    
    var handler = PaystackPop.setup({
      key: 'pk_test_18f4e3dec75530f3ce059ff055ae8556bfead856',
      email: '<?php echo $userEmail; ?>',
      amount: <?php echo $planAmount; ?>,
      currency: "NGN",
      ref: ''+Math.floor((Math.random() * 1000000000) + 1),
      metadata: {
         custom_fields: [
            {
                display_name: "<?php echo $userFullname; ?>",
                variable_name: "<?php echo $userIdName; ?>",
                value: "<?php echo $userPhone; ?>"
            }
         ]
      },
      callback: function(response){

          window.location.replace("pay-verify.php?ref="+response.reference);
      },
      onClose: function(){
          
      }
    });
    handler.openIframe();
  }










//this function controls paystack payment for MetroPush Plan
  function payMetroPush(){
    <?php 

    $sql="SELECT * FROM plans";

    $queryRun = mysqli_query($con,$sql); 

    $plan = mysqli_fetch_array($queryRun);

    $planAmount = $plan['metropush'];

    ?>

    <?php

    $query="SELECT * FROM users WHERE accountNumber='$userid'";

    $result = mysqli_query($con,$query); 

    $user = mysqli_fetch_array($result);

    $userEmail = $user['email'];  
    $userFullname = $user['fullname'];  
    $userIdName = $user['username'];
    $userPhone = $user['phone'];   




    ?>


    
    var handler = PaystackPop.setup({
      key: 'pk_test_18f4e3dec75530f3ce059ff055ae8556bfead856',
      email: '<?php echo $userEmail; ?>',
      amount: <?php echo $planAmount; ?>,
      currency: "NGN",
      ref: ''+Math.floor((Math.random() * 1000000000) + 1),
      metadata: {
         custom_fields: [
            {
                display_name: "<?php echo $userFullname; ?>",
                variable_name: "<?php echo $userIdName; ?>",
                value: "<?php echo $userPhone; ?>"
            }
         ]
      },
      callback: function(response){

          alert('success. transaction ref is ' + response.reference);
      },
      onClose: function(){
          
      }
    });
    handler.openIframe();
  }






//this function controls paystack payment for MetroBlast Plan
  function payMetroBlast(){
    <?php 

    $sql="SELECT * FROM plans";

    $queryRun = mysqli_query($con,$sql); 

    $plan = mysqli_fetch_array($queryRun);

    $planAmount = $plan['metroblast'];

    ?>

    <?php

    $query="SELECT * FROM users WHERE accountNumber='$userid'";

    $result = mysqli_query($con,$query); 

    $user = mysqli_fetch_array($result);

    $userEmail = $user['email'];  
    $userFullname = $user['fullname'];  
    $userIdName = $user['username'];
    $userPhone = $user['phone'];  




    ?>


    
    var handler = PaystackPop.setup({
      key: 'pk_test_18f4e3dec75530f3ce059ff055ae8556bfead856',
      email: '<?php echo $userEmail; ?>',
      amount: <?php echo $planAmount; ?>,
      currency: "NGN",
      ref: ''+Math.floor((Math.random() * 1000000000) + 1),
      metadata: {
         custom_fields: [
            {
                display_name: "<?php echo $userFullname; ?>",
                variable_name: "<?php echo $userIdName; ?>",
                value: "<?php echo $userPhone; ?>"
            }
         ]
      },
      callback: function(response){

          alert('success. transaction ref is ' + response.reference);
      },
      onClose: function(){
          
      }
    });
    handler.openIframe();
  }






//this function controls paystack payment for MetroBoost Plan
  function payMetroBoost(){
    <?php 

    $sql="SELECT * FROM plans";

    $queryRun = mysqli_query($con,$sql); 

    $plan = mysqli_fetch_array($queryRun);

    $planAmount = $plan['metroboost'];

    ?>

    <?php

    $query="SELECT * FROM users WHERE accountNumber='$userid'";

    $result = mysqli_query($con,$query); 

    $user = mysqli_fetch_array($result);

    $userEmail = $user['email'];  
    $userFullname = $user['fullname'];  
    $userIdName = $user['username'];
    $userPhone = $user['phone'];  




    ?>


    
    var handler = PaystackPop.setup({
      key: 'pk_test_18f4e3dec75530f3ce059ff055ae8556bfead856',
      email: '<?php echo $userEmail; ?>',
      amount: <?php echo $planAmount; ?>,
      currency: "NGN",
      ref: ''+Math.floor((Math.random() * 1000000000) + 1),
      metadata: {
         custom_fields: [
            {
                display_name: "<?php echo $userFullname; ?>",
                variable_name: "<?php echo $userIdName; ?>",
                value: "<?php echo $userPhone; ?>"
            }
         ]
      },
      callback: function(response){

          alert('success. transaction ref is ' + response.reference);
      },
      onClose: function(){
          
      }
    });
    handler.openIframe();
  }





//this function controls paystack payment for MetroEssential Plan
  function payMetroEssential(){
    <?php 

    $sql="SELECT * FROM plans";

    $queryRun = mysqli_query($con,$sql); 

    $plan = mysqli_fetch_array($queryRun);

    $planAmount = $plan['metroessential'];

    ?>

    <?php

    $query="SELECT * FROM users WHERE accountNumber='$userid'";

    $result = mysqli_query($con,$query); 

    $user = mysqli_fetch_array($result);

    $userEmail = $user['email'];  
    $userFullname = $user['fullname'];  
    $userIdName = $user['username'];
    $userPhone = $user['phone'];  

    ?>


    var handler = PaystackPop.setup({
      key: 'pk_test_18f4e3dec75530f3ce059ff055ae8556bfead856',
      email: '<?php echo $userEmail; ?>',
      amount: <?php echo $planAmount; ?>,
      currency: "NGN",
      ref: ''+Math.floor((Math.random() * 1000000000) + 1),
      metadata: {
         custom_fields: [
            {
                display_name: "<?php echo $userFullname; ?>",
                variable_name: "<?php echo $userIdName; ?>",
                value: "<?php echo $userPhone; ?>"
            }
         ]
      },
      callback: function(response){

          alert('success. transaction ref is ' + response.reference);
      },
      onClose: function(){
          
      }
    });
    handler.openIframe();
  }




//this function controls paystack payment for MetroBusiness Plan
  function payMetroBusiness(){
    <?php 

    $sql="SELECT * FROM plans";

    $queryRun = mysqli_query($con,$sql); 

    $plan = mysqli_fetch_array($queryRun);

    $planAmount = $plan['metrobusiness'];

    ?>

    <?php

    $query="SELECT * FROM users WHERE accountNumber='$userid'";

    $result = mysqli_query($con,$query); 

    $user = mysqli_fetch_array($result);

    $userEmail = $user['email'];  
    $userFullname = $user['fullname'];  
    $userIdName = $user['username'];
    $userPhone = $user['phone'];  

    ?>


    var handler = PaystackPop.setup({
      key: 'pk_test_18f4e3dec75530f3ce059ff055ae8556bfead856',
      email: '<?php echo $userEmail; ?>',
      amount: <?php echo $planAmount; ?>,
      currency: "NGN",
      ref: ''+Math.floor((Math.random() * 1000000000) + 1),
      metadata: {
         custom_fields: [
            {
                display_name: "<?php echo $userFullname; ?>",
                variable_name: "<?php echo $userIdName; ?>",
                value: "<?php echo $userPhone; ?>"
            }
         ]
      },
      callback: function(response){

          alert('success. transaction ref is ' + response.reference);
      },
      onClose: function(){
          
      }
    });
    handler.openIframe();
  }



</script>