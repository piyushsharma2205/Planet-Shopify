<?php
require "includes/common.php";
session_start();

$email = $_POST['eMail'];
$email = mysqli_real_escape_string($con, $email);

$first = $_POST['firstName'];
$first = mysqli_real_escape_string($con, $first);

$last = $_POST['lastName'];
$last = mysqli_real_escape_string($con, $last);

$pass = $_POST['password'];
$pass = mysqli_real_escape_string($con, $pass);
$pass = md5($pass);

// Check whether email already exists
$query = "SELECT * FROM users WHERE email_id='$email'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {

    $m = "Email Already Exists";
    header("Location: index.php?error=" . urlencode($m));
    exit();

} else {

    $query = "INSERT INTO users(email_id, first_name, last_name, password)
              VALUES('$email', '$first', '$last', '$pass')";

    mysqli_query($con, $query);

    $user_id = mysqli_insert_id($con);

    $_SESSION['email'] = $email;
    $_SESSION['user_id'] = $user_id;

    header("Location: products.php");
    exit();
}
?>
