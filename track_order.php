<?php

require "includes/common.php";

session_start();

if(!isset($_SESSION['user_id'])){

header("location:index.php");

exit();

}

$user_id=$_SESSION['user_id'];

$order_id=$_GET['id']; // order id

$query="SELECT

products.name,
products.price,

users_products.status

FROM users_products

INNER JOIN products
ON users_products.item_id=products.id

WHERE users_products.user_id='$user_id'

AND users_products.id='$order_id'";

$result=mysqli_query($con,$query);

$row=mysqli_fetch_array($result);

if(!$row){

echo "Order not found";

exit();

}

?>
<!DOCTYPE html>

<html>

<head>

<title>Track Order</title>

<link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<style>

body{

background:#f5f5f5;

}

.track-box{

max-width:600px;

margin:40px auto;

background:white;

padding:30px;

border-radius:10px;

box-shadow:0 5px 20px rgba(0,0,0,0.15);

}

.step{

display:flex;

align-items:center;

margin-bottom:15px;

}

.circle{

width:25px;

height:25px;

border-radius:50%;

background:#ccc;

margin-right:10px;

}

.active{

background:#28a745;

}

</style>

</head>

<body>


<div class="track-box">

<h3>Order Tracking</h3>

<hr>

<p>

<b>Product:</b>

<?php echo $row['name']; ?>

</p>

<p>

<b>Price:</b>

₹<?php echo $row['price']; ?>

</p>

<p>

<b>Status:</b>

<?php
$status = $row['status'];
?>

<div class="step">
<div class="circle active"></div>
Order Placed
</div>

<div class="step">
<div class="circle <?php echo ($status=='Confirmed')?'active':''; ?>"></div>
Confirmed
</div>

<div class="step">
<div class="circle <?php echo ($status=='Shipped')?'active':''; ?>"></div>
Shipped
</div>

<div class="step">
<div class="circle <?php echo ($status=='Out for Delivery')?'active':''; ?>"></div>
Out for Delivery
</div>

<div class="step">
<div class="circle <?php echo ($status=='Delivered')?'active':''; ?>"></div>
Delivered
</div>


</div>

</body>

</html>