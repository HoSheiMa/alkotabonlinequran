<?php
use PayPal\Api\Payment;

if (session_id() == '') {
    session_start();
}

include '../Class/Payment.php';
include '../Class/helper.php';
include '../config/db_config.php';



if (isset($_SESSION['WaitingDeal'])){

    if (
        !isset($_SESSION['WaitingDeal']['id']) 
        ) return;
 
    $d = $_SESSION['WaitingDeal'];

    $dealid = $d['id'];
    
    
}



if (
    !isset($_GET['paymentId']) ||
    !isset($_GET['PayerID']) ||
    !isset($_GET['state'])
) {
    echo "
    <script>

    window.location.assign('../sections.php?q=dashboard?paymentCanceldeal');
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

    window.location.assign('../sections.php?q=dashboard?paymentCanceldeal');
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

    window.location.assign('../sections.php?q=dashboard?paymentErrordeal');
    </script>

    ";
} else {


    $h = new helper;

    $h->_Connection($c);

    $me = $_SESSION['who'];

    $hoursHave = (int) $h->GetAll('users', [
        ["email", "=", "$me"]
    ], 1, false)[0]['BuyHoursInDeal'];

    $dealjsondata = json_decode(
            $h->GetAll('deals', [
                ["id", "=", "$dealid"]
            ], 1, false)[0]['json_data']
        , true);

    $hourseHaveNow = json_decode(
        $h->GetAll('deals', [
            ["id", "=", "$dealid"]
        ], 1, false)[0]['hours']
    , true);


    $hoursHave = $hoursHave + $hourseHaveNow ;

    $h->Update('users',[
        ["BuyHoursInDeal", "$hoursHave"]
    ] ,[
        ["email", "=", "$me"]
    ], false);
    
    $date =  Date('d-m-Y');

    array_push($dealjsondata, array(
        "date"=>"$date",
        "user"=>"$me"
    ));

    $dealjsondata = json_encode($dealjsondata, true);

    $h->Update('deals', [
        ['json_data', $dealjsondata]
    ], [
        ["id", "=", "$dealid"]
    ],false);


    echo "
    <script>
        window.location.assign('../sections.php?q=dashboard?paymentSuccessdeal');
    </script>
    ";
}

// echo var_dump($_GET);
