<?php

session_start();
require("includes/common.php");

if(isset($_POST['login'])){

$email=$_POST['lemail'];
$password=md5($_POST['lpassword']);

$query="
SELECT * FROM admins
WHERE email_id='$email'
AND password='$password'
";

$result=mysqli_query($con,$query);

if(mysqli_num_rows($result)>0){

$row=mysqli_fetch_array($result);

$_SESSION['admin']=$row['email_id'];

header("location:admin_dashboard.php");

}else{

$error="Invalid Email or Password";

}

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Admin Login</title>

<link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

</head>

<body style="background:#f3f4f6">

<div class="container" style="margin-top:100px">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card">

<div class="card-header">

<h4>Login</h4>

</div>

<div class="card-body">

<form method="post">

<div class="form-group">

<label>Email address:</label>

<input type="email"

name="lemail"

class="form-control"

placeholder="Enter email"

required>

</div>

<div class="form-group">

<label>Password:</label>

<input type="password"

name="lpassword"

class="form-control"

placeholder="Password"

required>

</div>

<div class="form-check">

<input type="checkbox"

class="form-check-input" required>

<label class="form-check-label">

Check me out

</label>

</div>

<button name="login"

class="btn btn-secondary btn-block mt-3">

Login

</button>

</form>
<?php

if(isset($error)){

echo "<p class='text-danger mt-2'>$error</p>";

}

?>

</div>

<div class="text-center mt-3">

<a href="index.php">

<button class="btn btn-secondary">

Close

</button>

</a>

</div>

</div>

</div>

</div>

</div>

</body>

</html>