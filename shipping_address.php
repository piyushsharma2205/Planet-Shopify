<?php
require "includes/common.php";
session_start();

if(!isset($_SESSION['user_id'])){
    header("location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// get user email automatically
$user_query = "SELECT email_id FROM users WHERE id='$user_id'";
$user_result = mysqli_query($con,$user_query);
$user_row = mysqli_fetch_array($user_result);

$email = $user_row['email_id'];

if($_SERVER["REQUEST_METHOD"] == "POST"){

$fullname = $_POST['fullname'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];
$phone = $_POST['phone'];

$query = "INSERT INTO shipping_address
(fullname,address,city,state,zipcode,phone,email)

VALUES
('$fullname','$address','$city','$state','$zipcode','$phone','$email')";

mysqli_query($con,$query) or die(mysqli_error($con));

// redirect to payment page
header("location: payment.php");
exit();

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Shipping Address</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:white;
}

.address-card{
background:white;
padding:30px;
max-width:550px;
margin:60px auto;
border-radius:15px;
box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

</style>

</head>

<body>

<div class="address-card">

<h3 class="text-center mb-4">Shipping Address</h3>

<form method="POST">

<div class="mb-3">
<label>Full Name</label>
<input type="text" name="fullname" class="form-control" required>
</div>

<div class="mb-3">
<label>Address</label>
<textarea name="address" class="form-control" required></textarea>
</div>

<div class="row">

<div class="col-md-6 mb-3">
<label>City</label>
<input type="text" name="city" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>State</label>
<input type="text" name="state" class="form-control" required>
</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">
<label>Zip Code</label>
<input type="text" name="zipcode" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Phone</label>
<input type="text" name="phone" class="form-control" maxlength="10" required>
</div>

</div>

<div class="mb-3">
<label>Email</label>

<input type="email"
value="<?php echo $email; ?>"
class="form-control"
readonly>

</div>

<button type="submit" class="btn btn-success w-100">

Continue to Payment

</button>

</form>

</div>

</body>

</html>