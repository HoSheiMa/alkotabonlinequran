<?php


if (file_exists('../config/db_config.php')) {

    include '../config/db_config.php';
} else {

    include 'config/db_config.php';
}

include '../functions/functions_login.php';

include '../Class/LOGIN_SESSION.php';

include '../Class/Admin.php';


if (!isset($_POST['req'])) return;
$req  = $_POST['req'];



if ($req == "login"){

    // post req
    
    $email = $_POST['email'];
    
    $pass  = $_POST['password'];
    
    $data = [$email, $pass];
    
    
    // checking if username & password is true

    if (found_email($data) == true) {

        $personLogin = new LOGIN_SESSION();

        $personLogin->_Connection($c);
        // checking is block or active :D 
        if ($personLogin->IsBlocked($email) == true) {
            echo 'false';
            return;
        }
        $a = new Admin();
        $a->_Connection($c);

        $date =  Date('d-m-Y');
        
        $personLogin->Login($email, 'user');

        if ($personLogin->IsToucher() == true) {
            $a->increaseLoginWebToDayForTeachers($date);
        } else {
            $a->increaseLoginWebToDay($date);
        }
        
        
        echo 'true';
        
    } else {
        echo 'false';
    }
    
} else if ($req == "logOut"){

    $personLoginOut = new LOGIN_SESSION();
        
    $personLoginOut->LogOut();


}

