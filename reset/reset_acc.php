<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once 'vendor/autoload.php';


include '../config/db_config.php';
if (!isset( $_POST['email'])) return;
$email = $_POST['email'];









$q = "SELECT * FROM `users` WHERE `email`='$email'";
$r = mysqli_query($c, $q);
// echo $r->num_rows;


// if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
//     $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// } else {
//     $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// }

$actual_link = 'http://nshama.net';
$name = 'nshama';
$dom = 'net';

if ($r->num_rows > 0) {

    $q = "SELECT * FROM `recovery` WHERE `email`='$email'";
    $r = mysqli_query($c, $q);
    if ($r->num_rows > 0) {
        $q = "DELETE FROM `recovery` WHERE `email`='$email'";

        mysqli_query($c, $q);

    }

    $key = 'key' . uniqid('', true);
    $q = "INSERT INTO `recovery`(`email`, `key`) VALUES ('$email','$key')";
    mysqli_query($c, $q);


    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
    //Server settings
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 0;
                             // Enable verbose debug output
        // $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Port = 587;                                    // TCP port to connect to
        $mail->Username = '';
        $mail->Password = '';                       // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted

    //Recipients
        $mail->setFrom("admin@info.com", "Reset Password");
        $mail->addAddress("$email");    // Name is optional

        $mail->setLanguage('ar', '/optional/path/to/language/directory/');

        $http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http';
        $name = $_SERVER['SERVER_NAME'];

        //$uri = $_SERVER['REQUEST_URI'];

        $_url = $http . '://' . $name;



        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'استرجاع الايمال';
        $mail->Body =
            "

        <div style=\"text-center\">
       <h3> هذا الرابط صالح مرة واحدة فقط سوف تستطيع فتح الايمال الخاص بيك و تغير الرقم السري</h3>" .

            " <a href='$_url/reset/redir.php?key=$key'>اضغط هنا</a> ";
        $mail->AltBody = '';

        $mail->send();
        echo 'true';
    } catch (Exception $e) {
        echo "false $e";
    }

} else {
    echo 'false';
}
