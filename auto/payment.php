<?php
use PayPal\Api\Payment;

if (session_id() == '') {
    session_start();
}

include '../Class/Payment.php';
include '../Class/meet.php';
include '../config/db_config.php';



if (isset($_SESSION['WaitingMeet'])){

    if (
        !isset($_SESSION['WaitingMeet'][0]) ||
        !isset($_SESSION['WaitingMeet'][1]) ||
        !isset($_SESSION['WaitingMeet'][2]) ||
        !isset($_SESSION['WaitingMeet'][3]) ||
        !isset($_SESSION['WaitingMeet'][4]) ||
        !isset($_SESSION['WaitingMeet'][5])
        ) return;
 
    $d = $_SESSION['WaitingMeet'];
    $t = $d[0];
    $date = $d[1];
    $datetime = $d[2];
    $time = $d[3];
    $TimZone = $d[4];
    $type = $d[5];
    $m = new meet();
    $m->AddNewMeet($c, $t, $date, $datetime, $time, $TimZone, $type);

    
}



if (
    !isset($_GET['paymentId']) ||
    !isset($_GET['PayerID']) ||
    !isset($_GET['state'])
) {
    echo "
    <script>

    window.location.assign('../sections.php?q=dashboard?paymentCancel');
    </script>

    ";
    return;
};
$p = new paypal();

$pId = $_GET['paymentId'];
$PayerID = $_GET['PayerID'];
$state = $_GET['state'];

if ($state == "paymentCancel") {
    echo "
    <script>

    window.location.assign('../sections.php?q=dashboard?paymentCancel');
    </script>

    ";
}


$p = $p->PaymentInject(
    $pId,
    $PayerID
);



if ($p == false) {
    echo "
    <script>

    window.location.assign('../sections.php?q=dashboard?paymentError');
    </script>

    ";
} else {
    echo "
    <script>
        window.location.assign('../sections.php?q=dashboard?paymentSuccess');
    </script>
    ";
}

// echo var_dump($_GET);
