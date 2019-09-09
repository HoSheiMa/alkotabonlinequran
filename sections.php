<?php


// if not have $_GET['q'] return to index page;


include 'config/db_config.php';

if (!isset($_GET['q'])) {
    echo '<script>window.location.assign("index.php")</script>';
}

?>


<!DOCTYPE html>
<html>

<head>


    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?php echo $_GET['q']; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="lib/semantic.min.css">

    <link rel="stylesheet" media="screen" href="css/helper.css" />

    <link rel="stylesheet" href="lib/swiper.min.css">
    <link rel="stylesheet" href="./lib/jsCalendar.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.css">
    <link rel="stylesheet" href="lib/toastr.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/sections.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

</head>

<body>
  <div class='loading-page col text-center' style='padding-top: calc(50vh - 75px);'>
    <img src='assets/loading.gif'>
  </div>


  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="lib/semantic.min.js"></script>
<!-- <script src='lib/jquery.nicescroll.iframehelper.min.js'></script> -->
<!-- <script src='lib/jquery.nicescroll.min.js'></script> -->

<script src='lib/swiper.min.js'></script>

<script src="lib/particles.min.js"></script>


<script src="./lib/jsCalendar.min.js"></script>

<script src="./lib/moment-with-locales.min.js"></script>
<script src="./lib/moment-timezone-with-data.js"></script>
<script src="lib/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>


<link rel="stylesheet" href="sweetalert2/dist/sweetalert2.min.css">
<script src="sweetalert2/dist/sweetalert2.min.js"></script>

<!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script> -->

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script src="js/sections.js"></script>



    <div id='view' class='transition hidden'>
    <?php
    $q = explode('?', $_GET['q']);

    // var_dump($q);
    if (file_exists("html/{$q[0]}.php")) {

        if(isset($q[1])) {

            $get_arr = explode('&', $q[1]);
            
            for ($i=0; $i < sizeof($get_arr); $i++) {
                $get_arr_element = explode('=', $get_arr[$i]);
                if (isset($get_arr_element[0]) && isset($get_arr_element[1])){   
                    $_GET[$get_arr_element[0]] = $get_arr_element[1];
                }
            }
        }

        include "html/{$q[0]}.php";
    } else {
        echo 'error';
    }
    ?>
    </div>



    
</body>

</html>