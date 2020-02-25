<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
     <?php echo "<title>". $title . "</title>";   ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    
    <script src="./assets/js/require.min.js"></script>
    <script>
    requirejs.config({
    baseUrl: '.'
    });
    </script>
    <!-- Dashboard Core -->
    <link href="./assets/css/dashboard.css" rel="stylesheet" />
    <script src="./assets/js/dashboard.js"></script>
    <!-- c3.js Charts Plugin -->
    <link href="./assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="./assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/maps-google/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="./assets/plugins/input-mask/plugin.js"></script>
   
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" /> 

<style>

.col-md-5 .img-fluid.img-thumbnail {
width: 140px!important;
height: 140px!important;
}

.col-md-3 .img-fluid.img-thumbnail {
width: 140px!important;
height: 140px!important;
}

.file_btn {
display: none;
}

#form_input_subject {
display: none;
}

.alert_div {
position: absolute;
right: 10px;
top: 80px;
width: 500px;

}

#btn-loading,
#eye_hide,
#eye_c_hide,
#eye_n_hide {
display: none;
}

.nav-tabs .nav-link.active {
border-color: none!important;
border: none!important;
}

@media screen and (max-width: 568px) {

#mobile_profile_top {
margin-top: 25px!important;
}

.alert_div {
position: absolute;
right: 0px;
top: 80px;
width: 70%;

}

}
@media screen and (max-width: 428px) {

.my-profile.row.mt-3 .col-nd-5 {

display: flex!important;
justify-content: center!important;
align-items: center!important;
margin: auto!important;

}

.col-md-3 .img-fluid.img-thumbnail {
width: 180px!important;
height: 180px!important;
margin-bottom: 50px;
}

.col-md-5 .img-fluid.img-thumbnail {
width: 200px!important;
height: 190px!important;
text-align: center;
margin: 15px auto 10px!important;

}

#form_image {
margin-bottom: 30px;;
}

.page-title {
font-size: 22px!important;
}

.goto_edit.ml-auto.text-right {
display: flex;
justify-content: center;
align-items: center;
}

}

    </style> 
</head>

<?php  


      if ($GLOBALS['title']) {
        $title = $GLOBALS['title'];
      }
       else {
        $GLOBALS['title'] = "Welcome to 5Mtelecom Portal";
      }

    ?>

<body class="">
    <div class="page">
      <div class="page-main">