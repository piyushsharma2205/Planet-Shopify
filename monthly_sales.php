<?php

session_start();
require("includes/common.php");

if(!isset($_SESSION['admin'])){
    header("location:admin_login.php");
    exit();
}

// default values
$start_date = "";
$end_date = "";

// build query
if(isset($_GET['start_date']) && isset($_GET['end_date'])){

    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    $query="

    SELECT 
    products.name,
    COUNT(users_products.item_id) AS quantity,
    SUM(products.price) AS total_sale

    FROM users_products

    JOIN products
    ON users_products.item_id = products.id

    WHERE users_products.status='Confirmed'
    AND DATE(users_products.order_date)
    BETWEEN '$start_date' AND '$end_date'

    GROUP BY users_products.item_id

    ";

}else{

    // show all sales if no filter
    $query="

    SELECT 
    products.name,
    COUNT(users_products.item_id) AS quantity,
    SUM(products.price) AS total_sale

    FROM users_products

    JOIN products
    ON users_products.item_id = products.id

    WHERE users_products.status='Confirmed'

    GROUP BY users_products.item_id

    ";
}

$result=mysqli_query($con,$query);

?>

<!DOCTYPE html>

<html>

<head>

<title>Sales Report</title>

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

.box{
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 4px 10px rgba(0,0,0,0.05);
}

input,button{
padding:10px;
margin-top:10px;
margin-right:10px;
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
}

td{
padding:12px;
border-bottom:1px solid #eee;
}

.total{
font-weight:bold;
background:#f9fafb;
}

</style>

</head>

<body>

<div class="sidebar">

<h2 style="text-align:center;">Admin Panel</h2>

<a href="admin_dashboard.php">Dashboard</a>

<a href="monthly_sales.php">Sales Report</a>

<a href="admin_orders.php">Manage Orders</a>

<a href="create_admin.php">Create Admin</a>

<a href="logout.php">Logout</a>

</div>

<div class="main">

<div class="box">

<h2>Sales Report (Date Wise)</h2>

<form method="get">

<label>Start Date:</label>
<input type="date" name="start_date" required
value="<?php echo $start_date; ?>">

<label>End Date:</label>
<input type="date" name="end_date" required
value="<?php echo $end_date; ?>">

<button type="submit">Filter</button>

<a href="monthly_sales.php">
<button type="button">Reset</button>
</a>

</form>

<table>

<tr>

<th>Product</th>
<th>Quantity Sold</th>
<th>Total Sale (₹)</th>

</tr>

<?php

$total=0;

while($row=mysqli_fetch_array($result)){

$total += $row['total_sale'];

echo "

<tr>

<td>".$row['name']."</td>

<td>".$row['quantity']."</td>

<td>₹".$row['total_sale']."</td>

</tr>

";

}

?>

<tr class="total">

<th colspan="2">Total Revenue</th>

<th>₹<?php echo $total; ?></th>

</tr>

</table>

</div>

</div>

</body>

</html>