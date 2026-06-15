<?php
include "db.php";

$email = $_POST['email'];
$otp   = $_POST['otp'];

$query = mysqli_query($conn, "SELECT * FROM users_otp WHERE email='$email' ORDER BY id DESC LIMIT 1");
$row = mysqli_fetch_assoc($query);

if($row['otp'] == $otp){
    echo "<h2>OTP Verified Successfully ✔</h2>";
} else {
    echo "<h2>Invalid OTP ❌</h2>";
}
?>
