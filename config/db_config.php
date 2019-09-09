<?php
$host = 'localhost';
$user = 'myuser';
$pass = 'mypassword';
$db = 'db';

$c = mysqli_connect($host, $user, $pass, $db);

$_http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http';

$_name = $_SERVER['SERVER_NAME'];

$_url = $_http . '://' . $_name;
