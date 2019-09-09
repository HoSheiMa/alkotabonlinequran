<?php


include '../Class/Payment.php';
include '../Class/LOGIN_SESSION.php';
include '../Class/helper.php';
include '../Class/Teacher.php';
include '../config/db_config.php';

if (session_id() == '') {

    session_start();
}

if (!isset($_POST['req'])) return;

$req  = $_POST['req'];



if ($req == "ReturnValidLinkPayment"){

    
    
    if (!isset($_SESSION['WaitingMeet'])) echo '{"error" : "not valid reqeust"}';
    
    $s = new Teacher();
  
    $te = $_SESSION['WaitingMeet'][0]; // teacher email

    $cost = $s->GetSalaryFromEmail($c, $te); // cost = teacher salary for one meet


    $p = new paypal();

    $link = $p->CreatePayLink($cost,
    // 'http://localhost/project5/auto/payment.php?state=paymentSuccess',
    // 'http://localhost/project5/auto/payment.php?state=paymentCancel',
    // 'http://localhost/project5/auto/payment.php?state=paymentError'
    // for test in my localhost
    "$_url/auto/payment.php?state=paymentSuccess",
    "$_url/auto/payment.php?state=paymentCancel",
    "$_url/auto/payment.php?state=paymentError"
    
    );


    echo $link;





} else if ($req == "GetallCashingTeachere") {

    
    $l = new LOGIN_SESSION;

    $l->_Connection($c);
    
    if ($l->IsAdmin() == false) return;

    $h = new helper;

    $h->_Connection($c);


    $d = $h->GetAll('toucherinfo', [], false, true); // should type be true to not be just numbers D:

    $d = $h->filterJustReturn($d, [0, 9]);

    echo $h->ToJSON($d);


    

}else if ($req == "CashGiven") {

    $l = new LOGIN_SESSION;

    $l->_Connection($c);

    if ($l->IsAdmin() == false) return;

    if (!isset($_POST['email'])) return;

    $email = $_POST['email'];

    $h = new helper;

    $h->_Connection($c);


    $d = $h->GetAll('toucherinfo', [
        ["ID", "=", "$email"]
    ], 1, false);

    $d = $d[0];

    $SalaryHistoryTakeFromWeb = json_decode($d['SalaryHistoryTakeFromWeb'], true);

    $TotalSalaryHaveNowFRomMeets = (int) $d['TotalSalaryHaveNowFRomMeets'];

    if ($TotalSalaryHaveNowFRomMeets == "0" || $TotalSalaryHaveNowFRomMeets == 0) return;

    $TotalSalaryDoneTake = (int) $d['TotalSalaryDoneTake'];

    $TotalSalaryDoneTake = $TotalSalaryDoneTake + $TotalSalaryHaveNowFRomMeets;


    $today = date("d-m-Y");

    array_push(
        $SalaryHistoryTakeFromWeb,
        array("DATE" => $today, "SalaryUsed" => "$TotalSalaryHaveNowFRomMeets")
    );


    $SalaryHistoryTakeFromWeb = $h->ToJSON($SalaryHistoryTakeFromWeb);


    $h->Update('toucherinfo', [
        ["SalaryHistoryTakeFromWeb", $SalaryHistoryTakeFromWeb],
        ["TotalSalaryHaveNowFRomMeets", "0"],
        ["TotalSalaryDoneTake", "$TotalSalaryDoneTake"]
    ],  [
        ["ID", "=", "$email"]
    ], false);

} else if ($req == "GetValidLinkBuyDeals") {

    if (!isset($_POST['Deal_id'])) echo '{"error" : "not valid reqeust"}';
    

    $Deal_id = $_POST['Deal_id'];


    $h = new helper;

    $h->_Connection($c);

    $cost = $h->GetAll('deals', [
        ['id', '=', $Deal_id],
    ], 1, false)[0]['Salary'];

    if (empty($cost)) return;

    $_SESSION['WaitingDeal'] = array(
        "id"=> $Deal_id
    );

    $p = new paypal();

    $link = $p->CreatePayLink($cost,
    // "http://localhost/project5/auto/payment_deal.php?state=paymentSuccessdeal",
    // "http://localhost/project5/auto/payment_deal.php?state=paymentCanceldeal",
    // "http://localhost/project5/auto/payment_deal.php?state=paymentErrordeal"
    // this for test in localhost
    "$_url/auto/payment_deal.php?state=paymentSuccessdeal",
    "$_url/auto/payment_deal.php?state=paymentCanceldeal",
    "$_url/auto/payment_deal.php?state=paymentErrordeal"
    );

    echo $link;





}
