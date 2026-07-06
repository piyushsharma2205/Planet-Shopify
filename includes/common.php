<?php

$con = mysqli_connect("mysql", "root", "root", "ecommerce");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
