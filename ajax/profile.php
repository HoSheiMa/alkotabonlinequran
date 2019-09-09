<?php

session_start();

include '../config/db_config.php';
include '../Class/meet.php';
include_once '../Class/LOGIN_SESSION.php';
include_once '../Class/Teacher.php';

if (isset($_POST['req'])) {
    $req = $_POST['req'];
    
    
    if ($req == "Getinfo" && isset($_POST['type'])) {
        
        $t = $_POST['type'];
        
        if ($t == "user") {

            $l = new LOGIN_SESSION();
            $l->_Connection($c);


            echo $l->ProfileInfo(null);






        }

    } else if ($req == "NewPassword") {
        if (isset($_POST['NewPassword'])) {
            $p = $_POST['NewPassword'];


            $l = new LOGIN_SESSION();
            $l->_Connection($c);

            $l->NewPassword(null, $p);



        }
    } else if ($req == "UploadNewImage") {

        if (isset($_FILES['profile_img'])) {
            $l = new LOGIN_SESSION();
            $l->_Connection($c);

            $l = $l->UploadProfileImage($_FILES['profile_img']);
            $url = $l->url;
            $l->UploadImageURL(null, $url);
            
            
        }
    } else if ($req == "teacher_profile") {
        if (isset($_POST['email'])) {
            $t = $_POST['email'];

            $l = new Teacher();
            $l->_Connection($c);

            echo $l->TeacherFullProfile($t);

        }
    }else if ($req == "GetSalaryHistroy") {
        $l = new LOGIN_SESSION;
        $h = new helper;
        $h->_Connection($c);
        $l->_Connection($c);


        if ($l->IsToucher() != true) return;


        $e = $_SESSION['who'];

        $d = $h->GetAll('toucherinfo', [
            [
            "ID", "=", $e,
            ]
        ], false, true);

        $d = $h->filterJustReturn($d, [11, 13]);// ["Total_salary_history", "TotalSalaryDoneTake"]);

        $d = $d[0];

        $d[0] = json_decode($d[0]);
        $d[1] = json_decode($d[1]);

        echo $h->ToJSON($d);







    } 

}