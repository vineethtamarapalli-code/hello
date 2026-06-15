<?php
include "db.php";

$email = $_POST['email'];
$otp   = $_POST['otp'];

// Secure the query using Prepared Statements
$stmt = mysqli_prepare($conn, "SELECT otp FROM users_otp WHERE email=? ORDER BY id DESC LIMIT 1");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if ($row && $row['otp'] == $otp) {
    echo "<h2>OTP Verified Successfully ✔</h2>";
} else {
    echo "<h2>Invalid OTP ❌</h2>";
}
?>
