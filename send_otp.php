<?php
session_start();
include "db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/PHPMailer/src/PHPMailer.php";
require __DIR__ . "/PHPMailer/src/Exception.php";
require __DIR__ . "/PHPMailer/src/SMTP.php";

$email = $_POST['email'];
$otp = rand(100000,999999);

// store otp in database
mysqli_query($conn, "INSERT INTO users_otp(email,otp) VALUES('$email','$otp')");

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = "vineethsai249@gmail.com";     // your mail
    $mail->Password = "vkzngtkzvbxaqfvh";       // app password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom("vineethsai249@gmail.com","OTP Verification");
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = "Your OTP Code";
    $mail->Body = "<h2>Your OTP is: <b>$otp</b></h2>";

    $mail->send();

    echo "<h2>OTP sent to email!</h2>";
    echo "
    <form action='verify.php' method='POST'>
        <input type='hidden' name='email' value='$email'>
        <input type='text' name='otp' placeholder='Enter OTP'>
        <button type='submit'>Verify OTP</button>
    </form>
    ";

} catch (Exception $e){
    echo "Error sending OTP: {$mail->ErrorInfo}";
}
?>
