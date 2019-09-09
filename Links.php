<?php

include_once './config/db_config.php';
include_once './Class/dashboard.php';
include_once './Class/PageViews.php';

if (!isset($_GET['q'])) {
    echo "<script>window.location.assign('../')</script>";
    return;
}
    
$pv = new PageViews;
$pv->_Connection($c);


$d = new dashboard();
$d->_Connection($c);

$data = $d->WebInfo();

$ico = $data['ico'];

$id = $_GET['q'];


$description = $pv->getdescription($id);
$keywords = $pv->getkeywords($id);
$title = $pv->gettitle($id);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon"  href="<?php echo $ico; ?>" />
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="keywords" content="<?php echo $keywords; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
    <?php echo $title; ?>
    </title>
    <link rel="stylesheet" href="lib/semantic.min.css">

<link rel="stylesheet" media="screen" href="css/style.css" />
<link rel="stylesheet" media="screen" href="css/helper.css" />
</head>
<body>
    
<div class="cover_nav_bar">
      <div class="ui small menu own_nav_bar">
      <?php
      

      echo $pv->getMenuLinks();
      ?>

<img style="position: absolute; right: 2%; top: 5%" width=70 height=70 src="<?php  echo $ico; ?>" />
</div>
 
        <div class="mobile-version">
          <i class="ui icon bars" onclick="$('.mobile-version-links').slideToggle('fast'); $(this).toggleClass('arrow').toggleClass('up').toggleClass('bars')"></i>
          <img src="<?php  echo $ico; ?>" />
        </div>
        <div class="mobile-version-links">
        <?php
      

      echo $pv->getMenuLinks();
      ?>
    </div>
        </div>


<div class="ui container" style="margin-top: 80px">

    <?php
echo $pv->getPageCode($id);
?>

</div>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script src="lib/semantic.min.js"></script>
  <script src='lib/jquery.nicescroll.iframehelper.min.js'></script>
  <script src='lib/jquery.nicescroll.min.js'></script>

  <script src='lib/swiper.min.js'></script>

  <script src="lib/particles.min.js"></script>


<script src="js/helper.js"></script>
  <script src="js/script.js"></script>


</body>
</html>