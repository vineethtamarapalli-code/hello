<?php
session_start();
include "db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/PHPMailer/src/PHPMailer.php";
require __DIR__ . "/PHPMailer/src/Exception.php";
require __DIR__ . "/PHPMailer/src/SMTP.php";

$email = $_POST['email'];
$otp = rand(100000, 999999);

// Secure the insert query
$stmt = mysqli_prepare($conn, "INSERT INTO users_otp(email, otp) VALUES(?, ?)");
mysqli_stmt_bind_param($stmt, "ss", $email, $otp);
mysqli_stmt_execute($stmt);

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    // add your Email 
    $mail->Username = "-----"; 
    // Add Your Email code 
    $mail->Password = "-----"; // WARNING: Move this to an environment variable (.env) later!
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    //Add Your Email
    $mail->setFrom("----", "OTP Verification");
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = "Your OTP Code";
    $mail->Body = "<h2>Your OTP is: <b>$otp</b></h2>";

    $mail->send();

    echo "<h2>OTP sent to email!</h2>";
    echo "
    <form action='verify.php' method='POST'>
        <input type='hidden' name='email' value='".htmlspecialchars($email)."'>
        <input type='text' name='otp' placeholder='Enter OTP' required>
        <button type='submit'>Verify OTP</button>
    </form>
    ";

} catch (Exception $e){
    echo "Error sending OTP. Please try again.";
}
?>
