<?php

session_start();

require("includes/common.php");

$user_id = $_SESSION['user_id'];

$item_id = $_GET['id'];

// add product to cart
$query="

INSERT INTO users_products(user_id,item_id,status)

VALUES('$user_id','$item_id','Added to cart')

";

mysqli_query($con,$query);

header("location:products.php");

?>