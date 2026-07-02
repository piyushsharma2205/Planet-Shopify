<?php
session_start();

if(!isset($_SESSION['admin'])){
header("location:admin_login.php");
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

body{
margin:0;
font-family:Poppins;
background:#f5f6fa;
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
margin-bottom:30px;
}

.sidebar a{
display:block;
padding:15px;
color:white;
text-decoration:none;
transition:0.3s;
}

.sidebar a:hover{
background:#2563eb;
padding-left:20px;
}

.main{
margin-left:240px;
padding:30px;
}

.card-container{
display:flex;
gap:20px;
margin-bottom:30px;
}

.card{
flex:1;
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 4px 10px rgba(0,0,0,0.05);
}

.card h3{
margin:0;
color:#555;
}

.card p{
font-size:22px;
font-weight:bold;
margin-top:10px;
}

</style>

</head>

<body>

<div class="sidebar">

<h2>Admin Panel</h2>

<a href="admin_dashboard.php">Dashboard</a>

<a href="monthly_sales.php">Monthly Sales</a>

<a href="admin_orders.php">Manage Orders</a>

<a href="create_admin.php">Create Admin</a>

<a href="logout.php">Logout</a>

</div>

<div class="main">

<h1>Dashboard</h1>

<div class="card-container">

<div class="card">
<h3>Total Products</h3>
<p>View in Sales Page</p>
</div>

<div class="card">
<h3>Monthly Revenue</h3>
<p>Auto Calculated</p>
</div>

<div class="card">
<h3>Admins</h3>
<p>Manage Access</p>
</div>

</div>

<p>Select option from sidebar</p>

</div>

</body>

</html>