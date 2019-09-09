<?php



include '../config/db_config.php';

function Create_New_Email($name, $email, $password) {

    // for include a connections from config file 
    global $c;

    // form of sql to create a new email address
    $q = "INSERT INTO
     `users`(`email`, `pass`, `name`, `profile_img`,`BLOCK_STATE`, `freeCoursestrial`, `permission`) 
     VALUES ('$email','$password','$name', 'default.png','false', '[]', '" . 

     "{\"permission\" : \"No-admin-permission\" }')";


    //  echo $q;
    // checking process
    if (mysqli_query($c, $q)){

        return 'true';
    
    } else {

        return 'false';
    }


}