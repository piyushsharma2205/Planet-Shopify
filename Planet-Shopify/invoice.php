<?php
require "includes/common.php";
session_start();

if(!isset($_SESSION['user_id'])){
header("location:index.php");
exit();
}

$user_id = $_SESSION['user_id'];
$order_id = $_GET['id']; // order id from users_products

$query = $query = "SELECT 

products.name,
products.price,

users_products.status,

payments.payment_method,
payments.created_at,

shipping_address.fullname,
shipping_address.address,
shipping_address.city,
shipping_address.state,
shipping_address.zipcode,
shipping_address.phone

FROM users_products

JOIN products
ON users_products.item_id = products.id

LEFT JOIN payments
ON payments.id = (
    SELECT MAX(id) FROM payments
)

JOIN shipping_address
ON shipping_address.email =
(
SELECT email_id FROM users WHERE id='$user_id'
)

WHERE users_products.id='$order_id'
AND users_products.user_id='$user_id'

LIMIT 1";

$result = mysqli_query($con,$query);

$row = mysqli_fetch_assoc($result);

/* invoice number */

$invoice_no = "INV".$order_id;

/* order date */

$date = date("d M Y h:i A",
strtotime($row['created_at']));
?>


<!DOCTYPE html>

<html>

<head>

<title>Invoice</title>

<link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<style>

body{
background:#f4f6f9;
font-family:Segoe UI;
}

/* container */

.invoice-box{

width:850px;
margin:40px auto;
background:white;
padding:40px;
border-radius:12px;
box-shadow:0 8px 25px rgba(0,0,0,0.15);

}

/* header */

.invoice-header{

display:flex;
justify-content:space-between;
border-bottom:2px solid #eee;
padding-bottom:15px;
margin-bottom:20px;

}

.logo{

font-size:22px;
font-weight:bold;
color:#0d6efd;

}

/* sections */

.section-title{

font-weight:bold;
margin-top:20px;
margin-bottom:10px;
color:#0d6efd;

}

/* table */

table{

width:100%;

}

th{

background:#0d6efd;
color:white;
padding:10px;

}

td{

padding:10px;

border-bottom:1px solid #eee;

}

/* total */

.total{

text-align:right;
font-size:18px;
font-weight:bold;
color:#0d6efd;

}

/* print button */

.print-btn{

margin-top:20px;

}

</style>

</head>


<body>


<div class="invoice-box">


<div class="invoice-header">

<div>

<div class="logo">

Planet Shopify

</div>

<div>

Online Shopping Store

</div>

</div>


<div>

<b>Invoice:</b> <?php echo $invoice_no; ?>

<br>

<b>Date:</b> <?php echo $date; ?>

</div>


</div>


<div class="section-title">

Customer Details

</div>


<p>

<b>Name:</b>

<?php echo $row['fullname']; ?>

<br>

<b>Address:</b>

<?php echo $row['address']; ?>,

<?php echo $row['city']; ?>,

<?php echo $row['state']; ?> -

<?php echo $row['zipcode']; ?>

<br>

<b>Phone:</b>

<?php echo $row['phone']; ?>

</p>


<div class="section-title">

Order Details

</div>


<table>

<tr>

<th>Product</th>

<th>Price</th>

<th>Status</th>

</tr>


<tr>

<td><?php echo $row['name']; ?></td>

<td>₹<?php echo $row['price']; ?></td>

<td>

<?php

if($row['status']=="Confirmed"){

echo "<span class='badge badge-success'>
Order Placed
</span>";

}
else{

echo "<span class='badge badge-warning'>
Pending
</span>";

}

?>

</td>

</tr>

</table>


<div class="total">

Total: ₹<?php echo $row['price']; ?>

</div>


<button
onclick="window.print()"
class="btn btn-success print-btn">

Print / Save PDF

</button>


</div>


</body>

</html>