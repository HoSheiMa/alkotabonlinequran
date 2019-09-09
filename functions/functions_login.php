<?php



require '../config/db_config.php';

function found_email($data) {

    // make global
    global $c;

    $email = $data[0];

    $pass  = $data[1];

    // form sql


    if (strlen($email) <= 5)  {
        return false;
    }
    if (strlen($pass) <= 5) { 
        return false;
    }



    $q = "SELECT * FROM `users` WHERE `email`='$email' AND `pass`='$pass'";

    $r = mysqli_query($c, $q)->num_rows;

    if ($r == 1) {
        return true;
    } else {
        
        return false;

    }

    


}