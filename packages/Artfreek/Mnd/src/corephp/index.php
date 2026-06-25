<?php
session_start();
require('config.php');
$error = '';
$success = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "select * from users where email = '$username' or username = '$username'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {

    $data = mysqli_fetch_assoc($result);

    if(password_verify($password,$data['password'])) {

        $_SESSION['user_id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];

        $success = "Login successfull";
        header("Location: dashboard.php");
    }
    else {
        $error = "Invalid password";
    }

    }
    else {
        $error = "Invalid username or email id";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IIT-MANDI Portal</title>

<style>
    .hd {
        margin-left: 150px;
    }
    #formid {
        border: 2px solid black;
        border-radius:10px;
        margin-top: 300px;
       margin-left: 350px;
       padding: 20px;
       width: 40%;
    }
</style>
<link href="assets/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body>
  
<div class="container">

<div class="row justify-content" id="formid">
    <div class="col-md-12">

<?php if($error): ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<?php if($success): ?>
<div class="alert alert-success"><?php echo $success; ?></div>
<?php endif; ?>

<h3 class="hd">User Login</h3>

<form method="POST">

<div class="col-md-12">
<label>Username/Email</label>
<input type="text" class="form-control" name="username" id="username" required/>
</div>

<div class="col-md-12">
<label>Password</label>
<input type="password" class="form-control" name="password" id="password" required/>
</div>

<br>
<button type="submit" class="btn btn-primary" name="submit">Submit</button>
<button type="reset" class="btn btn-danger" name="reset">Reset</button>
<br>
<a href="registration.php">Don't have userid ! Please sign-up</a>

</form>

</div>

</div>
</div>

</body>
<script src="assets/js/bootstrap.min.js" ></script>
<script src="assets/js/bootstrap.bundle.min.js" ></script>
</html>