<?php
session_start();    
// connect to database!
include '../config/db_config.php';

// helper functions 
require '../functions/functions_singup.php';


// info from post
$fullname = $_POST['name'];

$password = $_POST['password'];

$repassword = $_POST['repassword'];

$email = $_POST['email'];

// test password
if ($password != $repassword) return 'ccc';

// send to data base

echo Create_New_Email($fullname, $email, $password);

// create login session to active logig email :D 













