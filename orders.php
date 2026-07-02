<?php
require "includes/common.php";
session_start();

if(!isset($_SESSION['user_id'])){
    header('location: index.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT 

users_products.id as order_id,

products.id as product_id,
products.name,
products.price,

payments.payment_method,
payments.status as payment_status,
payments.created_at

FROM users_products

JOIN products
ON users_products.item_id = products.id

LEFT JOIN payments
ON payments.id = users_products.id

WHERE users_products.user_id='$user_id'
AND users_products.status='Confirmed'

ORDER BY payments.created_at DESC";

$result = mysqli_query($con,$query) or die(mysqli_error($con));

$total = 0;
?>

<!DOCTYPE html>
<html>

<head>

<title>My Orders</title>

<link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<style>

body{
background:#f5f5f5;
}

.order-box{
background:white;
padding:25px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
margin-top:30px;
}

</style>

</head>

<body>

<div class="container">

<div class="order-box">

<h2>My Orders</h2>

<table class="table table-bordered mt-4">

<tr class="bg-dark text-white">

<th>Product</th>
<th>Price</th>
<th>Payment</th>
<th>Status</th>
<th>Invoice</th>
<th>Track</th>

</tr>

<?php

if(mysqli_num_rows($result)>0){

while($row = mysqli_fetch_assoc($result)){

$total += $row['price'];

?>

<tr>

<td>

<?php echo $row['name']; ?>

</td>

<td>

₹<?php echo $row['price']; ?>

</td>

<td>

<?php echo $row['payment_method']; ?>

</td>

<td>

<?php

if($row['payment_status']=="Pending"){

echo "<span class='badge badge-warning'>
Pending
</span>";

}
else{

echo "<span class='badge badge-success'>
Completed
</span>";

}

?>

</td>

<td>

<a href="invoice.php?id=<?php echo $row['order_id']; ?>"

class="btn btn-primary btn-sm">

Invoice

</a>

</td>

<td>

<?php if(isset($row['order_id'])){ ?>
<a href="track_order.php?id=<?php echo $row['order_id']; ?>" class="btn btn-info">
    Track Order
</a>
<?php } else { ?>
<span class="text-danger">Order ID missing</span>
<?php } ?>

</td>

</tr>

<?php

}

}

else{

echo "<tr>

<td colspan='7' align='center'>

No Orders Found

</td>

</tr>";

}

?>

<tr class="bg-light">

<td colspan="6" align="right">

<b>Total Amount</b>

</td>

<td>

<b>₹<?php echo $total; ?></b>

</td>

</tr>

</table>

</div>

</div>

</body>

</html>