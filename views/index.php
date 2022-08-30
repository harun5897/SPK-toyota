<?php
session_start();
include_once('../modules/Connection.php');
include_once('../modules/LoginAccess.php');

if(isset($_GET['alertFailureLogin'])) {
  ?>
    <script>var alertFailureLogin = true;</script>
  <?php
}

if(isset($_GET['alertFailedChangePassword'])) {
  ?>
    <script>var alertFailedChangePassword = true;</script>
  <?php
}
if(isset($_GET['alertSuccessChangePassword'])) {
  ?>
    <script>var alertSuccessChangePassword = true;</script>
  <?php
}

if(isset($_POST['getLogin'])) {
  getLogin($connection, $_POST['email'], $_POST['password']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/scss/main/main.css">
  <title>Toyota</title>
</head>
<body>
  <div id="login">
    <div class="login w-100 h-100 bg-light d-flex justify-content-center align-items-center position-absolute">
      <div class="card w-25 border-0 shadow-lg">
        <div class="card-footer bg-white shadow-sm text-center rounded-3 border-0">
          <img src="../assets/icon/logo.png" alt="" width="300px">
        </div>
        <div class="card-body rounded-3 p-4">
          <form action="" method="POST">
            <label for="" class="fw-bold">Email</label>
            <input type="email" class="form-control" placeholder="Input Email" aria-label="Server" name="email">
            <label for="" class="mt-3 fw-bold">Password</label>
            <input type="password" class="form-control" placeholder="Input Password" aria-label="Server" name="password">
            <div class="d-flex justify-content-end mt-3">
              <button type="submit" class="btn btn-primary rounded-0 border-0" name="getLogin">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    if(alertFailureLogin) {
      swal({
        title: "Login Failed",
        text: "Your Email or Password is incorrect",
        buttons: 'OK',
        icon: 'warning',
      });
    }
  </script>
  <script>
    if(alertFailedChangePassword) {
      swal({
        title: "Failed",
        text: "Change Password Failed",
        buttons: 'OK',
        icon: 'warning',
      });
    }
  </script>
  <script>
    if(alertSuccessChangePassword) {
      swal({
        title: "Success",
        text: "Change Password Success",
        buttons: false,
        icon: "success",
        timer: 2000,
      });
    }
  </script>
</body>
</html>