<?php

session_start();

require("includes/common.php");

if(!isset($_SESSION['admin'])){
header("location:admin_login.php");
exit();
}

/* update order status */

if(isset($_POST['update'])){

$order_id=$_POST['order_id'];

$status=$_POST['status'];

mysqli_query($con,"
UPDATE users_products
SET status='$status'
WHERE id='$order_id'
");

}

/* fetch orders */

$query="

SELECT 

users_products.id AS order_id,

users.id AS user_id,

users.first_name,
users.last_name,

products.name,

products.price,

users_products.status

FROM users_products

JOIN users
ON users_products.user_id = users.id

JOIN products
ON users_products.item_id = products.id

ORDER BY users_products.id DESC

";

$result=mysqli_query($con,$query);

?>

<!DOCTYPE html>

<html>

<head>

<title>Manage Orders</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

body{
margin:0;
font-family:Poppins;
background:#f3f4f6;
}

.sidebar{
width:240px;
height:100vh;
background:#111827;
color:white;
position:fixed;
padding-top:20px;
}

.sidebar h2{
text-align:center;
}

.sidebar a{
display:block;
padding:15px;
color:white;
text-decoration:none;
}

.sidebar a:hover{
background:#2563eb;
}

.main{
margin-left:240px;
padding:30px;
}

.table-box{
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 4px 10px rgba(0,0,0,0.05);
}

table{
width:100%;
border-collapse:collapse;
margin-top:20px;
}

th{
background:#2563eb;
color:white;
padding:12px;
text-align:left;
}

td{
padding:12px;
border-bottom:1px solid #eee;
}

tr:hover{
background:#f1f5f9;
}

.title{
font-size:22px;
margin-bottom:10px;
}

select{
padding:6px;
}

button{
background:#2563eb;
color:white;
border:none;
padding:6px 12px;
cursor:pointer;
}

button:hover{
background:#1e40af;
}

</style>

</head>

<body>

<!-- same sidebar as monthly sales -->

<div class="sidebar">

<h2>Admin Panel</h2>

<a href="admin_dashboard.php">Dashboard</a>

<a href="monthly_sales.php">Monthly Sales</a>

<a href="admin_orders.php">Manage Orders</a>

<a href="create_admin.php">Create Admin</a>

<a href="logout.php">Logout</a>

</div>

<div class="main">

<div class="table-box">

<div class="title">Manage Orders</div>

<table>

<tr>

<th>Order ID</th>

<th>User ID</th>

<th>User Name</th>

<th>Product</th>

<th>Price (₹)</th>

<th>Status</th>

<th>Update</th>

</tr>

<?php

while($row=mysqli_fetch_array($result)){

?>

<tr>

<form method="post">

<td>

<?php echo $row['order_id']; ?>

<input type="hidden"

name="order_id"

value="<?php echo $row['order_id']; ?>">

</td>

<td>

<?php echo $row['user_id']; ?>

</td>

<td>

<?php echo $row['first_name']." ".$row['last_name']; ?>

</td>

<td>

<?php echo $row['name']; ?>

</td>

<td>

₹<?php echo $row['price']; ?>

</td>

<td>

<select name="status">

<option <?php if($row['status']=="Added to cart") echo "selected"; ?>>

Added to cart

</option>

<option <?php if($row['status']=="Confirmed") echo "selected"; ?>>

Confirmed

</option>

<option <?php if($row['status']=="Shipped") echo "selected"; ?>>

Shipped

</option>

<option <?php if($row['status']=="Out for Delivery") echo "selected"; ?>>

Out for Delivery

</option>

<option <?php if($row['status']=="Delivered") echo "selected"; ?>>

Delivered

</option>

</select>

</td>

<td>

<button name="update">

Save

</button>

</td>

</form>

</tr>

<?php

}

?>

</table>

</div>

</div>

</body>

</html>