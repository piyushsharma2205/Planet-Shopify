<?php

session_start();
require("includes/common.php");

if(!isset($_SESSION['admin'])){
header("location:admin_login.php");
exit();
}

if(isset($_POST['signup'])){

$email=$_POST['eMail'];
$first=$_POST['firstName'];
$last=$_POST['lastName'];
$password=md5($_POST['password']);

$query="

INSERT INTO admins
(email_id,first_name,last_name,password)

VALUES
('$email','$first','$last','$password')

";

mysqli_query($con,$query);

$msg="Admin Created Successfully";

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Create Admin</title>

<link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

</head>

<body style="background:#f3f4f6">

<div class="container" style="margin-top:80px">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card">

<div class="card-header">

<h4>Create Admin</h4>

</div>

<div class="card-body">

<form method="post">

<div class="form-group">

<label>Email address:</label>

<input type="email"

name="eMail"

class="form-control"

placeholder="Enter email"

required>

</div>

<div class="form-group">

<label>Password:</label>

<input type="password"

name="password"

class="form-control"

placeholder="Password"

required>

</div>

<div class="form-row">

<div class="form-group col-md-6">

<label>First Name</label>

<input type="text"

name="firstName"

class="form-control"

placeholder="First Name"

required>

</div>

<div class="form-group col-md-6">

<label>Last Name</label>

<input type="text"

name="lastName"

class="form-control"

placeholder="Last Name">

</div>

</div>

<div class="form-group form-check">

<input type="checkbox"

class="form-check-input"

required>

<label class="form-check-label">

Agree terms and Condition

</label>

</div>

<button name="signup"

class="btn btn-primary btn-block">

Create Admin

</button>

</form>

<?php

if(isset($msg)){
echo "<p class='text-success mt-2'>$msg</p>";
}

?>

</div>

<div class="card-footer text-center">

<a href="admin_dashboard.php">

Back to Dashboard

</a>

</div>

</div>

</div>

</div>

</div>

</body>

</html>