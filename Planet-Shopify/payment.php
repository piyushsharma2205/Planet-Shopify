<?php
session_start();
include('config.php');

if(!isset($_SESSION['user_id'])){
header("location: login.php");
exit();
}

$user_id = $_SESSION['user_id'];

/* get total cart amount */

$sql_total = "SELECT SUM(products.price) as total
FROM users_products
JOIN products ON users_products.item_id = products.id
WHERE users_products.user_id='$user_id'
AND users_products.status='Added to cart'";

$result_total = mysqli_query($conn,$sql_total);
$row_total = mysqli_fetch_assoc($result_total);

$total_amount = $row_total['total'] ?? 0;


/* place order */

if(isset($_POST['place_order'])){

$payment_method = "Cash on Delivery";
$status = "Pending";

/* save payment */

$insert_payment = "INSERT INTO payments
(payment_method,amount,status)

VALUES
('$payment_method','$total_amount','$status')";

mysqli_query($conn,$insert_payment);


/* update order */

$confirm_order = "UPDATE users_products
SET status='Confirmed'

WHERE user_id='$user_id'
AND status='Added to cart'";

mysqli_query($conn,$confirm_order);


/* redirect */

header("location:order_confirmed.php");
exit();

}
?>


<!DOCTYPE html>

<html>

<head>

<title>Checkout</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>

body{

background: linear-gradient(120deg,#00bfa5,#1de9b6);

font-family:Segoe UI;

}


/* main box */

.checkout-box{

width:520px;

background:white;

margin:80px auto;

padding:35px;

border-radius:18px;

box-shadow:0 8px 25px rgba(0,0,0,0.2);

}


/* title */

.title{

font-size:22px;

font-weight:600;

margin-bottom:20px;

text-align:center;

}


/* amount box */

.amount-box{

background:#f8f9fa;

padding:15px;

border-radius:10px;

margin-bottom:20px;

text-align:center;

font-size:18px;

font-weight:500;

}


/* payment option */

.payment-option{

border:2px solid #e9ecef;

padding:15px;

border-radius:12px;

cursor:pointer;

transition:.3s;

}

.payment-option:hover{

border-color:#00bfa5;

background:#f1fffb;

}


/* icon */

.icon{

font-size:22px;

margin-right:10px;

color:#00bfa5;

}


/* button */

.btn-order{

background:#00bfa5;

border:none;

padding:12px;

font-size:16px;

border-radius:10px;

width:100%;

color:white;

margin-top:20px;

}

.btn-order:hover{

background:#009f8c;

}


/* security */

.secure{

margin-top:15px;

text-align:center;

font-size:14px;

color:#666;

}

</style>

</head>


<body>


<div class="checkout-box">


<div class="title">

Secure Checkout

</div>


<div class="amount-box">

Total Amount :
<b>

₹ <?php echo $total_amount; ?>

</b>

</div>


<form method="post">

<div class="payment-option">
<input type="radio" name="payment_method" checked>
💵 Cash on Delivery
</div>

<button name="place_order" class="btn-order">
Place Order
</button>

</form>


<div class="secure">

🔒 100% Secure Payment

</div>


</div>


</body>

</html>